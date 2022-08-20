@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8 pb-5">

        <a href="{{ route('crew-wo.index') }}" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        
        <form action="{{ route('crew-wo.update', $crew_wo->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                <select class="form-control col-sm-8" name="id_crew" required>
                    <option disabled selected>Crew</option>
                    @foreach ($crews as $crew)
                        <option @if( $crew->id_crew == $crew_wo->id_crew ) selected @endif value="{{ $crew->id_crew }}">{{ $crew->full_name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Company Name</label>
                <div class="col-sm-10">
                    <input name="company_nm" type="text" required class="form-control" id="colFormLabel" placeholder="Company Name" value="{{ $crew_wo->company_nm }}">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Last Position</label>
                <div class="col-sm-10">
                    <input name="last_position" type="text" required class="form-control" id="colFormLabel" placeholder="Last Position" value="{{ $crew_wo->last_position }}">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Year In</label>
                <div class="col-sm-10">
                    <input name="year_in" type="number" required class="form-control" id="colFormLabel" placeholder="Year In" value="{{ $crew_wo->year_in }}">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Year Out</label>
                <div class="col-sm-10">
                    <input name="year_out" type="number" required class="form-control" id="colFormLabel" placeholder="Year Out" value="{{ $crew_wo->year_out }}">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Job Status</label>
                <div class="col-sm-10">
                    <input name="jobs_status" type="text" required class="form-control" id="colFormLabel" placeholder="Job Status" value="{{ $crew_wo->jobs_status }}">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">More Info</label>
                <div class="col-sm-10">
                    <input name="more_info" type="text" required class="form-control" id="colFormLabel" placeholder="More Info" value="{{ $crew_wo->more_info }}">
                </div>
            </div>
    
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                <select class="form-control col-sm-3" name="status" required>
                    <option @if( $crew_wo->status == 'ACT' ) selected @endif value="ACT">ACT</option>
                    <option @if( $crew_wo->status == 'DE' ) selected @endif value="DE">DE</option>
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