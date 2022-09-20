@extends('layout.main')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')
    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <button data-toggle="modal" data-target="#add-master-certificate" class="btn btn-secondary mb-4 mr-2">Add New Crew Certificate</button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <table class="table mt-2 table-striped text-center">
                <thead>
                    <tr>
                        <th>Certificate Name</th>
                        <th>Certificate Type</th>
                        <th>Certificate Rank</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="certificate-master-tbody">
                    
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal edit -->
    <div class="modal fade" id="edit-master-certificate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_master_certificate_edit">
                        <input type="hidden" name="id" id="real_id_master_certificate">
                        <div class="form-group">
                            <label for="colFormLabel">Certificate Name</label>
                            <div>
                                <input name="name" type="text" required class="form-control" id="master_certificate_name_edit" placeholder="Name...." value="{{ old('name') }}">
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="colFormLabel">Certificate Type</label>
                            <div>
                                <input name="type" type="text" required class="form-control" id="master_certificate_type_edit" placeholder="Type...." value="{{ old('type') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="colFormLabel">Certificate Rank</label>
                            <div>
                                <input name="rank" type="text" required class="form-control" id="master_certificate_rank_edit" placeholder="Rank...." value="{{ old('rank') }}">
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ADD -->
    <div class="modal fade" id="add-master-certificate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_master_certificate">
                        <div class="form-group">
                            <label for="colFormLabel">Certificate Name</label>
                            <div>
                                <input name="name" type="text" required class="form-control" id="master_certificate_name" placeholder="Name...." value="{{ old('name') }}">
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="colFormLabel">Certificate Type</label>
                            <div>
                                <input name="type" type="text" required class="form-control" id="master_certificate_type" placeholder="Type...." value="{{ old('type') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="colFormLabel">Certificate Rank</label>
                            <div>
                                <input name="rank" type="text" required class="form-control" id="master_certificate_rank" placeholder="Rank...." value="{{ old('rank') }}">
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            fetch_certificate_master()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //edit
            $(document).on('click', '.btn-edit-certificate-master', function (e) {
                e.preventDefault()
                let id = $(this).val()

                $("#edit-master-certificate").modal("show")

                $.ajax({
                    type: "get",
                    url: `crew-certificate-master/${id}`,
                    success: function (response) {
                        if( response.status == 200 ) {
                            $("#real_id_master_certificate").val(response.data.id);
                            $("#master_certificate_name_edit").val(response.data.name);
                            $("#master_certificate_type_edit").val(response.data.type);
                            $("#master_certificate_rank_edit").val(response.data.rank);
                        } else {
                            Swal.fire('Not Found', `${response.message}`, 'error')
                            $("#edit-master-certificate").modal("hide")
                            fetch_certificate_master()
                        }
                    }
                });

            });

            //update
            $('#form_master_certificate_edit').on('submit', function (e) {
                e.preventDefault();
                let id = $("#real_id_master_certificate").val();

                let new_certificate_master = {
                    name: $('#master_certificate_name_edit').val(),
                    type: $('#master_certificate_type_edit').val(),
                    rank: $('#master_certificate_rank_edit').val(),
                }

                $.ajax({
                    type: "post",
                    url: `crew-certificate-master/${id}`,
                    data: new_certificate_master,
                    success: function (response) {
                        if(response.status == 200) {
                            $("#edit-master-certificate").modal("hide")
                            Swal.fire('Success!', `${response.message}`, 'success')
                            fetch_certificate_master()
                        }
                        else if( response.status == 404 ) {
                            $("#edit-master-certificate").modal("hide")
                            Swal.fire('Not Found', `${response.message}`, 'error')
                        } else {
                            Swal.fire("Error!", 'Failed to update certficate', 'error')
                            $("#edit-master-certificate").modal("hide")
                        }
                    }
                });

            });

            //delete
            $(document).on('click', '.btn-delete-certificate-master', function (e) {
                e.preventDefault()
                let id = $(this).val()
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Certificate will be deleted",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: `delete-crew-certificate-master/${id}`,
                            success: function (response) {
                                if(response.status == 200) {
                                    Swal.fire(
                                    'Success!',
                                    `${response.message}`,
                                    'success'
                                    )
                                    fetch_certificate_master()
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        `${response.message}`,
                                        'error'
                                    )
                                    fetch_certificate_master()
                                }
                            }
                        });
                    }
                })
            });

            // store
            $('#form_master_certificate').on('submit', function (e) {
                e.preventDefault()
                $.ajax({
                    type: "post",
                    url: "crew-certificate-master",
                    data: {
                        name: $("#master_certificate_name").val(),
                        type: $("#master_certificate_type").val(),
                        rank: $("#master_certificate_rank").val()
                    },
                    success: function (response) {
                        if( response.status == 200 ) {
                            $("#add-master-certificate").modal("hide")
                            Swal.fire('Success', `${response.message}`, 'success')
                            fetch_certificate_master()

                            $('#master_certificate_name').val('');
                            $('#master_certificate_type').val('');
                            $('#master_certificate_rank').val('');
                        } else {
                            $("#add-master-certificate").modal("hide")
                            Swal.fire("Error", `${response.message}`, 'error')
                            fetch_certificate_master()
                        }
                    }
                });
            });
        })

        function fetch_certificate_master() {
            $.ajax({
                type: "get",
                url: "read-crew-certificate-master",
                dataType: "json",
                success: function (response) {
                    $('tbody#certificate-master-tbody').html('');
                    $.each(response.crew_certificate_master, function (key, record) { 
                        $('tbody#certificate-master-tbody').append(`
                        <tr>
                            <td>${record.name}</td>
                            <td>${record.type}</td>
                            <td>${record.rank}</td>
                            <td>            
                                <button type="button" value="${record.id}" class="btn btn-edit-certificate-master btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
            
                                <button type="button" value="${record.id}" class="btn btn-delete-certificate-master btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                        `)
                    });
                },
                error: function(e) {
                    console.log(e.responseText);
                }
            });
        }
    </script>
@endsection