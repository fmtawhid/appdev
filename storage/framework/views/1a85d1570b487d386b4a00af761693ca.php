

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
        <h4 class="page-title">Edit Achievement</h4>
        <a href="<?php echo e(route('achievements.index')); ?>" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('achievements.update', $achievement)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="title" class="form-label">Achievement Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo e($achievement->title); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Current Image</label><br>
                    <?php if($achievement->image): ?>
                        <img src="<?php echo e(asset($achievement->image)); ?>" width="80" class="mb-2">
                    <?php endif; ?>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/achievement/edit.blade.php ENDPATH**/ ?>