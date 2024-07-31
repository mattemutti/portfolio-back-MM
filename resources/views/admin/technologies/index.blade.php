@extends('layouts.admin')

@section('content')
    <div class="container">
        <section class="py-4">
            <div class="d-flex justify-content-between text-danger">
                <h1>TECHNOLOGIES</h1>
                <div class="d-flex flex-column">

                    <form action="{{ route('admin.technologies.store') }}" method="post" class="p-2">
                        @csrf

                        <input name="name" id="name" aria-describedby="nameHelper" placeholder="technology name"
                            class="bg-dark text-danger @error('name') is-invalid @enderror" type="text" value="">
                    </form>
                    <label> New Technology Press Enter</label>
                </div>
            </div>
        </section>
        @include('partials.message-confirm')

        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col" class="text-primary">ID</th>
                        <th scope="col" class="text-primary">Name</th>
                        <th scope="col" class="text-primary">Slug</th>
                        <th scope="col" class="text-primary">Actions </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($technologies as $technology)
                        <tr>
                            <td class="text-danger" scope="row">{{ $technology->id }}</td>
                            <td class="text-danger">
                                <form action="{{ route('admin.technologies.update', $technology) }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <input name="name" id="name" aria-describedby="nameHelper"
                                        placeholder="technology name"
                                        class="bg-dark text-danger @error('name') is-invalid @enderror" type="text"
                                        value="{{ $technology->name }}">
                                </form>
                            </td>
                            <td class="text-danger">{{ $technology->slug }}</td>
                            <td>

                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $technology->id }}">
                                    Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $technology->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger" id="modalTitleId-{{ $technology->id }}">
                                                    Attention! Deleting: {{ $technology->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-danger">
                                                Attention! You are about to delete this record. The operation is
                                                DESTRUCTIVE
                                                ❌❌❌
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>


                                                <form action="{{ route('admin.technologies.destroy', $technology) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">
                                                        Confirm
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr class="">
                            <td scope="row" colspan="5">No Projects</td>

                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- {{ $types->links('pagination::bootstrap-5') }} --}}
    </div>
@endsection
