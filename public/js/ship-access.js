$(document).ready( function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetch_ship_access()
    fetch_ship_list()
    fetch_crew_list()

    // store ship access
    $("#addShipAccessForm").on('submit', function (e) {
        e.preventDefault();
        let ship_access = {
            id_ship: $("#id_ship_ship_access").val(),
            id_crew: $("#id_crew_ship_access").val()
        }

        $.ajax({
            type: "post",
            url: "ship-access",
            data: ship_access,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success", `${response.message}`, 'success')
                    $("#shipAccessModalAdd").modal("hide")
                    fetch_ship_access()
                    fetch_ship_list()
                    fetch_crew_list()
                } else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.list-error-ship-access').append(
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

    // show ship access
    $(document).on('click', '.btn-show-ship-access', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#show-ship-access-modal").modal("show")

        $.ajax({
            type: "get",
            url: `ship-access/${id}`,
            success: function (response) {
                if( response.status == 200 ) {

                    $("#ship-id-in-ship-access").text( response.ship_access.id_ship )
                    $("#crew-id-in-ship-access").text( response.ship_access.id_crew)
                    $("#ship-name-in-ship-access").text( response.ship )
                    $("#crew-name-in-ship-access").text( response.crew )
                    $("#created-at-in-ship-access").text( response.ship_access.created_at )
                    $("#updated-at-in-ship-access").text( response.ship_access.updated_at )
                } else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // edit ship access
    $(document).on('click', '.btn-edit-ship-access', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#shipAccessModalEdit").modal("show")
        $.ajax({
            type: "get",
            url: `ship-access/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#id_ship_access").val(response.ship_access.id)
                    $("#id_ship_ship_access_edit").val(response.ship_access.id_ship)
                    $("#id_crew_ship_access_edit").val(response.ship_access.id_crew)
                } else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // update ship access
    $('#editShipAccessForm').on('submit', function (e) {
        e.preventDefault()
        let id = $("#id_ship_access").val()
        let new_ship_access = {
            id_ship: $("#id_ship_ship_access_edit").val(),
            id_crew: $("#id_crew_ship_access_edit").val()
        }

        $.ajax({
            type: "post",
            url: `update-ship-access/${id}`,
            data: new_ship_access,
            success: function (response) {
                if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.list-error-ship-access-edit').append(
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
                    $("#shipAccessModalEdit").modal("hide");
                    Swal.fire(
                        'Not Found',
                        `${response.message}`,
                        'error'
                    )
                }
                else if( response.status == 200 ) {
                    $("#shipAccessModalEdit").modal("hide");
                    Swal.fire(
                        'Success!',
                        `${response.message}`,
                        'success'
                    )
                    fetch_ship_access()
                    fetch_ship_list()
                    fetch_crew_list()
                }
            }
        });
    });

    // delete
    $(document).on('click', '.btn-delete-ship-access', function (e) {
        e.preventDefault()
        let id = $(this).val()
        Swal.fire({
            title: 'Are you sure?',
            text: "Ship access will permanently deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`delete-ship-access/${id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                    } else if( response.status == 400 ) {
                        Swal.fire(
                            'Error!',
                            'Error To Delete Ship Access',
                            'error'
                        )
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        fetch_ship_access()
                        fetch_ship_list()
                        fetch_crew_list()
                    }
                }
            });
        }
        })
    });
    
} )

function fetch_ship_list() {
    $.ajax({
        type: "get",
        url: "read-ship",
        dataType: "json",
        success: function (response) {
            $("#id_ship_ship_access").html('')
            $.each(response.ships, function (indexInArray, valueOfElement) { 
                $('#id_ship_ship_access').append(`
                    <option value="${valueOfElement.id_ship}">${valueOfElement.ship_nm}</option>
                `);
            });

            $("#id_ship_ship_access_edit").html('')
            $.each(response.ships, function (indexInArray, valueOfElement) { 
                $('#id_ship_ship_access_edit').append(`
                    <option value="${valueOfElement.id_ship}">${valueOfElement.ship_nm}</option>
                `);
            });
        }
    });
}

function fetch_ship_access() {
    $.ajax({
        type: "get",
        url: "read-ship-access",
        dataType: "json",
        success: function (response) {
            $('tbody#ship-access-list').html('');
            $.each(response.ship_accesses, function (key, record) { 
            $('tbody#ship-access-list').append(`
            <tr>
                <td>${record.id_ship}</td>
                <td>${record.id_crew}</td>
                <td>
                    <button type="button" value="${record.id}" class="btn btn-show-ship-access btn-info">
                        <i class="bi bi-eye-fill"></i>
                    </button>

                    <button type="button" value="${record.id}" class="btn btn-edit-ship-access btn-warning">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <button type="button" value="${record.id}" class="btn btn-delete-ship-access btn-danger">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
            `)
    });
        }
    });
}