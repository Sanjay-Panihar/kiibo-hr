<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendence;
use Yajra\DataTables\DataTables;

class AttendenceController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
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
                ->addColumn('status', function ($row) {
                    return $row->status ? '<span class="btn btn-primary btn-sm">Active</span>' : '<span class="btn btn-danger btn-sm">Inactive</span>';
                })
                ->addColumn('created_by', function ($row) {
                    return $row->user ? $row->user->name : 'N/A';
                })
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
}
