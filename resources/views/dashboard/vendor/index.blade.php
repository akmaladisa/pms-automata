@extends('layout.main')

@section('css')
<link href="/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')

    @include('sweetalert::alert')

    <h2>Vendor List</h2>

    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#addVendorModal">Add New</button>

    <div class="table-responsive mt-3" id="shipContent">
        <table class="table table-bordered table-hover table-striped mb-4">
            <thead>
                <tr>
                    <th>Vendor ID</th>
                    <th>Vendor NAME</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="vendor-list">
                
            </tbody>
        </table>
    </div>

    {{-- show vendor --}}
    <div class="modal animated fade" id="show-vendor-modal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contentShowVendor">
                    <div class="row">
                        <div class="col-12">
                            <div id="alert-show-certificate"></div>
                            <ul class="list-group ">
                                <li class="list-group-item active">Vendor ID : <span id="vendor-id-in-vendor"></span></li>
                                <li class="list-group-item active">Vendor Name : <span id="vendor-name-in-vendor"></span></li>
                                <li class="list-group-item active">Status : <span id="vendor-status-in-vendor"></span></li>
                                <li class="list-group-item active">Created At : <span id="created-at-in-vendor"></span></li>
                                <li class="list-group-item active">Updated At : <span id="updated-at-in-vendor"></span></li>
                                <li class="list-group-item active">Created By : <span id="created-by-in-vendor"></span></li>
                                <li class="list-group-item active">Updated By : <span id="updated-by-in-vendor"></span></li>
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
    {{-- show vendor end--}}

    <div class="modal fade" id="addVendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="vendors" method="POST">
                        @csrf
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Vendor ID</label>
                            <div class="col-sm-10">
                                <input name="vendor_id" type="text" readonly value="{{ $vendorId }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                            </div>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Vendor Name</label>
                            <div class="col-sm-10">
                                <input name="vendor_name" type="text" required class="form-control" id="colFormLabel" placeholder="Vendor Name" value="{{ old('vendor_name') }}">
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

    <div class="modal fade" id="editVendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_edit_vendor" method="POST">
                        @csrf

                        <div class="error-list-edit-vendor"></div>

                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Vendor ID</label>
                            <div class="col-sm-10">
                                <input name="vendor_id" type="text" readonly value="{{ $vendorId }}" class="form-control" id="vendor_id_edit" placeholder="col-form-label">
                            </div>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Vendor Name</label>
                            <div class="col-sm-10">
                                <input name="vendor_name" type="text" required class="form-control" id="vendor_name_edit" placeholder="Vendor Name" value="{{ old('vendor_name') }}">
                            </div>
                        </div>
                
                        <div class="input-group mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                            <select class="form-control col-sm-3" id="vendor_status_edit" name="status" required>
                                <option value="ACT">ACT</option>
                                <option value="DE">DE</option>
                            </select>
                        </div>
                
                        <div class="form-group row mb-4">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Updated User</label>
                            <div class="col-sm-10">
                                <input name="updated_user" type="text" readonly value="{{ auth()->user()->id_login }}" required class="form-control" id="updated_user_vendor" placeholder="col-form-label">
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

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            fetch_vendor()

            // show vendor
            $(document).on('click', '.btn-show-vendor', function (e) {
                e.preventDefault();
                let id = $(this).val()
                $("#show-vendor-modal").modal("show")

                $.ajax({
                    type: "get",
                    url: `vendors/${id}`,
                    success: function (response) {
                        if( response.status == 200 ) {
                            $("#vendor-id-in-vendor").text(response.vendor.vendor_id)
                            $("#vendor-name-in-vendor").text(response.vendor.vendor_name)
                            $("#vendor-status-in-vendor").text(response.vendor.status)
                            $("#created-at-in-vendor").text(response.vendor.created_at)
                            $("#created-by-in-vendor").text(response.vendor.created_user)
                            $("#updated-at-in-vendor").text(response.vendor.updated_at)
                            $("#updated-by-in-vendor").text(response.vendor.updated_user)
                        }
                        else {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });

            });

            // edit vendor
            $(document).on('click', '.btn-edit-vendor', function (e) {
                e.preventDefault()
                let id = $(this).val()
                $("#editVendorModal").modal("show")

                $.ajax({
                    type: "get",
                    url: `vendors/${id}`,
                    success: function (response) {
                        if( response.status == 200 ) {
                            $("#vendor_id_edit").val( response.vendor.vendor_id )
                            $("#vendor_name_edit").val( response.vendor.vendor_name )
                            $("#vendor_status_edit").val( response.vendor.status )
                        }
                        else {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    }
                });
            });

            // update vendor
            $("#form_edit_vendor").on('submit', function (e) {
                e.preventDefault()
                let id =  $("#vendor_id_edit").val()
                let new_vendor = {
                    vendor_id: $("#vendor_id_edit").val(),
                    vendor_name: $("#vendor_name_edit").val(),
                    status: $("#vendor_status_edit").val(),
                    updated_user: $("#updated_user_vendor").val()
                }

                $.ajax({
                    type: "post",
                    url: `vendors/${id}`,
                    data: new_vendor,
                    success: function (response) {
                        if( response.status == 400 ) {
                            $.each(response.errors, function (indexInArray, valueOfElement) { 
                                $('.error-list-edit-vendor').append(
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
                            $("#editVendorModal").modal("hide")
                            fetch_vendor()
                        }

                        if( response.status == 404 ) {
                            Swal.fire("404", `${response.message}`, 'error')
                        }
                    }
                });
            });

            // delete vendor
            $(document).on('click', '.btn-delete-vendor', function (e) {
                e.preventDefault()
                let id = $(this).val()

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Vendor status will be change to 'DE'",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url:`change-status-vendor/${id}`,
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
                                    'Error To Delete Vendor',
                                    'error'
                                )
                                
                            } else if( response.status == 200 ) {
                                Swal.fire(
                                    'Success!',
                                    `${response.message}`,
                                    'success'
                                )
                                fetch_vendor()
                                
                            }
                        }
                    });
                }
                })
            });

        })


        function fetch_vendor() {
            $.ajax({
                type: "get",
                url: "read-vendors",
                dataType: "json",
                success: function (response) {
                    $('tbody#vendor-list').html('');
                    $.each(response.vendors, function (key, record) { 
                    $('tbody#vendor-list').append(`
                    <tr>
                        <td>${record.vendor_id}</td>
                        <td>${record.vendor_name}</td>
                        <td>
                            <button type="button" value="${record.vendor_id}" class="btn btn-show-vendor btn-info">
                                <i class="bi bi-eye-fill"></i>
                            </button>
        
                            <button type="button" value="${record.vendor_id}" class="btn btn-edit-vendor btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </button>
        
                            <button type="button" value="${record.vendor_id}" class="btn btn-delete-vendor btn-danger">
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