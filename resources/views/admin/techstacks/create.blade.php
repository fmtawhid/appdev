@extends('layouts.admin_master')
@section('title', 'Create Tech Stack')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h4>Create New Tech Stack</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('techstacks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Platform</label>
                <input type="text" name="platform" class="form-control" value="{{ old('platform') }}" required>
            </div>
            <div class="mb-3">
                <label>Stack Name</label>
                <input type="text" name="stack_name" class="form-control" value="{{ old('stack_name') }}" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label>Programming Languages</label>
                <select name="programming_languages[]" class="form-control programming-language-select" multiple></select>

                </select>
            </div>
            <button class="btn btn-success">Save</button>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
$('.programming-language-select').select2({
    placeholder: 'Search Programming Languages',
    minimumInputLength: 1,
    ajax: {
        url: '{{ route("programming-languages.search") }}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return { results: data };
        },
        cache: true
    }
});

</script>
@endpush
