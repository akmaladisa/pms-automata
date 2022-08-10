@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8">

        <a href="/departement" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        
        <form action="{{ route('departement.update', $departement->departement_id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Departement ID</label>
                <div class="col-sm-10">
                    <input name="departement_id" type="text" required readonly value="{{ $departement->departement_id }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                </div>
            </div>
        
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">departement Name</label>
                <div class="col-sm-10">
                    <input name="departement_name" type="text" required class="form-control" id="colFormLabel" placeholder="departement Name" value="{{ $departement->departement_name }}">
                </div>
            </div>
        
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                <select class="form-control col-sm-2" name="status" required>
                    <option @if($departement->status == 'ACT') selected @endif value="ACT">ACT</option>
                    <option @if($departement->status == 'DE') selected @endif value="DE">DE</option>
                </select>
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