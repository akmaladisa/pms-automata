@extends('layout.main')

@section('container')

    @include('sweetalert::alert')

    <h2>Ship Access List</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#shipAccessModal">Add New</button>

    <div class="row">
        <div class="col-8">
            <div class="table-responsive mt-3" id="shipContent">
                <table class="table table-bordered table-hover table-striped mb-4">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Ship ID</th>
                            <th>Crew ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shipAccess as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->id_ship }}</td>
                                <td>{{ $s->id_crew }}</td>
                                <td>
                                    <a href="{{ route('ship-access.edit', $s->id) }}" class="btn btn-warning btn-sm">
                                        <x-bi-pencil-square></x-bi-pencil-square>
                                    </a>
                
                                    <form action="{{ route('ship-access.destroy', $s->id) }}" method="POST" class="d-inline">
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


    <div class="modal fade" id="shipAccessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Ship Access</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ship-access.store') }}" method="POST">
                        @csrf                
                        <select class="custom-select mb-4" required name="id_ship">
                            <option selected disabled>Ship</option>
                            @foreach ($ships as $ship)
                                <option value="{{ $ship->id_ship }}">{{ $ship->ship_nm }}</option>
                            @endforeach
                        </select>
                        <select class="custom-select mb-4" required name="id_crew">
                            <option selected disabled>Crew</option>
                            @foreach ($crews as $crew)
                                <option value="{{ $crew->id_crew }}">{{ $crew->full_name }}</option>
                            @endforeach
                        </select>
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