$(document).ready(function() {
    fetch_crew_insurance()
    fetch_crew_list()

    $('#crew_insurance_add_btn_modal').on('click', function (e) {
        e.preventDefault();
        
        remove_required_attribute_from_crew_master_modal_edit_input()
        remove_required_attribute_from_crew_master_modal_input()

        $("#add-crew-insurance-modal").modal('show');
    });

    $("#add-crew-insurance-modal").on("hidden.bs.modal", function () {
        add_required_attribute_from_crew_master_modal_edit_input()
        add_required_attribute_from_crew_master_modal_input()
    });

    // store crew insurance
    $("#form-add-crew-insurance").on('submit', function(e) {
        e.preventDefault()
        let crew_insurances_data = {
            id_crew: $('#id_crew_insurance').val(),
            insurance_name: $('#crew_insurance_name_insurance').val(),
            account_number: $('#crew_account_number_insurance').val(),
            insurance_type: $('#crew_insurance_type_insurance').val(),
            name_of_heritage: $('#crew_name_of_heritage_insurance').val(),
            remarks: $('#crew_remarks_insurance').val(),
            status: $('#status_crew_insurance').val(),
        }

        $.ajax({
            type: "post",
            url: "crew-insurance",
            data: crew_insurances_data,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire('Success', `${response.message}`, 'success')
                    $("#add-crew-insurance-modal").modal('hide');
                    fetch_crew_insurance()
                    fetch_crew_list()

                    // reset form
                    $('#crew_insurance_name_insurance').val('')
                    $('#crew_account_number_insurance').val('')
                    $('#crew_insurance_type_insurance').val('')
                    $('#crew_name_of_heritage_insurance').val('')
                    $('#crew_remarks_insurance').val('')

                } else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-insurance').append(
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
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    })

    // show crew insurance
    $(document).on('click', '.btn-show-crew-insurance ', function (e) {
        e.preventDefault()
        let id = $(this).val();
        $("#show-crew-insurance").modal('show');

        $.ajax({
            type: "get",
            url: `crew-insurance/${id}`,
            dataType: "json",
            contentType:'application/json',
            success: function (response) {
                if( response.status == 200 )
                {
                    $('#crew-name-insurace').text(response.crew_name);
                    $('#crew-id-insurace').text(response.crew_insurance.id_crew);
                    $('#crew-insurance-name-insurance').text(response.crew_insurance.insurance_name);
                    $('#crew-account-number-insurance').text(response.crew_insurance.account_number);
                    $('#crew-insurane-type-name-insurance').text(response.crew_insurance.insurance_type);
                    $('#crew-name-of-heritage-insurance').text(response.crew_insurance.name_of_heritage);
                    $('#crew-remarks-insurance').text(response.crew_insurance.remarks);
                    $('#crew-status-insurance').text(response.crew_insurance.status);
                    $('#crew-created-at-insurance').text(response.crew_insurance.created_at);
                    $('#crew-updated-at-insurance').text(response.crew_insurance.updated_at);

                }
                else
                {
                    Swal.fire('Error!', `${response.message}`, 'error')
                }
            },
            error: function(err) {
                console.log(err.responseText);
            }
        });
    });

    // edit crew insurance
    $(document).on('click', '.btn-edit-crew-insurance', function (e) {
        e.preventDefault()
        let id = $(this).val();
        $("#edit-crew-insurance-modal").modal('show');

        $.ajax({
            type: "get",
            url: `crew-insurance/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $('#id_crew_insurance_edit').val(response.crew_insurance.id_crew)
                    $('#crew_insurance_name_insurance_edit').val(response.crew_insurance.insurance_name)
                    $('#crew_account_number_insurance_edit').val(response.crew_insurance.account_number)
                    $('#crew_insurance_type_insurance_edit').val(response.crew_insurance.insurance_type)
                    $('#crew_name_of_heritage_insurance_edit').val(response.crew_insurance.name_of_heritage)
                    $('#crew_remarks_insurance_edit').val(response.crew_insurance.remarks)
                    $('#status_crew_insurance_edit').val(response.crew_insurance.status)
                    $('#real_ID_crew_insurance').val(response.crew_insurance.id)
                }
                else
                {
                    Swal.fire('Error!', `${response.message}`, 'error')
                    $("#edit-crew-insurance-modal").modal('hide');
                }
            }
        });
    });

    // update crew insurance
    $('#form-edit-crew-insurance').on('submit', function (e) {
        e.preventDefault()
        let id = $('#real_ID_crew_insurance').val()

        let new_crew_insurance = {
            id_crew: $('#id_crew_insurance_edit').val(),
            insurance_name: $('#crew_insurance_name_insurance_edit').val(),
            account_number: $('#crew_account_number_insurance_edit').val(),
            insurance_type: $('#crew_insurance_type_insurance_edit').val(),
            name_of_heritage: $('#crew_name_of_heritage_insurance_edit').val(),
            remarks: $('#crew_remarks_insurance_edit').val(),
            status: $('#status_crew_insurance_edit').val(),
        }

        $.ajax({
            type: "post",
            url: `crew-insurance/${id}`,
            data: new_crew_insurance,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#edit-crew-insurance-modal").modal('hide');
                    Swal.fire("Success", `${response.message}`, 'success')
                    fetch_crew_insurance()
                    fetch_crew_list()
                }
                else if( response.status == 404 ) {
                    $("#edit-crew-insurance-modal").modal('hide');
                    Swal.fire("Not Found", `${response.message}`, 'error')
                    fetch_crew_insurance()
                    fetch_crew_list()
                }
                else if( response.status == 400 ) {
                    $('.alert-group-list-insurance-edit').append(
                        `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>${valueOfElement}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        `
                    )
                }
            }
        });
    });

    // delete crew insurance
    $(document).on('click', '.btn-delete-crew-insurance', function (e) {
        e.preventDefault()
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
                    url: `change-status-crew-insurance/${id}`,
                    success: function (response) {
                        if( response.status == 404 ) {
                            Swal.fire(
                                'Not Found',
                                `${response.message}`,
                                'error'
                            )
                            fetch_crew_insurance()
                            fetch_crew_list()

                        } else if( response.status == 400 ) {
                            Swal.fire(
                                'Error!',
                                'Error To Delete Crew',
                                'error'
                            )
                            fetch_crew_insurance()
                            fetch_crew_list()

                        } else if( response.status == 200 ) {
                            Swal.fire(
                                'Success!',
                                `${response.message}`,
                                'success'
                            )
                            fetch_crew_insurance()
                            fetch_crew_list()
                        }
                    }
                });
            }
        })
    });

})


// ===function list
function fetch_crew_insurance() {
    $.ajax({
        type: "get",
        url: "read-crew-insurance",
        dataType: "json",
        success: function (response) {
            $('tbody#crew-insurance-tbody').html('');
            $.each(response.crew_insurances, function (key, record) { 
                $('tbody#crew-insurance-tbody').append(`
                <tr>
                    <td>${record.id_crew}</td>
                    <td>${record.insurance_name}</td>
                    <td>${record.account_number}</td>
                    <td>
                        <button type="button" value="${record.id}" class="btn btn-show-crew-insurance btn-info">
                            <i class="bi bi-eye-fill"></i>
                        </button>
    
                        <button type="button" value="${record.id}" class="btn btn-edit-crew-insurance btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </button>
    
                        <button type="button" value="${record.id}" class="btn btn-delete-crew-insurance btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
                `)
            });
        },
        error: function(xhr) {
            console.log(xhr.responseText)
        }
    });
}