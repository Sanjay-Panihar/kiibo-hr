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
            <label for="leave" class="form-label">Select Leave</label>
            <select class="form-select" id="leave" name="leave">
                <option>Select Leave</option>
            </select>
            <span class="text-danger" id="leave_error"></span>
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