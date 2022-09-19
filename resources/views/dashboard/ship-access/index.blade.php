@extends('layout.main')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
@endsection

@section('container')

    @include('sweetalert::alert')

    <h2>Ship Access List</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#shipAccessModalAdd">Add New</button>

    <div class="row">
        <div class="col-8">
            <div class="table-responsive mt-3" id="shipContent">
                <table class="table table-bordered table-hover table-striped mb-4">
                    <thead>
                        <tr>
                            <th>Ship ID</th>
                            <th>Crew ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="ship-access-list">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="shipAccessModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Ship Access</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="list-error-ship-access"></div>

                    <form id="addShipAccessForm" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Ship</label>
                            <select class="custom-select" required name="id_ship" id="id_ship_ship_access">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Crew</label>
                            <select class="custom-select" required name="id_crew" id="id_crew_ship_access">
                                
                            </select>
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

    <div class="modal fade" id="shipAccessModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Ship Access</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="list-error-ship-access-edit"></div>
                    
                    <form id="editShipAccessForm" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id_ship_access">
                        <div class="form-group">
                            <label>Ship</label>
                            <select class="custom-select" required name="id_ship" id="id_ship_ship_access_edit">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Crew</label>
                            <select class="custom-select" required name="id_crew" id="id_crew_ship_access_edit">
                                
                            </select>
                        </div>                
                </div>
                <div class="modal-footer">
                    <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">update</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal animated fade" id="show-ship-access-modal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ship Access</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contentShowShip">
                    <div class="row">
                        <div class="col-12">
                            <div id="alert-show-certificate"></div>
                            <ul class="list-group ">
                                <li class="list-group-item active">Ship ID : <span id="ship-id-in-ship-access"></span></li>
                                <li class="list-group-item active">Ship Name : <span id="ship-name-in-ship-access"></span></li>
                                <li class="list-group-item active">Crew ID : <span id="crew-id-in-ship-access"></span></li>
                                <li class="list-group-item active">Crew Name : <span id="crew-name-in-ship-access"></span></li>
                                <li class="list-group-item active">Created At : <span id="created-at-in-ship-access"></span></li>
                                <li class="list-group-item active">Updated At : <span id="updated-at-in-ship-access"></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeFormModal" data-dismiss="modal" lang="en">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="/js/crew-medical-record.js"></script>
    <script src="/js/ship-access.js"></script>
@endsection