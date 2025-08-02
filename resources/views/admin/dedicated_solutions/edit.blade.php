@extends('layouts.admin_master')

@section('content')
<div class="row mt-3 mb-3">
    <div class="col-md-8 offset-md-2">
        <h4>Edit Dedicated Solution</h4>
        <form id="dedicatedSolutionEditForm" method="POST" action="{{ route('dedicated-solutions.update', $dedicatedSolution->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="caption" class="form-label">Caption</label>
                <input type="text" name="caption" id="caption" class="form-control" value="{{ old('caption', $dedicatedSolution->caption) }}" required>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $dedicatedSolution->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control" required>{{ old('description', $dedicatedSolution->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Current Image</label><br>
                @if($dedicatedSolution->image)
                    <img src="{{ asset('uploads/dedicated_solutions/' . $dedicatedSolution->image) }}" width="100" alt="Current Image">
                @else
                    <p>No Image</p>
                @endif
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Change Image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*" class="form-control">
            </div>

            <div class="mb-3">
                <label for="video_url" class="form-label">Video URL (optional)</label>
                <input type="url" name="video_url" id="video_url" class="form-control" value="{{ old('video_url', $dedicatedSolution->video_url) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Solution</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#dedicatedSolutionEditForm').on('submit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        url: "{{ route('dedicated-solutions.update', $dedicatedSolution->id) }}",
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
                toastr.error('Failed to update data.');
            }
        }
    });
});
</script>
@endsection
