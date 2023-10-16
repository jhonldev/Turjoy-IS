<?php

namespace App\Imports;

use App\Models\Route;
use Maatwebsite\Excel\Concerns\ToModel;

class RouteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Route([
            //
        ]);
    }
}
