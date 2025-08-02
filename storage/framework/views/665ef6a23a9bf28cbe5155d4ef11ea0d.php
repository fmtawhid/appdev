

<?php $__env->startSection('content'); ?>
<div class="row mt-3">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header"><h5>Edit Client Review</h5></div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('client-reviews.update', $clientReview)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo e($clientReview->title); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Current Image</label><br>
                        <?php if($clientReview->image): ?>
                            <img src="<?php echo e(asset($clientReview->image)); ?>" width="100">
                        <?php else: ?>
                            <p class="text-muted">No image</p>
                        <?php endif; ?>
                        <input type="file" name="image" class="form-control mt-2">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control"><?php echo e($clientReview->description); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Rating</label>
                        <input type="number" name="rating" class="form-control" value="<?php echo e($clientReview->rating); ?>" min="1" max="5" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?php echo e(route('client-reviews.index')); ?>" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/client_review/edit.blade.php ENDPATH**/ ?>