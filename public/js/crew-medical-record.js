$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('#crew_medical_record_add_btn_modal').click(function (e) { 
        e.preventDefault();
        $('#addRecordModal').modal('show')
        // $("#fullScreenModal").modal("hide")

        // removing 'required' attr in crew modal master when this modal showing up
        remove_required_attribute_from_crew_master_modal_input()
        remove_required_attribute_from_crew_master_modal_edit_input()
    });

    $("#addRecordModal").on("hidden.bs.modal", function () {
        add_required_attribute_from_crew_master_modal_edit_input()
        add_required_attribute_from_crew_master_modal_input()
    });

    // crew medical record store
    $('#btn_crew_medical_record_store').on('click', function (e) {
        
        console.log('crew medical record');

        e.preventDefault();
        
        let crew_medical_record_data = {
            id_crew: $('#id_crew_medical').val(),
            height: $('#crew_height_medical').val(),
            weight: $('#crew_weight_medical').val(),
            mcu_issued: $('#crew_mcu_issued_medical').val(),
            mcu_expired: $('#crew_mcu_expired_medical').val(),
            history_of_pain: $('#crew_history_medical').val(),
            status: $('#crew_status_medical').val(),
            created_user: $('#crew_created_medical').val(),
        }

        console.log( crew_medical_record_data );

        $.ajax({
            type: "POST",
            url: "crew-medical-record",
            data: crew_medical_record_data,
            success: function (response) {
                if( response.status != 200 ) {
                    $("#addRecordModal").modal("hide");
                    Swal.fire(
                        'Fail!',
                        `${
                            response.errors.message
                        }`,
                        'error'
                    )
                    console.log(response.errors.message);
                    // fetchCrew()
                    add_required_attribute_from_crew_master_modal_input()
                    add_required_attribute_from_crew_master_modal_edit_input()
                }
                else if( response.status == 200 ) {
                    $("#addRecordModal").modal("hide");
                    Swal.fire(
                        'Success!',
                        `${response.message}`,
                        'success'
                    )
                    // fetchCrew()
                    add_required_attribute_from_crew_master_modal_input()
                    add_required_attribute_from_crew_master_modal_edit_input()
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        })

    });

})

// =====FUNCTION LIST========
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