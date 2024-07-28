<div class="modal fade" id="attendenceRegularisation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="attendenceRegularisationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="attendenceRegularisationLabel">Attendance Regularisation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <span><strong>Reporting Manager (ECode):</strong> <span id="reporting_manager">Jai Ram Chaudhary
                                (AGL2795)</span></span>
                    </div>
                    <div class="col-md-6">
                        <span><strong>Work Location:</strong> <span id="work_location">Jaipur</span></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <span><strong>Attendance Date:</strong> <span id="attendance_date">28-09-1990</span></span>
                    </div>
                    <div class="col-md-6">
                        <span><strong>Day:</strong> <span id="attendance_day">Present</span></span>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <span><strong>Regularise Type:</strong> <span id="regularise_type">Regularise Time</span></span>
                    </div>
                    <div class="col-md-6">
                        <span><strong>Attendance Marked As:</strong> <span id="attendance_marked_as"
                                class="badge bg-danger">LWA</span></span>
                    </div>
                </div>
                <form id="attendenceForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="punch_in" class="form-label">In Time <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="punch_in" name="punch_in"
                                onchange="calculateWorkingHours()">
                            <small class="text-muted" id="punch_in_time">HH:MM (24:00 Format)</small>
                            <span class="text-danger" id="punch_in_error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="punch_out" class="form-label">Out Time <span
                                    class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="punch_out" name="punch_out"
                                onchange="calculateWorkingHours()">
                            <small class="text-muted" id="punch_out_time">HH:MM (24:00 Format)</small>
                            <span class="text-danger" id="punch_out_error"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <span><strong>Working Hours:</strong> <span class="text-danger">*</span> <span
                                    id="hours"><strong>00:00</strong></span></span>
                            <input type="hidden" id="hours_input" name="hours">
                            <span class="text-danger" id="hours_error"></span>
                            <span class="text-muted">(HH:MM)</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="reason" name="reason"
                                placeholder="Provide a brief reason for your leave"></textarea>
                            <span class="text-danger" id="reason_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="attendenceRequest()">Save</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>