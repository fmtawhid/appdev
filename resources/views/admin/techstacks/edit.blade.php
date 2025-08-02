@extends('layouts.admin_master')
@section('title', 'Edit Tech Stack')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Tech Stack</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('techstacks.update', $techstack->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Platform</label>
                <input type="text" name="platform" class="form-control" value="{{ old('platform', $techstack->platform) }}" required>
            </div>
            <div class="mb-3">
                <label>Stack Name</label>
                <input type="text" name="stack_name" class="form-control" value="{{ old('stack_name', $techstack->stack_name) }}" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description', $techstack->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label>Programming Languages</label>
                <select name="programming_language_ids[]" class="form-control programming-language-select" multiple>
                    @foreach($programmingLanguages as $lang)
                        <option value="{{ $lang->id }}" {{ in_array($lang->id, $techstack->programming_languages->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $lang->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
$('.programming-language-select').select2({
    placeholder: 'Search Programming Languages',
    ajax: {
        url: '{{ route("programming-languages.search") }}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});
</script>
@endpush
