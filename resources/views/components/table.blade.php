<div class="table-responsive">
    <table id="{{ $id }}" class="table table-bordered table-striped">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ ucwords(str_replace('_', ' ', $column)) }}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here via AJAX -->
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#{{ $id }}').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ $ajaxUrl }}',
            columns: [
                @foreach ($columns as $column)
                    { data: '{{ $column }}', name: '{{ $column }}' },
                @endforeach
                { 
                    data: 'actions', 
                    name: 'actions', 
                    orderable: false, 
                    searchable: false 
                }
            ],
            columnDefs: [
                { targets: '_all', defaultContent: '' }
            ]
        });
    });
    $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            if (confirm('Are you sure you want to delete this item?')) {
                form.submit();
            }
        });
</script>
@endpush