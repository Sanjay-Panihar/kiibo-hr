<div class="row mt-2">
    <form id="leave-form">
        @csrf
        <input type="hidden" id="id" name="id">
        <input type="hidden" name="type" value="2">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="date" class="form-label">Select Date</label>
                <input type="date" class="form-control" id="date" name="date" min="{{ date('Y-m-d') }}">
                <span class="text-danger" id="date_error"></span>
            </div>
            <div class="col-md-6">
                <label for="duration" class="form-label">Select Duration</label>
                <select class="form-select" id="duration" name="duration">
                    <option value="">Select Duration</option>
                    {!! \App\Helpers\Helper::generateTimeOptions() !!}
                </select>
                <span class="text-danger" id="duration_error"></span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="leave_type" class="form-label">Select Leave</label>
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
            <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"
                    placeholder="Provide a brief description for your leave"></textarea>
                <span class="text-danger" id="description_error"></span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" onclick="submitTimesheet('leave-form')">Submit</button>
        </div>
    </form>
</div>