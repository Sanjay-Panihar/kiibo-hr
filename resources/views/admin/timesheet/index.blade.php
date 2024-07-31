@extends('layouts.app')

@section('title', 'Timesheet')

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
                        <h3>Timesheet</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="button" class="btn btn-primary" onclick="openAddModal()"><i class="ti ti-plus"></i> Add Timesheet</button>
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
                    <button class="tab-btn active" data-tab="weekly">Weekly</button>
                    <button class="tab-btn" data-tab="monthly">Monthly</button>
                </div>
                <div class="content-box">
                    <table id="timesheet-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Punch In</th>
                                <th>Att. Marked</th>
                                <th>Type</th>
                                <th>Punch Out</th>
                                <th>Hours</th>
                                <th>A_R</th>
                                <th>L_R</th>
                                <th>SHR_H</th>
                                <th>W_H</th>
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
@include('admin.timesheet.timesheet_modal')
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.tab-btn');
            const timesheetTable = $('#timesheet-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.timesheet') }}",
                    data: function (d) {
                        d.type = $('.tab-btn.active').data('tab');
                    }
                },
                columns: [
                    { data: 'id', defaultContent: '--' },
                    { data: 'date', defaultContent: '--' },
                    { data: 'day', defaultContent: '--' },
                    { data: 'punch_in', defaultContent: '--' },
                    { data: 'attendence_marked', defaultContent: '--' },
                    { data: 'type', defaultContent: '--' },
                    { data: 'punch_out', defaultContent: '--' },
                    { data: 'hours', defaultContent: '--' },
                    { data: 'SHR_H', defaultContent: '--' },
                    { data: 'W_H', defaultContent: '--' },

                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).find('td:eq(11)').html(data.status);
                }
            });

            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    loadAttendance(this.getAttribute('data-tab'));
                });
            });

            function loadAttendance(tab) {
                timesheetTable.ajax.reload();
            }

            // Initial load
            loadAttendance('monthly');

            // Reload DataTable after form submission
            $('#attendanceForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#staticBackdrop').modal('hide');
                        attendanceTable.ajax.reload(); // Reload DataTable
                    },
                    error: function (response) {
                        // Handle errors here
                    }
                });
            });
        });
        function openAddModal()
        {
            $('#timesheetModal').modal('show');
        }
       
    </script>
@endpush