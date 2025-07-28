@extends('layouts.admin_master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
        <h4 class="page-title">Achievments</h4>
        <a class="btn btn-success" href="{{ route('achievements.create') }}"> Add New Achievments</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="achievementTable" class="table table-striped dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
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
            var table = $('#achievementTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('achievements.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'image', name: 'image', orderable: false, searchable: false },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                ]
            });

            $('#createAchievementForm').submit(function (e) {
                e.preventDefault();
                let form = $(this)[0];
                let formData = new FormData(form);

                $.ajax({
                    type: "POST",
                    url: "{{ route('achievements.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        toastr.success(response.success);
                        $('#createAchievementForm')[0].reset();
                        $('#createAchievementModal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
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
