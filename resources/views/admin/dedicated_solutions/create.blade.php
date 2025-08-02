@extends('layouts.admin_master')

@section('content')
<div class="row mt-3 mb-3">
    <div class="col-md-8 offset-md-2">
        <h4>Add Dedicated Solution</h4>
        <form id="dedicatedSolutionForm" method="POST" action="{{ route('dedicated-solutions.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="caption" class="form-label">Caption</label>
                <input type="text" name="caption" id="caption" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*" class="form-control">
            </div>

            <div class="mb-3">
                <label for="video_url" class="form-label">Video URL (optional)</label>
                <input type="text" name="video_url" id="video_url" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Add Solution</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#dedicatedSolutionForm').on('submit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        url: "{{ route('dedicated-solutions.store') }}",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            toastr.success(res.success);
            window.location.href = "{{ route('dedicated-solutions.index') }}";
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = Object.values(errors).flat().join("<br>");
                toastr.error(errorMessages);
            } else {
                toastr.error('Failed to save data.');
            }
        }
    });
});
</script>
@endsection
