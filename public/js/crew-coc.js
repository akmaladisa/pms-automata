$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetch_crew_coc()
    fetch_certificate_rank()
    fetch_crew_list()

    $("#crew_coc_add_btn_modal").on('click', function(e) {
        e.preventDefault();
        $('#add-crew-coc-modal').modal('show')

        remove_required_attribute_from_crew_master_modal_input()
        remove_required_attribute_from_crew_master_modal_edit_input()
    })

    $('#add-crew-coc-modal').on("hidden.bs.modal", function() {
        add_required_attribute_from_crew_master_modal_edit_input()
        add_required_attribute_from_crew_master_modal_input()

        $("#certificate_scan_coc").val('')
        $("#file-certificate-scan-coc").text('')
    })

    $("#edit-crew-coc-modal").on('hidden.bs.modal', function() {
        $("#certificate_scan_coc_edit").val('')
        $("#file-certificate-scan-coc-edit").text('')
    })

    $('#certificate_scan_coc').change(function(e) {
        var geekss = e.target.files[0].name;
        $("#file-certificate-scan-coc").text(geekss);

    });

    $('#certificate_scan_coc_edit').change(function(e) {
        var geekss = e.target.files[0].name;
        $("#file-certificate-scan-coc-edit").text(geekss);

    });

    // store crew COC
    $("#form-add-crew-coc").on('submit', function (e) {
        e.preventDefault()
        let data_crew_coc = new FormData( $(this)[0] )

        $.ajax({
            type: "post",
            url: "crew-coc",
            data: data_crew_coc,
            processData: false,
            contentType: false,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success", `${response.message}`, 'success')
                    $("#add-crew-coc-modal").modal('hide')
                    fetch_crew_coc()
                    fetch_certificate_rank()
                    fetch_crew_list()

                    // reset form
                    $("#id_crew_coc").val('')
                    $("#certificate_rank_coc").val('')
                    $("#certificate_number_coc").val('')
                    $("#confirmed_coc").val('')
                    $("#institution_name_coc").val('')
                    $("#certificate_scan_coc").val('')
                    $("#remarks_coc").val('')

                }
                else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-coc').append(
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

    // show crew coc
    $(document).on('click', '.btn-show-crew-coc', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#show-crew-coc").modal('show')

        $.ajax({
            type: "get",
            url: `crew-coc/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#crew-name-in-coc").text(response.crew_name)
                    $("#crew-id-in-coc").text(response.crew_coc.id_crew)
                    $("#certificate-rank-in-coc").text(response.crew_coc.certificate_rank)
                    $("#certificate-number-in-coc").text(response.crew_coc.certificate_number)
                    $("#confirmed-in-coc").text(response.crew_coc.confirmed)
                    $("#institution-name-in-coc").text(response.crew_coc.institution_name)
                    $("#remarks-in-coc").text(response.crew_coc.remarks)
                    $("#status-in-coc").text(response.crew_coc.status)
                    $("#created-at-in-coc").text(response.crew_coc.created_at)
                    $("#updated-at-in-coc").text(response.crew_coc.updated_at)

                    if( response.crew_coc.certificate_scan ) {
                        $("#certificate-scan-in-coc").html(`
                        <a target="_blank" href="/storage/${response.crew_coc.certificate_scan}" class="btn btn-success btn-sm">
                            <i class="bi bi-download"></i>
                        </a>
                        `)
                    }
                    else {
                        $("#certificate-scan-in-coc").html(`
                            <button class="btn btn-dark btn-sm disabled">
                                <i class="bi bi-exclamation-circle-fill"></i>
                            </button>
                        `)
                    }

                } else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    //edit crew coc
    $(document).on('click', '.btn-edit-crew-coc', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#edit-crew-coc-modal").modal("show")

        $.ajax({
            type: "get",
            url: `crew-coc/${id}`,
            success: function (response) {
                if( response.status == 200 ) {

                    $("#real_id_coc").val( response.crew_coc.id )
                    $("#id_crew_coc_edit").val( response.crew_coc.id_crew )
                    $("#certificate_rank_coc_edit").val( response.crew_coc.certificate_rank )
                    $("#certificate_number_coc_edit").val( response.crew_coc.certificate_number )
                    $("#confirmed_coc_edit").val( response.crew_coc.confirmed )
                    $("#institution_name_coc_edit").val( response.crew_coc.institution_name )
                    $("#remarks_coc_edit").val( response.crew_coc.remarks )
                    $("#status_crew_coc_edit").val( response.crew_coc.status )

                    if( response.crew_coc.certificate_scan ) {
                        $("#file-certificate-scan-coc-edit").text(response.crew_coc.certificate_scan );
                    } else {
                        $("#file-certificate-scan-coc-edit").text('')
                    }

                } else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // update crew COC
    $("#form-edit-crew-coc").on('submit', function (e) {
        e.preventDefault()
        let data = new FormData( $(this)[0] )
        let id = $("#real_id_coc").val()

        $.ajax({
            type: "post",
            url: `crew-coc/${id}`,
            data: data,
            processData: false,
            contentType: false,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success", `${response.message}`, 'success')
                    $("#edit-crew-coc-modal").modal("hide")
                    fetch_crew_coc()
                    fetch_certificate_rank()
                    fetch_crew_list()
                }
                else if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-coc-edit').append(
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
                    $("#edit-crew-coc-modal").modal("hide")
                    Swal.fire('Not Found', `${response.message}`, 'error')

                    fetch_crew_coc()
                    fetch_certificate_rank()
                    fetch_crew_list()
                }
            }
        });
    });

    // delete crew COC
    $(document).on('click', '.btn-delete-crew-coc', function (e) {
        e.preventDefault()
        let id = $(this).val()

        Swal.fire({
            title: 'Are you sure?',
            text: "The Crew COC Status Will Change To 'DE'",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`change-status-crew-coc/${id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                        fetch_crew_coc()
                        fetch_certificate_rank()
                        fetch_crew_list()
                        
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        fetch_crew_coc()
                        fetch_certificate_rank()
                        fetch_crew_list()
                    }
                }
            });
        }
        })

    });

})

function fetch_crew_coc() {
    $.ajax({
        type: "get",
        url: "read-crew-coc",
        dataType: "json",
        success: function (response) {
            $('tbody#crew-coc-tbody').html('');
            $.each(response.crew_cocs, function (key, value) {
                
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

                $('tbody#crew-coc-tbody').append(`
                <tr>
                    <td>
                        ${value.id_crew}
                    </td>
                    <td>${value.certificate_rank}</td>
                    <td>${UI_scan_certificate}</td>
                    <td>
                        <button type="button" value="${value.id}" class="btn btn-show-crew-coc btn-info">
                            <i class="bi bi-eye-fill"></i>
                        </button>
    
                        <button type="button" value="${value.id}" class="btn btn-edit-crew-coc btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </button>
    
                        <button type="button" value="${value.id}" class="btn btn-delete-crew-coc btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>`
                )
            });
        }
    });
}

function fetch_certificate_rank() {
    $.ajax({
        type: "get",
        url: "read-crew-certificate-master",
        dataType: "json",
        success: function (response) {
            $('#certificate_rank_coc').html('');
            $.each(response.crew_certificate_master, function (indexInArray, valueOfElement) { 
                $('#certificate_rank_coc').append(`
                    <option value="${valueOfElement.rank}">${valueOfElement.rank}</option>
                `);
            });

            $('#certificate_rank_coc_edit').html('');
            $.each(response.crew_certificate_master, function (indexInArray, valueOfElement) { 
                $('#certificate_rank_coc_edit').append(`
                    <option value="${valueOfElement.rank}">${valueOfElement.rank}</option>
                `);
            });
        }
    });
}