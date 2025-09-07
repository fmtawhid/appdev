@extends('layouts.admin_master')

@section('content')
<div class="container mt-4">
    <h3>Edit Category</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea class="form-control" name="note" rows="3">{{ old('note', $category->note) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>
@endsection
