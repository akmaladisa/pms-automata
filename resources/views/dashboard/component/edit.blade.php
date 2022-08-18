@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8 pb-5">

        <a href="/component" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        
        <form action="{{ route('component.update', $component->code_component) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Component Code</label>
                <div class="col-sm-10">
                    <input min="100000000" max="999999999" name="code_component" type="number" required class="form-control" id="colFormLabel" placeholder="Component Code" value="{{ $component->code_component }}">
                </div>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Main Group</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_main_group" required>
                    <option disabled selected>Main Group</option>
                    @foreach ($mainGroups as $mg)
                        <option @if( $mg->code_main_group == $component->code_main_group ) selected @endif value="{{ $mg->code_main_group }}">{{ $mg->code_main_group }}) {{ $mg->main_group_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Group</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_group" required>
                    <option disabled selected>Group</option>
                    @foreach ($groups as $g)
                        <option @if( $g->code_group == $component->code_group ) selected @endif value="{{ $g->code_group }}">{{ $g->code_group }}) {{ $g->group_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Sub Group</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_sub_group" required>
                    <option disabled selected>Sub Group</option>
                    @foreach ($subGroups as $sg)
                        <option @if( $sg->code_sub_group == $component->code_sub_group ) selected @endif value="{{ $sg->code_sub_group }}">{{ $sg->code_sub_group }}) {{ $sg->sub_group_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Sub Group</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_sub_group" required>
                    <option disabled selected>Sub Group</option>
                    @foreach ($subGroups as $sg)
                        <option @if( $sg->code_sub_group == $component->code_sub_group ) selected @endif value="{{ $sg->code_sub_group }}">{{ $sg->code_sub_group }}) {{ $sg->sub_group_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Unit</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_unit" required>
                    <option disabled selected>Unit</option>
                    @foreach ($units as $unit)
                        <option @if( $unit->code_unit == $component->code_unit ) selected @endif value="{{ $unit->code_unit }}">{{ $unit->code_unit }}) {{ $unit->unit_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Component Name</label>
                <div class="col-sm-10">
                    <input name="component_name" type="text" required class="form-control" id="colFormLabel" placeholder="Component Name" value="{{ $component->component_name }}">
                </div>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Is Deleted?</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="is_deleted" required>
                    <option @if( !$component->is_deleted ) selected @endif value="0">NO</option>
                    <option @if( $component->is_deleted ) selected @endif value="1">YES</option>
                </select>
            </div>
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Updated User</label>
                <div class="col-sm-10">
                    <input name="updated_user" type="text" required class="form-control" id="colFormLabel" placeholder="" readonly value="{{ auth()->user()->id_login }}">
                </div>
            </div>
        
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
    
@endsection