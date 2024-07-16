@extends('layouts.app')

@section('title', 'Profile')

@push('css')
    <style>
        .education-entry {
            margin-bottom: 10px;
        }

        .remove-btn {
            cursor: pointer;
            color: red;
        }
    </style>
@endpush

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
                        <h3>My Profile</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary">Edit Profile</button>
                    </div>
                </div>
            </div>
            <div class="tab-container">
                <div class="tab-box">
                    <button class="tab-btn active">Personal Info</button>
                    <button class="tab-btn">Experience</button>
                </div>
                <div class="content-box">
                    <div class="content active">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p><strong>Name:</strong> <span>{{ Auth::user()->name }}</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Designation:</strong> <span>Developer</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Email:</strong> <span>{{ Auth::user()->email }}</span></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p><strong>Contact No:</strong> <span>9992745883</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Date Of Birth:</strong> <span>28-09-1990</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Reporting Manager:</strong> <span>Nevada Termius</span></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p><strong>Joined Since:</strong> <span>28-09-1990</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Location:</strong> <span>Nagpur</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Gender:</strong> <span>Male</span></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p><strong>Blood Group:</strong> <span>A+</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Marital Status:</strong> <span>Married</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Emergency Contact:</strong> <span>9876541330</span></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="govt_id">Select Govt Id</label>
                                <select class="form-control">
                                    <option value="" selected disabled>Select Govt Id</option>
                                    <option value="1">Aadhar Card</option>
                                    <option value="2">Pan card</option>
                                    <option value="3">Passport</option>
                                    <option value="4">Voter ID </option>
                                    <option value="5">Driving Licence </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                            <label class="form-label" for="govt_id">Govt Id No</label>
                                <input type="text" name="Govt Id" id="govt_id" class="form-control"
                                    placeholder="Enter Govt Id">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Skills</label>
                                <select name="skills" id="skills" class="form-select form-control" multiple>
                                    <option value="">Select</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="4">Four</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hobbies</label>
                                <select name="hobbies" id="hobbies" class="form-select form-control" multiple>
                                    <option value="">Select</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="4">Four</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Let us know more about you</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Achievements</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Current Address</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Permanent Address</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">Education Details</label>
                                    <button class="btn btn-primary" id="addEducationBtn"><i class="ti ti-plus"></i> Add
                                        New</button>
                                </div>
                                <div id="educationContainer">
                                    <div class="row mb-2">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="Degree" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="Institute" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="Start Year" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="End Year" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">Certifications</label>
                                    <button class="btn btn-primary" id="addCertificationBtn"><i class="ti ti-plus"></i>
                                        Add New</button>
                                </div>
                                <div id="certificationContainer">
                                    <div class="row mb-2">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="Certification" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="Institute" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="Year" />
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center">
                                                <input type="text" class="form-control" placeholder="Score" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">Experience</label>
                                    <button class="btn btn-primary" id="addExperienceBtn"><i class="ti ti-plus"></i> Add
                                        New</button>
                                </div>
                                <div id="experienceContainer">
                                    <div class="row mb-2">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="Position" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="Company" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" placeholder="Year" />
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center">
                                                <input type="text" class="form-control" placeholder="Location" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.partials.footer')
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.content');

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                contents.forEach(c => c.classList.remove('active'));
                contents[index].classList.add('active');
            });
        });

        $('#skills, #hobbies').select2({
            placeholder: "Select",
            allowClear: true,
        });

        function addEntry(containerId, entryHtml) {
            $(containerId).append(entryHtml);
        }

        const educationEntryHtml = `
            <div class="row education-entry">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Degree" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Institute" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Start Year" />
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control" placeholder="End Year" />
                        <button class="remove-btn ml-2 btn btn-sm"><i class="ti ti-trash"></i></button>
                    </div>
                </div>
            </div>
        `;

        const certificationEntryHtml = `
            <div class="row certification-entry mt-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Certification" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Institute" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Year" />
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control" placeholder="Score" />
                          <button class="remove-btn ml-2 btn btn-sm"><i class="ti ti-trash"></i></button>
                        </div>
                </div>
            </div>
        `;

        const experienceEntryHtml = `
            <div class="row experience-entry mt-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Position" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Company" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Year" />
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control" placeholder="Location" />
                          <button class="remove-btn ml-2 btn btn-sm"><i class="ti ti-trash"></i></button>
                    </div>
                </div>
            </div>
        `;

        $('#addEducationBtn').on('click', function () {
            addEntry('#educationContainer', educationEntryHtml);
        });

        $('#addCertificationBtn').on('click', function () {
            addEntry('#certificationContainer', certificationEntryHtml);
        });

        $('#addExperienceBtn').on('click', function () {
            addEntry('#experienceContainer', experienceEntryHtml);
        });

        $(document).on('click', '.remove-btn', function () {
            $(this).closest('.education-entry, .certification-entry, .experience-entry').remove();
        });
    });
</script>
@endsection