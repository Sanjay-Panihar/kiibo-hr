@extends('layouts.app')

@section('title', 'Update User')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    @include('admin.partials.sidebar')
    <div class="body-wrapper">
        @include('admin.partials.header')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h3>Update User</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                        <i class="ti ti-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="content-box">
                <div class="card">
                    <form id="updateForm" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <h4 class="card-title">User Information</h4>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="John" value="{{ $user->name }}">
                                        <span class="text-danger" id="name_error"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com" value="{{ $user->email }}">
                                        <span class="text-danger" id="email_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="********">
                                        <span class="text-danger" id="password_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="********">
                                        <span class="text-danger" id="password_confirmation_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select name="role_id" class="form-select">
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $role )
                                            <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}  
                                            </option>                                          
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="role_id_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">Select Role</option>
                                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <span class="text-danger" id="role_id_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="card-body border-top">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <button type="button" class="btn bg-danger-subtle text-danger ms-6" id="cancelBtn">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('admin.partials.footer')
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#cancelBtn').click(function() {
            window.location.href = "{{ route('admin.users.index') }}";
        });

        $('#updateForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        $('#updateForm')[0].reset();
                        $('#users-table').DataTable().ajax.reload();
                        window.location.href = "{{ route('admin.users.index') }}";
                    }else{
                        toastr.error(response.error);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '_error').text(value[0]);
                        });
                    }
                }
            });
        });
    });

</script>
@endpush