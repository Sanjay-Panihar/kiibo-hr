<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Timesheet;

class TimesheetController extends Controller
{
    public function index()
    {
        return view('admin.timesheet.index');
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'date'           => 'required|date_format:Y-m-d',
                'duration'       => 'required',
                'client'         => 'nullable|string|max:50',
                'project'        => 'nullable|string|max:50',
                'task'           => 'nullable|string|max:50',
                'billing_method' => 'required|in:1,2,3',
                'description'    => 'nullable|string|max:255',
                'leave_type'     => 'nullable|in:1,2,3,4,5,6,7',
                'type'           => 'required|in:1,2,3',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            } else {
                $request['created_by'] = auth()->user()->id;
                $timesheet = Timesheet::create($request->all());
                return response()->json(['success' => true, 'message' => 'Timesheet created successfully', 'timesheet' => $timesheet], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
