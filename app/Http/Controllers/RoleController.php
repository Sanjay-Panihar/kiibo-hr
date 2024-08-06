<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:read roles|create roles|update roles|delete roles', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:create roles', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:update roles', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:delete roles', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::select('id', 'name', 'status')->latest()->get();
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
        $permissions = Permission::select('id', 'name')->where('status', 1)->get(); // Retrieve all permissions
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
       try {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
        ]);
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['status' => false, 'message' => 'Role not found.'], 404);
        }
        $role->update(['name' => $request->name]);
        if ($request->has('permissions') && !empty($request->permissions)) {
            $permissions = Permission::whereIn('id', $request->permissions)
                                     ->where('status', 1)
                                     ->pluck('name');
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]);
        }
        return response()->json(['status' => true, 'message' => 'Role updated successfully.'], 200);

       } catch (Exception $e) {
           return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
       }
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('admin.roles.index')->with('message', 'Role deleted successfully!');
    }

}
