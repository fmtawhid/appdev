@extends('layouts.admin_master')

@section('content')
<div class="container mt-4">
    <h3>Edit Product</h3>

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
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control" required>
                        <option value="">--Select Category--</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Languages</label>
                    <select name="language_ids[]" class="form-control" multiple>
                        @foreach($languages as $language)
                            <option value="{{ $language->id }}" {{ in_array($language->id, old('language_ids', $product->languages->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $language->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Images</label>
                    <div id="images-container">
                        @foreach($product->images as $index => $image)
                            <div class="image-item mb-2">
                                <input type="file" name="images[]" class="form-control mb-1">
                                <input type="text" name="alt_texts[]" class="form-control" placeholder="Alt text" value="{{ old('alt_texts.'.$index, $image->alt_text) }}">
                                <small>Existing: <a href="{{ asset($image->image) }}" target="_blank">View</a></small>
                            </div>
                        @endforeach
                        @if(count($product->images) == 0)
                            <div class="image-item mb-2">
                                <input type="file" name="images[]" class="form-control mb-1">
                                <input type="text" name="alt_texts[]" class="form-control" placeholder="Alt text">
                            </div>
                        @endif
                    </div>
                    <button type="button" id="addImage" class="btn btn-secondary mt-2">Add Image</button>
                </div>

                <div class="mb-3">
                    <label class="form-label">Key Features</label>
                    <div id="features-container">
                        @foreach($product->features as $i => $feature)
                            <div class="feature-item mb-2">
                                <input type="text" name="features[{{ $i }}][title]" class="form-control mb-1" placeholder="Feature Title" value="{{ old('features.'.$i.'.title', $feature->title) }}">
                                <textarea name="features[{{ $i }}][description]" class="form-control" placeholder="Feature Description">{{ old('features.'.$i.'.description', $feature->description) }}</textarea>
                            </div>
                        @endforeach
                        @if(count($product->features) == 0)
                            <div class="feature-item mb-2">
                                <input type="text" name="features[0][title]" class="form-control mb-1" placeholder="Feature Title">
                                <textarea name="features[0][description]" class="form-control" placeholder="Feature Description"></textarea>
                            </div>
                        @endif
                    </div>
                    <button type="button" id="addFeature" class="btn btn-secondary mt-2">Add Feature</button>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let featureIndex = {{ count($product->features) }};
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

let imageIndex = {{ count($product->images) }};
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
