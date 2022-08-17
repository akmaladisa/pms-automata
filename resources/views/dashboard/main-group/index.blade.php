@extends('layout.main')

@section('container')

    @include('sweetalert::alert')

    <h2>Main Group List</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#addMainGroupModal">Add New</button>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive mt-3" id="shipContent">
                <table class="table table-bordered table-hover table-striped mb-4">
                    <thead>
                        <tr>
                            <th>Stuff ID</th>
                            <th>Main Group Code</th>
                            <th>Main Group Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mainGroup as $m)
                            <tr>
                                <td>{{ $m->kode_barang }}</td>
                                <td>{{ $m->code_main_group }}</td>
                                <td>{{ $m->main_group_name }}</td>
                                <td>
                                    <a href="{{ route('main-group.show', $m->code_main_group) }}" class="btn btn-info btn-sm">
                                        <x-bi-eye-fill></x-bi-eye-fill>
                                    </a>

                                    <a href="{{ route('main-group.edit', $m->code_main_group) }}" class="btn btn-warning btn-sm">
                                        <x-bi-pencil-square></x-bi-pencil-square>
                                    </a>
                
                                    <form action="{{ route('main-group.destroy', $m->code_main_group) }}" method="POST" class="d-inline">
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


    <div class="modal fade" id="addMainGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Main Group</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('main-group.store') }}" method="POST">
                        @csrf                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Stuff ID</label>
                            <div class="col-sm-10">
                                <input name="kode_barang" type="text" required class="form-control" id="colFormLabel" readonly placeholder="Identity Type" value="{{ $kode_barang }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Main Group Code</label>
                            <div class="col-sm-10">
                                <input min="1" max="9" name="code_main_group" type="number" required class="form-control" id="colFormLabel" placeholder="Main Group Code" value="{{ old('code_main_group') }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Main Group Name</label>
                            <div class="col-sm-10">
                                <input name="main_group_name" type="text" required class="form-control" id="colFormLabel" placeholder="Main Group Name" value="{{ old('main_group_name') }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Created User</label>
                            <div class="col-sm-10">
                                <input name="created_user" type="text" required class="form-control" id="colFormLabel" placeholder="" readonly value="{{ auth()->user()->id_login }}">
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