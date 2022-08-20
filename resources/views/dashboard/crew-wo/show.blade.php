@extends('layout.main')

@section('container')

    <a href="{{ route('crew-wo.index') }}" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Crew : {{ $crew_wo->crew->full_name }}</h5>

    <p>Crew ID : {{ $crew_wo->id_crew }}</p>
    <p>Company : {{ $crew_wo->company_nm }}</p>
    <p>Last Position : {{ $crew_wo->last_position }}</p>
    <p>Year In : {{ $crew_wo->year_in }}</p>
    <p>Year Out : {{ $crew_wo->year_out }}</p>
    <p>Jobs Status : {{ $crew_wo->jobs_status }}</p>
    <p>More Info : {{ $crew_wo->more_info }}</p>
    <p>Status : {{ $crew_wo->status }}</p>
    <p>Created At : {{ $crew_wo->created_at }}</p>
    <p>Updated At : {{ $crew_wo->updated_at }}</p>
    <p>Created By : {{ $crew_wo->created_user }}</p>
    <p>Updated By : {{ $crew_wo->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('crew-wo.edit', $crew_wo->id) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <a href="{{ route('crew-wo.isDeleted', $crew_wo->id) }}" class="btn btn-danger mr-1 btn-sm">
            <x-bi-trash-fill></x-bi-trash-fill>
        </a>
    </div>

@endsection