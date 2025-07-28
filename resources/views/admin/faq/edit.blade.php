@extends('layouts.admin_master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
        <h4 class="page-title">Edit FAQ</h4>
        <a href="{{ route('faqs.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('faqs.update', $faq) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">FAQ Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $faq->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="4">{{ $faq->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
