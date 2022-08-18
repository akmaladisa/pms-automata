@extends('layout.main')

@section('container')

    <a href="/sub-group" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Name : {{ $subGroup->sub_group_name }}</h5>

    <p>ID : {{ $subGroup->code_sub_group }}</p>
    <p>Main Group : {{ $subGroup->mainGroup->main_group_name ?? $subGroup->code_main_group }}</p>
    <p>Group : {{ $subGroup->group->group_name ?? $subGroup->code_group }}</p>
    <p>Created At : {{ $subGroup->created_at }}</p>
    <p>Updated At : {{ $subGroup->updated_at }}</p>
    <p>Created By : {{ $subGroup->created_user }}</p>
    <p>Updated By : {{ $subGroup->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('sub-group.edit', $subGroup->code_sub_group) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <form action="{{ route('sub-group.destroy', $subGroup->code_sub_group) }}" method="POST" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-sm">
                <x-bi-trash-fill></x-bi-trash-fill>
            </button>
        </form>
    </div>

@endsection