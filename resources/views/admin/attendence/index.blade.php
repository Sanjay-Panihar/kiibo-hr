@extends('layouts.app')

@section('title', 'Attendance')

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
                        <h3>Attendance</h3>
                    </div>
                    <!-- <div class="col-md-6 text-end">
                        <button type="button" class="btn btn-primary" onclick="openAddModal()"><i class="ti ti-plus"></i> Add Attendance</button>
                    </div> -->
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
                            <p><strong>Month:</strong> <span>{{ date('F Y') }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-container">
                <div class="tab-box">
                    <button class="tab-btn active" data-tab="monthly">Monthly</button>
                    <button class="tab-btn" data-tab="yearly">Yearly</button>
                </div>
                <div class="content-box">
                    <table id="attendance-table" class="table table-striped">
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
@include('admin.attendence.modals.leave_request_modal')
@include('admin.attendence.modals.attendence_regularisatioin_modal')
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.tab-btn');
            const attendanceTable = $('#attendance-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.attendence') }}",
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
                    {
                        data: 'A_R',
                        render: function (data, type, row) {
                            return `<button onclick="openAttendenceModal(${row.id})" class="btn btn-primary btn-sm edit-btn"><i class="ti ti-letter-r"></i></button>`;
                        }
                    },
                    {
                        data: 'L_R',
                        render: function (data, type, row) {
                            return `<button onclick="openLeaveRequestModal(${row.id})" class="btn btn-warning btn-sm edit-btn"><i class="fa fa-edit"></i></button>`;
                        }
                    },
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
                attendanceTable.ajax.reload();
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
        function openLeaveRequestModal(id) {
            let url = "{{ route('admin.leave.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    if (data.leave) {
                        populateForm(data.leave);
                        $('#leaveRequest').modal('show');
                    } else {
                        toastr.error("Leave request not found");
                    }
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
        document.getElementById('start_date').addEventListener('change', calculateDays);
        document.getElementById('end_date').addEventListener('change', calculateDays);

        function calculateDays() {
            var startDate = new Date($('#start_date').val());
            var endDate = new Date($('#end_date').val());
            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            $('#no_of_days').val(diffDays);
        }
        function openAttendenceModal(id) {
            let url = "{{ route('admin.attendence.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    if (data.attendence) {
                        populateAttendenceForm(data.attendence);
                        $('#attendenceRegularisation').modal('show');
                    } else {
                        toastr.error("Attendence not found");
                    }
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        }

        function populateAttendenceForm(data) {
            $('#id').val(data.id);
            $('#punch_in').val(data.punch_in);
            $('#punch_out').val(data.punch_out);
            $('#reason').val(data.reason);
            $('#attendance_date').text(data.date);
            $('#attendance_day').text(data.day);
            $('#attendance_marked_as').text(data.attendance_marked);
            $('#reporting_manager').text(data.reporting_manager);
            $('#work_location').text(data.work_location);
            calculateWorkingHours();
        }
        function calculateWorkingHours() {
            var punchIn = $('#punch_in').val();
            var punchOut = $('#punch_out').val();

            if (punchIn && punchOut) {
                var punchInTime = new Date('1970-01-01T' + punchIn + 'Z');
                var punchOutTime = new Date('1970-01-01T' + punchOut + 'Z');
                var diff = punchOutTime - punchInTime; // difference in milliseconds

                if (diff < 0) {
                    // if punch-out is on the next day
                    punchOutTime.setDate(punchOutTime.getDate() + 1);
                    diff = punchOutTime - punchInTime;
                }

                var hours = Math.floor(diff / 1000 / 60 / 60);
                var minutes = Math.floor((diff / 1000 / 60) % 60);

                var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);

                $('#hours').text(formattedTime);
                $('#hours_input').val(formattedTime);
            }
        }
        function attendenceRequest() {
            var id = $('#id').val();
            if (id) {
                url = "{{ route('admin.attendence.update', ':id') }}";
                url = url.replace(':id', id);
            }
            const form = document.getElementById('attendenceForm');
            const formData = new FormData(form);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response);
                    console.log('hre');
                    if (response.status === false) {
                        console.log(response.errors);
                        showErrors(response.errors);
                    } else {
                        // $('#attendenceRegularisation').modal('hide');
                        reloadTable('attendance-table');
                        clearErrors();
                        toastr.success(response.message);
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON);
                    if (xhr.status === 422) {
                        showErrors(xhr.responseJSON.errors);
                    } else {
                        toastr.error('An error occurred: ' + xhr.responseJSON.message);
                    }
                }
            });
        }
    </script>
@endpush