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
                        <button type="button" class="btn btn-primary" onclick="openAddModal()"><i
                                class="ti ti-plus"></i> Apply Leave</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="justify-content-between align-items-center mb-2">
                            <p><strong>Employee Name:</strong> <span>{{ Auth::user()->name ?? '' }}</span></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="justify-content-between align-items-center mb-2">
                            <p><strong>Employee Code:</strong> <span>EMP-045DB</span></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <?php
                                $currentYear = date('Y');
                                $currentMonth = date('F Y');
                                $months = [];
                                for ($i = 1; $i <= 12; $i++) {
                                    $timestamp = mktime(0, 0, 0, $i, 1, $currentYear);
                                    $months[] = date('F Y', $timestamp);
                                }
                            ?>
                            <p class="mb-0"><strong>Month:</strong></p>
                            <select id="month-dropdown" name="month-dropdown" class="form-select ms-2">
                                <?php foreach ($months as $month): ?>
                                <option value="<?= $month ?>" <?= $month == $currentMonth ? 'selected' : '' ?>><?= $month ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-container">
                <div class="tab-box">
                    <button class="tab-btn active" data-tab="my_leaves">My Leaves</button>
                    <button class="tab-btn" data-tab="leave_requests">Leave Request</button>
                    <button class="tab-btn" data-tab="saved_leaves">Saved Leaves</button>
                </div>
                <div class="content-box">
                    <table id="leave-table" class="table table-striped">
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
@include('admin.leave.add_leave_model')
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.tab-btn');
            const leaveTable = $('#leave-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.leave') }}",
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
                leaveTable.ajax.reload();
            }

            // Initial load
            loadLeaves('my_leaves');

            // Reload DataTable after form submission
            $('#leaveForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#staticBackdrop').modal('hide');
                        leaveTable.ajax.reload(); // Reload DataTable
                    },
                    error: function (response) {
                        // Handle errors here
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#skills, #hobbies").select2({
                placeholder: "Select",
                allowClear: true,
            });
        });

        function editLeave(id) {
            let url = "{{ route('admin.leave.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    populateForm(data.leave);
                    $('#staticBackdrop').modal('show');
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        }

        function populateForm(data) {
            $('#id').val(data.id);
            $('#leave_type').val(data.leave_type);
            $('#leave_balance').val(data.leave_balance);
            $('#start_date').val(data.start_date);
            $('#end_date').val(data.end_date);
            $('#no_of_days').val(data.no_of_days);
            $('#reason').val(data.reason);
        }

        function openAddModal() {
            $('#staticBackdrop').modal('show');
            resetForm();
        }

        function resetForm() {
            document.getElementById('leaveForm').reset();
            document.getElementById('id').value = '';
            clearErrors();
        }
    </script>
@endpush