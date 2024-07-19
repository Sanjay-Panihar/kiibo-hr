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
                                <p><strong>Contact No:</strong>
                                    <span>{{ $user->userDetails->phone ?? 'Not Available' }}</span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Date Of Birth:</strong>
                                    <span>{{ $user->userDetails->date_of_birth ?? 'Not Available' }}</span>
                                </p>
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
                                <p><strong>Gender:</strong>
                                    <span>{{ $user->userDetails->gender ?? 'Not Available' }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p><strong>Blood Group:</strong> <span>A+</span></p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Marital Status:</strong>
                                    <span>{{ $user->marital_status == 1 ? 'Married' : 'Unmarried' ?? 'Not Available' }}</span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Emergency Contact:</strong>
                                    <span>{{ $user->userDetails->emergency_contact ?? 'Not Available' }}</span>
                                </p>
                            </div>
                        </div>
                        <form method="post" id="profileForm">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="govt_id">Select Govt Id</label>
                                    <select class="form-control" name="govt_id">
                                        <option value="" selected disabled>Select Govt Id</option>
                                        <option value="1" {{ ($user->userDetails->govt_id ?? '') == 1 ? 'selected' : '' }}>Aadhar Card</option>
                                        <option value="2" {{ ($user->userDetails->govt_id ?? '') == 2 ? 'selected' : '' }}>Pan card</option>
                                        <option value="3" {{ ($user->userDetails->govt_id ?? '') == 3 ? 'selected' : '' }}>Passport</option>
                                        <option value="4" {{ ($user->userDetails->govt_id ?? '') == 4 ? 'selected' : '' }}>Voter ID</option>
                                        <option value="5" {{ ($user->userDetails->govt_id ?? '') == 5 ? 'selected' : '' }}>Driving Licence</option>
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="govt_id_no">Govt Id No</label>
                                    <input type="text" name="govt_id_no" id="govt_id_no" class="form-control"
                                        placeholder="Enter Govt Id"
                                        value="{{ old('govt_id_no', ($user->userDetails) ? $user->userDetails->govt_id_no : '') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Skills</label>
                                    <select name="skills[]" id="skills" class="form-select form-control" multiple>
                                        <option value="1" {{ in_array(1, $skills) ? 'selected' : '' }}>Skill 1</option>
                                        <option value="2" {{ in_array(2, $skills) ? 'selected' : '' }}>Skill 2</option>
                                        <option value="3" {{ in_array(3, $skills) ? 'selected' : '' }}>Skill 3</option>
                                        <option value="4" {{ in_array(4, $skills) ? 'selected' : '' }}>Skill 4</option>
                                        <option value="5" {{ in_array(5, $skills) ? 'selected' : '' }}>Skill 5</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Hobbies</label>
                                    <select name="hobbies[]" id="hobbies" class="form-select form-control" multiple>
                                        <option value="1" {{ in_array(1, $hobbies) ? 'selected' : '' }}>Hobby 1</option>
                                        <option value="2" {{ in_array(2, $hobbies) ? 'selected' : '' }}>Hobby 2</option>
                                        <option value="3" {{ in_array(3, $hobbies) ? 'selected' : '' }}>Hobby 3</option>
                                        <option value="4" {{ in_array(4, $hobbies) ? 'selected' : '' }}>Hobby 4</option>
                                        <option value="5" {{ in_array(5, $hobbies) ? 'selected' : '' }}>Hobby 5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Let us know more about you</label>
                                    <textarea class="form-control" rows="3" name="about_me"
                                        id="about_me">{{ $user->userDetails ? $user->userDetails->about_me : ''}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Achievements</label>
                                    <textarea name="achievements" id="achievements" class="form-control"
                                        rows="3">{{ $user->userDetails ? $user->userDetails->achievements : ''}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Current Address</label>
                                    <textarea name="current_address" id="current_address" class="form-control"
                                        rows="3">{{ $user->userDetails ? $user->userDetails->current_address : ''}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Permanent Address</label>
                                    <textarea name="permanent_address" id="permanent_address" class="form-control"
                                        rows="3">{{ $user->userDetails ? $user->userDetails->permanent_address : ''}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label mb-0">Education Details</label>
                                        <button class="btn btn-primary" id="addEducationBtn" type="button"><i
                                                class="ti ti-plus"></i> Add New</button>
                                    </div>
                                    <div id="educationContainer">
                                        @forelse($educationDetails as $index => $education)
                                            <div class="row mb-2 education-entry">
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        name="education_details[{{ $index }}][degree]" placeholder="Degree"
                                                        value="{{ $education['degree'] ?? '' }}" />
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        name="education_details[{{ $index }}][institute]"
                                                        placeholder="Institute"
                                                        value="{{ $education['institute'] ?? '' }}" />
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        name="education_details[{{ $index }}][start_year]"
                                                        placeholder="Start Year"
                                                        value="{{ $education['start_year'] ?? '' }}" />
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="d-flex align-items-center">
                                                        <input type="text" class="form-control"
                                                            name="education_details[{{ $index }}][end_year]"
                                                            placeholder="End Year"
                                                            value="{{ $education['end_year'] ?? '' }}" />
                                                        @if(!$loop->first)
                                                            <button type="button" class="remove-btn ml-2 btn btn-sm"><i
                                                                    class="ti ti-trash"></i></button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        name="education_details[0][degree]" placeholder="Degree" />
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        name="education_details[0][institute]" placeholder="Institute" />
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        name="education_details[0][start_year]" placeholder="Start Year" />
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control"
                                                        name="education_details[0][end_year]" placeholder="End Year" />
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label mb-0">Certifications</label>
                                <button class="btn btn-primary" id="addCertificationBtn" type="button"><i
                                        class="ti ti-plus"></i>
                                    Add New</button>
                            </div>
                            <div id="certificationContainer">
                                @forelse($certifications as $index => $certification)
                                    <div class="row mb-2 certification-entry">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control"
                                                name="certifications[{{ $index }}][certification]"
                                                placeholder="Certification"
                                                value="{{ $certification['certification'] ?? '' }}" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control"
                                                name="certifications[{{ $index }}][institute]" placeholder="Institute"
                                                value="{{ $certification['institute'] ?? '' }}" />
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control"
                                                name="certifications[{{ $index }}][year]" placeholder="Year"
                                                value="{{ $certification['year'] ?? '' }}" />
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center">
                                                <input type="text" class="form-control"
                                                    name="certifications[{{ $index }}][score]" placeholder="Score"
                                                    value="{{ $certification['score'] ?? '' }}" />
                                                @if(!$loop->first)
                                                    <button class="remove-btn ml-2 btn btn-sm"><i
                                                            class="ti ti-trash"></i></button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                                    <div class="row mb-2">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="certifications[0][certification]"
                                                                placeholder="Certification" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="certifications[0][institute]"
                                                                placeholder="Institute" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" name="certifications[0][year]"
                                                                placeholder="Year" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="d-flex align-items-center">
                                                                <input type="text" class="form-control" name="certifications[0][score]"
                                                                    placeholder="Score" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" id="saveProfileBtn" type="button">Save</button>
                                        </form>
                                    </div>
                                @endforelse

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
            width: '100%' // Add this line to ensure proper width
        });

        function addEntry(containerId, entryHtml) {
            $(containerId).append(entryHtml);

        }

        let educationIndex = {{ count($educationDetails) }};
        let certificationIndex = {{ count($certifications) }};

        function addEducationRow() {
            const educationEntryHtml = `
            <div class="row mb-2 education-entry">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="education_details[${educationIndex}][degree]" placeholder="Degree" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="education_details[${educationIndex}][institute]" placeholder="Institute" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="education_details[${educationIndex}][start_year]" placeholder="Start Year" />
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control" name="education_details[${educationIndex}][end_year]" placeholder="End Year" />
                        <button class="remove-btn ml-2 btn btn-sm"><i class="ti ti-trash"></i></button>
                    </div>
                </div>
            </div>
        `;
            $('#educationContainer').append(educationEntryHtml);
            educationIndex++;
        }

        function addCertificationRow() {
            const certificationEntryHtml = `
            <div class="row mb-2 certification-entry">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="certifications[${certificationIndex}][certification]" placeholder="Certification" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="certifications[${certificationIndex}][institute]" placeholder="Institute" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="certifications[${certificationIndex}][year]" placeholder="Year" />
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control" name="certifications[${certificationIndex}][score]" placeholder="Score" />
                        <button class="remove-btn ml-2 btn btn-sm"><i class="ti ti-trash"></i></button>
                    </div>
                </div>
            </div>
        `;
            $('#certificationContainer').append(certificationEntryHtml);
            certificationIndex++;
        }

        $('#addEducationBtn').on('click', function () {
            addEducationRow();
        });

        $('#addCertificationBtn').on('click', function () {
            addCertificationRow();
        });

        $('#addExperienceBtn').on('click', function () {
            addEntry('#experienceContainer', experienceEntryHtml);
        });

        $(document).on('click', '.remove-btn', function () {
            $(this).closest('.education-entry, .certification-entry, .experience-entry').remove();
        });

        $('#saveProfileBtn').on('click', function () {
            saveProfile();
        });

        function saveProfile() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: "{{ route('admin.user-details.store') }}",
                data: $('#profileForm').serialize(),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken  // Include CSRF token in headers
                },
                success: function (response) {
                    if (response.status === 'true') {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (error) {
                    console.error('Error saving profile:', error);
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                }
            });
        }
    });
</script>
@endsection