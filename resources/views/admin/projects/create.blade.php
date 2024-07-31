@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row py-2 text-white">
            <h1>CREATE PROJECT</h1>
        </div>
        @include('partials.validation-errors')

        <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label text-white">Title</label>
                <input type="text" class="form-control bg-dark text-white @error('title') is-invalid @enderror"
                    name="title" id="title" aria-describedby="titleHelper" placeholder="project"
                    value="{{ old('title') }}" />
                <small id="titleHelper" class="form-text text-muted">Type a title for this project</small>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label text-white">Image</label>
                <input type="file" class="form-control bg-dark text-white @error('cover_image') is-invalid @enderror"
                    name="cover_image" id="cover_image" aria-describedby="cover_imageeHelper" placeholder="project"
                    value="{{ old('cover_image') }}" />
                <small id="cover_imageHelper" class="form-text text-muted">Type a image for this project</small>
                @error('cover_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>




            <label for="cover_image" class="form-label text-white">Select one or more technologies</label>
            <div class="mb-3 d-flex gap-3 flex-wrap ">
                @foreach ($technologies as $technology)
                    <div class="form-check text-white">
                        <input name="technologies[]" class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                            id="technology-{{ $technology->id }}"
                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="technology-{{ $technology->id }}"> {{ $technology->name }}
                        </label>
                    </div>
                @endforeach
                @error('technologies')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- select technologies --}}

            {{--
            <div class="mb-3">
                <label for="technologies" class="form-label text-white">Select one or more technologies</label>
                <select multiple class="form-select form-select-lg" name="technologies[]" id="technologies">
                    <option selected>Select one</option>
                    @foreach ($technologies as $technology)
                        <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                    @endforeach
                </select>
            </div> --}}


            <div class="mb-3 py-4">
                <label for="type_id" class="form-label text-white">Type</label>
                <select class="form-select bg-dark text-white form-select-lg" name="type_id" id="type_id">
                    <option selected disabled>Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="create_data" class="form-label text-white">Date</label>
                <input type="text" class="form-control bg-dark text-white @error('create_data') is-invalid @enderror"
                    name="create_data" id="create_data" aria-describedby="create_dataHelper" placeholder="project date"
                    value="{{ old('create_date') }}" />
                <small id="create_dataHelper" class="form-text text-muted">Type a date for this project</small>
                @error('create_data')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="repo" class="form-label text-white">Repo</label>
                <input type="text"
                    class="form-control bg-dark text-white bg-dark text-white @error('repo') is-invalid @enderror"
                    name="repo" id="repo" aria-describedby="repoHelper" placeholder="project date"
                    value="{{ old('repo') }}" />
                <small id="repoHelper" class="form-text text-muted">Type link the repo for this project</small>
                @error('repo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="code" class="form-label text-white">Code</label>
                <input type="text" class="form-control bg-dark text-white @error('code') is-invalid @enderror"
                    name="code" id="code" aria-describedby="codeHelper" placeholder="project date"
                    value="{{ old('code') }}" />
                <small id="codeHelper" class="form-text text-muted">Type link the code for this project</small>
                @error('code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="video" class="form-label text-white">Video</label>
                <input type="text" class="form-control bg-dark text-white @error('video') is-invalid @enderror"
                    name="video" id="video" aria-describedby="videoHelper" placeholder="project date"
                    value="{{ old('video') }}" />
                <small id="videoHelper" class="form-text text-muted">Type link the video for this project</small>
                @error('video')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="video" class="form-label text-white">Description</label>
                <div class="form-floating">
                    <textarea name="description" id="description"
                        class="form-control bg-dark text-white @error('description') is-invalid @enderror"
                        placeholder="Leave a comment here"style="height: 100px">{{ old('description') }}</textarea>
                    <label for="floatingTextarea">
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </label>

                </div>
            </div>

            <button type="submit" class="btn btn-secondary">Create</button>


        </form>
    </div>
@endsection
