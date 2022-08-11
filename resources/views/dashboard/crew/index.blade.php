@extends('layout.main')

@section('container')

    @include('sweetalert::alert')

    <h2>Crew List</h2>

    <a class="btn btn-dark mt-3" href="{{ route('crew.create') }}">Add New</a>

    <div class="table-responsive mt-3" id="shipContent">
        <table class="table table-bordered table-hover table-striped mb-4">
            <thead>
                <tr>
                    <th>Crew ID</th>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($crew as $c)
                    <tr>
                        <td>{{ $c->id_crew }}</td>
                        <td>{{ $c->full_name}}</td>
                        <td>{{ $c->job_title }}</td>
                        <td>{{ $c->status }}</td>
                        <td>
                            <a href="{{ route('crew.show', $c->id_crew) }}" class="btn btn-info btn-sm">
                                <x-bi-eye-fill></x-bi-eye-fill>
                            </a>
        
                            <a href="{{ route('crew.edit', $c->id_crew) }}" class="btn btn-warning btn-sm">
                                <x-bi-pencil-square></x-bi-pencil-square>
                            </a>
        
                            <a href="/change-status-crew/{{ $c->id_crew }}" class="btn btn-danger btn-sm">
                                <x-bi-trash-fill></x-bi-trash-fill>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection