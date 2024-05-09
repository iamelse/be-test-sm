<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        try {
            $vehicles = Vehicle::all();
            
            $data = [];
            $index = 1;
            foreach ($vehicles as $vehicle) {
                $data[] = [
                    'DT_RowIndex' => $index++,
                    'id' => $vehicle->id,
                    'brand' => $vehicle->brand,
                    'model' => $vehicle->model,
                    'year' => $vehicle->year,
                    'color' => $vehicle->color
                ];
            }
            
            $response = [
                'message' => 'Success',
                'status_code' => 200,
                'data' => $data
            ];

            return response()->json($response);
        } catch (QueryException $e) {
            $response = [
                'message' => 'Database error',
                'status_code' => 500,
                'error' => $e->getMessage()
            ];
            
            return response()->json($response, 500);
        } catch (\Exception $e) {
            $response = [
                'message' => 'Internal server error',
                'status_code' => 500,
                'error' => $e->getMessage()
            ];
            
            return response()->json($response, 500);
        }
    }
}
