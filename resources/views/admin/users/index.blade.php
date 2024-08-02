@extends('layouts.app')

@section('title', 'Users')

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
                        <h3>Users</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i
                                class="ti ti-plus"></i> Add User</a>
                    </div>
                </div>
            </div>
            <div class="tab-container">
                <div class="content-box">
                    <table id="users-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Last Login</th>
                                <th>Role</th>
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
            const usersTable = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'last_login_at', name: 'last_login_at', defaultContent: 'N/A'},
                    {data: 'roles', name: 'roles'},
                    {data: 'status', name: 'status'},
                    { data: 'actions', orderable: false, searchable: false }

                ]
            });
        });

      

    </script>
@endpush