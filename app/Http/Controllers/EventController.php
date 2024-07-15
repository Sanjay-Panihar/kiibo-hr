<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Event;


class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $event = Event::select('id', 'name', 'start_date', 'end_date','time', 'announcements', 'total_likes', 'total_views','status', 'created_by');
            return DataTables::of($event)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return $row->status ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('actions', function($row){
                    $btn = '<a href="'.route('admin.event.edit', $row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= '<form action="'.route('admin.event.delete', $row->id).'" method="POST" style="display:inline-block;">
                                 '.csrf_field().'
                                 '.method_field('DELETE').'
                                 <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                             </form>';
                    return $btn;
                })
                ->rawColumns(['status','actions'])
                ->make(true);
        }
        return view('admin.event.index');
    }
}
