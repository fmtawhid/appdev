@extends('layouts.admin_master')
@section('title', 'Tech Stack List')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">All Tech Stacks</h4>
        @can('techstack_add')
        <a href="{{ route('techstacks.create') }}" class="btn btn-primary">Add New</a>
        @endcan
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="techstack-table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Platform</th>
                    <th>Stack Name</th>
                    <th>Description</th>
                    <th>Programming Languages</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
$(function () {
    $('#techstack-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('techstacks.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'platform', name: 'platform' },
            { data: 'stack_name', name: 'stack_name' },
            { data: 'description', name: 'description' },
            { data: 'languages', name: 'languages' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Delete
    $(document).on("click", ".delete", function () {
        var url = $(this).data("url");
        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure to delete this?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            toastr.success(res.message);
                            $('#techstack-table').DataTable().ajax.reload();
                        }
                    });
                },
                cancel: function () {}
            }
        });
    });
});
</script>
@endpush
