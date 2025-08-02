

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
        <h4 class="page-title">Programming Languages</h4>
        <a class="btn btn-success" href="<?php echo e(route('languages.create')); ?>">Add New Language</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="languageTable" class="table table-striped dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function () {
        var table = $('#languageTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "<?php echo e(route('languages.index')); ?>",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'icon', name: 'icon', orderable: false, searchable: false },
                { data: 'description', name: 'description' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/language/index.blade.php ENDPATH**/ ?>