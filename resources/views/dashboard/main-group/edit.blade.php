@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8">

        <a href="/main-group" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        
        <form action="{{ route('main-group.update', $mainGroup->kode_barang) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Stuff ID</label>
                <div class="col-sm-10">
                    <input name="kode_barang" type="text" required readonly value="{{ $mainGroup->kode_barang }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Main Group Code</label>
                <div class="col-sm-10">
                    <input name="code_main_group" type="number" max="9" min="1" required class="form-control" id="colFormLabel" placeholder="Main Group Code" value="{{ $mainGroup->code_main_group}}">
                </div>
            </div>
        
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Main Group Name</label>
                <div class="col-sm-10">
                    <input name="main_group_name" type="text" required class="form-control" id="colFormLabel" placeholder="Main Group Name" value="{{ $mainGroup->main_group_name }}">
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