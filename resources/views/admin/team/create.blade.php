@extends('layouts.admin_master')

@section('content')
<div class="container mt-4">
    <h3>Add New Team Member</h3>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validation Errors --}}
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
            <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Profession <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="profession" value="{{ old('profession') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email (optional)</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Short Summary</label>
                    <textarea class="form-control" name="sort_summary" rows="3">{{ old('sort_summary') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('teams.index') }}" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>
@endsection
