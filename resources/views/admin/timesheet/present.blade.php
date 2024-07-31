<form id="leaveForm">
    @csrf
    <input type="hidden" id="id" name="id">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="start_date" class="form-label">Select Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" min="{{ date('Y-m-d') }}">
            <span class="text-danger" id="start_date_error"></span>
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
        <div class="col-md-6">
            <label for="client" class="form-label">Select Client</label>
            <select class="form-select" id="client" name="client">
                <option>Select Client</option>
            </select>
            <span class="text-danger" id="client_error"></span>
        </div>
        <div class="col-md-6">
            <label for="project" class="form-label">Select Project</label>
            <select class="form-select" id="project" name="project">
                <option>Select Project</option>
            </select>
            <span class="text-danger" id="project_error"></span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="task" class="form-label">Select Task</label>
            <select class="form-select" id="task" name="task">
                <option>Select Task</option>
            </select>
            <span class="text-danger" id="task_error"></span>
        </div>
        <div class="col-md-6">
            <label for="end_date" class="form-label">Select Billing Method</label>
            <select class="form-select" id="billing_method" name="billing_method">
                <option>Select Billing Method</option>
            </select>
            <span class="text-danger" id="end_date_error"></span>
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
        <button type="button" class="btn btn-primary" onclick="submitTimesheet()">Submit</button>
    </div>
</form>