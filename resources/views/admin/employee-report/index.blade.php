@extends('layouts.app')

@section('title', 'Employee Report')

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
                        <h3>Employee Report</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.employee-report.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Add Employee</a>
                    </div>
                </div>
            </div>
            <div class="content-box">
                <div class="content active">
                    <x-table id="employee-report-table" :columns="['id', 'emp_code', 'first_name','last_name', 'phone', 'designation', 'location', 'date_of_joining']" ajaxUrl="{{ route('admin.employee-report.index') }}" />
                </div>
            </div>
        </div>
        @include('admin.partials.footer')
    </div>
</div>
@endsection