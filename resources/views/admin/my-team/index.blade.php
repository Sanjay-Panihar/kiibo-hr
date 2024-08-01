@extends('layouts.app')

@section('title', 'My Team')

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
                        <h3>My Team</h3>
                    </div>
                    <!-- <div class="col-md-6 text-end">
                        <button type="button" class="btn btn-primary" onclick="openAddModal()"><i
                                class="ti ti-plus"></i> Apply Leave</button>
                    </div> -->
                </div>
            </div>
            <div class="tab-container">
                <div class="tab-box">
                    <button class="tab-btn active" data-tab="attendence_report">Attendence Report</button>
                    <button class="tab-btn" data-tab="leave_report">Leave Report</button>
                    <button class="tab-btn" data-tab="timesheet_report">Timesheet Report</button>
                </div>
                <div class="content-box">
                    <table id="timesheet-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Leave Type</th>
                                <th>Applied On</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>No. of Days</th>
                                <th>Reason</th>
                                <th>Manager</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be loaded here via DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('admin.partials.footer')
    </div>
</div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.tab-btn');
            const timesheetTable = $('#timesheet-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.myteam') }}",
                    data: function (d) {
                        d.type = $('.tab-btn.active').data('tab');
                    }
                },
                columns: [
                    { data: 'id' },
                    { data: 'leave_type' },
                    { data: 'applied_on' },
                    { data: 'start_date' },
                    { data: 'end_date' },
                    { data: 'no_of_days' },
                    { data: 'reason' },
                    { data: 'manager' },
                    {
                        data: 'status', render: function (data) {
                            return data ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                        }
                    },
                    {
                        data: 'created_by', render: function (data, type, row) {
                            return row.user ? row.user.name : 'N/A';
                        }
                    },
                    { data: 'actions', orderable: false, searchable: false }
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).find('td:eq(8)').html(data.status); // Render HTML for status column
                }
            });

            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    loadLeaves(this.getAttribute('data-tab'));
                });
            });

            function loadLeaves(tab) {
                timesheetTable.ajax.reload();
            }

            // Initial load
            loadLeaves('attendence_report');

            // Reload DataTable after form submission
            $('#leaveForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#staticBackdrop').modal('hide');
                        timesheetTable.ajax.reload(); // Reload DataTable
                    },
                    error: function (response) {
                        // Handle errors here
                    }
                });
            });
        });
    </script>
@endpush