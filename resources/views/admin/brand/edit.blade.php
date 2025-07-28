@extends('layouts.admin_master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
        <h4 class="page-title">Edit Brand</h4>
        <a href="{{ route('brands.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Brand Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $brand->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Current Logo</label><br>
                    @if($brand->logo)
                        <img src="{{ asset($brand->logo) }}" width="80" class="mb-2">
                    @endif
                    <input type="file" class="form-control" name="logo" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description (optional)</label>
                    <textarea name="description" class="form-control" rows="3">{{ $brand->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Brand</button>
            </form>
        </div>
    </div>
@endsection
