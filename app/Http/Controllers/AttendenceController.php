<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendence;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class AttendenceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $type = $request->query('type', 'monthly');
            $attendence = Attendence::with('user:id,name')->select('id', 'day', 'date', 'type', 'punch_in', 'punch_out', 'hours', 'A_R', 'L_R', 'SHR_H', 'W_H');
            switch ($type) {
                case 'monthly':
                    $attendence->whereYear('date', date('Y'));
                    $attendence->whereMonth('date', date('m'));
                    break;
                case 'yearly':
                    $attendence->whereYear('date', date('Y'));
                    break;
                default:
                    $attendence->whereYear('date', date('Y'));
                    $attendence->whereMonth('date', date('m'));
                    break;
            }
            return DataTables::of($attendence)
                ->addColumn('actions', function ($row) {
                    $btn = '<button class="btn btn-primary btn-sm" onclick="editLeave(' . $row->id . ')"><i class="ti ti-edit"></i></button>';
                    $btn .= '<form action="' . route('admin.leave.delete', $row->id) . '" method="POST" style="display:inline-block;">
                                 ' . csrf_field() . '
                                 ' . method_field('DELETE') . '
                                 <button type="submit" class="btn btn-danger btn-sm delete-btn"><i class="ti ti-trash"></i></button>
                             </form>';
                    return $btn;
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);

        }
        return view('admin.attendence.index');
    }
    public function edit($id)
    {
        $attendence = Attendence::select('id', 'day', 'date', 'type', 'punch_in', 'punch_out', 'hours', 'reason')->find($id);

        return response()->json(['success' => true, 'attendence' => $attendence], 200);
    }

    public function update(Request $request, $id)
{
    try {
        $validator = Validator::make($request->all(), [
            'punch_in'  => 'required|date_format:H:i:s',
            'punch_out' => 'required|date_format:H:i:s|after:punch_in',
            'hours'     => 'required',
            'reason'    => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        } else {
            $attendance = Attendence::find($id);
            $attendance->update($request->all());

            return response()->json(['status' => true, 'message' => 'Attendance updated successfully'], 200);
        }
    } catch (\Exception $e) {
        return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
    }
}

}
