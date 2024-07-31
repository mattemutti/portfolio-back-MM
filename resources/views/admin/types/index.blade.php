@extends('layouts.admin')

@section('content')
    <div class="container">
        <section class="py-4">
            <div class="d-flex justify-content-between text-danger">
                <h1>TYPES</h1>
                <div>
                    <a class="btn btn-outline-danger" href="{{ route('admin.types.create') }}"><i class="fa fa-pencil"
                            aria-hidden="true"></i> NewType</a>
                </div>
            </div>
        </section>
        @include('partials.message-confirm')

        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col" class="text-primary">ID</th>
                        <th scope="col" class="text-primary">Image</th>
                        <th scope="col" class="text-primary">Name</th>
                        <th scope="col" class="text-primary">Slug</th>
                        <th scope="col" class="text-primary">Version</th>
                        <th scope="col" class="text-primary">Actions </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $type)
                        <tr>
                            <td class="text-danger" scope="row">{{ $type->id }}</td>
                            <td class="text-danger">
                                <img width="140" loading="lazy" src="{{ asset('storage/' . $type->cover_image) }}"
                                    alt="{{ $type->name }}">
                            </td>
                            <td class="text-danger">{{ $type->name }}</td>
                            <td class="text-danger">{{ $type->slug }}</td>
                            <td class="text-danger">{{ $type->version }}</td>

                            <td>
                                <a class="btn
                            btn-outline-success"
                                    href="{{ route('admin.types.show', $type) }}">View</a>
                                <a class="btn btn-outline-warning" href="{{ route('admin.types.edit', $type) }}">Edit</a>

                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $type->id }}">
                                    Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $type->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger" id="modalTitleId-{{ $type->id }}">
                                                    Attention! Deleting: {{ $type->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-danger">
                                                Attention! You are about to delete this record. The operation is DESTRUCTIVE
                                                ❌❌❌
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>


                                                <form action="{{ route('admin.types.destroy', $type) }}" method="post">
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
