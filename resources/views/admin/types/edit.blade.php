@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row py-2">
            <h1>CREATE Type</h1>
        </div>
        @include('partials.validation-errors')

        <form action="{{ route('admin.types.update', $type) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelper" placeholder="Name" value="{{ old('name') }}{{ $type->name }}" />
                <small id="nameHelper" class="form-text text-muted">Type a name for this type</small>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2 mb-3">
                <img width="200" loading="lazy" src="{{ asset('storage/' . $type->cover_image) }}"
                    alt="{{ $type->title }}">
                <div class="mb-3">
                    <label for="cover_image" class="form-label">Image</label>
                    3-
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image"
                        id="cover_image" aria-describedby="cover_imageeHelper" placeholder="type" value="" />
                    <small id="cover_imageHelper" class="form-text text-muted">Type a image for this project</small>
                    @error('cover_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                    id="description" aria-describedby="descriptionHelper" placeholder="description type">{{ old('description') }}{{ $type->description }}</textarea>
                <small id="descriptionHelper" class="form-text text-muted">Type a description for this type</small>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="version" class="form-label">Version</label>
                <input type="text" class="form-control @error('version') is-invalid @enderror" name="version"
                    id="version" aria-describedby="versionHelper" placeholder="version"
                    value="{{ old('version') }}{{ $type->version }}" />
                <small id="versionHelper" class="form-text text-muted">Type a version for this type</small>
                @error('version')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-secondary">Update</button>
        </form>
    </div>
@endsection
