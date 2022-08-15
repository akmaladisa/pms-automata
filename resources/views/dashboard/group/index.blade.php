@extends('layout.main')

@section('container')

    @include('sweetalert::alert')

    <h2>Group List</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#addGroupModal">Add New</button>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive mt-3" id="shipContent">
                <table class="table table-bordered table-hover table-striped mb-4">
                    <thead>
                        <tr>
                            <th>Group Code</th>
                            <th>Main Group Code</th>
                            <th>Group Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $g)
                            <tr>
                                <td>{{ $g->code_group }}</td>
                                <td>{{ $g->code_main_group }}</td>
                                <td>{{ $g->group_name }}</td>
                                <td>
                                    <a href="{{ route('group.show', $g->code_group) }}" class="btn btn-info btn-sm">
                                        <x-bi-eye-fill></x-bi-eye-fill>
                                    </a>

                                    <a href="{{ route('group.edit', $g->code_group) }}" class="btn btn-warning btn-sm">
                                        <x-bi-pencil-square></x-bi-pencil-square>
                                    </a>
                
                                    <form action="{{ route('group.destroy', $g->code_group) }}" method="POST" class="d-inline">
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


    <div class="modal fade" id="addGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Group</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('group.store') }}" method="POST">
                        @csrf                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Group Code</label>
                            <div class="col-sm-10">
                                <input min="10" max="99" name="code_group" type="number" required class="form-control" id="colFormLabel" placeholder="Group Code" value="{{ old('code_group') }}">
                            </div>
                        </div>
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Main Group</label>
                            <select class="form-control col-sm-8" id="status_ship_store" name="code_main_group" required>
                                <option disabled selected>Main Group</option>
                                @foreach ($mainGroups as $mg)
                                    <option value="{{ $mg->code_main_group }}">{{ $mg->code_main_group }}) {{ $mg->main_group_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Group Name</label>
                            <div class="col-sm-10">
                                <input name="group_name" type="text" required class="form-control" id="colFormLabel" placeholder="Group Name" value="{{ old('group_name') }}">
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