$(document).ready(function() {
    fetch_crew_education()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#crew_education_add_btn_modal').on('click', function (e) {
        e.preventDefault();
        
        $('#addCrewEducationdModal').modal('show')

        remove_required_attribute_from_crew_master_modal_input()
        remove_required_attribute_from_crew_master_modal_edit_input()
    });

    $("#addCrewEducationdModal").on("hidden.bs.modal", function () {
        add_required_attribute_from_crew_master_modal_edit_input()
        add_required_attribute_from_crew_master_modal_input()
    });

    $('#certificate_crew_education').change(function(e) {
        var geekss = e.target.files[0].name;
        $("#file-certificate-name").text(geekss);

    });

    $('#certificate_crew_education_edit').change(function(e) {
        var geekss = e.target.files[0].name;
        $("#file-certificate-name-edit").text(geekss);

    });

    // show crew education
    $(document).on('click', '.btn-show-crew-education', function (e) {
        e.preventDefault()
        let id = $(this).val();

        $("#show-crew-education").modal('show');

        $.ajax({
            type: "get",
            url: `crew-education/${id}`,
            dataType: "json",
            contentType:'application/json',
            success: function (response) {
                if( response.status == 200 ) {
                    $('#crew-name-education').text(response.crew_name);
                    $('#crew-id-education').text(response.crew_education.id_crew);
                    $('#crew-instance-education').text(response.crew_education.instance_nm);
                    $('#crew-more-info-education').text(response.crew_education.more_information);
                    $('#crew-year-in-education').text(response.crew_education.year_in);
                    $('#crew-year-out-education').text(response.crew_education.year_out);
                    $('#crew-status-education').text(response.crew_education.status);
                    $('#crew-created-at-education').text(response.crew_education.created_at);
                    $('#crew-updated-at-education').text(response.crew_education.updated_at);
                    $('#crew-created-user-education').text(response.crew_education.created_user);
                    $('#crew-updated-user-education').text(response.crew_education.updated_user);

                    if( response.crew_education.scan_certificate ) {
                        $('#crew-certificate-education').html(
                            `<a target="_blank" href="/storage/${response.crew_education.scan_certificate}" class="btn btn-success btn-sm">
                                <i class="bi bi-download"></i>
                            </a>`);
                    } else {
                        $('#crew-certificate-education').html(`<button class="btn btn-dark btn-sm disabled">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        </button>`)
                    }
                }
            }
        });
    });

    // edit crew education
    $(document).on('click','.btn-edit-crew-education',function (e) {
        e.preventDefault()
        let id = $(this).val();

        $("#edit-crew-education-modal").modal('show');

        $.ajax({
            type: "get",
            url: `crew-education/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $('#real_ID_crew_education_edit').val(response.crew_education.id);
                    $('#id_crew_education_edit').val(response.crew_education.id_crew)
                    $('#instance_crew_education_edit').val(response.crew_education.instance_nm)

                    if( response.crew_education.scan_certificate ) {
                        $('#file-certificate-name-edit').text(response.crew_education.scan_certificate)
                    } else {
                        $('#file-certificate-name-edit').text('')
                    }

                    $('#more_info_crew_education_edit').val(response.crew_education.more_information)
                    $('#year_in_crew_education_edit').val(response.crew_education.year_in)
                    $('#year_out_crew_education_edit').val(response.crew_education.year_out)
                } else {
                    Swal.fire(
                        'Not Found',
                        `${response.message}`,
                        'error'
                    )
                    $('#edit-crew-education-modal').modal('hide');
                }
            }
        });
    });

    // update crew education
    $(document).on('submit', '#form-edit-crew-education', function(e){
        e.preventDefault()
        let id = $('#real_ID_crew_education_edit').val();

        let new_crew_education = new FormData( $(this)[0] );

        $.ajax({
            type: "post",
            url: `crew-education/${id}`,
            data: new_crew_education,
            processData: false,
            contentType: false,
            success: function (response) {
                if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-education-edit').append(
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
                    $("#edit-crew-education-modal").modal("hide");
                    Swal.fire(
                        'Not Found',
                        `${response.message}`,
                        'error'
                    )
                    fetch_crew_list()
                    fetch_crew_education()
                }
                else if( response.status == 200 ) {
                    $("#edit-crew-education-modal").modal("hide");
                    Swal.fire(
                        'Success!',
                        `${response.message}`,
                        'success'
                    )
                    fetch_crew_list()
                    fetch_crew_education()
                }
            }
        });
    });

    // delete crew education
    $(document).on('click', '.btn-delete-crew-education', function (e) {
        e.preventDefault()
        let id = $(this).val();    

        Swal.fire({
            title: 'Are you sure?',
            text: "The Crew Education Status Will Change To 'DE'",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`change-status-crew-education/${id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                        fetch_crew_education()
                        fetch_crew_list()
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        fetch_crew_education()
                        fetch_crew_list()
                    }
                }
            });
        }
        })
    });

    //store crew education
    $(document).on('submit', '#form-add-crew-education', function (e) {
        e.preventDefault()

        let crew_education_data = {
            id_crew: $('#id_crew_education').val(),
            instance_nm: $('#instance_crew_education').val(),
            scan_certificate: $('#certificate_crew_education').val(),
            more_information: $('#more_info_crew_education').val(),
            year_in: $('#year_in_crew_education').val(),
            year_out: $('#year_out_crew_education').val(),
            status: $('#status_crew_education').val(),
            created_user: $('#created_user_crew_education').val(),
        }

        let dataxx = new FormData( $(this)[0] );

        $.ajax({
            type: "post",
            url: "crew-education",
            data: dataxx,
            processData: false,
            contentType: false,
            success: function (response) {                
                if( response.status == 200 ) {
                    $("#addCrewEducationdModal").modal("hide");
                    Swal.fire(
                        'Success!',
                        `${response.message}`,
                        'success'
                    )
                    fetch_crew_list()
                    fetch_crew_education()
                    add_required_attribute_from_crew_master_modal_input()
                    add_required_attribute_from_crew_master_modal_edit_input()

                    // reseting form
                    $('#id_crew_education').val('')
                    $('#instance_crew_education').val('')
                    $('#certificate_crew_education').val('')
                    $('#more_info_crew_education').val('')
                    $('#year_in_crew_education').val('')
                    $('#year_out_crew_education').val('')
                } else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-education').append(
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
    });

})

// ====FUNCTION LIST======
function fetch_crew_education() {
    $.ajax({
        type: "get",
        url: "read-crew-education",
        dataType: "json",
        success: function (response) {
            $('tbody#crew-education').html('');
            $.each(response.crew_education, function (key, value) {
                
                let UI_scan_certificate;

                if( value.scan_certificate ) {
                    UI_scan_certificate = `<a target="_blank" href="/storage/${value.scan_certificate}" class="btn btn-success btn-sm">
                    <i class="bi bi-download"></i>
                    </a>`
                } else {
                    UI_scan_certificate = `<button class="btn btn-dark btn-sm disabled">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    </button>`
                }

                $('tbody#crew-education').append(`
                <tr>
                    <td>${value.id_crew}</td>
                    <td>${value.instance_nm}</td>
                    <td>${UI_scan_certificate}</td>
                    <td>
                        <button type="button" value="${value.id}" class="btn btn-show-crew-education btn-info">
                            <i class="bi bi-eye-fill"></i>
                        </button>
    
                        <button type="button" value="${value.id}" class="btn btn-edit-crew-education btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </button>
    
                        <button type="button" value="${value.id}" class="btn btn-delete-crew-education btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>`
                )
            });
        }
    });
}