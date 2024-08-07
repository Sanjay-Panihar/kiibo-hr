<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::select('id', 'name', 'status', 'group')->latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = '<a href="' . route('admin.permissions.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>';
                $btn .= '<form action="' . route('admin.permissions.destroy', $row->id) . '" method="POST" style="display:inline-block;">
                             ' . csrf_field() . '
                             ' . method_field('DELETE') . '
                             <button type="submit" class="btn btn-danger btn-sm delete-btn"><i class="ti ti-trash"></i></button>
                         </form>';
                return $btn;
            })
            ->addColumn('status', function ($row) {
                return $row->status ? '<span class="badge bg-success-subtle text-success btn-sm">Active</span>' : '<span class="badge bg-danger-subtle text-danger btn-sm">Inactive</span>';
            })
            ->addColumn('created_by', function ($row) {
                return $row->created_by ? $row->created_by->name : 'N/A';
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }
        return view('admin.permissions.index');
    }
    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions',
            'status' => 'required|in:1,0',
        ]);
        $request['created_by'] = auth()->user()->id;
        $permission = Permission::create($request->all());
        return response()->json([ 'status' => true, 'message'=> 'Permission created successfully.']);
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);
        $permission = Permission::findOrFail($id);
        $request['updated_by'] = auth()->user()->id;
        $permission->update($request->all());
        return response()->json([ 'status' => true, 'message'=> 'Permission updated successfully.'], 200);
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('message', 'Permission deleted successfully.');
    }
}
