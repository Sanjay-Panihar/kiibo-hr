<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $type = $request->query('type', 'my_leaves');
            $query = Leave::with('user:id,name')->select('id', 'leave_type', 'applied_on', 'start_date', 'end_date', 'no_of_days', 'reason', 'manager', 'status', 'created_by');

            switch ($type) {
                case 'leave_requests':
                    $query->where('is_submitted', 1);
                    break;
                case 'saved_leaves':
                    $query->where('is_saved', 1);
                    break;
                default:
                    $query->where('created_by', auth()->user()->id);
                    break;
            }

            return DataTables::of($query)
                ->addColumn('status', function ($row) {
                    return $row->status ? '<span class="btn btn-primary btn-sm">Active</span>' : '<span class="btn btn-danger btn-sm">Inactive</span>';
                })
                ->addColumn('created_by', function ($row) {
                    return $row->user ? $row->user->name : 'N/A';
                })
                ->addColumn('leave_type', function ($row) {
                    return $row->leave_type_name;
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

        return view('admin.leave.index');
    }

    public function store(Request $request)
    {
       return $this->updateOrCreate($request);
    }
    public function update(Request $request)
    {
        return $this->updateOrCreate($request);
    }
    public function updateOrCreate(Request $request)
    {
        try {
            $data = $request->all();
            $id = $data['id'] ?? 0;
            $validator = Validator::make($data, [
                'start_date'    => 'required|date',
                'end_date'      => 'required|date|after:start_date',
                'reason'        => 'required|max:255|string',
                'no_of_days'    => 'required|numeric',
                'leave_type'    => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            } else {
                $userId = Auth::user()->id;
                $id ? $data['updated_by'] = $userId : $data['created_by'] = $userId;
                $data['applied_on'] = date('Y-m-d');

                $leave = Leave::updateOrCreate(
                    ['id' => $id],
                    $data
                );

                $message = $id ? 'Leave updated successfully' : 'Leave applied successfully';

                return response()->json(['success' => true, 'message' => $message, 'leave' => $leave], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $leave = Leave::with('user:id,name')->select('id', 'leave_type', 'applied_on', 'start_date', 'end_date', 'no_of_days', 'reason', 'manager', 'status', 'created_by')->find($id);

        return response()->json(['success' => true, 'leave' => $leave], 200);
    }
    public function delete($id)
    {
        Leave::find($id)->delete();

        return redirect()->back()->with(['success' => true, 'message' => 'Leave deleted successfully'], 200);
    }
}
