@extends('layout.main')

@section('container')

    <a href="/vendors" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Name : {{ $vendor->vendor_name }}</h5>

    <p>ID : {{ $vendor->vendor_id }}</p>
    <p>Status : {{ $vendor->status }}</p>
    <p>Created At : {{ $vendor->created_at }}</p>
    <p>Updated At : {{ $vendor->updated_at }}</p>
    <p>Created By : {{ $vendor->created_user }}</p>
    <p>Updated By : {{ $vendor->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('vendors.edit', $vendor->vendor_id) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <a href="/change-status-vendor/{{ $vendor->vendor_id }}" class="btn btn-danger mr-1 btn-sm">
            <x-bi-trash-fill></x-bi-trash-fill>
        </a>
    </div>

@endsection