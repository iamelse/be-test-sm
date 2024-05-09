<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::with('role')->get();
            
            $data = [];
            $index = 1;
            foreach ($users as $user) {
                $data[] = [
                    'DT_RowIndex' => $index++,
                    'id' => $user->id,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'role' => $user->role ? $user->role : 'N/A'
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
