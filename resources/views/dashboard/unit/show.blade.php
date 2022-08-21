@extends('layout.main')

@section('container')

    <a href="/unit" class="btn btn-secondary mb-3 btn-sm">
        <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
    </a>
    
    <h5 class="modal-title" id="shipNameShow">Name : {{ $unit->unit_name }}</h5>

    <p>ID : {{ $unit->code_unit }}</p>
    <p>Main Group : {{ $unit->mainGroup->main_group_name ?? $unit->code_main_group }} <span>({{ $unit->code_main_group }})</span></p>
    <p>Group : {{ $unit->group->group_name ?? $unit->code_group }} <span>({{ $unit->code_group }})</span></p>
    <p>Sub Group : {{ $unit->subGroup->sub_group_name ?? $unit->code_sub_group }} <span>({{ $unit->code_sub_group }})</span></p>
    <p>Created At : {{ $unit->created_at }}</p>
    <p>Updated At : {{ $unit->updated_at }}</p>
    <p>Created By : {{ $unit->created_user }}</p>
    <p>Updated By : {{ $unit->updated_user }}</p>

    <div class="btn-group mt-3">
        <a href="{{ route('unit.edit', $unit->code_unit) }}" class="btn btn-warning mr-1 btn-sm">
            <x-bi-pencil-square></x-bi-pencil-square>
        </a>

        <form action="{{ route('unit.destroy', $unit->code_unit) }}" method="POST" class="d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-sm">
                <x-bi-trash-fill></x-bi-trash-fill>
            </button>
        </form>
    </div>

@endsection