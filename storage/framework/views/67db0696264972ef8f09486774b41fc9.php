

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3>Add New Programming Language</h3>

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
            <form action="<?php echo e(route('languages.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Icon (optional)</label>
                    <input type="file" class="form-control" name="icon" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3"><?php echo e(old('description')); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?php echo e(route('languages.index')); ?>" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/language/create.blade.php ENDPATH**/ ?>