

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3>Add New Achievement</h3>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card mt-3">
        <div class="card-body">
            <form action="<?php echo e(route('achievements.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="title" class="form-label">Achievement Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo e(old('title')); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image (optional)</label>
                    <input type="file" class="form-control" name="image" id="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Create Achievement</button>
                <a href="<?php echo e(route('achievements.index')); ?>" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/achievement/create.blade.php ENDPATH**/ ?>