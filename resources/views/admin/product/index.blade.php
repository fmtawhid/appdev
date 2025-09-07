@extends('layouts.admin_master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 mt-3">
    <h4 class="page-title">Products</h4>
    <a class="btn btn-success" href="{{ route('products.create') }}">Add New Product</a>
</div>

<div class="card">
    <div class="card-body">
        <table id="productTable" class="table table-striped dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Languages</th>
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
    var table = $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('products.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false },
            { data: 'title', name: 'title' },
            { data: 'category', name: 'category' },
            { data: 'languages', name: 'languages', orderable:false, searchable:false },
            { data: 'actions', name: 'actions', orderable:false, searchable:false },
        ]
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
                        data: { _token: token, _method: method },
                        success: function(res) {
                            if(res.success) {
                                toastr.success(res.message);
                                table.ajax.reload();
                            } else {
                                toastr.error(res.message || 'Delete failed');
                            }
                        },
                        error: function() {
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
