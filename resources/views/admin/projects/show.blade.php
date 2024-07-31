@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        @include('partials.message-confirm')


        <div class="row py-4">
            <div class=" text-center py-4">
                <div class="d-flex flex-column">

                    <div class="d-flex py-5">
                        <div class="d-flex text-white">Title:</div>
                        <div class="d-flex text-white">{{ $project->title }}</div>
                        <div class="text-white"></div>
                    </div>
                    <div class="d-flex  justify-content-end">
                        <div class="text-white py-4">ID: {{ $project->id }}</div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="">
                            @if (Str::startsWith($project->cover_image, 'https://'))
                                <img width="600" loading="lazy" src="{{ $project->cover_image }}"
                                    alt="{{ $project->title }}">
                            @else
                                <img width="600" loading="lazy" src="{{ asset('storage/' . $project->cover_image) }}"
                                    alt="{{ $project->title }}">
                            @endif
                        </div>
                    </div>
                    <div class="py-5">
                        <div class="d-flex justify-content-end text-white">Description:</div>
                        <div class="d-flex justify-content-end text-white"> {{ $project->description }}</div>
                    </div>
                    <div class="d-flex py-5">
                        <div class="text-white">Slug: {{ $project->slug }}</div>
                    </div>
                    <strong class="text-white">Technologies</strong>
                    <div>
                        @forelse ($project->technologies as $technology)
                            <span class="badge bg-light text-dark">{{ $technology->name }}</span>
                        @empty
                            <span class="badge bg-light text-dark"> n/a </span>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-evenly py-5">
                        <div class="text-white">Repo: {{ $project->repo }}</div>
                        <div class="text-white">Code: {{ $project->code }}</div>

                    </div>
                    <div class="text-white">Type: {{ $project->type ? $project->type->name : 'No-type' }}</div>
                    <div class="text-white">Create: {{ $project->create_data }}</div>
                </div>

                <div class="d-flex justify-content-center py-5">
                    <div class="text-white">Video:</div>
                    <div class="text-white">{{ $project->video }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
