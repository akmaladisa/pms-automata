@extends('layout.main')

@section('container')

    <a href="/group" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Name : {{ $group->group_name }}</h5>

    <p>ID : {{ $group->code_group }}</p>
    <p>Main Group : {{ $group->mainGroup->main_group_name ?? $group->code_main_group }}</p>
    <p>Created At : {{ $group->created_at }}</p>
    <p>Updated At : {{ $group->updated_at }}</p>
    <p>Created By : {{ $group->created_user }}</p>
    <p>Updated By : {{ $group->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('group.edit', $group->code_group) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <form action="{{ route('group.destroy', $group->code_group) }}" method="POST" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-sm">
                <x-bi-trash-fill></x-bi-trash-fill>
            </button>
        </form>
    </div>

@endsection