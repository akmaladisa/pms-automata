$(document).ready(function() {

    fetch_crew_medical_record()
    fetch_crew_list()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('#crew_medical_record_add_btn_modal').click(function (e) { 
        e.preventDefault();
        $('#addRecordModal').modal('show')

        remove_required_attribute_from_crew_master_modal_input()
        remove_required_attribute_from_crew_master_modal_edit_input()
    });

    $("#addRecordModal").on("hidden.bs.modal", function () {
        add_required_attribute_from_crew_master_modal_edit_input()
        add_required_attribute_from_crew_master_modal_input()
    });

    // crew medical record store
    $('#btn_crew_medical_record_store').on('click', function (e) {

        e.preventDefault();
        
        let crew_medical_record_data = {
            id_crew: $('#id_crew_medical').val(),
            height: $('#crew_height_medical').val(),
            weight: $('#crew_weight_medical').val(),
            blood_type: $('#crew_blood_type_medical').val(),
            mcu_validity_date: $('#crew_mcu_issued_medical').val(),
            mcu_expired: $('#crew_mcu_expired_medical').val(),
            warning_period: $('#crew_warning_period_medical').val(),
            history_of_pain: $('#crew_history_medical').val(),
            status: $('#crew_status_medical').val(),
            created_user: $('#crew_created_medical').val(),
        }

        $.ajax({
            type: "POST",
            url: "crew-medical-record",
            data: crew_medical_record_data,
            success: function (response) {
                if( response.status != 200 ) {
                    
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list').append(
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
                else if( response.status == 200 ) {
                    $("#addRecordModal").modal("hide");
                    Swal.fire(
                        'Success!',
                        `${response.message}`,
                        'success'
                    )
                    fetch_crew_medical_record()
                    fetch_crew_list()
                    add_required_attribute_from_crew_master_modal_input()
                    add_required_attribute_from_crew_master_modal_edit_input()

                    // reseting form
                    $('#crew_weight_medical').val('');
                    $('#crew_height_medical').val('');
                    $('#crew_mcu_issued_medical').val('');
                    $('#crew_mcu_expired_medical').val('');
                    $('#crew_history_medical').val('');
                    $('#crew_warning_period_medical').val('');
                    $('#crew_blood_type_medical').val('');
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        })

    });

    // show
    $(document).on('click', '.btn-show-crew-medical-record', function (e) {
        e.preventDefault();
        let id = $(this).val();
        $('#show-crew-medical-record').modal('show');

        $.ajax({
            type: "get",
            url: `crew-medical-record/${id}`,
            dataType: "json",
            contentType:'application/json',
            success: function (response) {
                if( response.status == 200 ) {

                    $('#crew-name-medical-record').text(response.crew_name);
                    $('#crew-id-medical-record').text(response.record.id_crew);
                    $('#crew-height-medical-record').text(response.record.height);
                    $('#crew-weight-medical-record').text(response.record.weight);
                    $('#crew-mcu-issued-medical-record').text(response.record.mcu_validity_date);
                    $('#crew-warning-period-medical-record').text(response.record.warning_period);
                    $('#crew-blood-type-medical-record').text(response.record.blood_type);
                    $('#crew-mcu-expired-medical-record').text(response.record.mcu_expired);
                    $('#crew-history-pain-medical-record').text(response.record.history_of_pain);
                    $('#crew-created-at-medical-record').text(response.record.created_at);
                    $('#crew-updated-at-medical-record').text(response.record.updated_at);
                    $('#crew-created-user-medical-record').text(response.record.created_user);
                    $('#crew-updated-user-medical-record').text(response.record.updated_user);
                    $('#crew-status-medical-record').text(response.record.status);

                } else {
                    Swal.fire(
                        'Not Found',
                        `${response.message}`,
                        'error'
                    )
                    $('#show-crew-medical-record').modal('hide');
                }
            }
        });

    });

    // edit
    $(document).on('click', '.btn-edit-crew-medical-record', function (e) {
        e.preventDefault();

        let id = $(this).val();

        $('#medical_record_edit').modal('show');

        $.ajax({
            type: "get",
            url: `crew-medical-record/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $('#id_crew_medical_edit').val(response.record.id_crew);
                    $('#crew_height_medical_edit').val(response.record.height);
                    $('#crew_weight_medical_edit').val(response.record.weight);
                    $('#crew_mcu_issued_medical_edit').val(response.record.mcu_validity_date);
                    $('#crew_mcu_expired_medical_edit').val(response.record.mcu_expired);
                    $('#crew_history_medical_edit').val(response.record.history_of_pain);
                    $('#crew_status_medical_edit').val(response.record.status);
                    $('#id_medical_record_edit').val(response.record.id);
                    $('#crew_warning_period_medical_edit').val(response.record.warning_period);
                    $('#crew_blood_type_medical_edit').val(response.record.blood_type);
                } else {
                    Swal.fire(
                        'Not Found',
                        `${response.message}`,
                        'error'
                    )
                    $('#medical_record_edit').modal('hide');
                }
            }
        });
    });

    //update
    $(document).on('click', '#btn_crew_medical_record_update', function (e) {
        e.preventDefault()
        let id = $('#id_medical_record_edit').val();
        let new_medical_record = {
            id_crew: $('#id_crew_medical_edit').val(),
            height: $('#crew_height_medical_edit').val(),
            weight: $('#crew_weight_medical_edit').val(),
            blood_type: $('#crew_blood_type_medical_edit').val(),
            mcu_validity_date: $('#crew_mcu_issued_medical_edit').val(),
            mcu_expired: $('#crew_mcu_expired_medical_edit').val(),
            warning_period: $("#crew_warning_period_medical_edit").val(),
            history_of_pain: $('#crew_history_medical_edit').val(),
            status: $('#crew_status_medical_edit').val(),
            updated_user: $('#crew_updated_medical').val()
        }

        $.ajax({
            type: "post",
            url: `update-crew-medical-record/${id}`,
            data: new_medical_record,
            success: function (response) {
                if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-edit-error').append(
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
                    $("#medical_record_edit").modal("hide");
                    Swal.fire(
                        'Not Found',
                        `${response.message}`,
                        'error'
                    )
                    fetch_crew_list()
                    fetch_crew_medical_record()
                }
                else if( response.status == 200 ) {
                    $("#medical_record_edit").modal("hide");
                    Swal.fire(
                        'Success!',
                        `${response.message}`,
                        'success'
                    )
                    fetch_crew_list()
                    fetch_crew_medical_record()
                }
            }
        });

    });

    // delete
    $(document).on('click', '.btn-delete-crew-medical-record', function (e) { 
        e.preventDefault();

        let id = $(this).val();    
        
        Swal.fire({
            title: 'Are you sure?',
            text: "The Crew Medical Record Status Will Change To 'DE'",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`change-status-crew-medical-record/${id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                        fetch_crew_medical_record()
                        fetch_crew_list()
                    } else if( response.status == 400 ) {
                        Swal.fire(
                            'Error!',
                            'Error To Delete Crew',
                            'error'
                        )
                        fetch_crew_medical_record()
                        fetch_crew_list()
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        fetch_crew_medical_record()
                        fetch_crew_list()
                    }
                }
            });
        }
        })
        
    });

})

// =====FUNCTION LIST========

function fetch_crew_medical_record() {
    $.ajax({
        type: "get",
        url: "read-crew-medical-record",
        dataType: "json",
        success: function (response) {

            $('tbody#crew-medical-record').html('');
            $.each(response.records, function (key, record) { 
                $('tbody#crew-medical-record').append(`
                <tr>
                    <td>${record.id_crew}</td>
                    <td>${record.history_of_pain}</td>
                    <td>${record.mcu_expired}</td>
                    <td>
                        <button type="button" value="${record.id}" class="btn btn-show-crew-medical-record btn-info">
                            <i class="bi bi-eye-fill"></i>
                        </button>
    
                        <button type="button" value="${record.id}" class="btn btn-edit-crew-medical-record btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </button>
    
                        <button type="button" value="${record.id}" class="btn btn-delete-crew-medical-record btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
                `)
            });
        }
    });
}

function fetch_crew_list() {
    // fetching list crew for medical record info
    $.ajax({
        type: "get",
        url: "read-crew",
        dataType: "json",
        success: function (response) {
            $('#id_crew_medical').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_medical').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });

            $('#id_crew_medical_edit').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_medical_edit').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });

            $('#id_crew_education').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_education').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });

            $('#id_crew_education_edit').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_education_edit').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });

            $('#id_crew_wo').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_wo').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });

            $('#id_crew_wo_edit').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_wo_edit').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });

            $('#id_crew_bank').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_bank').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });

            $('#id_crew_bank_edit').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_bank_edit').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });

            $('#id_crew_insurance').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_insurance').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });

            $('#id_crew_insurance_edit').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_insurance_edit').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });

            $('#id_crew_certificate').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_certificate').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });

            $('#id_crew_certificate_edit').html('');
            $.each(response.crews, function (indexInArray, valueOfElement) { 
                $('#id_crew_certificate_edit').append(`
                    <option value="${valueOfElement.id_crew}">${valueOfElement.full_name}</option>
                `);
            });
        }
    });
}

function remove_required_attribute_from_crew_master_modal_input() {
    // this function is to solve this issue : https://stackoverflow.com/questions/22148080/an-invalid-form-control-with-name-is-not-focusable

    $('#txtIdCrew').removeAttr('required');
    $("#txtFullName").removeAttr('required');
    $("#txtEmail").removeAttr('required');
    $("#txtIdentityType").removeAttr('required');
    $("#txtIdentityNumber").removeAttr('required');
    $("#txtJobTitle").removeAttr('required');
    $("#txtCountry").removeAttr('required');
    $("#txtPhone").removeAttr('required');
    $("#txtWhatsapp").removeAttr('required');
    $("#txtGender").removeAttr('required');
    $("#txtStatusMerital").removeAttr('required');
    $("#txtPob").removeAttr('required');
    $("#txtDob").removeAttr('required');
    $("#txtAddress").removeAttr('required');
    $("#txtJoinDate").removeAttr('required');
    $("#txtNote").removeAttr('required');
    $('#txtStatus').removeAttr('required');
    $("#txtJoinPort").removeAttr('required');
    $('#txtCreatedUser').removeAttr('required');
}

function add_required_attribute_from_crew_master_modal_input() {
    $('#txtIdCrew').attr('required', true);
    $("#txtFullName").attr('required', true);
    $("#txtEmail").attr('required', true);
    $("#txtIdentityType").attr('required', true);
    $("#txtIdentityNumber").attr('required', true);
    $("#txtJobTitle").attr('required', true);
    $("#txtCountry").attr('required', true);
    $("#txtPhone").attr('required', true);
    $("#txtWhatsapp").attr('required', true);
    $("#txtGender").attr('required', true);
    $("#txtStatusMerital").attr('required', true);
    $("#txtPob").attr('required', true);
    $("#txtDob").attr('required', true);
    $("#txtAddress").attr('required', true);
    $("#txtJoinDate").attr('required', true);
    $("#txtNote").attr('required', true);
    $('#txtStatus').attr('required', true);
    $("#txtJoinPort").attr('required', true);
    $('#txtCreatedUser').attr('required', true);
}

function remove_required_attribute_from_crew_master_modal_edit_input() {
    // this function is to solve this issue : https://stackoverflow.com/questions/22148080/an-invalid-form-control-with-name-is-not-focusable

    $('#txtIdCrewEdit').removeAttr('required');
    $("#txtFullNameEdit").removeAttr('required');
    $("#txtEmailEdit").removeAttr('required');
    $("#txtIdentityTypeEdit").removeAttr('required');
    $("#txtIdentityNumberEdit").removeAttr('required');
    $("#txtJobTitleEdit").removeAttr('required');
    $("#txtCountryEdit").removeAttr('required');
    $("#txtPhoneEdit").removeAttr('required');
    $("#txtWhatsappEdit").removeAttr('required');
    $("#txtGenderEdit").removeAttr('required');
    $("#txtStatusMeritalEdit").removeAttr('required');
    $("#txtPobEdit").removeAttr('required');
    $("#txtDobEdit").removeAttr('required');
    $("#txtAddressEdit").removeAttr('required');
    $("#txtJoinDateEdit").removeAttr('required');
    $("#txtNoteEdit").removeAttr('required');
    $('#txtStatusEdit').removeAttr('required');
    $("#txtJoinPortEdit").removeAttr('required');
    $('#txtCreatedUserEdit').removeAttr('required');
}

function add_required_attribute_from_crew_master_modal_edit_input() {
    $('#txtIdCrewEdit').attr('required', true);
    $("#txtFullNameEdit").attr('required', true);
    $("#txtEmailEdit").attr('required', true);
    $("#txtIdentityTypeEdit").attr('required', true);
    $("#txtIdentityNumberEdit").attr('required', true);
    $("#txtJobTitleEdit").attr('required', true);
    $("#txtCountryEdit").attr('required', true);
    $("#txtPhoneEdit").attr('required', true);
    $("#txtWhatsappEdit").attr('required', true);
    $("#txtGenderEdit").attr('required', true);
    $("#txtStatusMeritalEdit").attr('required', true);
    $("#txtPobEdit").attr('required', true);
    $("#txtDobEdit").attr('required', true);
    $("#txtAddressEdit").attr('required', true);
    $("#txtJoinDateEdit").attr('required', true);
    $("#txtNoteEdit").attr('required', true);
    $('#txtStatusEdit').attr('required', true);
    $("#txtJoinPortEdit").attr('required', true);
    $('#txtCreatedUserEdit').attr('required', true);
}