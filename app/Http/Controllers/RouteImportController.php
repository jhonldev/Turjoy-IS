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
    public function indexAddRoutes()
    {
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

    public function indexRoutes()
    {
        return view('admin.routes.routes', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows')
        ]);
    }

    public function routeCheck(Request $request)
    {
        $messages = makeMessages();
        $this->validate($request, [
            'file' => ['required', 'max:5120', 'mimes:xlsx']
        ], $messages);

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

    public function registerIndex (){
        $travels = Route::get()->count();
        return view('register',[
            'countTravels' => $travels,
        ]);
    }

    public function originIndex (){

        $origins = Route::distinct()->orderBy('origin', 'asc')->pluck('origin');

        return response()->json([
            'origins' =>$origins,
        ]);
    }

    public function searchDestinations($origin){

        $destinations = Route::where('origin', $origin)->orderBy('destination', 'asc')->pluck('destination');

        return response()->json([
            'destination' =>$destinations,
        ]);
    }
}
