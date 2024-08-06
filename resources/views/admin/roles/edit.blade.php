@extends('layouts.app')

@section('title', 'Update Roles')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('admin.partials.sidebar')
    <div class="body-wrapper">
        @include('admin.partials.header')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h3>Update Roles</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">
                        <i class="ti ti-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="content-box">
                <div class="card">
                    <form id="roleForm" action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Role name" value="{{ $role->name }}">
                                        <span class="text-danger" id="name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status<span class="text-danger">*</span></label>
                                        <select name="status" class="form-select">
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="1" {{ $role->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $role->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <span class="text-danger" id="status_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="text-xl my-4 text-gray-600">Permissions</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                                    @foreach($permissions as $permission)
                                        <div class="flex flex-col justify-center">
                                            <div class="flex flex-col">
                                                <label class="inline-flex items-center mt-3">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                                                        name="permissions[]" value="{{ $permission->id }}"
                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                                    <span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="card-body border-top">
                                    <button type="submit" class="btn btn-primary">
                                        Save
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
        $(document).ready(function () {
            $('#cancelBtn').click(function () {
                window.location.href = "{{ route('admin.roles.index') }}";
            });

            $('#roleForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.status) {
                            toastr.success(response.message);
                            $('#roleForm')[0].reset();
                            $('#permissions-table').DataTable().ajax.reload();
                            // window.location.href = "{{ route('admin.roles.index') }}";
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                $('#' + key + '_error').text(value[0]);
                            });
                        }
                    }
                });
            });
        });

    </script>
@endpush