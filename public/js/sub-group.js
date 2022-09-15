$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetch_sub_group()
    fetch_main_group_list()
    fetch_group_list()

    // store sub group
    $('#add_sub_group_form').on('submit', function (e) {
        e.preventDefault();
        let sub_group = {
            code_sub_group: $('#code_sub_group_sub_group').val(),
            code_main_group: $('#code_main_group_in_sub_group').val(),
            code_group: $("#code_group_in_sub_group").val(),
            sub_group_name: $('#name_sub_group').val(),
            created_user: $("#created_user_sub_group").val()
        };

        $.ajax({
            type: "post",
            url: "sub-group",
            data: sub_group,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success", `${response.message}`, "success")
                    $("#add_sub_group_modal").modal("hide")
                    
                    $("#code_sub_group_sub_group").val('')
                    $('#name_sub_group').val('')

                    refresh_other_item_based_on_sub_group()
                } else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.error-list-sub-group').append(
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

    // show sub group
    $(document).on('click', '.btn-show-sub-group', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#show-sub-group-modal").modal('show')

        $.ajax({
            type: "get",
            url: `sub-group/${id}`,
            contentType:'application/json',
            dataType: "json",
            success: function (response) {
                if( response.status == 200 ) {
                    $("#code-sub-group-in-sub-group").text( response.sub_group.code_sub_group )
                    $("#name-sub-group-in-sub-group").text( response.sub_group.sub_group_name )
                    $("#code-group-in-sub-group").text( response.sub_group.code_group )
                    $("#name-group-in-sub-group").text( response.group )
                    $("#code-main-group-in-sub-group").text( response.sub_group.code_main_group )
                    $("#main-group-in-sub-group").text( response.main_group )
                    $("#created-at-in-sub-group").text( response.sub_group.created_at )
                    $("#updated-at-in-sub-group").text( response.sub_group.updated_at )
                    $("#created-by-in-sub-group").text( response.sub_group.created_user )
                    $("#updated-by-in-sub-group").text( response.sub_group.updated_user )
                }
                else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // edit sub group
    $(document).on('click', '.btn-edit-sub-group', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#edit_sub_group_modal").modal('show')

        $.ajax({
            type: "get",
            url: `sub-group/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#code_sub_group_sub_group_edit").val( response.sub_group.code_sub_group )
                    $("#code_main_group_in_sub_group_edit").val(response.sub_group.code_main_group)
                    $("#code_group_in_sub_group_edit").val(response.sub_group.code_group)
                    $("#name_sub_group_edit").val(response.sub_group.sub_group_name)

                    $("#id_sub_group").val( response.sub_group.code_sub_group )
                }
                else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // update sub group
    $("#update_sub_group_form").on('submit', function (e) {
        e.preventDefault()
        let id = $("#id_sub_group").val()
        let new_sub_group = {
            code_sub_group: $("#code_sub_group_sub_group_edit").val(),
            code_main_group: $("#code_main_group_in_sub_group_edit").val(),
            code_group: $("#code_group_in_sub_group_edit").val(),
            sub_group_name: $("#name_sub_group_edit").val(),
            updated_user: $("#updated_user_sub_group").val()
        }

        $.ajax({
            type: "post",
            url: `sub-group/${id}`,
            data: new_sub_group,
            success: function (response) {
                if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.error-list-sub-group-edit').append(
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
                    $("#edit_sub_group_modal").modal("hide")
                    refresh_other_item_based_on_sub_group()
                }

                if( response.status == 404 ) {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // delete sub group
    $(document).on('click', '.btn-delete-sub-group', function (e) {
        e.preventDefault()
        let id = $(this).val()

        Swal.fire({
            title: 'Are you sure?',
            text: "Sub Group will be permanently deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`delete-sub-group/${id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                        fetch_group_list()
                        fetch_main_group_list()
                    } else if( response.status == 400 ) {
                        Swal.fire(
                            'Error!',
                            'Error To Delete Group',
                            'error'
                        )
                        fetch_group_list()
                        fetch_main_group_list()
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        refresh_other_item_based_on_sub_group()
                    }
                }
            });
        }
        })
    });

})

function fetch_sub_group() {
    $.ajax({
        type: "get",
        url: "read-sub-group",
        dataType: "json",
        success: function (response) {
            $('tbody#sub-group-item').html('');

            $.each(response.sub_groups, function (indexInArray, valueOfElement) { 
                $('tbody#sub-group-item').append(
                    `
                        <tr>
                            <td>${valueOfElement.code_sub_group}</td>
                            <td>${valueOfElement.sub_group_name}</td>
                            <td>
                                <button type="button" value="${valueOfElement.code_sub_group}" class="btn btn-show-sub-group btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_sub_group}" class="btn btn-edit-sub-group btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_sub_group}" class="btn btn-delete-sub-group btn-danger">
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

function fetch_group_list() {
    $.ajax({
        type: "get",
        url: "read-group",
        dataType: "json",
        success: function (response) {
            $('#code_group_in_sub_group').html('');
            $.each(response.groups, function (indexInArray, valueOfElement) { 
                $('#code_group_in_sub_group').append(`
                    <option value="${valueOfElement.code_group}">${valueOfElement.code_group} - ${valueOfElement.group_name}</option>
                `);
            });

            $('#code_group_in_sub_group_edit').html('');
            $.each(response.groups, function (indexInArray, valueOfElement) { 
                $('#code_group_in_sub_group_edit').append(`
                    <option value="${valueOfElement.code_group}">${valueOfElement.code_group} - ${valueOfElement.group_name}</option>
                `);
            });

            $('#code_group_in_unit').html('');
            $.each(response.groups, function (indexInArray, valueOfElement) { 
                $('#code_group_in_unit').append(`
                    <option value="${valueOfElement.code_group}">${valueOfElement.code_group} - ${valueOfElement.group_name}</option>
                `);
            });

            $('#code_group_in_unit_edit').html('');
            $.each(response.groups, function (indexInArray, valueOfElement) { 
                $('#code_group_in_unit_edit').append(`
                    <option value="${valueOfElement.code_group}">${valueOfElement.code_group} - ${valueOfElement.group_name}</option>
                `);
            });

            $('#code_group_in_component').html('');
            $.each(response.groups, function (indexInArray, valueOfElement) { 
                $('#code_group_in_component').append(`
                    <option value="${valueOfElement.code_group}">${valueOfElement.code_group} - ${valueOfElement.group_name}</option>
                `);
            });

            $('#code_group_in_component_edit').html('');
            $.each(response.groups, function (indexInArray, valueOfElement) { 
                $('#code_group_in_component_edit').append(`
                    <option value="${valueOfElement.code_group}">${valueOfElement.code_group} - ${valueOfElement.group_name}</option>
                `);
            });

            $('#code_group_in_part').html('');
            $.each(response.groups, function (indexInArray, valueOfElement) { 
                $('#code_group_in_part').append(`
                    <option value="${valueOfElement.code_group}">${valueOfElement.code_group} - ${valueOfElement.group_name}</option>
                `);
            });

            $('#code_group_in_part_edit').html('');
            $.each(response.groups, function (indexInArray, valueOfElement) { 
                $('#code_group_in_part_edit').append(`
                    <option value="${valueOfElement.code_group}">${valueOfElement.code_group} - ${valueOfElement.group_name}</option>
                `);
            });
        }
    });
}

function refresh_other_item_based_on_sub_group() {
    fetch_sub_group()
    fetch_sub_group_list()
}