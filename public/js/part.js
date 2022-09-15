$(document).ready( function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetch_part()
    fetch_main_group_list()
    fetch_group_list()
    fetch_sub_group_list()
    fetch_unit_list()
    fetch_component_list()

    // STORE PART
    $("#add_part_form").on('submit', function (e) {
        e.preventDefault();
        let part = {
            code_part: $("#code_part_part").val(),
            code_main_group: $("#code_main_group_in_part").val(),
            code_group: $("#code_group_in_part").val(),
            code_sub_group: $("#code_sub_group_in_part").val(),
            code_unit: $("#code_unit_in_part").val(),
            code_component: $("#code_component_in_part").val(),
            part_name: $("#name_part").val(),
            created_user: $("#created_user_part").val()
        }

        $.ajax({
            type: "post",
            url: "part",
            data: part,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success", `${response.message}`, 'success')
                    $("#add_part_modal").modal("hide")
                    $("#code_part_part").val('')
                    $("#name_part").val('')

                    refresh_other_item_based_on_part()
                }
                else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.error-list-part').append(
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

    // SHOW PART
    $(document).on('click', '.btn-show-part', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#show-part-modal").modal('show')

        $.ajax({
            type: "get",
            url: `part/${id}`,
            contentType:'application/json',
            dataType: "json",
            success: function (response) {
                if( response.status == 200 ) {
                    $("#code-part-in-part").text(response.part.code_part)
                    $("#name-part-in-part").text(response.part.part_name)
                    $("#code-component-in-part").text(response.part.code_component)
                    $("#name-component-in-part").text(response.component)
                    $("#code-unit-in-part").text(response.part.code_unit)
                    $("#name-unit-in-part").text(response.unit)
                    $("#code-sub-group-in-part").text(response.part.code_sub_group)
                    $("#name-sub-group-in-part").text(response.sub_group)
                    $("#code-group-in-part").text(response.part.code_group)
                    $("#name-group-in-part").text(response.group)
                    $("#code-main-group-in-part").text(response.part.code_main_group)
                    $("#main-group-in-part").text(response.main_group)
                    $("#created-at-in-part").text(response.part.created_at)
                    $("#updated-at-in-part").text(response.part.updated_at)
                    $("#created-by-in-part").text(response.part.created_user)
                    $("#updated-by-in-part").text(response.part.updated_user)
                }
                else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // EDIT PART
    $(document).on('click', '.btn-edit-part', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#edit_part_modal").modal('show')

        $.ajax({
            type: "get",
            url: `part/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#id_part").val(response.part.code_part)
                    $("#code_part_part_edit").val(response.part.code_part)
                    $("#code_main_group_in_part_edit").val(response.part.code_main_group)
                    $("#code_group_in_part_edit").val(response.part.code_group)
                    $("#code_sub_group_in_part_edit").val(response.part.code_sub_group)
                    $("#code_unit_in_part_edit").val(response.part.code_unit)
                    $("#code_component_in_part_edit").val(response.part.code_component)
                    $("#name_part_edit").val(response.part.part_name)
                } else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // update part
    $('#update_part_form').on('submit', function (e) {
        e.preventDefault()
        let id = $("#id_part").val()
        let new_part = {
            code_part: $("#code_part_part_edit").val(),
            code_main_group: $("#code_main_group_in_part_edit").val(),
            code_group: $("#code_group_in_part_edit").val(),
            code_sub_group: $("#code_sub_group_in_part_edit").val(),
            code_unit: $("#code_unit_in_part_edit").val(),
            code_component: $("#code_component_in_part_edit").val(),
            part_name: $("#name_part_edit").val(),
            updated_user: $("#updated_user_part").val()
        }

        $.ajax({
            type: "post",
            url: `part/${id}`,
            data: new_part,
            success: function (response) {
                if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.error-list-part-edit').append(
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
                    $("#edit_part_modal").modal("hide")
                    refresh_other_item_based_on_part()
                }

                if( response.status == 404 ) {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // delete part
    $(document).on('click', '.btn-delete-part', function (e) {
        e.preventDefault()
        let id = $(this).val()

        Swal.fire({
            title: 'Are you sure?',
            text: "Part will be permanently deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`delete-part/${id}`,
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
                        fetch_unit_list()
                        fetch_component_list()
                    } else if( response.status == 400 ) {
                        Swal.fire(
                            'Error!',
                            'Error To Delete Group',
                            'error'
                        )
                        fetch_group_list()
                        fetch_main_group_list()
                        fetch_sub_group_list()
                        fetch_unit_list()
                        fetch_component_list()
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        refresh_other_item_based_on_part()
                    }
                }
            });
        }
        })
    });

} )

function fetch_component_list() {
    $.ajax({
        type: "get",
        url: "read-component",
        dataType: "json",
        success: function (response) {
            $('#code_component_in_part').html('');
            $.each(response.components, function (indexInArray, valueOfElement) { 
                $('#code_component_in_part').append(`
                    <option value="${valueOfElement.code_component}">${valueOfElement.component_name}</option>
                `);
            });

            $('#code_component_in_part_edit').html('');
            $.each(response.components, function (indexInArray, valueOfElement) { 
                $('#code_component_in_part_edit').append(`
                    <option value="${valueOfElement.code_component}">${valueOfElement.component_name}</option>
                `);
            });

        }
    });
}

function fetch_part() {
    $.ajax({
        type: "get",
        url: "read-part",
        dataType: "json",
        success: function (response) {
            $('tbody#part-item').html('');

            $.each(response.parts, function (indexInArray, valueOfElement) { 
                $('tbody#part-item').append(
                    `
                        <tr>
                            <td>${valueOfElement.code_part}</td>
                            <td>${valueOfElement.part_name}</td>
                            <td>
                                <button type="button" value="${valueOfElement.code_part}" class="btn btn-show-part btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_part}" class="btn btn-edit-part btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_part}" class="btn btn-delete-part btn-danger">
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

function refresh_other_item_based_on_part() {
    fetch_part()
}