@extends('layouts.admin_master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
        <h4 class="page-title">Edit Team Member</h4>
        <a href="{{ route('teams.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('teams.update', $team) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ $team->name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
                    <input type="text" name="profession" value="{{ $team->profession }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="sort_summary" class="form-label">Short Summary</label>
                    <textarea name="sort_summary" class="form-control" rows="3">{{ $team->sort_summary }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" value="{{ $team->email }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="current_image" class="form-label">Current Image</label><br>
                    @if($team->image)
                        <img src="{{ asset($team->image) }}" width="80" class="mb-2" alt="Team Image">
                    @endif
                    <input type="file" name="image" accept="image/*" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update Member</button>
            </form>
        </div>
    </div>
@endsection
