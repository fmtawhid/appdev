

<?php $__env->startSection('content'); ?>
<div class="row mt-3">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header"><h5>Add Client Review</h5></div>
            <div class="card-body">
                <form id="reviewForm" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Rating (1-5)</label>
                        <input type="number" name="rating" class="form-control" min="1" max="5" required>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="<?php echo e(route('client-reviews.index')); ?>" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$('#reviewForm').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        url: "<?php echo e(route('client-reviews.store')); ?>",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            toastr.success(res.success);
            setTimeout(() => window.location.href = "<?php echo e(route('client-reviews.index')); ?>", 1000);
        },
        error: function(xhr) {
            $.each(xhr.responseJSON.errors, function (key, val) {
                toastr.error(val);
            });
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/client_review/create.blade.php ENDPATH**/ ?>