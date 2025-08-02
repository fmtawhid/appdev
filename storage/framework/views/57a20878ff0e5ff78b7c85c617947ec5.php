

<?php $__env->startSection('content'); ?>
<div class="row mt-3 mb-3">
    <div class="col-md-8 offset-md-2">
        <h4>Edit Dedicated Solution</h4>
        <form id="dedicatedSolutionEditForm" method="POST" action="<?php echo e(route('dedicated-solutions.update', $dedicatedSolution->id)); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="caption" class="form-label">Caption</label>
                <input type="text" name="caption" id="caption" class="form-control" value="<?php echo e(old('caption', $dedicatedSolution->caption)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title', $dedicatedSolution->title)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control" required><?php echo e(old('description', $dedicatedSolution->description)); ?></textarea>
            </div>

            <div class="mb-3">
                <label>Current Image</label><br>
                <?php if($dedicatedSolution->image): ?>
                    <img src="<?php echo e(asset('uploads/dedicated_solutions/' . $dedicatedSolution->image)); ?>" width="100" alt="Current Image">
                <?php else: ?>
                    <p>No Image</p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Change Image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*" class="form-control">
            </div>

            <div class="mb-3">
                <label for="video_url" class="form-label">Video URL (optional)</label>
                <input type="url" name="video_url" id="video_url" class="form-control" value="<?php echo e(old('video_url', $dedicatedSolution->video_url)); ?>">
            </div>

            <button type="submit" class="btn btn-primary">Update Solution</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$('#dedicatedSolutionEditForm').on('submit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        url: "<?php echo e(route('dedicated-solutions.update', $dedicatedSolution->id)); ?>",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            toastr.success(res.success);
            window.location.href = "<?php echo e(route('dedicated-solutions.index')); ?>";
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = Object.values(errors).flat().join("<br>");
                toastr.error(errorMessages);
            } else {
                toastr.error('Failed to update data.');
            }
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/dedicated_solutions/edit.blade.php ENDPATH**/ ?>