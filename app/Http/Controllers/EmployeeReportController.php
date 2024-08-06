<?php

namespace App\Http\Controllers;

use App\Models\EmployeeReport;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Validator;
use App\Models\Designation;

class EmployeeReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $event = EmployeeReport::with('user:id,name')->select('id',  'emp_code', 'salutation', 'first_name','last_name', 'email', 'phone', 'address', 'designation', 'department', 'date_of_joining', 'date_of_birth', 'gender', 'blood_group', 'marital_status', 'location', 'image', 'department_head', 'reporting_manager', 'role_id', 'notice_period', 'entity',);
            return DataTables::of($event)
                ->addColumn('status', function($row){
                    return $row->status ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('created_by', function ($row) {
                    return $row->user ? $row->user->name : 'N/A';
                })
                ->addColumn('actions', function($row){
                    $btn = '<a href="'.route('admin.employee-report.edit', $row->id).'" class="edit btn btn-primary btn-sm"><i class="ti ti-edit"></i></a>';
                    $btn .= '<form action="'.route('admin.employee-report.destroy', $row->id).'" method="POST" style="display:inline-block;">
                                 '.csrf_field().'
                                 '.method_field('DELETE').'
                                 <button type="submit" class="btn btn-danger btn-sm delete-btn"><i class="ti ti-trash"></i></button>
                             </form>';
                    return $btn;
                })
                ->rawColumns(['status','actions'])
                ->make(true);
        }
        return view('admin.employee-report.index');
    }
    public function create()
    {
        $designations = Designation::select('id', 'name')->where('status', 1)->get();

        return view('admin.employee-report.create', compact('designations'));
    }

    public function store(Request $request)
    {
        return $this->addOrUpdate($request);
    }

    public function edit($id)
    {
        $employeeReport = EmployeeReport::find($id);
        $designations = Designation::select('id', 'name')->where('status', 1)->get();

        return view('admin.employee-report.edit', compact('employeeReport', 'designations'));
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        return $this->addOrUpdate($request);
    }

    public function destroy($id)
    {
        $employee = EmployeeReport::find($id);
        if(!empty($employee->image)){
            unlink(public_path('storage/'.$employee->image));
        }
        $employee->delete();
        return redirect()->route('admin.employee-report.index')->with('message', 'Employee Report Deleted Successfully');
    }

    public function addOrUpdate(Request $request)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'emp_code'          => 'required|string|max:10',
                'salutation'        => 'required|string|max:5',
                'first_name'        => 'required|string|max:50',
                'middle_name'       => 'nullable|string|max:50',
                'last_name'         => 'required|string|max:50',
                'email'             => 'required|string|email|max:50|unique:users,email,' . $request->id,
                'phone'             => 'required|numeric|digits:10',
                'address'           => 'nullable|string|max:255',
                'designation'       => 'required|string|max:50',
                'department'        => 'required|string|max:30',
                'date_of_joining'   => 'required|date',
                'date_of_birth'     => 'required|date',
                'gender'            => 'required|in:1,2,3',
                'blood_group'       => 'nullable|string|max:5',
                'marital_status'    => 'required|numeric|in:0,1',
                'location'          => 'required|string|max:255',
                'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'department_head'   => 'nullable|string|max:50',
                'reporting_manager' => 'nullable|string|max:50',
                'role_id'           => 'nullable|exists:roles,id|numeric',
                'notice_period'     => 'nullable|numeric',
                'entity'            => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('image')) {
                $imagePath = Helper::saveImage($request->file('image'), 'employee-report');
                $data['image'] = $imagePath;
            }

            if ($request->has('id')) {
                $action = 'update';
                $data['updated_by'] = Auth::user()->id;
            } else {
                $action = 'create';
                $data['created_by'] = Auth::user()->id;
            }
           
            EmployeeReport::updateOrCreate(['id' => $request->id], $data);

            return redirect()->route('admin.employee-report.index')->with('message', 'Employee Report ' . $action . ' Successfully');

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

}
