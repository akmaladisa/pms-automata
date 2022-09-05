$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetch_crew_list()
    fetch_certificate_name_and_certificate_type()
    fetch_crew_certificate()

    $('#crew_certificate_add_btn_modal').on('click', function (e) {
        e.preventDefault();
        
        $('#add-crew-cerficate-modal').modal('show')

        remove_required_attribute_from_crew_master_modal_input()
        remove_required_attribute_from_crew_master_modal_edit_input()
    });

    $("#add-crew-cerficate-modal").on("hidden.bs.modal", function () {
        add_required_attribute_from_crew_master_modal_edit_input()
        add_required_attribute_from_crew_master_modal_input()
    });

    $("#add-crew-cerficate-modal").on("hidden.bs.modal", function () {
        $("#certificate_scan_certificate").val("")
        $('#file-certificate-scan-certificate').text('');
    });

    $("#edit-crew-education-modal").on('hidden.bs.modal', function() {
        $("#certificate_scan_certificate_edit").val("")
        $('#file-certificate-scan-certificate-edit').text('');
    })

    $('#certificate_scan_certificate').change(function(e) {
        var geekss = e.target.files[0].name;
        $("#file-certificate-scan-certificate").text(geekss);

    });

    $('#certificate_scan_certificate_edit').change(function(e) {
        var geekss = e.target.files[0].name;
        $("#file-certificate-scan-certificate-edit").text(geekss);

    });

    // store crew certificate
    $('#form-add-crew-certificate').on('submit', function (e) {
        e.preventDefault()
        let crew_certificate_data = new FormData( $(this)[0] );
        
        $.ajax({
            type: "post",
            url: "crew-certificate",
            data: crew_certificate_data,
            processData: false,
            contentType: false,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire('Success!', `${response.message}`, 'success')
                    $('#add-crew-cerficate-modal').modal('hide')
                    fetch_certificate_name_and_certificate_type()
                    fetch_crew_certificate()
                    fetch_crew_list()

                    // reset form
                    $("#id_crew_certificate").val('');
                    $('#certificate_number_certificate').val('');
                    $('#certificate_type_certificate').val('');
                    $('#certificate_name_certificate').val('');
                    $('#issued_at_certificate').val('');
                    $('#certificate_scan_certificate').val('');
                    $('#issued_date_certificate').val('');
                    $('#expired_date_certificate').val('');
                    $('#warning_periode_certificate').val('');
                    $('#remarks_certificate').val('');
                }
                else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-certificate').append(
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
function fetch_certificate_name_and_certificate_type() {
    $.ajax({
        type: "get",
        url: "read-crew-certificate-master",
        dataType: "json",
        success: function (response) {
            $('#certificate_name_certificate').html('');
            $.each(response.crew_certificate_master, function (indexInArray, valueOfElement) { 
                $('#certificate_name_certificate').append(`
                    <option value="${valueOfElement.name}">${valueOfElement.name}</option>
                `);
            });

            $('#certificate_name_certificate_edit').html('');
            $.each(response.crew_certificate_master, function (indexInArray, valueOfElement) { 
                $('#certificate_name_certificate_edit').append(`
                    <option value="${valueOfElement.name}">${valueOfElement.name}</option>
                `);
            });

            $('#certificate_type_certificate').html('');
            $.each(response.crew_certificate_master, function (indexInArray, valueOfElement) { 
                $('#certificate_type_certificate').append(`
                    <option value="${valueOfElement.type}">${valueOfElement.type}</option>
                `);
            });

            $('#certificate_type_certificate_edit').html('');
            $.each(response.crew_certificate_master, function (indexInArray, valueOfElement) { 
                $('#certificate_type_certificate_edit').append(`
                    <option value="${valueOfElement.type}">${valueOfElement.type}</option>
                `);
            });
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}

function fetch_crew_certificate() {
    $.ajax({
        type: "get",
        url: "read-crew-certificate",
        dataType: "json",
        success: function (response) {
            $('tbody#crew-certificate-tbody').html('');
            $.each(response.crew_certificates, function (key, value) {
                
                let UI_scan_certificate;

                if( value.certificate_scan ) {
                    UI_scan_certificate = `<a target="_blank" href="/storage/${value.certificate_scan}" class="btn btn-success btn-sm">
                    <i class="bi bi-download"></i>
                    </a>`
                } else {
                    UI_scan_certificate = `<button class="btn btn-dark btn-sm disabled">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    </button>`
                }

                $('tbody#crew-certificate-tbody').append(`
                <tr>
                    <td>${value.id_crew}</td>
                    <td>${value.certificate_name}</td>
                    <td>${UI_scan_certificate}</td>
                    <td>
                        <button type="button" value="${value.id}" class="btn btn-show-crew-certificate btn-info">
                            <i class="bi bi-eye-fill"></i>
                        </button>
    
                        <button type="button" value="${value.id}" class="btn btn-edit-crew-certificate btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </button>
    
                        <button type="button" value="${value.id}" class="btn btn-delete-crew-certificate btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>`
                )
            });
        }
    });
} 