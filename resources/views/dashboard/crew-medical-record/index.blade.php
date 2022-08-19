@extends('layout.main')

@section('container')

    @include('sweetalert::alert')

    <h2>Crew Medical Record</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#addRecordModal">Add New</button>

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover table-striped mb-4">
            <thead>
                <tr>
                    <th>Crew ID</th>
                    <th>Crew Name</th>
                    <th>Crew Height</th>
                    <th>Crew Weight</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <td>{{ $record->id_crew }}</td>
                        <td>{{ $record->crew->full_name }}</td>
                        <td>{{ $record->height }}</td>
                        <td>{{ $record->weight }}</td>
                        <td>
                            <a href="{{ route('crew-medical-record.show', $record->id) }}" class="btn btn-info btn-sm btn-show-ship">
                                <x-bi-eye-fill></x-bi-eye-fill>
                            </a>
        
                            <a href="{{ route('crew-medical-record.edit', $record->id) }}" class="btn btn-warning btn-sm btn-edit-ship">
                                <x-bi-pencil-square></x-bi-pencil-square>
                            </a>
        
                            <a href="{{ route('crew-medical-record.isDeleted', $record->id) }}" class="btn btn-danger btn-sm">
                                <x-bi-trash-fill></x-bi-trash-fill>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Record</h5>
                </div>
                <div class="modal-body">
                    <form id="addShipForm" action="{{ route('crew-medical-record.store') }}" method="POST">
                        @csrf
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                            <select class="form-control col-sm-8" name="id_crew" required>
                                <option disabled selected>Crew</option>
                                @foreach ($crews as $crew)
                                    <option value="{{ $crew->id_crew }}">{{ $crew->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Height</label>
                            <div class="col-sm-10">
                                <input name="height" type="number" required class="form-control" id="colFormLabel" placeholder="Crew Height" value="{{ old('height') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Weight</label>
                            <div class="col-sm-10">
                                <input name="weight" type="number" required class="form-control" id="colFormLabel" placeholder="Crew Weight" value="{{ old('weight') }}">
                            </div>
                        </div>
                
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                            <select class="form-control col-sm-3" name="status" required>
                                <option value="ACT">ACT</option>
                                <option value="DE">DE</option>
                            </select>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">MCU Issued</label>
                            <div class="col-sm-10">
                                <input name="mcu_issued" type="text" required class="form-control" id="colFormLabel" placeholder="MCU Issued" value="{{ old('mcu_issued') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">MCU Expired</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" required name="mcu_expired" placeholder="MCU Expired" class="form-control" id="colFormLabel" placeholder="col-form-label">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">History Of Pain</label>
                            <div class="col-sm-10">
                                <input name="history_of_pain" type="text" required class="form-control" id="colFormLabel" placeholder="History Of Pain" value="{{ old('history_of_pain') }}">
                            </div>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Created User</label>
                            <div class="col-sm-10">
                                <input name="created_user" type="text" readonly value="{{ auth()->user()->id_login }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

@endsection