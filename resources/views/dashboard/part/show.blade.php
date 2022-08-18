@extends('layout.main')

@section('container')

    <a href="/part" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Name : {{ $part->part_name }} @if($part->is_deleted) (deleted) @endif </h5>

    <p>ID : {{ $part->code_part }}</p>
    <p>Main Group : {{ $part->mainGroup->main_group_name ?? $part->code_main_group }}</p>
    <p>Group : {{ $part->group->group_name ?? $part->code_group }}</p>
    <p>Sub Group : {{ $part->subGroup->sub_group_name ?? $part->code_sub_group }}</p>
    <p>Unit : {{ $part->unit->unit_name ?? $part->code_unit }}</p>
    <p>Component : {{ $part->component->component_name ?? $part->code_component }}</p>
    <p>Created At : {{ $part->created_at }}</p>
    <p>Updated At : {{ $part->updated_at }}</p>
    <p>Created By : {{ $part->created_user }}</p>
    <p>Updated By : {{ $part->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('part.edit', $part->code_part) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>


        <a href="{{ route('part.isDeleted', $part->code_part) }}" class="btn btn-danger btn-sm">
            <x-bi-trash-fill></x-bi-trash-fill>
        </a>
    </div>

@endsection