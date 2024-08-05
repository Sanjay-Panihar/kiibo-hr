<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::select('id', 'name')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $btn = '';

                    if (auth()->user()->can('update roles')) {
                        $btn .= '<a href="' . route('admin.roles.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>';
                    }

                    if (auth()->user()->can('delete roles')) {
                        $btn .= '<form action="' . route('admin.roles.destroy', $row->id) . '" method="POST" style="display:inline-block;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn"><i class="ti ti-trash"></i></button>
                                </form>';
                    }

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
        return view('admin.roles.index');
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);
        $role = Role::create(['name' => $request->name]);
        return redirect()->route('admin.roles.index')->with('message', 'Role created successfully!');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
        ]);
        $role = Role::find($id);
        $role->update(['name' => $request->name]);
        return redirect()->route('admin.roles.index')->with('message', 'Role updated successfully!');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('admin.roles.index')->with('message', 'Role deleted successfully!');
    }

}
