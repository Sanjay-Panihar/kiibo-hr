@extends('layouts.app')

@section('title', 'Leave')

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
                        <h3>Leave</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="ti ti-plus"></i> Apply Leave</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class=" justify-content-between align-items-center mb-2">
                            <p><strong>Employee Name:</strong> <span>{{ Auth::user()->name ?? '' }}</span></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class=" justify-content-between align-items-center mb-2">
                            <p><strong>Employee Code:</strong> <span>EMP-045DB</span></p>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class=" justify-content-between align-items-center mb-2">
                            <p><strong>Month:</strong> <span>{{ Auth::user()->name ?? '' }}</span></p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-container">
                <div class="tab-box">
                    <button class="tab-btn active">My Leaves</button>
                    <button class="tab-btn">Leave Request</button>
                    <button class="tab-btn">Saved Leaves</button>
                </div>
                <div class="content-box">
                    <div class="content active">
                    <x-table id="leave-table" :columns="['id', 'leave_type', 'applied_on', 'start_date', 'end_date','no_of_days', 'reason', 'manager','status', 'created_by']" ajaxUrl="{{ route('admin.leave') }}" />
                    </div>
                    <div class="content">
                    <div class="row mb-3">
                            
                        </div>
                    </div>
                    <div class="content">
                    <div class="row mb-3">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.partials.footer')
    </div>
</div>
@include('admin.leave.add_leave_model')
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.content');

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                contents.forEach(c => c.classList.remove('active'));
                contents[index].classList.add('active');
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#skills, #hobbies").select2({
            placeholder: "Select",
            allowClear: true,
        });
    });
</script>
@endpush