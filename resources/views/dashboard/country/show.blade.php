@extends('layout.main')

@section('container')

    <a href="/country" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Name : {{ $country->country_nm }}</h5>

    <p>ID : {{ $country->id_country }}</p>
    <p>Description : {{ $country->description }}</p>
    <p>Status : {{ $country->status }}</p>
    <p>Created At : {{ $country->created_at }}</p>
    <p>Updated At : {{ $country->updated_at }}</p>
    <p>Created By : {{ $country->created_user }}</p>
    <p>Updated By : {{ $country->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('country.edit', $country->id_country) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <a href="/change-status-country/{{ $country->id_country }}" class="btn btn-danger mr-1 btn-sm">
            <x-bi-trash-fill></x-bi-trash-fill>
        </a>
    </div>

@endsection