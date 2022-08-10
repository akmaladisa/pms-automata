@extends('layout.main')

@section('container')

    <a href="/ship" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Name : {{ $ship->ship_nm }}</h5>

    <p>ID : {{ $ship->id_ship }}</p>
    <p>Description : {{ $ship->description }}</p>
    <p>Status : {{ $ship->status }}</p>
    <p>Created At : {{ $ship->created_at }}</p>
    <p>Updated At : {{ $ship->updated_at }}</p>
    <p>Created By : {{ $ship->created_user }}</p>
    <p>Updated By : {{ $ship->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('ship.edit', $ship->id_ship) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <a href="/change-status-ship/{{ $ship->id_ship }}" class="btn btn-danger mr-1 btn-sm">
            <x-bi-trash-fill></x-bi-trash-fill>
        </a>
    </div>

@endsection