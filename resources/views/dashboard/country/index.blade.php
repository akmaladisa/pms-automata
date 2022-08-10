@extends('layout.main')

@section('container')

    @include('sweetalert::alert')

    <h2>Country List</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#addCountryModal">Add New</button>

    <div class="table-responsive mt-3" id="shipContent">
        <table class="table table-bordered table-hover table-striped mb-4">
            <thead>
                <tr>
                    <th>Country ID</th>
                    <th>Country Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)
                    <tr>
                        <td>{{ $country->id_country }}</td>
                        <td>{{ $country->country_nm }}</td>
                        <td>{{ $country->description }}</td>
                        <td>{{ $country->status }}</td>
                        <td>
                            <a href="{{ route('country.show', $country->id_country) }}" class="btn btn-info btn-sm">
                                <x-bi-eye-fill></x-bi-eye-fill>
                            </a>
        
                            <a href="{{ route('country.edit', $country->id_country) }}" class="btn btn-warning btn-sm">
                                <x-bi-pencil-square></x-bi-pencil-square>
                            </a>
        
                            <a href="/change-status-country/{{ $country->id_country }}" class="btn btn-danger btn-sm">
                                <x-bi-trash-fill></x-bi-trash-fill>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addCountryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Country</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('country.store') }}" method="POST">
                        @csrf
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Country ID</label>
                            <div class="col-sm-10">
                                <input name="id_country" required type="text" readonly value="{{ $countryId }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                            </div>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Country Name</label>
                            <div class="col-sm-10">
                                <input name="country_nm" type="text" required class="form-control" id="colFormLabel" placeholder="country Name" value="{{ old('country_name') }}">
                            </div>
                        </div>

                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Description</span>
                            </div>
                            <textarea class="form-control" required name="description" aria-label="With textarea"></textarea>
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