@extends('layouts.admin_master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
        <h4 class="page-title">Team Members</h4>
        <a class="btn btn-success" href="{{ route('teams.create') }}"> Add New Member</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="teamTable" class="table table-striped dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Profession</th>
                        <th>Summary</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var table = $('#teamTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('teams.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false },
                { data: 'name', name: 'name' },
                { data: 'profession', name: 'profession' },
                { data: 'sort_summary', name: 'sort_summary' },
                { data: 'email', name: 'email' },
                { data: 'image', name: 'image', orderable:false, searchable:false },
                { data: 'actions', name: 'actions', orderable:false, searchable:false },
            ]
        });

        $('#createTeamForm').submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "{{ route('teams.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.success);
                    $('#createTeamForm')[0].reset();
                    $('#createTeamModal').modal('hide');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        toastr.error(value[0]);
                    });
                }
            });
        });

        $(document).on("click", ".delete", function(e) {
            e.preventDefault();
            let that = $(this);
            $.confirm({
                icon: "fas fa-exclamation-triangle",
                closeIcon: true,
                title: "Are you sure?",
                content: "You cannot undo this action!",
                type: "red",
                typeAnimated: true,
                buttons: {
                    confirm: function() {
                        let form = that.closest("form");
                        const url = form.attr('action');
                        const token = $('input[name="_token"]', form).val();
                        const method = $('input[name="_method"]', form).val();

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: token,
                                _method: method
                            },
                            success: function(res) {
                                if (res.success) {
                                    toastr.success(res.message);
                                    table.ajax.reload();
                                } else {
                                    toastr.error(res.message || 'Delete failed');
                                }
                            },
                            error: function () {
                                toastr.error('Something went wrong.');
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
