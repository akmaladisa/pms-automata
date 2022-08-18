@extends('layout.main')

@section('container')

    <a href="/component" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Name : {{ $component->component_name }} @if($component->is_deleted) (deleted) @endif </h5>

    <p>ID : {{ $component->code_component }}</p>
    <p>Main Group : {{ $component->mainGroup->main_group_name ?? $component->code_main_group }}</p>
    <p>Group : {{ $component->group->group_name ?? $component->code_group }}</p>
    <p>Sub Group : {{ $component->subGroup->sub_group_name ?? $component->code_sub_group }}</p>
    <p>Unit : {{ $component->unit->unit_name ?? $component->code_unit }}</p>
    <p>Created At : {{ $component->created_at }}</p>
    <p>Updated At : {{ $component->updated_at }}</p>
    <p>Created By : {{ $component->created_user }}</p>
    <p>Updated By : {{ $component->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('component.edit', $component->code_component) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <form action="{{ route('component.destroy', $component->code_component) }}" method="POST" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-sm">
                <x-bi-trash-fill></x-bi-trash-fill>
            </button>
        </form>
    </div>

@endsection