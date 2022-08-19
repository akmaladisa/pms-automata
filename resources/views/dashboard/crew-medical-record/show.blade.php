@extends('layout.main')

@section('container')

    <a href="{{ route('crew-medical-record.index') }}" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Crew Record : {{ $medicalRecord->crew->full_name }}</h5>

    <p>Crew ID : {{ $medicalRecord->id_crew }}</p>
    <p>Job Title : {{ $medicalRecord->crew->job_title }}</p>
    <p>Height : {{ $medicalRecord->height }}</p>
    <p>Weight : {{ $medicalRecord->weight }}</p>
    <p>MCU Issued : {{ $medicalRecord->mcu_issued }}</p>
    <p>MCU Expired : {{ $medicalRecord->mcu_expired }}</p>
    <p>History Of Pain : {{ $medicalRecord->history_of_pain }}</p>
    <p>Status : {{ $medicalRecord->status }}</p>
    <p>Created At : {{ $medicalRecord->created_at }}</p>
    <p>Updated At : {{ $medicalRecord->updated_at }}</p>
    <p>Created By : {{ $medicalRecord->created_user }}</p>
    <p>Updated By : {{ $medicalRecord->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('crew-medical-record.edit', $medicalRecord->id) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <a href="{{ route('crew-medical-record.isDeleted', $medicalRecord->id) }}" class="btn btn-danger mr-1 btn-sm">
            <x-bi-trash-fill></x-bi-trash-fill>
        </a>
    </div>

@endsection