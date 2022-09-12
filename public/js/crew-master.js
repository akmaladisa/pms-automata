$(document).ready(function(){
    fetchCrew()

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    // reset input image, when edit modal is closed
    $("#modalEditCrew").on("hidden.bs.modal", function () {
        $("#filePhotoEdit").val("")
    });

    // show crew
    $(document).on('click', '.btn-show-crew', function (e) {
        e.preventDefault()

        $('#modalShowCrew').modal("show")

        let crew_id = $(this).val()

        $.ajax({
            type: "get",
            url: `crew/${crew_id}`,
            dataType: "json",
            contentType:'application/json',
            success: function (response) {
                if(response.status == 200) {
                    $('#crewNameShow').text(response.crew.full_name);
                    $('#crewDobShow').text(response.crew.dob);
                    $('#crewPobShow').text(response.crew.pob);
                    $('#crewPhoneShow').text(response.crew.phone);
                    $('#crewWhatsappShow').text(response.crew.whatsapp_phone);
                    $('#crewGenderShow').text(response.crew.gender);
                    $('#crewIdShow').text(response.crew.id_crew);
                    $('#crewIdentityNumberShow').text(response.crew.identity_number);
                    $('#crewMeritalStatusShow').text(response.crew.status_merital);
                    $('#crewAddressShow').text(response.crew.address);
                    $('#crewEmailShow').text(response.crew.email);
                    $('#crewJobTitleShow').text(response.crew.job_title);
                    $('#crewJoinDateShow').text(response.crew.join_date);
                    $('#crewJoinPortShow').text(response.crew.join_port);
                    $('#crewStatusShow').text(response.crew.status);
                    $('#crewNoteShow').text(response.crew.note);
                    $('#crewEmploymentStatus').text(response.crew.employment_status);
                    
                    if( response.crew.photo ) {
                        $(".crewImgShow").attr("src", `/storage/${response.crew.photo}`)
                        $(".crewImgShow").attr('width', '200px')
                        $(".crewImgShow").attr('height', '200px')
                    } else if( response.crew.gender == 'MALE' && !response.crew.photo ) {
                        $(".crewImgShow").attr("src", '/img/default-male.png')
                        $(".crewImgShow").attr('width', '200px')
                        $(".crewImgShow").attr('height', '200px')
                    } else if( response.crew.gender == 'FEMALE' && !response.crew.photo ) {
                        $(".crewImgShow").attr("src", '/img/default-female.png')
                        $(".crewImgShow").attr('width', '200px')
                        $(".crewImgShow").attr('height', '200px')
                    }
                    
                    $("#crewCountryShow").text(response.crew_country);
                    $('#crewIdentityTypeShow').text(response.crew_identity_type);
                    $("#dutyOnShip").text(response.crew_ship);

                }
                else{
                    Swal.fire(
                        'Not Found',
                        `${response.message}`,
                        'error'
                    )
                    fetchCrew()
                }
            }
        });
    });


    // edit crew
    $(document).on('click', '.btn-edit-crew', function (e) {
        e.preventDefault();

        let crew_id = $(this).val()
        // alert(crew_id)

        $("#modalEditCrew").modal("show")

        $.ajax({
            type: "get",
            url: `crew/${crew_id}`,
            success: function (response) {
                if( response.status == 404 )
                {
                    Swal.fire(
                        'Not Found',
                        `${response.message}`,
                        'error'
                    )
                    $("#modalEditCrew").modal("hide")
                }
                else
                {
                    $('#txtIdCrewEdit').val(crew_id)
                    $("#txtFullNameEdit").val(response.crew.full_name)
                    $("#txtEmailEdit").val(response.crew.email)
                    $("#txtIdentityTypeEdit").val(response.crew.identity_type)
                    $("#txtIdentityNumberEdit").val(response.crew.identity_number)
                    $("#txtJobTitleEdit").val(response.crew.job_title)
                    $("#txtCountryEdit").val(response.crew.country)
                    $("#txtPhoneEdit").val(response.crew.phone)
                    $("#txtWhatsappEdit").val(response.crew.whatsapp_phone)
                    $("#txtGenderEdit").val(response.crew.gender)
                    $("#txtStatusMeritalEdit").val(response.crew.status_merital)
                    $("#txtPobEdit").val(response.crew.pob)
                    $("#txtDobEdit").val(response.crew.dob)
                    $("#txtAddressEdit").val(response.crew.address)
                    $("#txtJoinDateEdit").val(response.crew.join_date)
                    $("#txtNoteEdit").val(response.crew.note)
                    $('#txtStatusEdit').val(response.crew.status)
                    $("#txtJoinPortEdit").val(response.crew.join_port)
                    $("#txtDutyOnShipEdit").val(response.crew.duty_on_ship)
                    $("#txtEmploymentStatusEdit").val(response.crew.employment_status)

                    if( response.crew.photo ) {
                        $("#imgCrewEdit").css('display', 'block');
                        $("#imgCrewEdit").attr("src", `/storage/${response.crew.photo}`)
                    } else {
                        $("#imgCrewEdit").css('display', 'none');
                    }
                }
            }
        });
    });

    // delete crew
    $(document).on('click', '.btn-delete-crew', function (e) {
        e.preventDefault()

        let crew_id = $(this).val()

        Swal.fire({
            title: 'Are you sure?',
            text: "The Crew Status Will Change To 'DE'",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`/change-status-crew/${crew_id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                        fetchCrew()
                    } else if( response.status == 400 ) {
                        Swal.fire(
                            'Error!',
                            'Error To Delete Crew',
                            'error'
                        )
                        fetchCrew()
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        fetchCrew()
                    }
                }
            });
        }
        })
    });

    // update crew
    $(document).on('submit', '#crewUpdateForm', function (e) {
        e.preventDefault()

        let id = $('#txtIdCrewEdit').val();
        let editFormData = new FormData( $('#crewUpdateForm')[0] );

        $.ajax({
            type: "post",
            url: `update-crew/${id}`,
            data: editFormData,
            contentType: false,
            processData: false,
            success: function (response) {
                if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-crew-master-edit').append(
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
                    $("#modalEditCrew").modal("hide");
                    Swal.fire(
                        'Not Found',
                        `${response.message}`,
                        'error'
                    )
                    fetchCrew()
                }
                else if( response.status == 200 ) {
                    $("#modalEditCrew").modal("hide");
                    Swal.fire(
                        'Success!',
                        `${response.message}`,
                        'success'
                    )
                    fetchCrew()
                    fetch_crew_list()
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });

    });

})


function preview() {
    document.getElementById('imgCrew').src = URL.createObjectURL(event.target.files[0]);
    document.getElementById('imgCrew').style.display = 'block'
}

function previewEdit() {
    document.getElementById('imgCrewEdit').src = URL.createObjectURL(event.target.files[0]);
    document.getElementById('imgCrewEdit').style.display = 'block'
}

function fetchCrew() {
    $.ajax({
        type: "get",
        url: "/read-crew",
        dataType: "json",
        success: function (response) {
            $('tbody#crew-master').html('');
            $.each(response.crews, function (key, crew) { 
                $('tbody#crew-master').append(`
                <tr>
                    <td>${crew.id_crew}</td>
                    <td>${crew.full_name}</td>
                    <td>${crew.job_title}</td>
                    <td>${crew.employment_status}</td>
                    <td>
                        <button type="button" value="${crew.id_crew}" class="btn btn-show-crew btn-info">
                            <i class="bi bi-eye-fill"></i>
                        </button>
    
                        <button type="button" value="${crew.id_crew}" class="btn btn-edit-crew btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </button>
    
                        <button type="button" value="${crew.id_crew}" class="btn btn-delete-crew btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
                `)
            });
        }
    });
}