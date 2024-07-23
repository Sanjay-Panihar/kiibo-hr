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
                                <th>Day</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Punch In</th>
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
                { data: 'id' ,  defaultContent: '--' },
                { data: 'day' ,  defaultContent: '--' },
                { data: 'date' ,  defaultContent: '--' },
                { data: 'type' ,  defaultContent: '--' },
                { data: 'punch_in' ,  defaultContent: '--' },
                { data: 'punch_out' ,  defaultContent: '--' },
                { data: 'hours' ,  defaultContent: '--' },
                { data: 'A_R' ,  defaultContent: '--' },
                { data: 'L_R' ,  defaultContent: '--' },
                { data: 'SHR_H' ,  defaultContent: '--' },
                { data: 'W_H' ,  defaultContent: '--' },
                
            ],
            createdRow: function(row, data, dataIndex) {
                $(row).find('td:eq(11)').html(data.status); // Render HTML for status column
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
</script>
@endpush