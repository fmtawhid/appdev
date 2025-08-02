
<?php $__env->startSection('title', 'Create Tech Stack'); ?>

<?php $__env->startSection('content'); ?>
<div class="card mt-4">
    <div class="card-header">
        <h4>Create New Tech Stack</h4>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('techstacks.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label>Platform</label>
                <input type="text" name="platform" class="form-control" value="<?php echo e(old('platform')); ?>" required>
            </div>
            <div class="mb-3">
                <label>Stack Name</label>
                <input type="text" name="stack_name" class="form-control" value="<?php echo e(old('stack_name')); ?>" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"><?php echo e(old('description')); ?></textarea>
            </div>
            <div class="mb-3">
                <label>Programming Languages</label>
                <select name="programming_languages[]" class="form-control programming-language-select" multiple></select>

                </select>
            </div>
            <button class="btn btn-success">Save</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
$('.programming-language-select').select2({
    placeholder: 'Search Programming Languages',
    minimumInputLength: 1,
    ajax: {
        url: '<?php echo e(route("programming-languages.search")); ?>',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return { results: data };
        },
        cache: true
    }
});

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/techstacks/create.blade.php ENDPATH**/ ?>