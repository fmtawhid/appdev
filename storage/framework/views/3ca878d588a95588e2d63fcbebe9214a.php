

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3>Edit Product</h3>

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
            <form action="<?php echo e(route('products.update', $product)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $product->title)); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="">--Select Category--</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Languages</label>
                    <select name="language_ids[]" class="form-control" multiple>
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($language->id); ?>" <?php echo e(in_array($language->id, old('language_ids', $product->languages->pluck('id')->toArray())) ? 'selected' : ''); ?>>
                                <?php echo e($language->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5"><?php echo e(old('description', $product->description)); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Images</label>
                    <div id="images-container">
                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="image-item mb-2">
                                <input type="file" name="images[]" class="form-control mb-1">
                                <input type="text" name="alt_texts[]" class="form-control" placeholder="Alt text" value="<?php echo e(old('alt_texts.'.$index, $image->alt_text)); ?>">
                                <small>Existing: <a href="<?php echo e(asset($image->image)); ?>" target="_blank">View</a></small>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(count($product->images) == 0): ?>
                            <div class="image-item mb-2">
                                <input type="file" name="images[]" class="form-control mb-1">
                                <input type="text" name="alt_texts[]" class="form-control" placeholder="Alt text">
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="button" id="addImage" class="btn btn-secondary mt-2">Add Image</button>
                </div>

                <div class="mb-3">
                    <label class="form-label">Key Features</label>
                    <div id="features-container">
                        <?php $__currentLoopData = $product->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="feature-item mb-2">
                                <input type="text" name="features[<?php echo e($i); ?>][title]" class="form-control mb-1" placeholder="Feature Title" value="<?php echo e(old('features.'.$i.'.title', $feature->title)); ?>">
                                <textarea name="features[<?php echo e($i); ?>][description]" class="form-control" placeholder="Feature Description"><?php echo e(old('features.'.$i.'.description', $feature->description)); ?></textarea>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(count($product->features) == 0): ?>
                            <div class="feature-item mb-2">
                                <input type="text" name="features[0][title]" class="form-control mb-1" placeholder="Feature Title">
                                <textarea name="features[0][description]" class="form-control" placeholder="Feature Description"></textarea>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="button" id="addFeature" class="btn btn-secondary mt-2">Add Feature</button>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
let featureIndex = <?php echo e(count($product->features)); ?>;
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

let imageIndex = <?php echo e(count($product->images)); ?>;
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

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/product/edit.blade.php ENDPATH**/ ?>