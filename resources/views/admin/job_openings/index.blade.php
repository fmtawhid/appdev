@extends('layouts.admin_master')

@section('content')
<div class="row mb-3 mt-3">
    <div class="col-md-6">
        <h4>Job Openings</h4>
    </div>
    <div class="col-md-6 text-end">
        @can('job_add')
            <a href="{{ route('job-openings.create') }}" class="btn btn-success">+ Add Job</a>
        @endcan
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="jobTable" class="table dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Job Type</th>
                    <th>Title</th>
                    <th>Short Summary</th>
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
    let table = $('#jobTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('job-openings.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'job_type', name: 'job_type' },
            { data: 'title', name: 'title' },
            { data: 'sort_summary', name: 'sort_summary' },
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
            content: "Are you sure to delete this job opening?",
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
                                toastr.error(res.error || 'Failed to delete!');
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
