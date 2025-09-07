@extends('layouts.admin_master')

@section('content')
<div class="container mt-4">
    <h3>Add New Product</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
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
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="">--Select Category--</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Languages</label>
                    <select name="language_ids[]" class="form-control" multiple>
                        @foreach($languages as $language)
                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Images</label>
                    <div id="images-container">
                        <div class="image-item mb-2">
                            <input type="file" name="images[]" class="form-control mb-1">
                            <input type="text" name="alt_texts[]" class="form-control" placeholder="Alt text">
                        </div>
                    </div>
                    <button type="button" id="addImage" class="btn btn-secondary mt-2">Add Image</button>
                </div>

                <div class="mb-3">
                    <label class="form-label">Key Features</label>
                    <div id="features-container">
                        <div class="feature-item mb-2">
                            <input type="text" name="features[0][title]" class="form-control mb-1" placeholder="Feature Title">
                            <textarea name="features[0][description]" class="form-control" placeholder="Feature Description"></textarea>
                        </div>
                    </div>
                    <button type="button" id="addFeature" class="btn btn-secondary mt-2">Add Feature</button>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let featureIndex = 1;
$('#addFeature').click(function() {
    let html = `
        <div class="feature-item mb-2">
            <input type="text" name="features[${featureIndex}][title]" class="form-control mb-1" placeholder="Feature Title">
            <textarea name="features[${featureIndex}][description]" class="form-control" placeholder="Feature Description"></textarea>
        </div>
    `;
    $('#features-container').append(html);
    featureIndex++;
});

let imageIndex = 1;
$('#addImage').click(function() {
    let html = `
        <div class="image-item mb-2">
            <input type="file" name="images[]" class="form-control mb-1">
            <input type="text" name="alt_texts[]" class="form-control" placeholder="Alt text">
        </div>
    `;
    $('#images-container').append(html);
    imageIndex++;
});
</script>
@endsection
