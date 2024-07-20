<style>
    .modal-header {
        background-color: rgb(73 190 255);
        color: #fff;
    }

    .modal-title {
        color: #fff;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        background-color: #f8f9fa;
    }

    .form-label {
        font-weight: bold;
        color: #495057;
    }

    .form-control,
    .form-select {
        border-radius: 0.25rem;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    textarea.form-control {
        resize: vertical;
    }

    .modal-footer {
        background-color: #f1f1f1;
        border-top: 1px solid #dee2e6;
    }
</style>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Apply Leave</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="reporting_manager" class="form-label">Reporting Manager (Employee Code)</label>
                        <span class="form-control">Jai Ram Chaudhary (AGL2795)</span>
                    </div>
                    <div class="col-md-6">
                        <label for="location" class="form-label">Work Location</label>
                        <span class="form-control">Jaipur</span>
                    </div>
                </div>
                <form id="leaveForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="leave_type" class="form-label">Leave Type</label>
                            <select class="form-select" id="leave_type" name="leave_type">
                                <option selected disabled>Select Leave Type</option>
                                <option value="1">Sick Leave</option>
                                <option value="2">Earned Leave</option>
                                <option value="3">Casual Leave</option>
                                <option value="4">Optional Leave</option>
                                <option value="5">Compensatory Leave</option>
                                <option value="6">Short Leave</option>
                                <option value="7">Optional Holiday</option>
                            </select>
                            <span class="text-danger" id="leave_type_error"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                min="{{ date('Y-m-d') }}">
                            <span class="text-danger" id="start_date_error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                            <span class="text-danger" id="end_date_error"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="no_of_days" class="form-label">No. of Days</label>
                            <input type="number" class="form-control" id="no_of_days" name="no_of_days">
                            <span class="text-danger" id="no_of_days_error"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea class="form-control" id="reason" name="reason"
                                placeholder="Provide a brief reason for your leave"></textarea>
                            <span class="text-danger" id="reason_error"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="leave_balance" class="form-label">Leave Balance</label>
                            <select class="form-select" id="leave_balance" name="leave_balance">
                                <option selected disabled>Leave Balance</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="leaveRequest('submit')">Submit</button>
                        <button type="button" class="btn btn-success" onclick="leaveRequest('save')">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function leaveRequest(type) {
        let url = "{{ route('admin.leave.store') }}";
        let method = "POST";
        const form = document.getElementById('leaveForm');
        const formData = new FormData(form);

        if (type == 'submit') {
            formData.append('is_submitted', 1);
        } else {
            formData.append('is_saved', 1);
        }
        $.ajax({
            url: url,
            type: method,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            success: function (response) {
                if (response.errors) {
                    showErrors(response.errors);
                } else {
                    $('#leaveForm')[0].reset();
                    toastr.success(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    showErrors(xhr.responseJSON.errors);
                } else {
                    alert('An error occurred: ' + xhr.responseJSON.message);
                }
            }
        });
    }
</script>