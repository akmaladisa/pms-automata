@extends('layout.main')

@section('container')

    @include('sweetalert::alert')

    <h2>Crew Education</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#addCrewEducationdModal">Add New</button>

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover table-striped mb-4">
            <thead>
                <tr>
                    <th>Crew ID</th>
                    <th>Crew Name</th>
                    <th>Certificate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($crew_education as $c)
                    <tr>
                        <td>{{ $c->id_crew }}</td>
                        <td>{{ $c->crew->full_name }}</td>
                        <td>
                            @if( $c->scan_certificate )
                                <a href="{{ asset("storage/" . $c->scan_certificate) }}" class="btn btn-success btn-sm">download</a>
                            @else
                                <a class="btn btn-dark btn-sm disabled text-white">
                                    <x-bi-dash-circle-fill></x-bi-dash-circle-fill>
                                </a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('crew-education.show', $c->id) }}" class="btn btn-info btn-sm">
                                <x-bi-eye-fill></x-bi-eye-fill>
                            </a>
        
                            <a href="{{ route('crew-education.edit', $c->id) }}" class="btn btn-warning btn-sm">
                                <x-bi-pencil-square></x-bi-pencil-square>
                            </a>
        
                            <a href="{{ route('crew-education.isDeleted', $c->id) }}" class="btn btn-danger btn-sm">
                                <x-bi-trash-fill></x-bi-trash-fill>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addCrewEducationdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Crew Education</h5>
                </div>
                <div class="modal-body">
                    <form id="addShipForm" action="{{ route('crew-education.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Instance</label>
                            <div class="col-sm-10">
                                <input name="instance_nm" type="text" required class="form-control" id="colFormLabel" placeholder="Instance" value="{{ old('instance_nm') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label mr-3">Certificate</label>
                            <div class="col-sm-8">
                                <input type="file" class="custom-file-input" id="customFile" name="scan_certificate">
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
                                <input name="more_information" type="text" required class="form-control" id="colFormLabel" placeholder="More Information" value="{{ old('more_information') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Year In</label>
                            <div class="col-sm-10">
                                <input name="year_in" type="number" required class="form-control" id="colFormLabel" placeholder="Year In" value="{{ old('year_in') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Year Out</label>
                            <div class="col-sm-10">
                                <input name="year_out" type="number" required class="form-control" id="colFormLabel" placeholder="Year Out" value="{{ old('year_out') }}">
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