
<div class="modal fade" id="leaveRequest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="leaveRequestLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Leave Request</h1>
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
                    <input type="hidden" id="id" name="id">
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
                            <input type="number" class="form-control" id="no_of_days" name="no_of_days" readonly>
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