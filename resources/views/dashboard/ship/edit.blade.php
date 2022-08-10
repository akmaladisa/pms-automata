@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8">

        <a href="/ship" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        
        <form id="addShipForm" action="{{ route('ship.update', $ship->id_ship) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Ship ID</label>
                <div class="col-sm-10">
                    <input name="id_ship" type="text" readonly value="{{ $ship->id_ship }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                </div>
            </div>
        
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Ship Name</label>
                <div class="col-sm-10">
                    <input name="ship_nm" type="text" required class="form-control" id="colFormLabel" placeholder="Ship Name" value="{{ $ship->ship_nm }}">
                </div>
            </div>
        
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text">Description</span>
                </div>
                <textarea class="form-control" name="description" required aria-label="With textarea">{{ $ship->description }}</textarea>
            </div>
        
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                <select class="form-control col-sm-2" name="status" required>
                    <option @if($ship->status == 'ACT') selected @endif value="ACT">ACT</option>
                    <option @if($ship->status == 'DE') selected @endif value="DE">DE</option>
                </select>
            </div>
        
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Updated User</label>
                <div class="col-sm-10">
                    <input name="updated_user" type="text" readonly value="{{ auth()->user()->id_login }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                </div>
            </div>
        
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
    
@endsection