@extends('layouts.admin_master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
        <h4 class="page-title">Edit Achievement</h4>
        <a href="{{ route('achievements.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('achievements.update', $achievement) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Achievement Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $achievement->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Current Image</label><br>
                    @if($achievement->image)
                        <img src="{{ asset($achievement->image) }}" width="80" class="mb-2">
                    @endif
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
