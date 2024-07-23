@extends('layouts.app')

@section('title', 'Add Employee')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('admin.partials.sidebar')
    <div class="body-wrapper">
        @include('admin.partials.header')
        <div class="container-fluid">
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Add Employee</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary"><i class="ti ti-arrow-left"></i> Back</button>
                    </div>
                </div>
            </div>
            <div class="content-box">
                <div class="content active">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.employee-report.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="emp_code" class="form-label">Employee Code</label>
                                    <input type="text" class="form-control @error('emp_code') is-invalid @enderror"
                                        id="emp_code" name="emp_code" value="{{ old('emp_code') }}" maxlength="10" required>
                                    @error('emp_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender"
                                        class="form-control @error('gender') is-invalid @enderror">
                                        <option value="">Select Gender</option>
                                        <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Male</option>
                                        <option value="2" {{ old('gender') == '2' ? 'selected' : ''}}> Female</option>
                                        <option value="3" {{ old('Other') == '3' ? 'selected' : ''}}> Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="date_of_joining" class="form-label">Joining Date</label>
                                    <input type="date" class="form-control @error('date_of_joining') is-invalid @enderror"
                                        id="date_of_joining" name="date_of_joining" value="{{ old('date_of_joining') }}"
                                        required>
                                    @error('date_of_joining')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="notice_period" class="form-label">Notice Period</label>
                                    <input type="text" class="form-control @error('notice_period') is-invalid @enderror"
                                        id="notice_period" name="notice_period" value="{{ old('notice_period') }}"
                                        required>
                                    @error('notice_period')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="entity" class="form-label">Entity</label>
                                    <input type="text" class="form-control @error('entity') is-invalid @enderror"
                                        id="entity" name="entity" value="{{ old('entity') }}" required>
                                    @error('entity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Role</label>
                                    <select name="role_id" id="role_id"
                                        class="form-control @error('role_id') is-invalid @enderror">
                                        <option value="">Select Role</option>
                                        <!-- Add role options here -->
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" value="{{ old('image') }}">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Marital Status</label>
                                    <select name="marital_status" id="marital_status"
                                        class="form-select @error('marital_status') is-invalid @enderror">
                                        <option selected disabled>Select Marital Status</option>
                                        <option value="1" {{ old('marital_status') == '1' ? 'selected' : '' }}>Married
                                        </option>
                                        <option value="0" {{ old('marital_status') == '0' ? 'selected' : '' }}>Unmarried
                                        </option>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="salutation" class="form-label">Salutation</label>
                                <select name="salutation" id="salutation"
                                    class="form-select @error('salutation') is-invalid @enderror">
                                    <option selected disabled>Select Salutation</option>
                                    <option value="Mr." {{ old('salutation') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                                    <option value="Mrs." {{ old('salutation') == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                                    <option value="Miss." {{ old('salutation') == 'Miss.' ? 'selected' : '' }}>Miss.
                                    </option>
                                    <option value="Dr." {{ old('salutation') == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                                </select>
                                @error('salutation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control @error('middle_name') is-invalid @enderror"
                                    id="middle_name" name="middle_name" value="{{ old('middle_name') }}" required>
                                @error('middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" value="{{ old('phone') }}" maxlength="10" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                    id="designation" name="designation" value="{{ old('designation') }}" required>
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control @error('department') is-invalid @enderror"
                                    id="department" name="department" value="{{ old('department') }}" required>
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                @error('dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="reporting_manager" class="form-label">Reporting Manager</label>
                                <input type="text" class="form-control @error('reporting_manager') is-invalid @enderror"
                                    id="reporting_manager" name="reporting_manager"
                                    value="{{ old('reporting_manager') }}" required>
                                @error('reporting_manager')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="department_head" class="form-label">Department Head</label>
                                <input type="text" class="form-control @error('department_head') is-invalid @enderror"
                                    id="department_head" name="department_head" value="{{ old('department_head') }}"
                                    required>
                                @error('department_head')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                    id="location" name="location" value="{{ old('location') }}" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="blood_group" class="form-label">Blood Group</label>
                                <select class="form-select @error('blood_group') is-invalid @enderror" id="blood_group"
                                    name="blood_group" required>
                                    <option value="">Select Blood Group</option>
                                    <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                                </select>
                                @error('blood_group')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.partials.footer')
    </div>
</div>
@endsection