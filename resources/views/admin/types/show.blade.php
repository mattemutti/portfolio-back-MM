@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('partials.message-confirm')
        <div class="row">
            <div class="col text-danger text-center">
                <div>
                    <h1>{{ $type->name }}</h1>
                    <div>
                        <img width="600" loading="lazy" src="{{ asset('storage/' . $type->cover_image) }}"
                            alt="{{ $type->name }}">
                    </div>
                    <div>Description: {{ $type->description }}</div>
                    <div>Slug: {{ $type->slug }}</div>
                    <div>Version: {{ $type->version }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
