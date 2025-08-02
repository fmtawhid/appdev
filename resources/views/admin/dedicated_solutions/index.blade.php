@extends('layouts.admin_master')

@section('content')
<div class="row mb-3 mt-3">
    <div class="col-md-6">
        <h4>Dedicated Solutions</h4>
    </div>
    <div class="col-md-6 text-end">
        @can('dedicated_add')
            <a href="{{ route('dedicated-solutions.create') }}" class="btn btn-success">+ Add Solution</a>
        @endcan
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="dedicatedSolutionTable" class="table dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Caption</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Video URL</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(function() {
    let table = $('#dedicatedSolutionTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dedicated-solutions.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'caption', name: 'caption' },
            { data: 'title', name: 'title' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'video_url', name: 'video_url' },
            { data: 'description', name: 'description' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        order: [[0, 'desc']],
    });

    $(document).on("click", ".delete", function(e) {
        e.preventDefault();
        let that = $(this);
        $.confirm({
            icon: "fas fa-exclamation-triangle",
            title: "Confirm Delete",
            content: "Are you sure to delete this item?",
            type: "red",
            buttons: {
                confirm: function() {
                    let form = that.closest("form");
                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        success: function(res) {
                            if(res.success) {
                                toastr.success(res.success);
                                table.ajax.reload();
                            } else {
                                toastr.error(res.error || 'Delete failed!');
                            }
                        },
                        error: function() {
                            toastr.error('Delete failed!');
                        }
                    });
                },
                cancel: function () {}
            }
        });
    });
});
</script>
@endsection
