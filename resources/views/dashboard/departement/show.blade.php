@extends('layout.main')

@section('container')

    <a href="/departement" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Name : {{ $departement->departement_name }}</h5>

    <p>ID : {{ $departement->departement_id }}</p>
    <p>Status : {{ $departement->status }}</p>
    <p>Created At : {{ $departement->created_at }}</p>
    <p>Updated At : {{ $departement->updated_at }}</p>
    <p>Created By : {{ $departement->created_user }}</p>
    <p>Updated By : {{ $departement->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('departement.edit', $departement->departement_id) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <a href="/change-status-departement/{{ $departement->departement_id }}" class="btn btn-danger mr-1 btn-sm">
            <x-bi-trash-fill></x-bi-trash-fill>
        </a>
    </div>

@endsection