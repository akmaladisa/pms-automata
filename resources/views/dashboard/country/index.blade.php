@extends('layout.main')

@section('css')
<link href="/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="country-list">
                
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addCountryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="country" method="POST">
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

                        <div class="input-group row mb-4">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <textarea class="form-control form-control-sm" id="desc_country_store" name="description" required aria-label="With textarea">{{ old('description') }}</textarea>
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

    <div class="modal fade" id="editCountryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_country_form" method="POST">
                        @csrf

                        <div class="error-list-edit-country"></div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Country ID</label>
                            <div class="col-sm-10">
                                <input name="id_country" required type="text" readonly value="{{ $countryId }}" class="form-control" id="country_id_edit" placeholder="col-form-label">
                            </div>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Country Name</label>
                            <div class="col-sm-10">
                                <input name="country_nm" type="text" required class="form-control" id="country_name_edit" placeholder="country Name" value="{{ old('country_name') }}">
                            </div>
                        </div>

                        <div class="input-group row mb-4">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <textarea class="form-control form-control-sm" id="country_desc_edit" name="description" required aria-label="With textarea">{{ old('description') }}</textarea>
                        </div>
                
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                            <select class="form-control col-sm-3" id="country_status_edit" name="status" required>
                                <option value="ACT">ACT</option>
                                <option value="DE">DE</option>
                            </select>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Updated User</label>
                            <div class="col-sm-10">
                                <input name="updated_user" type="text" readonly value="{{ auth()->user()->id_login }}" required class="form-control" id="updated_user_country" placeholder="col-form-label">
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

    {{-- show country --}}
    <div class="modal animated fade" id="show-country-modal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contentShowCountry">
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-group ">
                                <li class="list-group-item active">Country ID : <span id="country-id-in-country"></span></li>
                                <li class="list-group-item active">Country Name : <span id="country-name-in-country"></span></li>
                                <li class="list-group-item active">Description : <span id="country-desc-in-country"></span></li>
                                <li class="list-group-item active">Status : <span id="country-status-in-country"></span></li>
                                <li class="list-group-item active">Created At : <span id="created-at-in-country"></span></li>
                                <li class="list-group-item active">Updated At : <span id="updated-at-in-country"></span></li>
                                <li class="list-group-item active">Created By : <span id="created-by-in-country"></span></li>
                                <li class="list-group-item active">Updated By : <span id="updated-by-in-country"></span></li>
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
            fetch_country()

            // show country
            $(document).on('click', '.btn-show-country', function (e) {
                e.preventDefault()
                let id = $(this).val()
                $("#show-country-modal").modal("show")

                $.ajax({
                    type: "get",
                    url: `country/${id}`,
                    success: function (response) {
                        if( response.status == 200 ) {
                            $("#country-id-in-country").text(response.country.id_country)
                            $("#country-name-in-country").text(response.country.country_nm)
                            $("#country-desc-in-country").text(response.country.description)
                            $("#country-status-in-country").text(response.country.status)
                            $("#created-at-in-country").text(response.country.created_at)
                            $("#created-by-in-country").text(response.country.created_user)
                            $("#updated-at-in-country").text(response.country.updated_at)
                            $("#updated-by-in-country").text(response.country.updated_user)
                        }
                        else {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    }
                });
            });

            //edit country
            $(document).on('click', '.btn-edit-country', function (e) {
                e.preventDefault()
                let id = $(this).val()
                $("#editCountryModal").modal("show")
                $.ajax({
                    type: "get",
                    url: `country/${id}`,
                    success: function (response) {
                        if( response.status == 200 ) {
                            $("#country_id_edit").val( response.country.id_country )
                            $("#country_name_edit").val( response.country.country_nm )
                            $("#country_status_edit").val( response.country.status )
                            $("#country_desc_edit").val( response.country.description )
                        }
                        else {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    }
                });
            });

            // update country
            $("#edit_country_form").on('submit', function (e) {
                e.preventDefault()
                let id =  $("#country_id_edit").val();
                let new_country = {
                    id_country: $("#country_id_edit").val(),
                    country_nm: $("#country_name_edit").val(),
                    description: $("#country_desc_edit").val(),
                    status:  $("#country_status_edit").val(),
                    updated_user: $("#updated_user_country").val()
                }

                $.ajax({
                    type: "post",
                    url: `country/${id}`,
                    data: new_country,
                    success: function (response) {
                        if( response.status == 400 ) {
                            $.each(response.errors, function (indexInArray, valueOfElement) { 
                                $('.error-list-edit-country').append(
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
                            $("#editCountryModal").modal("hide")
                            fetch_country()
                        }

                        if( response.status == 404 ) {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    }
                });
            });

            // delete country
            $(document).on('click', '.btn-delete-country', function (e) {
                e.preventDefault()
                let id = $(this).val()
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Country status will be change to 'DE'",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url:`change-status-country/${id}`,
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
                                    'Error To Delete Country',
                                    'error'
                                )
                                
                            } else if( response.status == 200 ) {
                                Swal.fire(
                                    'Success!',
                                    `${response.message}`,
                                    'success'
                                )
                                fetch_country()
                                
                            }
                        }
                    });
                }
                })
            });

        })

        function fetch_country() {
            $.ajax({
                type: "get",
                url: "read-country",
                dataType: "json",
                success: function (response) {
                    $('tbody#country-list').html('');
                    $.each(response.countries, function (key, record) { 
                    $('tbody#country-list').append(`
                    <tr>
                        <td>${record.id_country}</td>
                        <td>${record.country_nm}</td>
                        <td>
                            <button type="button" value="${record.id_country}" class="btn btn-show-country btn-info">
                                <i class="bi bi-eye-fill"></i>
                            </button>
        
                            <button type="button" value="${record.id_country}" class="btn btn-edit-country btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </button>
        
                            <button type="button" value="${record.id_country}" class="btn btn-delete-country btn-danger">
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