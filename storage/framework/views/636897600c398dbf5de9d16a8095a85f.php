

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3>Add New Brand</h3>

    
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
            <form action="<?php echo e(route('brands.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo e(old('name')); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" class="form-control" name="logo" id="logo" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description (optional)</label>
                    <textarea name="description" id="description" class="form-control" rows="4"><?php echo e(old('description')); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create Brand</button>
                <a href="<?php echo e(route('brands.index')); ?>" class="btn btn-secondary">Back to Brand List</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/brand/create.blade.php ENDPATH**/ ?>