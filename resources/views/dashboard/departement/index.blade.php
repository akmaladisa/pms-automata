@extends('layout.main')

@section('container')

    @include('sweetalert::alert')

    <h2>departement List</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#addDepartementModal">Add New</button>

    <div class="table-responsive mt-3" id="shipContent">
        <table class="table table-bordered table-hover table-striped mb-4">
            <thead>
                <tr>
                    <th>Departement ID</th>
                    <th>Departement Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departements as $departement)
                    <tr>
                        <td>{{ $departement->departement_id }}</td>
                        <td>{{ $departement->departement_name }}</td>
                        <td>{{ $departement->status }}</td>
                        <td>
                            <a href="{{ route('departement.show', $departement->departement_id) }}" class="btn btn-info btn-sm">
                                <x-bi-eye-fill></x-bi-eye-fill>
                            </a>
        
                            <a href="{{ route('departement.edit', $departement->departement_id) }}" class="btn btn-warning btn-sm">
                                <x-bi-pencil-square></x-bi-pencil-square>
                            </a>
        
                            <a href="/change-status-departement/{{ $departement->departement_id }}" class="btn btn-danger btn-sm">
                                <x-bi-trash-fill></x-bi-trash-fill>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addDepartementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Departement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('departement.store') }}" method="POST">
                        @csrf
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Departement ID</label>
                            <div class="col-sm-10">
                                <input name="departement_id" type="text" readonly value="{{ $departementID }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                            </div>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Departement Name</label>
                            <div class="col-sm-10">
                                <input name="departement_name" type="text" required class="form-control" id="colFormLabel" placeholder="departement Name" value="{{ old('departement_name') }}">
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
                                <input name="created_user" type="text" readonly value="{{ auth()->user()->id_login }}" required class="form-control" id="colFormLabel" placeholder="col-form-label">
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