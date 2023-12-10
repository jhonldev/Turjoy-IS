<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\RouteImport;
use App\Imports\RoutesImport;
use App\Models\Route;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class RouteImportController extends Controller
{
    /**
     * Display the add routes index view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function indexAddRoutes() {
        if (session('validRows') || session('invalidRows') || session('duplicatedRows')) {
            session()->put('validRows', []);
            session()->put('invalidRows', []);
            session()->put('duplicatedRows', []);
        } else {
            session(['validRows' => []]);
            session(['invalidRows' => []]);
            session(['duplicatedRows' => []]);
        }
        return view('admin.routes.routes', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows'),
        ]);
    }

    /**
     * Display the routes index view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function indexRoutes() {
        return view('admin.routes.routes', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows')
        ]);
    }

    /**
     * Check and import routes from the uploaded file.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function routeCheck(Request $request) {
        $messages = makeMessages();
        $this->validate($request, [
            'file' => ['required', 'max:5120', 'mimes:xlsx']
        ], $messages);

        $file = $request->file('file');
        $rows = Excel::toArray(new RoutesImport, $file)[0];

        if($rows[0][0] != 'Origen' || $rows[0][1] != 'Destino' || $rows[0][2] != 'Cantidad de asientos' || $rows[0][3] != 'Tarifa base'){
            $error = $messages['file.inputs'];
            return back()->withErrors(['file' => $error]);
        }

        if ($request->hasFile('file')) {
            $file = request()->file('file');
            $import = new RoutesImport();
            Excel::import($import, $file);

            $validRows = $import->getValidRows();
            $invalidRows = $import->getInvalidRows();
            $duplicatedRows = $import->getDuplicatedRows();

            foreach ($validRows as $row){

                $origin = $row[0];
                $destination = $row[1];

                $route = Route::where('origin', $origin)->where('destination', $destination)->first();

                if ($route) {
                    $route->update([
                        'available_seats' => $row[2],
                        'base_rate' => $row[3],
                    ]);
                } else {
                    Route::create([
                        'origin' => $origin,
                        'destination' => $destination,
                        'available_seats' => $row[2],
                        'base_rate' => $row[3],
                        'iduser' =>  auth()->user()->id,
                    ]);
                }
            }
            $invalidRows = array_filter($invalidRows, function($invalidrow) {
                return $invalidrow[0] !== null || $invalidrow[1] !== null || $invalidrow[2] !== null || $invalidrow[3] !== null;
            });

            session()->put('validRows', $validRows);
            session()->put('invalidRows', $invalidRows);
            session()->put('duplicatedRows', $duplicatedRows);

            return redirect()->route('routesAdd.index');
        }
    }
}
