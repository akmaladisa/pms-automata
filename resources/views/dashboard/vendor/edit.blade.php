@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8">

        <a href="/vendors" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        
        <form action="{{ route('vendors.update', $vendor->vendor_id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Vendor ID</label>
                <div class="col-sm-10">
                    <input name="vendor_id" type="text" required readonly value="{{ $vendor->vendor_id }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                </div>
            </div>
        
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Vendor Name</label>
                <div class="col-sm-10">
                    <input name="vendor_name" type="text" required class="form-control" id="colFormLabel" placeholder="Vendor Name" value="{{ $vendor->vendor_name }}">
                </div>
            </div>
        
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                <select class="form-control col-sm-2" name="status" required>
                    <option @if($vendor->status == 'ACT') selected @endif value="ACT">ACT</option>
                    <option @if($vendor->status == 'DE') selected @endif value="DE">DE</option>
                </select>
            </div>
        
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Updated User</label>
                <div class="col-sm-10">
                    <input name="updated_user" type="text" readonly value="{{ auth()->user()->id_login }}" class="form-control" required id="colFormLabel" placeholder="col-form-label">
                </div>
            </div>
        
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
    
@endsection