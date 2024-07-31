<div class="modal fade" id="timesheetModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="timesheetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="timesheetModalLabel">Add New Timesheet</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-container">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="present-tab" data-bs-toggle="tab"
                                    data-bs-target="#present-tab-pane" type="button" role="tab"
                                    aria-controls="present-tab-pane" aria-selected="true">Present</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="leave-tab" data-bs-toggle="tab"
                                    data-bs-target="#leave-tab-pane" type="button" role="tab"
                                    aria-controls="leave-tab-pane" aria-selected="false">Leave</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="idle-tab" data-bs-toggle="tab"
                                    data-bs-target="#idle-tab-pane" type="button" role="tab"
                                    aria-controls="idle-tab-pane" aria-selected="false">Idle</button>
                            </li>
                        </ul>
                        <div>
                            <strong>Reporting Manager:</strong>
                            <span id="reporting-manager-name">Jai Ram Chaudhary</span>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="present-tab-pane" role="tabpanel"
                            aria-labelledby="present-tab" tabindex="0">
                            @include('admin.timesheet.present')
                        </div>
                        <div class="tab-pane fade" id="leave-tab-pane" role="tabpanel"
                            aria-labelledby="leave-tab" tabindex="0">
                            @include('admin.timesheet.leave')
                        </div>
                        <div class="tab-pane fade" id="idle-tab-pane" role="tabpanel" aria-labelledby="idle-tab"
                            tabindex="0">
                            @include('admin.timesheet.idle')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add custom CSS for active tab color -->
<style>
    .nav-tabs .nav-link.active {
        background-color: rgb(73, 190, 255);
        border-color: rgb(73, 190, 255);
        color: white; /* Ensure text is readable */
    }
    .nav-tabs .nav-link {
        color: black; /* Default color for inactive tabs */
    }
</style>
