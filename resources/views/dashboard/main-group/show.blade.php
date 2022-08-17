@extends('layout.main')

@section('container')

    <a href="/main-group" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Name : {{ $mainGroup->main_group_name }}</h5>

    <p>Stuff ID : {{ $mainGroup->kode_barang }}</p>
    <p>Code : {{ $mainGroup->code_main_group }}</p>
    <p>Created At : {{ $mainGroup->created_at }}</p>
    <p>Updated At : {{ $mainGroup->updated_at }}</p>
    <p>Created By : {{ $mainGroup->created_user }}</p>
    <p>Updated By : {{ $mainGroup->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('main-group.edit', $mainGroup->kode_barang) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <form action="{{ route('main-group.destroy', $mainGroup->kode_barang) }}" method="POST" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-sm">
                <x-bi-trash-fill></x-bi-trash-fill>
            </button>
        </form>
    </div>

@endsection