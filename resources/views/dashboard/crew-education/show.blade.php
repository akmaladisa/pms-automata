@extends('layout.main')

@section('container')

    <a href="{{ route('crew-education.index') }}" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Crew Record : {{ $crew_education->crew->full_name }}</h5>

    <p>Crew ID : {{ $crew_education->id_crew }}</p>
    <p>Instance : {{ $crew_education->instance_nm}}</p>
    <p>Certificate :
            @if( $crew_education->scan_certificate )
                <a href="{{ asset("storage/" . $crew_education->scan_certificate) }}" class="badge badge-success">
                    Download Certificate
                </a>
            @else
                <a class="btn btn-dark btn-sm disabled text-white">
                    <x-bi-dash-circle-fill></x-bi-dash-circle-fill>
                </a>
            @endif
    </p>
    <p>More Information : {{ $crew_education->more_information }}</p>
    <p>Year In : {{ $crew_education->year_in }}</p>
    <p>Year Out : {{ $crew_education->year_out }}</p>
    <p>Status : {{ $crew_education->status }}</p>
    <p>Created At : {{ $crew_education->created_at }}</p>
    <p>Updated At : {{ $crew_education->updated_at }}</p>
    <p>Created By : {{ $crew_education->created_user }}</p>
    <p>Updated By : {{ $crew_education->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('crew-education.edit', $crew_education->id) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <a href="{{ route('crew-education.isDeleted', $crew_education->id) }}" class="btn btn-danger mr-1 btn-sm">
            <x-bi-trash-fill></x-bi-trash-fill>
        </a>
    </div>

@endsection