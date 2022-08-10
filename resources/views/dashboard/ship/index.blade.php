@extends('layout.main')

@section('container')

    @include('sweetalert::alert')

    <h2>Ship List</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#addShipModal">Add New</button>

    <div class="table-responsive mt-3" id="shipContent">
        <table class="table table-bordered table-hover table-striped mb-4">
            <thead>
                <tr>
                    <th>Ship ID</th>
                    <th>Ship NAME</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ships as $ship)
                    <tr>
                        <td>{{ $ship->id_ship }}</td>
                        <td>{{ $ship->ship_nm }}</td>
                        <td>{{ $ship->description }}</td>
                        <td>{{ $ship->status }}</td>
                        <td>
                            <a href="/ship/{{ $ship->id_ship }}" class="btn btn-info btn-sm btn-show-ship">
                                <x-bi-eye-fill></x-bi-eye-fill>
                            </a>
        
                            <a href="{{ route('ship.edit', $ship->id_ship) }}" class="btn btn-warning btn-sm btn-edit-ship">
                                <x-bi-pencil-square></x-bi-pencil-square>
                            </a>
        
                            <a href="/change-status-ship/{{ $ship->id_ship }}" class="btn btn-danger btn-sm">
                                <x-bi-trash-fill></x-bi-trash-fill>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addShipModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Ship</h5>
                </div>
                <div class="modal-body">
                    <form id="addShipForm" action="/ship" method="POST">
                        @csrf
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Ship ID</label>
                            <div class="col-sm-10">
                                <input name="id_ship" id="id_ship_store" type="text" readonly value="{{ $shipID }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                            </div>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Ship Name</label>
                            <div class="col-sm-10">
                                <input name="ship_nm" id="ship_nm_store" type="text" required class="form-control" id="colFormLabel" placeholder="Ship Name" value="{{ old('ship_nm') }}">
                            </div>
                        </div>
                
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Description</span>
                            </div>
                            <textarea class="form-control" id="desc_ship_store" name="description" required aria-label="With textarea">{{ old('description') }}</textarea>
                        </div>
                
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                            <select class="form-control col-sm-3" id="status_ship_store" name="status" required>
                                <option value="ACT">ACT</option>
                                <option value="DE">DE</option>
                            </select>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Created User</label>
                            <div class="col-sm-10">
                                <input name="created_user" type="text" id="creator_store" readonly value="{{ auth()->user()->id_login }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
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