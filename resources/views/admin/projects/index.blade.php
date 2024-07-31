@extends('layouts.admin')

@section('content')
    <div class="container">
        <section class="py-4">
            <div class="d-flex justify-content-between text-danger">
                <h1>MATTE'S PROJECTS</h1>
                <div>
                    <a class="btn btn-outline-danger" href="{{ route('admin.projects.create') }}"><i class="fa fa-pencil"
                            aria-hidden="true"></i> NewProject</a>
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
                        <th scope="col" class="text-primary">Title</th>
                        <th scope="col" class="text-primary">Type</th>
                        <th scope="col" class="text-primary">Date</th>
                        <th scope="col" class="text-primary">Actions </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td class="text-danger" scope="row">{{ $project->id }}</td>
                            <td class="text-danger">
                                @if (Str::startsWith($project->cover_image, 'https://'))
                                    <img width="140" loading="lazy" src="{{ $project->cover_image }}"
                                        alt="{{ $project->title }}">
                                @else
                                    <img width="140" loading="lazy" src="{{ asset('storage/' . $project->cover_image) }}"
                                        alt="{{ $project->title }}">
                                @endif
                            </td>
                            <td class="text-danger">{{ $project->title }}</td>
                            <td class="text-danger">
                                @forelse ($types as $type)
                                    @if ($project->type_id == $type->id)
                                        {{ $type->name }}
                                    @endif
                                @empty
                                @endforelse
                            </td>
                            <td class="text-danger">{{ $project->create_data }}</td>

                            <td>
                                <a class="btn
                                btn-outline-success"
                                    href="{{ route('admin.projects.show', $project) }}">View</a>
                                <a class="btn btn-outline-warning"
                                    href="{{ route('admin.projects.edit', $project) }}">Edit</a>

                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $project->id }}">
                                    Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark" id="modalTitleId-{{ $project->id }}">
                                                    Attention! Deleting: {{ $project->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body  text-dark">
                                                Attention! You are about to delete this record. The operation is DESTRUCTIVE
                                                ❌❌❌
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>


                                                <form action="{{ route('admin.projects.destroy', $project) }}"
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
        {{ $projects->links('pagination::bootstrap-5') }}
    </div>
@endsection
