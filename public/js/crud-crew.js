$(document).ready(function(){
    read()
})

function preview() {
    document.getElementById('imgCrew').src = URL.createObjectURL(event.target.files[0]);
    document.getElementById('imgCrew').style.display = 'block'
}

function read() {
    $.get("{{ url('read-crew') }}", {}, function(data, status) {
        $("#shipContent").html(data)
    });
}

function addCrew() {
    let _url = '/crew';
    let _token = $('meta[name="csrf-token"]').attr('content');

    let id_crew = $('#txtIdCrew').val();
    let full_name = $('#txtFullName').val();
    let email = $('#txtEmail').val();
    let identity_type = $('#txtIdentityType').val();
    let identity_number = $('#txtIdentityNumber').val();
    let job_title = $('#txtJobTitle').val();
    let country = $('#txtCountry').val();
    let phone = $('#txtPhone').val();
    let whatsapp_phone = $('#txtWhatsapp').val();
    let gender = $('#txtGender').val();
    let status_merital = $('#txtStatusMerital').val();
    let pob = $('#txtPob').val();
    let dob = $('#txtDob').val();
    let address = $('#txtAddress').val();
    let join_date = $('#txtJoinDate').val();
    let note = $('#txtNote').val();
    let status = $('#txtStatus').val();
    let join_port = $('#txtJoinPort').val();
    let photo = $('#filePhoto').val();
    let created_user = $("#txtCreatedUser").val();


    $.ajax({
        type: "post",
        url: _url,
        data: {
            id_crew: id_crew,
            full_name: full_name,
            email: email,
            identity_type: identity_type,
            identity_number: identity_number,
            job_title: job_title,
            country: country,
            phone: phone,
            whatsapp_phone: whatsapp_phone,
            gender: gender,
            status_merital: status_merital,
            pob: pob,
            dob: dob,
            address: address,
            join_date: join_date,
            note: note,
            status: status,
            join_port: join_port,
            photo: photo,
            created_user: created_user,
            _token: _token
        },
        success: function (response) {
            $('#closeFormModal').click()
            read()
        },
        error: function() {
            alert('error')
        }
    });
}
