@extends('layouts.admin_master')

@section('content')
<div class="container mt-4">
    <h3>Add New Achievement</h3>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route('achievements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Achievement Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image (optional)</label>
                    <input type="file" class="form-control" name="image" id="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Create Achievement</button>
                <a href="{{ route('achievements.index') }}" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>
@endsection
