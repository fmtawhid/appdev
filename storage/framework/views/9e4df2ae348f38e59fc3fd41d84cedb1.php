

<?php $__env->startSection('content'); ?>
<div class="row mb-3 mt-3">
    <div class="col-md-6">
        <h4>Client Reviews</h4>
    </div>
    <div class="col-md-6 text-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('review_add')): ?>
            <a href="<?php echo e(route('client-reviews.create')); ?>" class="btn btn-success">+ Add Review</a>
        <?php endif; ?>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="reviewTable" class="table dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Rating</th>
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
$(function() {
    let table = $('#reviewTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo e(route('client-reviews.index')); ?>",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'title', name: 'title' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'rating', name: 'rating' },
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
            content: "Are you sure to delete this review?",
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
                                toastr.success(res.message);
                                table.ajax.reload();
                            } else {
                                toastr.error(res.message);
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/client_review/index.blade.php ENDPATH**/ ?>