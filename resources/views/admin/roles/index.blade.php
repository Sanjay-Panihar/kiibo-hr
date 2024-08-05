@extends('layouts.app')

@section('title', 'Roles')

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
                        <h3>Roles</h3>
                    </div>
                    <!-- <div class="col-md-6 text-end">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i
                                class="ti ti-plus"></i> Add User</a>
                    </div> -->
                </div>
            </div>
            <div class="tab-container">
                <div class="content-box">
                    <table id="role-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be loaded here via DataTables -->
                        </tbody>
                    </table>
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
            const usersTable = $('#role-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.roles.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },  // Serial number column
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    { data: 'actions', orderable: false, searchable: false }

                ]
            });
        });
        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault();
            var form = $(this).closest('form');
            if (confirm('Are you sure you want to delete this item?')) {
                form.submit();
            }
        });
    </script>
@endpush