@extends('layout.main')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <h3>Add Bank</h3>

            <form class="d-inline" id="form_add_bank">
                <div class="input-group">
                    <input name="name" required type="text" id="bank_input" class="form-control form-control-sm" placeholder="Bank..." aria-label="Recipient's username">
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="btn_add_bank" type="submit">
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
                        <th>Bank</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="bank-tbody">

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="edit-bank-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form class="d-inline" id="form_update_bank">
                    <div class="input-group">
                        <input type="hidden" name="id" id="id_bank">
                        <input name="name" required type="text" id="bank_input_edit" class="form-control form-control-sm" placeholder="bank..." aria-label="Recipient's username">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="btn_update_bank" type="submit">
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
        
            fetch_bank()

            $('#form_add_bank').on('submit', function (e) {
                e.preventDefault();
                let bank = { name: $('#bank_input').val() }
                $.ajax({
                    type: "post",
                    url: "bank",
                    data: bank,
                    success: function (response) {
                        if( response.status == 200 ) {
                            Swal.fire(
                                'Success!',
                                `${response.message}`,
                                'success'
                            )
                            $('#bank_input').val('')
                            fetch_bank()
                        } else {
                            Swal.fire(
                                'Error!',
                                `${response.message}`,
                                'error'
                            )
                            fetch_bank()
                        }
                    }
                });
            });

            // updated bank
            $(document).on('submit', '#form_update_bank', function (e) {
                e.preventDefault()
                let id = $('#id_bank').val()
                let bank = { name: $('#bank_input_edit').val() }
                $.ajax({
                    type: "post",
                    url: `bank/${id}`,
                    data: bank,
                    success: function (response) {
                        if( response.status == 200 ) {
                            Swal.fire(
                                'Success!',
                                `${response.message}`,
                                'success'
                            )
                            $('#edit-bank-modal').modal('hide')
                            fetch_bank()

                        } else {
                            Swal.fire(
                                'Error!',
                                `${response.message}`,
                                'error'
                            )
                            $('#edit-bank-modal').modal('hide')
                            fetch_bank()
                        }
                    }
                });
            });

            // edit bank
            $(document).on('click', '.btn-edit-bank', function (e) {
                e.preventDefault()
                $('#edit-bank-modal').modal('show')

                let id = $(this).val();

                $.ajax({
                    type: "get",
                    url: `bank/${id}`,
                    success: function (response) {
                        if( response.status == 200 ) {
                            $('#id_bank').val(response.bank.id);
                            $('#bank_input_edit').val(response.bank.name);
                        } else {
                                    Swal.fire(
                                        'Error!',
                                        `${response.message}`,
                                        'error'
                                    )
                                    fetch_bank()
                                }
                    }
                });
            });

            //delete bank
            $(document).on('click', '.btn-delete-bank', function (e) {
                e.preventDefault();
                let id = $(this).val();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "bank will be deleted",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: `delete-bank/${id}`,
                            success: function (response) {
                                if(response.status == 200) {
                                    Swal.fire(
                                    'Success!',
                                    `${response.message}`,
                                    'success'
                                    )
                                    fetch_bank()
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        `${response.message}`,
                                        'error'
                                    )
                                    fetch_bank()
                                }
                            }
                        });
                    }
                })
            });

        })

        function fetch_bank() {
            let i = 1;
            $.ajax({
                type: "get",
                url: "read-bank",
                dataType: "json",
                success: function (response) {
                    $('#bank-tbody').html('')
                    $.each(response.banks, function (indexInArray, valueOfElement) { 
                        $('#bank-tbody').append(`
                            <tr>
                                <td>${valueOfElement.name}</td>
                                <td>                
                                    <button type="button" value="${valueOfElement.id}" class="btn btn-edit-bank btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                
                                    <button type="button" value="${valueOfElement.id}" class="btn btn-delete-bank btn-danger">
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