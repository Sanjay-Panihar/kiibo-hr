<form id="idle-form">
    @csrf
    <input type="hidden" id="id" name="id">
    <input type="hidden" name="type" value="3">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="date" class="form-label">Select Date</label>
            <input type="date" class="form-control" id="date" name="date" min="{{ date('Y-m-d') }}">
            <span class="text-danger" id="date_error"></span>
        </div>
        <div class="col-md-6">
            <label for="duration" class="form-label">Select Duration</label>
            <select class="form-select" id="duration" name="duration">
                <option value="0">Select Duration</option>
                {!! \App\Helpers\Helper::generateTimeOptions() !!}

            </select>
            <span class="text-danger" id="duration_error"></span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="client" class="form-label">Select Client</label>
            <select class="form-select" id="client" name="client">
                <option>Select Client</option>
            </select>
            <span class="text-danger" id="client_error"></span>
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
        <button type="button" class="btn btn-primary" onclick="submitTimesheet('idle-form')">Submit</button>
    </div>
</form>