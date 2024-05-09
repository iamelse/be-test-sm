<?php

namespace App\Http\Controllers\Validator\API;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        try {
            $reqs = ModelsRequest::with('driver', 'validator', 'vehicle')->get();
            
            $data = [];
            $index = 1;
            foreach ($reqs as $req) {
                $data[] = [
                    'DT_RowIndex' => $index++,
                    'id' => $req->id,
                    'driver' => $req->driver ? $req->driver : 'N/A',
                    'validator' => $req->validator ? $req->validator : 'N/A',
                    'vehicle' => $req->vehicle ? $req->vehicle : 'N/A',
                    'valid_to_borrow_at' => $req->valid_to_borrow_at,
                    'valid_to_use_at' => $req->valid_to_use_at,
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
