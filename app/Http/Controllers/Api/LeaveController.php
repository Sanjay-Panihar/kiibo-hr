<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Leave;

class LeaveController extends Controller
{
    public function store(Request $request)
    {
        $this->updateOrCreate($request);
    }
    public function update(Request $request, $id)
    {
        $this->updateOrCreate($request, $id);
    }
    public function updateOrCreate(Request $request, $id = null)
    {
        \Log::info('Request data: ', $request->all());

        try {
            Log::info('Request data: ', $request->all());
    
            $data = $request->all();
            $validator = Validator::make($data, [
                'start_date'    => 'required|date|after:yesterday',
                'end_date'      => 'required|date|after:start_date',
                'reason'        => 'required|max:255|string',
                'no_of_days'    => 'required|numeric',
                'leave_type'    => 'required|numeric',
            ]);
    
            if ($validator->fails()) {
                Log::error('Validation errors: ', $validator->errors()->toArray());
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }
    
            $data['created_by'] = Auth::user()->id;
            $data['applied_on'] = date('Y-m-d');
    
            $leave = Leave::updateOrCreate(
                ['id' => $id],
                $data
            );
    
            $message = $id ? 'Leave updated successfully' : 'Leave applied successfully';
    
            return response()->json(['success' => true, 'message' => $message, 'leave' => $leave], 200);
    
        } catch (\Exception $e) {
            Log::error('Exception: ', ['message' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
