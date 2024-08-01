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
            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    loadTimesheet(this.getAttribute('data-tab'));
                });
            });

            function loadTimesheet(tab) {
                timesheetTable.ajax.reload();
            }

            // Initial load
            // loadTimesheet('monthly');

            // Reload DataTable after form submission
        });
        function openAddModal(){
            $('#timesheetModal').modal('show');
        }
       function submitTimesheet(formType){
           $.ajax({
               url: '{{ route('admin.timesheet.store') }}',
               type: 'POST',
               dataType: 'json',    
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: $('#'+formType).serialize(),
               success: function(response) {
                   if (response.success) {
                       $('#timesheetModal').modal('hide');
                       toastr.success(response.message);
                    //    timesheetTable.ajax.reload();
                   }
               },
               error: function(xhr) {
                showErrors(xhr.responseJSON.errors);
                   console.log(xhr.responseText);
                   
               }
           });
        }
    </script>
@endpush