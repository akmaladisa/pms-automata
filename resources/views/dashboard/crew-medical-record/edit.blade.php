@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8 pb-5">

        <a href="{{ route('crew-medical-record.index') }}" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        
        <form action="{{ route('crew-medical-record.update', $medicalRecord->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                <select class="form-control col-sm-8" name="id_crew" required>
                    <option disabled selected>Crew</option>
                    @foreach ($crews as $crew)
                        <option @if( $crew->id_crew == $medicalRecord->id_crew ) selected @endif value="{{ $crew->id_crew }}">{{ $crew->full_name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Height</label>
                <div class="col-sm-10">
                    <input name="height" type="number" required class="form-control" id="colFormLabel" placeholder="Crew Height" value="{{ $medicalRecord->height }}">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Weight</label>
                <div class="col-sm-10">
                    <input name="weight" type="number" required class="form-control" id="colFormLabel" placeholder="Crew Weight" value="{{ $medicalRecord->weight }}">
                </div>
            </div>
    
            <div class="input-group mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                <select class="form-control col-sm-3" name="status" required>
                    <option @if( $medicalRecord->status == 'ACT' ) selected @endif value="ACT">ACT</option>
                    <option @if( $medicalRecord->status == 'DE' ) selected @endif value="DE">DE</option>
                </select>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">MCU Issued</label>
                <div class="col-sm-10">
                    <input name="mcu_issued" type="text" required class="form-control" id="colFormLabel" placeholder="MCU Issued" value="{{ $medicalRecord->mcu_issued }}">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">MCU Expired</label>
                <div class="col-sm-10">
                    <input type="datetime-local" required name="mcu_expired" placeholder="MCU Expired" class="form-control" id="colFormLabel" value="{{ $medicalRecord->mcu_expired }}" placeholder="col-form-label">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label for="colFormLabel" class="col-sm-2 col-form-label">History Of Pain</label>
                <div class="col-sm-10">
                    <input name="history_of_pain" type="text" required class="form-control" id="colFormLabel" placeholder="History Of Pain" value="{{ $medicalRecord->history_of_pain }}">
                </div>
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