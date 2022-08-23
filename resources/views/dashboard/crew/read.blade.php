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
        @foreach ($crews as $c)
            <tr>
                <td>{{ $c->id_crew }}</td>
                <td>{{ $c->full_name}}</td>
                <td>{{ $c->job_title }}</td>
                <td>{{ $c->status }}</td>
                <td>
                    <a href="{{ route('crew.show', $c->id_crew) }}" class="btn btn-show-crew btn-info btn-sm" title="show">
                        <x-bi-eye-fill></x-bi-eye-fill>
                    </a>

                    <button type="button" value="{{ $c->id_crew }}" class="btn btn-edit-crew btn-warning btn-sm">
                        <x-bi-pencil-square></x-bi-pencil-square>
                    </button>

                    <a href="/change-status-crew/{{ $c->id_crew }}" class="btn btn-danger btn-sm">
                        <x-bi-trash-fill></x-bi-trash-fill>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
