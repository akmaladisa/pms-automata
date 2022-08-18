@extends('layout.main')

@section('container')

    @include('sweetalert::alert')

    <h2>Part List</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#addPartModal">Add New</button>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive mt-3" id="shipContent">
                <table class="table table-bordered table-hover table-striped mb-4">
                    <thead>
                        <tr>
                            <th>Part Code</th>
                            <th>Main Group Code</th>
                            <th>Group Code</th>
                            <th>Sub Group Code</th>
                            <th>Unit Code</th>
                            <th>Component Code</th>
                            <th>Part Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parts as $part)
                            <tr>
                                <td>{{ $part->code_part }}</td>
                                <td>{{ $part->code_main_group }}</td>
                                <td>{{ $part->code_group }}</td>
                                <td>{{ $part->code_sub_group }}</td>
                                <td>{{ $part->code_unit }}</td>
                                <td>{{ $part->code_part }}</td>
                                <td>{{ $part->part_name }}</td>
                                <td>
                                    <a href="{{ route('part.show', $part->code_part) }}" class="btn btn-info btn-sm">
                                        <x-bi-eye-fill></x-bi-eye-fill>
                                    </a>

                                    <a href="{{ route('part.edit', $part->code_part) }}" class="btn btn-warning btn-sm">
                                        <x-bi-pencil-square></x-bi-pencil-square>
                                    </a>
                
                                    <a href="{{ route('part.isDeleted', $part->code_part) }}" class="btn btn-danger btn-sm">
                                        <x-bi-trash-fill></x-bi-trash-fill>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addPartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Part</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('part.store') }}" method="POST">
                        @csrf                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Part Code</label>
                            <div class="col-sm-10">
                                <input min="100000000000" max="999999999999" name="code_part" type="number" required class="form-control" id="colFormLabel" placeholder="Part Code" value="{{ old('code_part') }}">
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
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Group</label>
                            <select class="form-control col-sm-8" id="status_ship_store" name="code_group" required>
                                <option disabled selected>Group</option>
                                @foreach ($groups as $g)
                                    <option value="{{ $g->code_group }}">{{ $g->code_group }}) {{ $g->group_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Sub Group</label>
                            <select class="form-control col-sm-8" id="status_ship_store" name="code_sub_group" required>
                                <option disabled selected>Sub Group</option>
                                @foreach ($subGroups as $sg)
                                    <option value="{{ $sg->code_sub_group }}">{{ $sg->code_sub_group }}) {{ $sg->sub_group_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Unit</label>
                            <select class="form-control col-sm-8" id="status_ship_store" name="code_unit" required>
                                <option disabled selected>Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->code_unit }}">{{ $unit->code_unit }}) {{ $unit->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Component</label>
                            <select class="form-control col-sm-8" id="status_ship_store" name="code_component" required>
                                <option disabled selected>Unit</option>
                                @foreach ($components as $component)
                                    <option value="{{ $component->code_component }}">{{ $component->code_component }}) {{ $component->component_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Part Name</label>
                            <div class="col-sm-10">
                                <input name="part_name" type="text" required class="form-control" id="colFormLabel" placeholder="Part Name" value="{{ old('part_name') }}">
                            </div>
                        </div>
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Is Deleted?</label>
                            <select class="form-control col-sm-8" id="status_ship_store" name="is_deleted" required>
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
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