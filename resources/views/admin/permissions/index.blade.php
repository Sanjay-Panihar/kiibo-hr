@extends('layouts.app')

@section('title', 'Permissions')

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
                        <h3>Permissions</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary"><i
                                class="ti ti-plus"></i> Add Permission</a>
                    </div>
                </div>
            </div>
            <div class="tab-container">
                <div class="content-box">
                    <table id="permissions-table" class="table table-striped">
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
            const usersTable = $('#permissions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.permissions.index') }}",
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