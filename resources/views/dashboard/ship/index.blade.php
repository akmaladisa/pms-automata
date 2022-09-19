@extends('layout.main')

@section('css')
<link href="/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')

    @include('sweetalert::alert')

    <h2>Ship List</h2>

    <button class="btn btn-dark mt-2" data-toggle="modal" data-target="#addShipModal">Add New</button>

    <div class="table-responsive mt-3" id="shipContent">
        <table class="table mt-3 table-bordered table-hover table-striped mb-4">
            <thead>
                <tr>
                    <th>Ship ID</th>
                    <th>Ship NAME</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="ship-list">
                
            </tbody>
        </table>
    </div>

    


    <div class="modal fade" id="addShipModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Ship</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                
                        <div class="input-group row mb-4">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <textarea class="form-control form-control-sm" id="desc_ship_store" name="description" required aria-label="With textarea">{{ old('description') }}</textarea>
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

    <div class="modal fade" id="editShipModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Ship</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="error-list-edit-ship"></div>

                    <form id="updateShipForm" method="POST">
                        @csrf
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Ship ID</label>
                            <div class="col-sm-10">
                                <input name="id_ship" id="id_ship_edit" type="text" readonly class="form-control" id="colFormLabel" placeholder="col-form-label">
                            </div>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Ship Name</label>
                            <div class="col-sm-10">
                                <input name="ship_nm" id="ship_nm_edit" type="text" required class="form-control" id="colFormLabel" placeholder="Ship Name" value="{{ old('ship_nm') }}">
                            </div>
                        </div>
                
                        <div class="input-group row mb-4">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <textarea class="form-control form-control-sm" id="desc_ship_edit" name="description" required aria-label="With textarea">{{ old('description') }}</textarea>
                        </div>
                
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                            <select class="form-control col-sm-3" id="status_ship_edit" name="status" required>
                                <option value="ACT">ACT</option>
                                <option value="DE">DE</option>
                            </select>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Updated User</label>
                            <div class="col-sm-10">
                                <input name="updated_user" type="text" id="updated_user_ship" readonly value="{{ auth()->user()->id_login }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    {{-- show ship modal --}}
    <div class="modal animated fade" id="show-ship-modal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ship</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contentShowShip">
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-group ">
                                <li class="list-group-item active">Ship ID : <span id="ship-id-in-ship"></span></li>
                                <li class="list-group-item active">Ship Name : <span id="ship-name-in-ship"></span></li>
                                <li class="list-group-item active">Description : <span id="ship-desc-in-ship"></span></li>
                                <li class="list-group-item active">Status : <span id="ship-status-in-ship"></span></li>
                                <li class="list-group-item active">Created At : <span id="created-at-in-ship"></span></li>
                                <li class="list-group-item active">Updated At : <span id="updated-at-in-ship"></span></li>
                                <li class="list-group-item active">Created By : <span id="created-by-in-ship"></span></li>
                                <li class="list-group-item active">Updated By : <span id="updated-by-in-ship"></span></li>
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
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetch_ship();

            // show ship
            $(document).on('click', '.btn-show-ship', function (e) {
                e.preventDefault()
                let id = $(this).val()
                $("#show-ship-modal").modal("show")

                $.ajax({
                    type: "get",
                    url: `ship/${id}`,
                    success: function (response) {
                        if( response.status == 200 ) {
                            $("#ship-id-in-ship").text(response.ship.id_ship)
                            $("#ship-name-in-ship").text(response.ship.ship_nm)
                            $("#ship-desc-in-ship").text(response.ship.description)
                            $("#ship-status-in-ship").text(response.ship.status)
                            $("#created-at-in-ship").text(response.ship.created_at)
                            $("#created-by-in-ship").text(response.ship.created_user)
                            $("#updated-at-in-ship").text(response.ship.updated_at)
                            $("#updated-by-in-ship").text(response.ship.updated_user)
                        }
                        else {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    }
                });

            });

            // delete ship
            $(document).on('click', '.btn-delete-ship', function (e) {
                e.preventDefault()
                let id = $(this).val()

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Ship status will be change to 'DE'",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url:`change-status-ship/${id}`,
                        success: function (response) {
                            if( response.status == 404 ) {
                                Swal.fire(
                                    'Not Found',
                                    `${response.message}`,
                                    'error'
                                )
                                
                            } else if( response.status == 400 ) {
                                Swal.fire(
                                    'Error!',
                                    'Error To Delete Ship',
                                    'error'
                                )
                                
                            } else if( response.status == 200 ) {
                                Swal.fire(
                                    'Success!',
                                    `${response.message}`,
                                    'success'
                                )
                                fetch_ship()
                                
                            }
                        }
                    });
                }
                })
            });

            // edit ship
            $(document).on('click', '.btn-edit-ship', function (e) {
                e.preventDefault();
                let id = $(this).val()
                $("#editShipModal").modal("show")

                $.ajax({
                    type: "get",
                    url: `ship/${id}`,
                    success: function (response) {
                        if( response.status == 200 ) {
                            $("#id_ship_edit").val(response.ship.id_ship);
                            $("#ship_nm_edit").val(response.ship.ship_nm);
                            $("#desc_ship_edit").val(response.ship.description);
                            $("#status_ship_edit").val(response.ship.status);
                        }else {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    }
                });
            });

            // update ship
            $("#updateShipForm").on('submit', function (e) {
                e.preventDefault()
                let id =  $("#id_ship_edit").val()

                let new_ship = {
                    id_ship: $("#id_ship_edit").val(),
                    ship_nm: $("#ship_nm_edit").val(),
                    description: $("#desc_ship_edit").val(),
                    status: $("#status_ship_edit").val(),
                    updated_user: $("#updated_user_ship").val()
                }

                $.ajax({
                    type: "post",
                    url: `ship/${id}`,
                    data: new_ship,
                    success: function (response) {
                        if( response.status == 400 ) {
                            $.each(response.errors, function (indexInArray, valueOfElement) { 
                                $('.error-list-edit-ship').append(
                                    `
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>${valueOfElement}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    `
                                )
                            });
                        }

                        if( response.status == 200 ) {
                            Swal.fire('Success', `${response.message}`, 'success')
                            $("#editShipModal").modal("hide")
                            fetch_ship()
                        }

                        if( response.status == 404 ) {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    }
                });
            });

        })

        function fetch_ship() {
            $.ajax({
                type: "get",
                url: "read-ship",
                dataType: "json",
                success: function (response) {
                    $('tbody#ship-list').html('');
                    $.each(response.ships, function (key, record) { 
                    $('tbody#ship-list').append(`
                    <tr>
                        <td>${record.id_ship}</td>
                        <td>${record.ship_nm}</td>
                        <td>
                            <button type="button" value="${record.id_ship}" class="btn btn-show-ship btn-info">
                                <i class="bi bi-eye-fill"></i>
                            </button>
        
                            <button type="button" value="${record.id_ship}" class="btn btn-edit-ship btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </button>
        
                            <button type="button" value="${record.id_ship}" class="btn btn-delete-ship btn-danger">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </td>
                    </tr>
                    `)
            });
                }
            });
        }
    </script>
@endsection