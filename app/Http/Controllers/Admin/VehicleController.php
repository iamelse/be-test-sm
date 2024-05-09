<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        return view('admin.vehicle.index');
    }

    public function create()
    {
        $vehicles = Vehicle::all();

        return view('admin.vehicle.create', [
            'vehicles' => $vehicles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|digits:4',
            'color' => 'required|string|max:255',
        ]);

        $vehicle = new Vehicle();
        $vehicle->brand = $request->input('brand');
        $vehicle->model = $request->input('model');
        $vehicle->year = $request->input('year');
        $vehicle->color = $request->input('color');
        $vehicle->save();

        return redirect()->route('admin.vehicle')->with('success', 'Vehicle created successfully');
    }

    public function edit(Vehicle $vehicle)
    {
        $vehicle = Vehicle::findOrFail($vehicle->id);

        return view('admin.vehicle.edit', [
            'vehicle' => $vehicle
        ]);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|digits:4',
            'color' => 'required|string|max:255',
        ]);

        $vehicle = Vehicle::findOrFail($vehicle->id);

        $vehicle->brand = $request->input('brand');
        $vehicle->model = $request->input('model');
        $vehicle->year = $request->input('year');
        $vehicle->color = $request->input('color');
        $vehicle->save();

        return redirect()->route('admin.vehicle')->with('success', 'Vehicle updated successfully');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle = Vehicle::findOrFail($vehicle->id);

        $vehicle->delete();

        return redirect()->route('admin.vehicle')->with('success', 'Vehicle deleted successfully');
    }
}
