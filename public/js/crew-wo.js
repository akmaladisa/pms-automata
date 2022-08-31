$(document).ready(function() {
    fetch_position_list()
    fetch_crew_wo()

    $('#crew_wo_add_btn_modal').on('click', function (e) {
        e.preventDefault();
        
        remove_required_attribute_from_crew_master_modal_edit_input()
        remove_required_attribute_from_crew_master_modal_input()

        $('#add-crew-wo-modal').modal('show')
    });

    $('#add-crew-wo-modal').on("hidden.bs.modal", function () {
        add_required_attribute_from_crew_master_modal_edit_input()
        add_required_attribute_from_crew_master_modal_input()
    });

    // show crew WO
    $(document).on('click', '.btn-show-crew-wo', function (e) {
        e.preventDefault();
        let id = $(this).val();
        $("#show-crew-wo").modal('show');

        $.ajax({
            type: "get",
            url: `crew-wo/${id}`,
            dataType: "json",
            contentType:'application/json',
            success: function (response) {
                if( response.status == 200 ) {
                    $('#crew-name-wo').text(response.crew_name);
                    $('#crew-id-wo').text(response.crew_wo.id_crew);
                    $('#crew-company-wo').text(response.crew_wo.company_nm);
                    $('#crew-last-position-wo').text(response.crew_wo.last_position);
                    $('#crew-year-in-wo').text(response.crew_wo.year_in);
                    $('#crew-year-out-wo').text(response.crew_wo.year_out);
                    $('#crew-job-status-wo').text(response.crew_wo.jobs_status);
                    $('#crew-more-info-wo').text(response.crew_wo.more_info);
                    $('#crew-status-wo').text(response.crew_wo.status);
                    $('#crew-created-at-wo').text(response.crew_wo.created_at);
                    $('#crew-updated-at-wo').text(response.crew_wo.updated_at);
                    $('#crew-created-user-wo').text(response.crew_wo.created_user);
                    $('#crew-updated-user-wo').text(response.crew_wo.updated_user);
                }
                else{
                    Swal.fire('Error!', `${response.message}`, 'error')
                }
            }
        });
    });

    // edit crew WO
    $(document).on('click', '.btn-edit-crew-wo', function (e) {
        e.preventDefault()
        let id = $(this).val();

        $("#edit-crew-wo-modal").modal('show')

        $.ajax({
            type: "get",
            url: `crew-wo/${id}`,
            success: function (response) {
                if(response.status == 200) {
                    $("#real_id_crew_WO").val(response.crew_wo.id);
                    $('#id_crew_wo_edit').val(response.crew_wo.id_crew)
                    $('#company_name_crew_wo_edit').val(response.crew_wo.company_nm)
                    $('#last_position_crew_wo_edit').val(response.crew_wo.last_position)
                    $('#year_in_crew_wo_edit').val(response.crew_wo.year_in)
                    $('#year_out_crew_wo_edit').val(response.crew_wo.year_out)
                    $('#job_status_crew_wo_edit').val(response.crew_wo.jobs_status)
                    $('#more_info_crew_wo_edit').val(response.crew_wo.more_info)
                    $('#status_crew_wo_edit').val(response.crew_wo.status)
                } else {
                    Swal.fire('Error!', `${response.message}`, 'error')
                }
            }
        });
    });

    // update Crew WO
    $(document).on('submit', '#edit-crew-wo-form', function(e) {
        e.preventDefault();
        let id = $('#real_id_crew_WO').val();
        let new_crew_wo = {
            id_crew: $('#id_crew_wo_edit').val(),
            company_nm: $('#company_name_crew_wo_edit').val(),
            last_position: $('#last_position_crew_wo_edit').val(),
            year_in: $('#year_in_crew_wo_edit').val(),
            year_out: $('#year_out_crew_wo_edit').val(),
            jobs_status: $('#job_status_crew_wo_edit').val(),
            more_info: $('#more_info_crew_wo_edit').val(),
            status: $('#status_crew_wo_edit').val(),
            updated_user: $('#updated_user_crew_wo').val(),
        }

        $.ajax({
            type: "post",
            url: `crew-wo/${id}`,
            data: new_crew_wo,
            success: function (response) {
                if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-crew-wo-edit-error').append(
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
                    $("#edit-crew-wo-modal").modal("hide");
                    Swal.fire(
                        'Not Found',
                        `${response.message}`,
                        'error'
                    )
                    fetch_crew_list()
                    fetch_crew_wo()
                    fetch_position_list()
                }
                else if( response.status == 200 ) {
                    $("#edit-crew-wo-modal").modal("hide");
                    Swal.fire(
                        'Success!',
                        `${response.message}`,
                        'success'
                    )
                    fetch_crew_list()
                    fetch_crew_wo()
                    fetch_position_list()
                }
            }
        });
    })

    // delete crew WO
    $(document).on('click', '.btn-delete-crew-wo', function (e) {
        e.preventDefault()
        let id = $(this).val();
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
                    url: `change-status-crew-wo/${id}`,
                    success: function (response) {
                        if( response.status == 404 ) {
                            Swal.fire(
                                'Not Found',
                                `${response.message}`,
                                'error'
                            )
                            fetch_crew_wo()
                            fetch_crew_list()
                            fetch_position_list()

                        } else if( response.status == 400 ) {
                            Swal.fire(
                                'Error!',
                                'Error To Delete Crew',
                                'error'
                            )
                            fetch_crew_wo()
                            fetch_crew_list()
                            fetch_position_list()

                        } else if( response.status == 200 ) {
                            Swal.fire(
                                'Success!',
                                `${response.message}`,
                                'success'
                            )
                            fetch_crew_wo()
                            fetch_crew_list()
                            fetch_position_list()
                        }
                    }
                });
            }
        })

    });

    // store crew WO
    $('#add-crew-wo-form').on('submit', function (e) {
        e.preventDefault()
        let crew_wo_data = {
            id_crew: $('#id_crew_wo').val(),
            company_nm: $('#company_name_crew_wo').val(),
            last_position: $('#last_position_crew_wo').val(),
            year_in: $('#year_in_crew_wo').val(),
            year_out: $('#year_out_crew_wo').val(),
            jobs_status: $('#job_status_crew_wo').val(),
            more_info: $('#more_info_crew_wo').val(),
            status: $('#status_crew_wo').val(),
            created_user: $('#created_user_crew_wo').val(),
        }

        $.ajax({
            type: "post",
            url: "crew-wo",
            data: crew_wo_data,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire(
                        'success', 
                        `${response.message}`,
                        'success'
                    )
                    $("#add-crew-wo-modal").modal('hide')
                    fetch_position_list()
                    fetch_crew_list()
                    fetch_crew_wo()

                    add_required_attribute_from_crew_master_modal_input()
                    add_required_attribute_from_crew_master_modal_edit_input()

                    // reset form
                    $('#company_name_crew_wo').val('');
                    $('#year_in_crew_wo').val('');
                    $('#year_out_crew_wo').val('');
                    $('#job_status_crew_wo').val('');
                    $('#more_info_crew_wo').val('');
                }
                else
                {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-crew-wo-error').append(
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

// ===function list
function fetch_crew_wo() {
    $.ajax({
        type: "get",
        url: "read-crew-wo",
        dataType: "json",
        success: function (response) {
            $('tbody#crew-wo-tbody').html('');
            $.each(response.crew_wo, function (key, record) { 
                $('tbody#crew-wo-tbody').append(`
                <tr>
                    <td>${record.id_crew}</td>
                    <td>${record.company_nm}</td>
                    <td>${record.last_position}</td>
                    <td>
                        <button type="button" value="${record.id}" class="btn btn-show-crew-wo btn-info">
                            <i class="bi bi-eye-fill"></i>
                        </button>
    
                        <button type="button" value="${record.id}" class="btn btn-edit-crew-wo btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </button>
    
                        <button type="button" value="${record.id}" class="btn btn-delete-crew-wo btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
                `)
            });
        }
    });
}

function fetch_position_list() {
    $.ajax({
        type: "get",
        url: "read-position",
        dataType: "json",
        success: function (response) {
            $('#last_position_crew_wo').html('');
            $.each(response.positions, function (indexInArray, valueOfElement) { 
                $('#last_position_crew_wo').append(`
                    <option value="${valueOfElement.name}">${valueOfElement.name}</option>
                `)
            });

            $('#last_position_crew_wo_edit').html('');
            $.each(response.positions, function (indexInArray, valueOfElement) { 
                $('#last_position_crew_wo_edit').append(`
                    <option value="${valueOfElement.name}">${valueOfElement.name}</option>
                `)
            });
        }
    });
}