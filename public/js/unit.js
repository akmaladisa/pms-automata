$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetch_unit()
    fetch_main_group_list()
    fetch_group_list()
    fetch_sub_group_list()

    //store unit
    $("#add_unit_form").on('submit', function (e) {
        e.preventDefault();
        let unit = {
            code_unit: $("#code_unit_unit").val(),
            code_main_group: $("#code_main_group_in_unit").val(),
            code_group: $("#code_group_in_unit").val(),
            code_sub_group: $("#code_sub_group_in_unit").val(),
            unit_name: $("#name_unit").val(),
            created_user: $("#created_user_unit").val()
        };

        $.ajax({
            type: "post",
            url: "unit",
            data: unit,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire('Success', `${response.message}`, 'success')
                    $("#add_unit_modal").modal("hide")
                    $("#name_unit").val('')
                    $("#code_unit_unit").val('')

                    refresh_other_item_based_on_unit()
                }
                else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.error-list-unit').append(
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

    // show unit
    $(document).on('click', '.btn-show-unit', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#show-unit-modal").modal('show')

        $.ajax({
            type: "get",
            url: `unit/${id}`,
            contentType:'application/json',
            dataType: "json",
            success: function (response) {
                if( response.status == 200 ) {
                    $("#code-unit-in-unit").text(response.unit.code_unit)
                    $("#name-unit-in-unit").text(response.unit.unit_name)
                    $("#code-sub-group-in-unit").text(response.unit.code_sub_group)
                    $("#name-sub-group-in-unit").text(response.sub_group)
                    $("#code-group-in-unit").text(response.unit.code_group)
                    $("#name-group-in-unit").text(response.group)
                    $("#code-main-group-in-unit").text(response.unit.code_main_group)
                    $("#main-group-in-unit").text(response.main_group)
                    $("#created-at-in-unit").text(response.unit.created_at)
                    $("#updated-at-in-unit").text(response.unit.updated_at)
                    $("#created-by-in-unit").text(response.unit.created_user)
                    $("#updated-by-in-unit").text(response.unit.updated_user)
                } else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // edit unit
    $(document).on('click', '.btn-edit-unit', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#edit_unit_modal").modal('show')

        $.ajax({
            type: "get",
            url: `unit/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#code_unit_unit_edit").val(response.unit.code_unit)
                    $("#id_unit").val(response.unit.code_unit)
                    $("#code_main_group_in_unit_edit").val(response.unit.code_main_group)
                    $("#code_group_in_unit_edit").val(response.unit.code_group)
                    $("#code_sub_group_in_unit_edit").val(response.unit.code_sub_group)
                    $("#name_unit_edit").val(response.unit.unit_name)
                } else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // update unit
    $("#update_unit_form").on('submit', function (e) {
        e.preventDefault()
        let id = $("#id_unit").val()
        let new_unit = {
            code_unit: $("#code_unit_unit_edit").val(),
            code_main_group: $("#code_main_group_in_unit_edit").val(),
            code_group: $("#code_group_in_unit_edit").val(),
            code_sub_group: $("#code_sub_group_in_unit_edit").val(),
            unit_name: $("#name_unit_edit").val(),
            updated_user: $("#updated_user_unit").val()
        }

        $.ajax({
            type: "post",
            url: `unit/${id}`,
            data: new_unit,
            success: function (response) {
                if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.error-list-unit-edit').append(
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

                if( response.status == 200 ) {
                    Swal.fire('Success', `${response.message}`, 'success')
                    $("#edit_unit_modal").modal("hide")
                    refresh_other_item_based_on_unit()
                }

                if( response.status == 404 ) {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // delete unit
    $(document).on('click', '.btn-delete-unit', function (e) {
        e.preventDefault()
        let id = $(this).val()

        Swal.fire({
            title: 'Are you sure?',
            text: "Unit will be permanently deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`delete-unit/${id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                        fetch_group_list()
                        fetch_main_group_list()
                        fetch_sub_group_list()
                    } else if( response.status == 400 ) {
                        Swal.fire(
                            'Error!',
                            'Error To Delete Group',
                            'error'
                        )
                        fetch_group_list()
                        fetch_main_group_list()
                        fetch_sub_group_list()
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        refresh_other_item_based_on_unit()
                    }
                }
            });
        }
        })
    });

})

function fetch_unit() {
    $.ajax({
        type: "get",
        url: "read-unit",
        dataType: "json",
        success: function (response) {
            $('tbody#unit-item').html('');

            $.each(response.units, function (indexInArray, valueOfElement) { 
                $('tbody#unit-item').append(
                    `
                        <tr>
                            <td>${valueOfElement.code_unit}</td>
                            <td>${valueOfElement.unit_name}</td>
                            <td>
                                <button type="button" value="${valueOfElement.code_unit}" class="btn btn-show-unit btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_unit}" class="btn btn-edit-unit btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_unit}" class="btn btn-delete-unit btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                    `
                )
            });
        }
    });
}

function fetch_sub_group_list() {
    $.ajax({
        type: "get",
        url: "read-sub-group",
        dataType: "json",
        success: function (response) {
            $('#code_sub_group_in_unit').html('');
            $.each(response.sub_groups, function (indexInArray, valueOfElement) { 
                $('#code_sub_group_in_unit').append(`
                    <option value="${valueOfElement.code_sub_group}">${valueOfElement.sub_group_name}</option>
                `);
            });

            $('#code_sub_group_in_unit_edit').html('');
            $.each(response.sub_groups, function (indexInArray, valueOfElement) { 
                $('#code_sub_group_in_unit_edit').append(`
                    <option value="${valueOfElement.code_sub_group}">${valueOfElement.sub_group_name}</option>
                `);
            });

            $('#code_sub_group_in_component').html('');
            $.each(response.sub_groups, function (indexInArray, valueOfElement) { 
                $('#code_sub_group_in_component').append(`
                    <option value="${valueOfElement.code_sub_group}">${valueOfElement.sub_group_name}</option>
                `);
            });

            $('#code_sub_group_in_component_edit').html('');
            $.each(response.sub_groups, function (indexInArray, valueOfElement) { 
                $('#code_sub_group_in_component_edit').append(`
                    <option value="${valueOfElement.code_sub_group}">${valueOfElement.sub_group_name}</option>
                `);
            });

            $('#code_sub_group_in_part').html('');
            $.each(response.sub_groups, function (indexInArray, valueOfElement) { 
                $('#code_sub_group_in_part').append(`
                    <option value="${valueOfElement.code_sub_group}">${valueOfElement.sub_group_name}</option>
                `);
            });

            $('#code_sub_group_in_part_edit').html('');
            $.each(response.sub_groups, function (indexInArray, valueOfElement) { 
                $('#code_sub_group_in_part_edit').append(`
                    <option value="${valueOfElement.code_sub_group}">${valueOfElement.sub_group_name}</option>
                `);
            });

        }
    });
}

function refresh_other_item_based_on_unit() {
    fetch_unit()
    fetch_unit_list()
}