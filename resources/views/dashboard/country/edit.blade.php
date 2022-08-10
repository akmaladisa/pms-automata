@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8">

        <a href="/country" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        
        <form id="addShipForm" action="{{ route('country.update', $country->id_country) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Country ID</label>
                <div class="col-sm-10">
                    <input name="id_country" type="text" readonly value="{{ $country->id_country }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                </div>
            </div>
        
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Country Name</label>
                <div class="col-sm-10">
                    <input name="country_nm" type="text" required class="form-control" id="colFormLabel" placeholder="Country Name" value="{{ $country->country_nm }}">
                </div>
            </div>
        
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text">Description</span>
                </div>
                <textarea class="form-control" name="description" required aria-label="With textarea">{{ $country->description }}</textarea>
            </div>
        
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                <select class="form-control col-sm-2" name="status" required>
                    <option @if($country->status == 'ACT') selected @endif value="ACT">ACT</option>
                    <option @if($country->status == 'DE') selected @endif value="DE">DE</option>
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