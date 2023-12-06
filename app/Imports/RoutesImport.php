<?php

namespace App\Imports;

use App\Models\Route;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RoutesImport implements ToCollection, WithHeadings, WithStartRow
{
    protected $validRows = [];
    protected $invalidRows = [];
    protected $duplicatedRows = [];
    protected $existingOriginsDestinations = [];

    public function collection(Collection $rows)
    {
        $messages = makeMessages();

        unset($rows[0]);

        if (count(array_filter($rows->toArray(), 'array_filter')) === 0) {
            $error = $messages['file.empty'];
            return back()->withErrors(['file' => $error]);
        }

        foreach ($rows->slice(1) as $row) {
            $origin = $row[0];
            $destination = $row[1];
            $available_seats = $row[2];
            $base_rate = $row[3];
            if (!preg_match("/^[A-Za-z\s]+$/", $origin)) {
                $this->invalidRows[] = $row;
                continue;
            }
            if (!preg_match("/^[A-Za-z\s]+$/", $destination)) {
                $this->invalidRows[] = $row;
                continue;
            }
            if (str_replace(' ', '', strtolower($origin)) == str_replace(' ', '', strtolower($destination))) {
                $this->invalidRows[] = $row;
                continue;
            }
            if (!(is_numeric($available_seats)) || !($available_seats >= 0)) {
                $this->invalidRows[] = $row;
                continue;
            }
            if (!(is_numeric($base_rate)) || !($base_rate >= 0)) {
                $this->invalidRows[] = $row;
                continue;
            }
            if ($this->hasDuplicateOriginDestination($origin, $destination)) {
                $this->duplicatedRows[] = $row;
                continue;
            }
            $this->validRows[] = $row;
            $this->existingOriginsDestinations[] = $origin . '-' . $destination;
        }
    }

    public function hasDuplicateOriginDestination($origin, $destination)
    {
        $key = $origin . '-' . $destination;
        return in_array($key, $this->existingOriginsDestinations);
    }

    public function getValidRows()
    {
        return $this->validRows;
    }

    public function getInvalidRows()
    {
        return $this->invalidRows;
    }

    public function getDuplicatedRows()
    {
        return $this->duplicatedRows;
    }

    public function headings(): array
    {
        return [
            'origin',
            'destination',
            'available_seats',
            'base_rate',
        ];
    }

    public function startRow(): int
    {
        return 1;
    }
}
