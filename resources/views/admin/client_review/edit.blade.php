@extends('layouts.admin_master')

@section('content')
<div class="row mt-3">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header"><h5>Edit Client Review</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('client-reviews.update', $clientReview) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $clientReview->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Current Image</label><br>
                        @if ($clientReview->image)
                            <img src="{{ asset($clientReview->image) }}" width="100">
                        @else
                            <p class="text-muted">No image</p>
                        @endif
                        <input type="file" name="image" class="form-control mt-2">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control">{{ $clientReview->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Rating</label>
                        <input type="number" name="rating" class="form-control" value="{{ $clientReview->rating }}" min="1" max="5" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('client-reviews.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
