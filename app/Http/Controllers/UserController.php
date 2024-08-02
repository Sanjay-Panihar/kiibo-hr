<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $users = User::with('roles')->select('id', 'name', 'email', 'last_login_at', 'status')->where('id', '<>', auth()->user()->id);
            return DataTables::of($users)
                ->addColumn('status', function ($row) {
                    return $row->status ? '<button class="btn btn-success btn-sm">Active</button>' : '<button class="btn btn-danger btn-sm">Inactive</button>';
                })
                ->addColumn('roles', function ($row) {
                    return $row->roles ? $row->roles->pluck('name')->implode(', ') : 'N/A'; // Access the role's name
                })
                ->addColumn('created_by', function ($row) {
                    return $row->user ? $row->user->name : 'N/A';
                })
                ->addColumn('actions', function ($row) {
                    $btn = '<a href="' . route('admin.users.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>';
                    $btn .= '<form action="' . route('admin.users.destroy', $row->id) . '" method="POST" style="display:inline-block;">
                                 ' . csrf_field() . '
                                 ' . method_field('DELETE') . '
                                 <button type="submit" class="btn btn-danger btn-sm delete-btn"><i class="ti ti-trash"></i></button>
                             </form>';
                    return $btn;
                })
                ->rawColumns(['status', 'actions', 'role'])
                ->make(true);
        }
        return view('admin.users.index');
    }
    public function create()
    {
        $roles = Role::select('name', 'id')->get();

        return view('admin.users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        return $this->updateOrCreate($request);
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::select('name', 'id')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }
    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        return $this->updateOrCreate($request);
    }
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
    private function updateOrCreate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
                'password' => $request->id ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
                'role_id' => 'required|exists:roles,id',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            } else {
                $data = $request->all();
                if ($request->id) {
                    $data['updated_by'] = auth()->user()->id;
                } else {
                    $data['created_by'] = auth()->user()->id;
                }

                if ($request->password) {
                    $data['password'] = Hash::make($request->password);
                }
                
                $user = User::updateOrCreate(['id' => $request->id], $data);
                if($request->role_id) {
                    $role = Role::find($request->role_id);
                    $user->syncRoles($role->name);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'User ' . ($request->id ? 'updated' : 'created') . ' successfully'
                ], 200);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([ 'status' => false, 'message' => 'An error occurred: ' . $e->getMessage(),], 500);

        }
    }
}
