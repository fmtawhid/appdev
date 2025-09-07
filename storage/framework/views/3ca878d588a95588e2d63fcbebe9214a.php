

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
                            <option value="<?php echo e($category->id); ?>" <?php echo e($product->category_id == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Languages</label>
                    <select name="language_ids[]" class="form-control" multiple>
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($language->id); ?>" <?php echo e(in_array($language->id, $product->languages->pluck('id')->toArray()) ? 'selected' : ''); ?>>
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
                    <input type="file" name="images[]" class="form-control" multiple>
                    <div class="mt-2">
                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-inline-block position-relative me-2 mb-2">
                                <img src="<?php echo e(asset('storage/'.$img->path)); ?>" width="80" class="rounded">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 delete-image" data-id="<?php echo e($img->id); ?>">&times;</button>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Key Features</label>
                    <div id="features-container">
                        <?php $__currentLoopData = $product->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="feature-item mb-2">
                                <input type="text" name="features[<?php echo e($i); ?>][title]" class="form-control mb-1" value="<?php echo e($feature->title); ?>" placeholder="Feature Title">
                                <textarea name="features[<?php echo e($i); ?>][description]" class="form-control" placeholder="Feature Description"><?php echo e($feature->description); ?></textarea>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
let featureIndex = <?php echo e($product->features->count()); ?>;
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

// Delete single image via ajax
$('.delete-image').click(function() {
    let btn = $(this);
    let imageId = btn.data('id');
    $.confirm({
        title: 'Delete Image?',
        content: 'This action cannot be undone!',
        buttons: {
            confirm: function () {
                $.ajax({
                    url: '/admin/product-images/' + imageId,
                    type: 'DELETE',
                    data: {_token: '<?php echo e(csrf_token()); ?>'},
                    success: function(res) {
                        if(res.success) {
                            toastr.success(res.message);
                            btn.closest('div').remove();
                        } else {
                            toastr.error(res.message);
                        }
                    },
                    error: function() { toastr.error('Something went wrong'); }
                });
            },
            cancel: function () {}
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/product/edit.blade.php ENDPATH**/ ?>