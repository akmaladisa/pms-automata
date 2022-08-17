@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8">

        <a href="/sub-group" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        
        <form action="{{ route('sub-group.update', $subGroup->code_sub_group) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Sub Group Code</label>
                <div class="col-sm-10">
                    <input name="code_sub_group" type="number" required max="999" min="100" value="{{ $subGroup->code_sub_group }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                </div>
            </div>

            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Main Group</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_main_group" required>
                    <option disabled selected>Main Group</option>
                    @foreach ($mainGroups as $mg)
                        <option @if($mg->code_main_group == $subGroup->code_main_group) selected @endif value="{{ $mg->code_main_group }}">{{ $mg->code_main_group }}) {{ $mg->main_group_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Group</label>
                <select class="form-control col-sm-8" id="status_ship_store" name="code_group" required>
                    <option disabled selected>Group</option>
                    @foreach ($groups as $g)
                        <option @if($g->code_group == $subGroup->code_group) selected @endif value="{{ $g->code_group }}">{{ $g->code_group }}) {{ $g->group_name }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Sub Group Name</label>
                <div class="col-sm-10">
                    <input name="sub_group_name" type="text" required class="form-control" id="colFormLabel" placeholder="Main Group Name" value="{{ $subGroup->sub_group_name }}">
                </div>
            </div>
        
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Updated User</label>
                <div class="col-sm-10">
                    <input name="updated_user" required type="text" readonly value="{{ auth()->user()->id_login }}" class="form-control" required id="colFormLabel" placeholder="col-form-label">
                </div>
            </div>
        
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
    
@endsection