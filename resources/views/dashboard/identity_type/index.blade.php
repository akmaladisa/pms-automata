@extends('layout.main')

@section('container')

    @include('sweetalert::alert')

    <h2>Identity Type List</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#addIdentityTypeModal">Add New</button>

    <div class="row">
        <div class="col-8">
            <div class="table-responsive mt-3" id="shipContent">
                <table class="table table-bordered table-hover table-striped mb-4">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Identity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($identity as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $i->name }}</td>
                                <td>
                                    <a href="{{ route('identity-type.edit', $i->id) }}" class="btn btn-warning btn-sm">
                                        <x-bi-pencil-square></x-bi-pencil-square>
                                    </a>
                
                                    <form action="{{ route('identity-type.destroy', $i->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <x-bi-trash-fill></x-bi-trash-fill>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addIdentityTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Identity Type</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('identity-type.store') }}" method="POST">
                        @csrf                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Identity Type</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" required class="form-control" id="colFormLabel" placeholder="Identity Type" value="{{ old('jenis_identitas') }}">
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