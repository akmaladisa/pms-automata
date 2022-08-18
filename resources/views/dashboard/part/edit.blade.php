@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8 pb-5">

        <a href="/part" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        
        <form action="{{ route('part.update', $part->code_part) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Part Code</label>
                <div class="col-sm-10">
                    <input min="100000000000" max="999999999999" name="code_part" type="number" required class="form-control" id="colFormLabel" placeholder="Part Code" value="{{ $part->code_part }}">
                </div>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Main Group</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_main_group" required>
                    <option disabled selected>Main Group</option>
                    @foreach ($mainGroups as $mg)
                        <option @if( $mg->code_main_group == $part->code_main_group ) selected @endif value="{{ $mg->code_main_group }}">{{ $mg->code_main_group }}) {{ $mg->main_group_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Group</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_group" required>
                    <option disabled selected>Group</option>
                    @foreach ($groups as $g)
                        <option @if( $g->code_group == $part->code_group ) selected @endif value="{{ $g->code_group }}">{{ $g->code_group }}) {{ $g->group_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Sub Group</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_sub_group" required>
                    <option disabled selected>Sub Group</option>
                    @foreach ($subGroups as $sg)
                        <option @if( $sg->code_sub_group == $part->code_sub_group ) selected @endif value="{{ $sg->code_sub_group }}">{{ $sg->code_sub_group }}) {{ $sg->sub_group_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Sub Group</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_sub_group" required>
                    <option disabled selected>Sub Group</option>
                    @foreach ($subGroups as $sg)
                        <option @if( $sg->code_sub_group == $part->code_sub_group ) selected @endif value="{{ $sg->code_sub_group }}">{{ $sg->code_sub_group }}) {{ $sg->sub_group_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Unit</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_unit" required>
                    <option disabled selected>Unit</option>
                    @foreach ($units as $unit)
                        <option @if( $unit->code_unit == $part->code_unit ) selected @endif value="{{ $unit->code_unit }}">{{ $unit->code_unit }}) {{ $unit->unit_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Component</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_component" required>
                    <option disabled selected>Component</option>
                    @foreach ($components as $component)
                        <option @if( $component->code_component == $part->code_component ) selected @endif value="{{ $component->code_component }}">{{ $component->code_component }}) {{ $component->component_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Part Name</label>
                <div class="col-sm-10">
                    <input name="part_name" type="text" required class="form-control" id="colFormLabel" placeholder="Part Name" value="{{ $part->part_name }}">
                </div>
            </div>
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Is Deleted?</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="is_deleted" required>
                    <option @if( !$part->is_deleted ) selected @endif value="0">NO</option>
                    <option @if( $part->is_deleted ) selected @endif value="1">YES</option>
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