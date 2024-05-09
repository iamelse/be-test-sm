<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportRequest;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Request as RequestModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RequestController extends Controller
{
    public function index()
    {
        return view('admin.request.index');
    }

    public function create()
    {
        $drivers = User::whereHas('role', function ($query) {
            $query->where('name', 'Driver');
        })->get();
    
        $validators = User::whereHas('role', function ($query) {
            $query->where('name', 'Validator');
        })->get();
    
        $vehicles = Vehicle::all();

        return view('admin.request.create', [
            'drivers' => $drivers,
            'validators' => $validators,
            'vehicles' => $vehicles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:users,id',
            'validator_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $req = new RequestModel();
        $req->driver_id = $request->input('driver_id');
        $req->validator_id = $request->input('validator_id');
        $req->vehicle_id = $request->input('vehicle_id');
        $req->save();

        return redirect()->route('admin.request')->with('success', 'Request created successfully');
    }

    public function exportRequestAsExcel(Request $request){
        return Excel::download(new ExportRequest, 'request-vehicle.xlsx', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportRequestAsCsv(Request $request){
        return Excel::download(new ExportRequest, 'request-vehicle.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
