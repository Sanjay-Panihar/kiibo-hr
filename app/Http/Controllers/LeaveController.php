<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class LeaveController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $leave = Leave::with('user:id,name')->select('id', 'leave_type', 'applied_on', 'start_date', 'end_date','no_of_days', 'reason', 'manager','status', 'created_by');
            return DataTables::of($leave)
                ->addColumn('status', function($row){
                    return $row->status ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('leave_type', function($row){
                    return $row->leave_type_name;
                })
                ->addColumn('created_by', function ($row) {
                    return $row->user ? $row->user->name : 'N/A';
                })
                ->addColumn('actions', function($row){
                    $btn = '<a href="'.route('admin.leave.edit', $row->id).'" class="edit btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>';
                    $btn .= '<form action="'.route('admin.leave.delete', $row->id).'" method="POST" style="display:inline-block;">
                                 '.csrf_field().'
                                 '.method_field('DELETE').'
                                 <button type="submit" class="btn btn-danger btn-sm delete-btn"><i class="ti ti-trash"></i></button>
                             </form>';
                    return $btn;
                })
                ->rawColumns(['status','actions'])
                ->make(true);
        }
        return view('admin.leave.index');
    }
    public function store(Request $request)
    {
        return view('admin.leave.index');
    }
    public function edit($id)
    {
        return view('admin.leave.index');
    }
    public function delete($id)
    {
        return view('admin.leave.index');
    }
}
