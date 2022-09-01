$(document).ready(function() {

    fetch_bank()
    fetch_crew_bank_account()
    fetch_crew_list()

    $('#crew_bank_add_btn_modal').on('click', function (e) {
        e.preventDefault();
        
        remove_required_attribute_from_crew_master_modal_edit_input()
        remove_required_attribute_from_crew_master_modal_input()

        $("#add-crew-bank-modal").modal('show');
    });

    $("#add-crew-bank-modal").on("hidden.bs.modal", function () {
        add_required_attribute_from_crew_master_modal_edit_input()
        add_required_attribute_from_crew_master_modal_input()
    });

    // edit crew bank
    $(document).on('click', '.btn-edit-crew-bank', function (e) {
        e.preventDefault()
        let id = $(this).val();

        $("#edit-crew-bank-modal").modal('show')
        
        $.ajax({
            type: "get",
            url: `crew-bank/${id}`,
            success: function (response) {
                if(response.status == 200) {
                    $('#id_crew_bank_edit').val(response.crew_bank.id_crew)
                    $('#fetched_bank_edit').val(response.crew_bank.bank_name)
                    $('#crew_account_number_bank_edit').val(response.crew_bank.account_number)
                    $('#crew_account_name_bank_edit').val(response.crew_bank.account_name)
                    $('#crew_salary_transfer_bank_edit').val(response.crew_bank.salary_transfer)
                    $('#crew_remarks_bank_edit').val(response.crew_bank.remarks)
                    $('#status_crew_bank_edit').val(response.crew_bank.status)
                    $('#id_crew_bank_real').val(response.crew_bank.id);
                }
                else
                {
                    Swal.fire(
                        'Not Found',
                        `${response.message}`,
                        'error'
                    )
                    $('#edit-crew-bank-modal').modal('hide');
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    //update crew bank
    $(document).on('submit', '#form-edit-crew-bank', function (e) {
        e.preventDefault()
        let id = $('#id_crew_bank_real').val();

        let new_crew_bank = {
            id_crew: $('#id_crew_bank_edit').val(),
            bank_name: $("#fetched_bank_edit").val(),
            account_number: $('#crew_account_number_bank_edit').val(),
            account_name: $('#crew_account_name_bank_edit').val(),
            salary_transfer: $('#crew_salary_transfer_bank_edit').val(),
            remarks: $('#crew_remarks_bank_edit').val(),
            status: $('#status_crew_bank_edit').val(),
        }

        $.ajax({
            type: "post",
            url: `crew-bank/${id}`,
            data: new_crew_bank,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#edit-crew-bank-modal").modal('hide')
                    Swal.fire('Success!', `${response.message}`, 'success')

                    fetch_crew_bank_account()
                    fetch_bank()
                    fetch_crew_list()
                }
                else if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-bank-edit').append(
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
                else if( response.status == 404 ) {
                    $("#edit-crew-bank-modal").modal('hide')
                    Swal.fire('Not Found!', `${response.message}`, 'error')

                    fetch_crew_bank_account()
                    fetch_bank()
                    fetch_crew_list()
                }
            }
        });
    });

    // delete crew bank
    $(document).on('click', '.btn-delete-crew-bank', function (e) {
        e.preventDefault();
        let id = $(this).val()

        Swal.fire({
            title: 'Are you sure?',
            text: "The status will be change to 'DE'",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: `change-status-crew-bank/${id}`,
                    success: function (response) {
                        if( response.status == 404 ) {
                            Swal.fire(
                                'Not Found',
                                `${response.message}`,
                                'error'
                            )
                            fetch_crew_bank_account()
                            fetch_crew_list()
                            fetch_bank()

                        } else if( response.status == 400 ) {
                            Swal.fire(
                                'Error!',
                                'Error To Delete Crew',
                                'error'
                            )
                            fetch_crew_bank_account()
                            fetch_crew_list()
                            fetch_bank()

                        } else if( response.status == 200 ) {
                            Swal.fire(
                                'Success!',
                                `${response.message}`,
                                'success'
                            )
                            fetch_crew_bank_account()
                            fetch_crew_list()
                            fetch_bank()
                        }
                    }
                });
            }
        })
    });

    // show crew bank
    $(document).on('click', '.btn-show-crew-bank', function (e) {
        e.preventDefault()
        $("#show-crew-bank").modal('show');
        let id = $(this).val()

        $.ajax({
            type: "get",
            url: `crew-bank/${id}`,
            dataType: "json",
            contentType:'application/json',
            success: function (response) {
                if(response.status == 200) {

                    $('#crew-name-bank').text(response.crew_name);
                    $('#crew-id-bank').text(response.crew_bank.id_crew);
                    $('#crew-bank-name-bank').text(response.crew_bank.bank_name);
                    $('#crew-account-number-bank').text(response.crew_bank.account_number);
                    $('#crew-account-name-bank').text(response.crew_bank.account_name);
                    $('#crew-salary-transfer-bank').text(response.crew_bank.salary_transfer);
                    $('#crew-remarks-bank').text(response.crew_bank.remarks);
                    $('#crew-status-bank').text(response.crew_bank.status);
                    $('#crew-created-at-bank').text(response.crew_bank.created_at);
                    $('#crew-updated-at-bank').text(response.crew_bank.updated_at);

                }else {
                    Swal.fire('Error!', `${response.message}`, 'error')
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // store crew bank
    $('#form-add-crew-bank').on('submit', function (e) {
        e.preventDefault()
        let crew_bank_data = {
            id_crew: $('#id_crew_bank').val(),
            bank_name: $("#fetched_bank").val(),
            account_number: $('#crew_account_number_bank').val(),
            account_name: $('#crew_account_name_bank').val(),
            salary_transfer: $('#crew_salary_transfer_bank').val(),
            remarks: $('#crew_remarks_bank').val(),
            status: $('#status_crew_bank').val(),
        }

        $.ajax({
            type: "post",
            url: "crew-bank",
            data: crew_bank_data,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#add-crew-bank-modal").modal('hide');
                    Swal.fire('Success!', `${response.message}`, 'success');
                    fetch_bank()
                    fetch_crew_bank_account()
                    fetch_crew_list()

                    // reset form
                    $("#crew_account_number_bank").val('')
                    $("#crew_account_name_bank").val('')
                    $("#crew_salary_transfer_bank").val('')
                    $("#crew_remarks_bank").val('')
                }
                else
                {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-bank').append(
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
            }
        });
    });

})

// ===FUNCTION LIST====
function fetch_bank() {
    $.ajax({
        type: "get",
        url: "read-bank",
        dataType: "json",
        success: function (response) {
            $('#fetched_bank').html('');
            $.each(response.banks, function (indexInArray, valueOfElement) { 
                $('#fetched_bank').append(`
                    <option value="${valueOfElement.name}">${valueOfElement.name}</option>
                `)
            });

            $('#fetched_bank_edit').html('');
            $.each(response.banks, function (indexInArray, valueOfElement) { 
                $('#fetched_bank_edit').append(`
                    <option value="${valueOfElement.name}">${valueOfElement.name}</option>
                `)
            });
        }
    });
}

function fetch_crew_bank_account() {
    $.ajax({
        type: "get",
        url: "read-crew-bank",
        dataType: "json",
        success: function (response) {
            $('tbody#crew-bank-tbody').html('');
            $.each(response.crew_bank_accounts, function (key, record) { 
                $('tbody#crew-bank-tbody').append(`
                <tr>
                    <td>${record.id_crew}</td>
                    <td>${record.bank_name}</td>
                    <td>${record.account_number}</td>
                    <td>
                        <button type="button" value="${record.id}" class="btn btn-show-crew-bank btn-info">
                            <i class="bi bi-eye-fill"></i>
                        </button>
    
                        <button type="button" value="${record.id}" class="btn btn-edit-crew-bank btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </button>
    
                        <button type="button" value="${record.id}" class="btn btn-delete-crew-bank btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
                `)
            });
        }
    });
}