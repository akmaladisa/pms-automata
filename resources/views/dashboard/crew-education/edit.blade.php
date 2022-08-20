@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8 pb-5">

        <a href="{{ route('crew-education.index') }}" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        
        <form action="{{ route('crew-education.update', $crew_education->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                <select class="form-control col-sm-8" name="id_crew" required>
                    <option disabled selected>Crew</option>
                    @foreach ($crews as $crew)
                        <option @if( $crew->id_crew == $crew_education->id_crew ) selected @endif value="{{ $crew->id_crew }}">{{ $crew->full_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Instance</label>
                <div class="col-sm-10">
                    <input name="instance_nm" type="text" required class="form-control" id="colFormLabel" placeholder="Instance" value="{{ $crew_education->instance_nm }}">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label mr-3">Certificate</label>
                <div class="col-sm-8">
                    <input type="file" value="{{ $crew_education->scan_certificate }}" class="custom-file-input" id="customFile" name="scan_certificate">
                    <label class="custom-file-label" for="customFile">Choose Certificate</label>
                    <div class=" mt-2">
                        <span class="badge badge-primary">
                            <small id="sh-text4" class="form-text mt-0">PDF,DOCX,DOC</small>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">More Information</label>
                <div class="col-sm-10">
                    <input name="more_information" type="text" required class="form-control" id="colFormLabel" placeholder="More Information" value="{{ $crew_education->more_information }}">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Year In</label>
                <div class="col-sm-10">
                    <input name="year_in" type="number" required class="form-control" id="colFormLabel" placeholder="Year In" value="{{ $crew_education->year_in }}">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Year Out</label>
                <div class="col-sm-10">
                    <input name="year_out" type="number" required class="form-control" id="colFormLabel" placeholder="Year Out" value="{{ $crew_education->year_out }}">
                </div>
            </div>
    
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                <select class="form-control col-sm-3" name="status" required>
                    <option @if( $crew_education->status == 'ACT' ) selected @endif value="ACT">ACT</option>
                    <option @if( $crew_education->status == 'DE' ) selected @endif value="DE">DE</option>
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