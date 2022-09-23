$(document).ready( function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    fetch_counter()
    fetch_ship_for_counter()
    fetch_item_description()

    // store counter
    $("#addCounterForm").on('submit', function (e) {
        e.preventDefault();
        let data = {
            ship_name: $("#ship_counter").val(),
            date: $("#date_counter").val(),
            item_description: $("#item_description_counter").val(),
            part_no: $("#part_no_counter").val(),
            starting_of_running_hours: $("#starting_of_running_hours_counter").val(),
            unit_runing: $("#unit_runing_counter").val(),
            remarks: $("#remarks_counter").val(),
            status: $("#status_counter").val()
        }

        $.ajax({
            type: "post",
            url: "counter",
            data: data,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success", `${response.message}`, 'success')
                    $("#addCounterModal").modal('hide')
                    fetch_counter()
                    fetch_ship_for_counter()
                    fetch_item_description()

                    $("#ship_counter").val('')
                    $("#date_counter").val('')
                    $("#item_description_counter").val('')
                    $("#part_no_counter").val('')
                    $("#starting_of_running_hours_counter").val('')
                    $("#unit_runing_counter").val('HOURS')
                    $("#remarks_counter").val('')
                    $("#status_counter").val('ACT')


                } else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-counter').append(
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

    // edit counter
    $(document).on('click', '.btn-edit-counter', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#editCounterModal").modal("show")
        $.ajax({
            type: "get",
            url: `counter/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#ship_counter_edit").val(response.counter.ship_name)
                    $("#date_counter_edit").val(response.counter.date)
                    $("#item_description_counter_edit").val(response.counter.item_description)
                    $("#part_no_counter_edit").val(response.counter.part_no)
                    $("#starting_of_running_hours_counter_edit").val(response.counter.starting_of_running_hours)
                    $("#unit_runing_counter_edit").val(response.counter.unit_runing)
                    $("#remarks_counter_edit").val(response.counter.remarks)
                    $("#status_counter_edit").val(response.counter.status)
                    $("#real_id_counter").val(response.counter.id)
                } else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // update counter
    $("#editCounterForm").on('submit', function (e) {
        e.preventDefault()
        let id = $("#real_id_counter").val()
        let data_new = {
            ship_name: $("#ship_counter_edit").val(),
            date: $("#date_counter_edit").val(),
            item_description: $("#item_description_counter_edit").val(),
            part_no: $("#part_no_counter_edit").val(),
            starting_of_running_hours: $("#starting_of_running_hours_counter_edit").val(),
            unit_runing: $("#unit_runing_counter_edit").val(),
            remarks: $("#remarks_counter_edit").val(),
            status: $("#status_counter_edit").val()
        }

        $.ajax({
            type: "post",
            url: `counter/${id}`,
            data: data_new,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#editCounterModal").modal("hide")
                    Swal.fire('Success', `${response.message}`, 'success');
                    fetch_counter()
                    fetch_ship_for_counter()
                    fetch_item_description()
                    
                }
                else if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-counter-edit').append(
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
                    $("#editCounterModal").modal("hide")
                    Swal.fire('Not Found', `${response.message}`, 'error')
                    fetch_counter()
                    fetch_ship_for_counter()
                    fetch_item_description()
                }
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });
    });

    //delete counter
    $(document).on('click', '.btn-delete-counter', function (e) {
        e.preventDefault()
        let id = $(this).val()
        Swal.fire({
            title: 'Are you sure?',
            text: "Counter Status Will Change To 'DE'",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`change-status-counter/${id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                        fetch_counter()
                        fetch_ship_for_counter()
                        fetch_item_description()
                        
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        fetch_counter()
                        fetch_ship_for_counter()
                        fetch_item_description()
                    }
                }
            });
        }
        })
    });

} )

function fetch_ship_for_counter() {
    $.ajax({
        type: "get",
        url: "read-ship",
        dataType: "json",
        success: function (response) {
            $("#ship_counter").html('')
            $.each(response.ships, function (indexInArray, valueOfElement) { 
                $('#ship_counter').append(`
                    <option value="${valueOfElement.ship_nm}">${valueOfElement.ship_nm}</option>
                `);
            });

            $("#ship_counter_edit").html('')
            $.each(response.ships, function (indexInArray, valueOfElement) { 
                $('#ship_counter_edit').append(`
                    <option value="${valueOfElement.ship_nm}">${valueOfElement.ship_nm}</option>
                `);
            });
        }
    });
}

function fetch_item_description() {
    $("#item_description_counter").html('')
    $("#item_description_counter_edit").html('')
    fetch_unit_for_item()
    fetch_component_for_item()
    fetch_part_for_item()
}

function fetch_counter() {
    $.ajax({
        type: "get",
        url: "read-counter",
        success: function (response) {
            $('tbody#counter-list').html('');
            let no = 0
            $.each(response.counters, function (key, record) {
            $('tbody#counter-list').append(`
                <tr>
                    <td>${no+=1}</td>
                    <td>${record.ship_name}</td>
                    <td>${record.item_description}</td>
                    <td>${record.part_no}</td>
                    <td>${record.starting_of_running_hours} ${record.unit_runing}</td>
                    <td>${record.date}</td>
                    <td>${record.remarks}</td>
                    <td class="d-flex justify-content-between">
                        <button type="button" value="${record.id}" class="btn mr-1 btn-edit-counter btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <button type="button" value="${record.id}" class="btn ml-1 btn-delete-counter btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
                `)
            });
        }
    });
}

function fetch_unit_for_item(url = 'read-unit') {
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $.each(response.units, function (indexInArray, valueOfElement) { 
                $("#item_description_counter").append(`
                    <option value="${valueOfElement.code_unit} - ${valueOfElement.unit_name}">${valueOfElement.code_unit} - ${valueOfElement.unit_name}</option>
                `)
            });

            $.each(response.units, function (indexInArray, valueOfElement) { 
                $("#item_description_counter_edit").append(`
                    <option value="${valueOfElement.code_unit} - ${valueOfElement.unit_name}">${valueOfElement.code_unit} - ${valueOfElement.unit_name}</option>
                `)
            });
        }
    });
}

function fetch_component_for_item(url = 'read-component') {
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $.each(response.components, function (indexInArray, valueOfElement) { 
                $("#item_description_counter").append(`
                    <option value="${valueOfElement.code_component} - ${valueOfElement.component_name}">${valueOfElement.code_component} - ${valueOfElement.component_name}</option>
                `)
            });

            $.each(response.components, function (indexInArray, valueOfElement) { 
                $("#item_description_counter_edit").append(`
                    <option value="${valueOfElement.code_component} - ${valueOfElement.component_name}">${valueOfElement.code_component} - ${valueOfElement.component_name}</option>
                `)
            });
        }
    });
}

function fetch_part_for_item(url = 'read-part') {
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            $.each(response.parts, function (indexInArray, valueOfElement) { 
                $("#item_description_counter").append(`
                    <option value="${valueOfElement.code_part} - ${valueOfElement.part_name}">${valueOfElement.code_part} - ${valueOfElement.part_name}</option>
                `)
            });

            $.each(response.parts, function (indexInArray, valueOfElement) { 
                $("#item_description_counter_edit").append(`
                    <option value="${valueOfElement.code_part} - ${valueOfElement.part_name}">${valueOfElement.code_part} - ${valueOfElement.part_name}</option>
                `)
            });
        }
    });
}
