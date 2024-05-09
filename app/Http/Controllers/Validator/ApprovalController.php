<?php

namespace App\Http\Controllers\Validator;

use App\Http\Controllers\Controller;
use App\Models\Request as RequestModel;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        return view('validator.approval.index');
    }

    public function show(RequestModel $req)
    {
        return view('validator.approval.show', [
            'request' => $req,
        ]);
    }

    public function update(Request $request, RequestModel $req)
    {
        $validated = $request->validate([
            'valid_to_borrow' => 'nullable',
            'valid_to_use' => 'nullable',
        ]);

        if ($validated['valid_to_borrow'] && is_null($req->valid_to_borrow_at)) {
            $validated['valid_to_borrow_at'] = now();
        }
        if ($validated['valid_to_use'] && is_null($req->valid_to_use_at)) {
            $validated['valid_to_use_at'] = now();
        }
    
        unset($validated['valid_to_borrow'], $validated['valid_to_use']);

        $req->update($validated);

        return redirect()->route('validator.approval')->with('success', 'Request updated successfully.');
    }
}
