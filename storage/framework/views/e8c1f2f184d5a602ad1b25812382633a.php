

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3>Add New Product</h3>

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
            <form action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="<?php echo e(old('title')); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="">--Select Category--</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Languages</label>
                    <select name="language_ids[]" class="form-control" multiple>
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($language->id); ?>"><?php echo e($language->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5"><?php echo e(old('description')); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Images</label>
                    <div id="images-container">
                        <div class="image-item mb-2">
                            <input type="file" name="images[]" class="form-control mb-1">
                            <input type="text" name="alt_texts[]" class="form-control" placeholder="Alt text">
                        </div>
                    </div>
                    <button type="button" id="addImage" class="btn btn-secondary mt-2">Add Image</button>
                </div>

                <div class="mb-3">
                    <label class="form-label">Key Features</label>
                    <div id="features-container">
                        <div class="feature-item mb-2">
                            <input type="text" name="features[0][title]" class="form-control mb-1" placeholder="Feature Title">
                            <textarea name="features[0][description]" class="form-control" placeholder="Feature Description"></textarea>
                        </div>
                    </div>
                    <button type="button" id="addFeature" class="btn btn-secondary mt-2">Add Feature</button>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
let featureIndex = 1;
$('#addFeature').click(function() {
    let html = `
        <div class="feature-item mb-2">
            <input type="text" name="features[${featureIndex}][title]" class="form-control mb-1" placeholder="Feature Title">
            <textarea name="features[${featureIndex}][description]" class="form-control" placeholder="Feature Description"></textarea>
        </div>
    `;
    $('#features-container').append(html);
    featureIndex++;
});

let imageIndex = 1;
$('#addImage').click(function() {
    let html = `
        <div class="image-item mb-2">
            <input type="file" name="images[]" class="form-control mb-1">
            <input type="text" name="alt_texts[]" class="form-control" placeholder="Alt text">
        </div>
    `;
    $('#images-container').append(html);
    imageIndex++;
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/product/create.blade.php ENDPATH**/ ?>