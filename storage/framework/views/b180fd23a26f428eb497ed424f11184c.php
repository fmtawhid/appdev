

<?php $__env->startSection('content'); ?>
<div class="row mt-3 mb-3">
    <div class="col-md-12">
        <h4>Add New Job Opening</h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="jobCreateForm" method="POST" action="<?php echo e(route('job-openings.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label for="job_type" class="form-label">Job Type <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="job_type" name="job_type" value="<?php echo e(old('job_type')); ?>" required>
                <span class="text-danger" id="job_type_error"></span>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo e(old('title')); ?>" required>
                <span class="text-danger" id="title_error"></span>
            </div>

            <div class="mb-3">
                <label for="sort_summary" class="form-label">Short Summary <span class="text-danger">*</span></label>
                <textarea class="form-control" id="sort_summary" name="sort_summary" rows="3" required><?php echo e(old('sort_summary')); ?></textarea>
                <span class="text-danger" id="sort_summary_error"></span>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="6"><?php echo e(old('description')); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Job</button>
            <a href="<?php echo e(route('job-openings.index')); ?>" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    $('#jobCreateForm').on('submit', function(e) {
        e.preventDefault();

        // Clear previous errors
        $('#job_type_error').text('');
        $('#title_error').text('');
        $('#sort_summary_error').text('');

        let form = this;
        let data = new FormData(form);

        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.success);
                window.location.href = "<?php echo e(route('job-openings.index')); ?>";
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if(errors.job_type) {
                        $('#job_type_error').text(errors.job_type[0]);
                    }
                    if(errors.title) {
                        $('#title_error').text(errors.title[0]);
                    }
                    if(errors.sort_summary) {
                        $('#sort_summary_error').text(errors.sort_summary[0]);
                    }
                } else {
                    toastr.error('Something went wrong.');
                }
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\appdev\resources\views/admin/job_openings/create.blade.php ENDPATH**/ ?>