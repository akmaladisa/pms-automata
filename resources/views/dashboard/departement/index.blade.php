@extends('layout.main')

@section('css')
<link href="/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')

    @include('sweetalert::alert')

    <h2>Departement List</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#addDepartementModal">Add New</button>

    <div class="table-responsive mt-3" id="shipContent">
        <table class="table table-bordered table-hover table-striped mb-4">
            <thead>
                <tr>
                    <th>Departement ID</th>
                    <th>Departement Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="departement-list">
                
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
                    <form action="departement" method="POST">
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

    {{-- edit departement --}}
    <div class="modal fade" id="editDepartementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Departement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_departement_form" method="POST">
                        @csrf

                        <div class="error-list-edit-departement"></div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Departement ID</label>
                            <div class="col-sm-10">
                                <input name="departement_id" type="text" readonly value="{{ $departementID }}" class="form-control" id="departement_id_edit" placeholder="col-form-label">
                            </div>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Departement Name</label>
                            <div class="col-sm-10">
                                <input name="departement_name" type="text" required class="form-control" id="departement_name_edit" placeholder="departement Name" value="{{ old('departement_name') }}">
                            </div>
                        </div>
                
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                            <select class="form-control col-sm-3" name="status" id="departement_status_edit" required>
                                <option value="ACT">ACT</option>
                                <option value="DE">DE</option>
                            </select>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Updated User</label>
                            <div class="col-sm-10">
                                <input name="updated_user" type="text" readonly value="{{ auth()->user()->id_login }}" required class="form-control" id="updated_user_departement" placeholder="col-form-label">
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

    {{-- show departement --}}
    <div class="modal animated fade" id="show-departement-modal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Departement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contentShowDepartement">
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-group ">
                                <li class="list-group-item active">Departement ID : <span id="departement-id-in-departement"></span></li>
                                <li class="list-group-item active">Departement Name : <span id="departement-name-in-departement"></span></li>
                                <li class="list-group-item active">Status : <span id="departement-status-in-departement"></span></li>
                                <li class="list-group-item active">Created At : <span id="created-at-in-departement"></span></li>
                                <li class="list-group-item active">Updated At : <span id="updated-at-in-departement"></span></li>
                                <li class="list-group-item active">Created By : <span id="created-by-in-departement"></span></li>
                                <li class="list-group-item active">Updated By : <span id="updated-by-in-departement"></span></li>
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

@section("js")
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            fetch_departement()

            // show departement
            $(document).on('click', '.btn-show-departement', function (e) {
                e.preventDefault();
                let id = $(this).val()
                $("#show-departement-modal").modal("show")
                $.ajax({
                    type: "get",
                    url: `departement/${id}`,
                    success: function (response) {
                        if( response.status == 200 ) {
                            $("#departement-id-in-departement").text(response.departement.departement_id)
                            $("#departement-name-in-departement").text(response.departement.departement_name)
                            $("#departement-status-in-departement").text(response.departement.status)
                            $("#created-at-in-departement").text(response.departement.created_at)
                            $("#created-by-in-departement").text(response.departement.created_user)
                            $("#updated-at-in-departement").text(response.departement.updated_at)
                            $("#updated-by-in-departement").text(response.departement.updated_user)
                        } 
                        else {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    }
                });
            });

            // edit departement
            $(document).on('click', '.btn-edit-departement', function (e) {
                e.preventDefault()
                let id = $(this).val()
                $("#editDepartementModal").modal("show")
                $.ajax({
                    type: "get",
                    url: `departement/${id}`,
                    success: function (response) {
                        if( response.status == 200 ) {
                            $("#departement_id_edit").val( response.departement.departement_id )
                            $("#departement_name_edit").val( response.departement.departement_name )
                            $("#departement_status_edit").val( response.departement.status )
                        } else {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    }
                });
            });

            // update dapertement
            $("#edit_departement_form").on('submit', function (e) {
                e.preventDefault()
                let id = $("#departement_id_edit").val()
                let new_departement = {
                    departement_id: $("#departement_id_edit").val(),
                    departement_name: $("#departement_name_edit").val(),
                    status:  $("#departement_status_edit").val(),
                    updated_user: $("#updated_user_departement").val()
                }

                $.ajax({
                    type: "post",
                    url: `departement/${id}`,
                    data: new_departement,
                    success: function (response) {
                        if( response.status == 400 ) {
                            $.each(response.errors, function (indexInArray, valueOfElement) { 
                                $('.error-list-edit-departement').append(
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
                            $("#editDepartementModal").modal("hide")
                            fetch_departement()
                        }

                        if( response.status == 404 ) {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    }
                });
            });

            // delete departement
            $(document).on('click', '.btn-delete-departement', function (e) {
                e.preventDefault()
                let id = $(this).val()

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Departement status will be change to 'DE'",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url:`change-status-departement/${id}`,
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
                                    'Error To Delete Departement',
                                    'error'
                                )
                                
                            } else if( response.status == 200 ) {
                                Swal.fire(
                                    'Success!',
                                    `${response.message}`,
                                    'success'
                                )
                                fetch_departement()
                                
                            }
                        }
                    });
                }
                })
            });

        })

        function fetch_departement() {
            $.ajax({
                type: "get",
                url: "read-departement",
                dataType: "json",
                success: function (response) {
                    $('tbody#departement-list').html('');
                    $.each(response.departements, function (key, record) { 
                    $('tbody#departement-list').append(`
                    <tr>
                        <td>${record.departement_id}</td>
                        <td>${record.departement_name}</td>
                        <td>
                            <button type="button" value="${record.departement_id}" class="btn btn-show-departement btn-info">
                                <i class="bi bi-eye-fill"></i>
                            </button>
        
                            <button type="button" value="${record.departement_id}" class="btn btn-edit-departement btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </button>
        
                            <button type="button" value="${record.departement_id}" class="btn btn-delete-departement btn-danger">
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