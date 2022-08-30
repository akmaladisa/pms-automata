$(document).ready(function() {
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
                    add_required_attribute_from_crew_master_modal_input()
                    add_required_attribute_from_crew_master_modal_edit_input()

                    // reseting form
                    $('#id_crew_education').val('')
                    $('#instance_crew_education').val('')
                    $('#certificate_crew_education').val('')
                    $('#more_info_crew_education').val('')
                    $('#year_in_crew_education').val('')
                    $('#year_out_crew_education').val('')
                    $('#status_crew_education').val('')
                    $('#created_user_crew_education').val('')
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
