@extends('layout.main')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <h3>Add Position</h3>

            <form class="d-inline" id="form_add_position">
                <div class="input-group">
                    <input name="name" required type="text" id="position_input" class="form-control form-control-sm" placeholder="Position..." aria-label="Recipient's username">
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="btn_add_position" type="submit">
                            <x-bi-plus-circle></x-bi-plus-circle>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <table class="table-sm table mt-4 table-striped text-center">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="position-tbody">

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="edit-position-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form class="d-inline" id="form_update_position">
                    <div class="input-group">
                        <input type="hidden" name="id" id="id_position">
                        <input name="name" required type="text" id="position_input_edit" class="form-control form-control-sm" placeholder="Position..." aria-label="Recipient's username">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="btn_update_position" type="submit">
                                <x-bi-plus-circle></x-bi-plus-circle>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
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
        
            fetch_position()

            $('#form_add_position').on('submit', function (e) {
                e.preventDefault();
                let position = { name: $('#position_input').val() }
                $.ajax({
                    type: "post",
                    url: "position",
                    data: position,
                    success: function (response) {
                        if( response.status == 200 ) {
                            Swal.fire(
                                'Success!',
                                `${response.message}`,
                                'success'
                            )
                            $('#position_input').val('')
                            fetch_position()
                        } else {
                            Swal.fire(
                                'Error!',
                                `${response.message}`,
                                'error'
                            )
                            fetch_position()
                        }
                    }
                });
            });

            // updated position
            $(document).on('submit', '#form_update_position', function (e) {
                e.preventDefault()
                let id = $('#id_position').val()
                let position = { name: $('#position_input_edit').val() }
                $.ajax({
                    type: "post",
                    url: `position/${id}`,
                    data: position,
                    success: function (response) {
                        if( response.status == 200 ) {
                            Swal.fire(
                                'Success!',
                                `${response.message}`,
                                'success'
                            )
                            $('#edit-position-modal').modal('hide')
                            fetch_position()

                        } else {
                            Swal.fire(
                                'Error!',
                                `${response.message}`,
                                'error'
                            )
                            $('#edit-position-modal').modal('hide')
                            fetch_position()
                        }
                    }
                });
            });

            // edit position
            $(document).on('click', '.btn-edit-position', function (e) {
                e.preventDefault()
                $('#edit-position-modal').modal('show')

                let id = $(this).val();

                $.ajax({
                    type: "get",
                    url: `position/${id}`,
                    success: function (response) {
                        if( response.status == 200 ) {
                            $('#id_position').val(response.position.id);
                            $('#position_input_edit').val(response.position.name);
                        } else {
                                    Swal.fire(
                                        'Error!',
                                        `${response.message}`,
                                        'error'
                                    )
                                    fetch_position()
                                }
                    }
                });
            });

            //delete position
            $(document).on('click', '.btn-delete-position', function (e) {
                e.preventDefault();
                let id = $(this).val();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Position will be deleted",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: `delete-position/${id}`,
                            success: function (response) {
                                if(response.status == 200) {
                                    Swal.fire(
                                    'Success!',
                                    `${response.message}`,
                                    'success'
                                    )
                                    fetch_position()
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        `${response.message}`,
                                        'error'
                                    )
                                    fetch_position()
                                }
                            }
                        });
                    }
                })
            });

        })

        function fetch_position() {
            let i = 1;
            $.ajax({
                type: "get",
                url: "read-position",
                dataType: "json",
                success: function (response) {
                    $('#position-tbody').html('')
                    $.each(response.positions, function (indexInArray, valueOfElement) { 
                        $('#position-tbody').append(`
                            <tr>
                                <td>${valueOfElement.name}</td>
                                <td>                
                                    <button type="button" value="${valueOfElement.id}" class="btn btn-edit-position btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                
                                    <button type="button" value="${valueOfElement.id}" class="btn btn-delete-position btn-danger">
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