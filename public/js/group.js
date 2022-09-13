$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetch_group()
    fetch_main_group_list()

    // store group
    $('#add_group_form').on('submit', function (e) {
        e.preventDefault();
        let group = {
            code_group: $('#code_group_group').val(),
            code_main_group:$("#code_main_group_in_group").val(),
            group_name: $("#name_group_group").val(),
            created_user: $("#created_user_group").val()
        }

        $.ajax({
            type: "post",
            url: "group",
            data: group,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success", `${response.message}`, 'success')
                    $("#add_group_modal").modal("hide")
                    fetch_group()
                    fetch_main_group_list()

                    $('#code_group_group').val('')
                    $("#name_group_group").val('')

                } else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.error-list-group').append(
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

    // show group
    $(document).on('click', '.btn-show-group', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#show-group-modal").modal("show")
        $.ajax({
            type: "get",
            url: `group/${id}`,
            contentType:'application/json',
            dataType: "json",
            success: function (response) {
                if( response.status == 200 ) {
                    $("#code-group-in-group").text(response.group.code_group)
                    $("#code-main-group-in-group").text(response.group.code_main_group)
                    $("#name-group-in-group").text(response.group.group_name)
                    $("#created-at-in-group").text(response.group.created_at)
                    $("#created-by-in-group").text(response.group.created_user)
                    $("#updated-at-in-group").text(response.group.updated_at)
                    $("#updated-by-in-group").text(response.group.updated_user)
                    $("#main-group-in-group").text(response.main_group)
                }
            }
        });
    });

    // edit group
    $(document).on('click', '.btn-edit-group', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#edit_group_modal").modal("show")

        $.ajax({
            type: "get",
            url: `group/${id}`,
            success: function (response) {
                if( response.status == 200 ) {

                    $("#code_group_group_edit").val(response.group.code_group);
                    $("#code_main_group_in_group_edit").val(response.group.code_main_group);
                    $("#name_group_group_edit").val(response.group.group_name);
                    $("#id_group").val(response.group.code_group);

                } else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // update group
    $("#update_group_form").on('submit', function (e) {
        e.preventDefault()
        let id = $("#id_group").val()
        let new_group = {
            code_group: $("#code_group_group_edit").val(),
            code_main_group: $("#code_main_group_in_group_edit").val(),
            group_name: $("#name_group_group_edit").val(),
            updated_user: $("#updated_user_group").val()
        }

        $.ajax({
            type: "post",
            url: `group/${id}`,
            data: new_group,
            success: function (response) {
                if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.error-list-group-edit').append(
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
                    $("#edit_group_modal").modal("hide")
                    fetch_group()
                    fetch_main_group_list()
                }

                if( response.status == 404 ) {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // delete group
    $(document).on('click', '.btn-delete-group', function (e) {
        e.preventDefault
        let id = $(this).val()

        Swal.fire({
            title: 'Are you sure?',
            text: "Group will be permanently deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`delete-group/${id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                        fetch_group()
                        fetch_main_group_list()
                    } else if( response.status == 400 ) {
                        Swal.fire(
                            'Error!',
                            'Error To Delete Group',
                            'error'
                        )
                        fetch_group()
                        fetch_main_group_list()
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        fetch_group()
                        fetch_main_group_list()
                    }
                }
            });
        }
        })
    });

})

function fetch_main_group_list() {
    $.ajax({
        type: "get",
        url: "read-main-group",
        dataType: "json",
        success: function (response) {

            $('#code_main_group_in_group').html('');
            $.each(response.main_groups, function (indexInArray, valueOfElement) { 
                $('#code_main_group_in_group').append(`
                    <option value="${valueOfElement.code_main_group}">${valueOfElement.main_group_name}</option>
                `);
            });

            $('#code_main_group_in_group_edit').html('');
            $.each(response.main_groups, function (indexInArray, valueOfElement) { 
                $('#code_main_group_in_group_edit').append(`
                    <option value="${valueOfElement.code_main_group}">${valueOfElement.main_group_name}</option>
                `);
            });

        }
    });
}

function fetch_group() {
    $.ajax({
        type: "get",
        url: "read-group",
        dataType: "json",
        success: function (response) {
            $('tbody#group-item').html('');

            $.each(response.groups, function (indexInArray, valueOfElement) { 
                $('tbody#group-item').append(
                    `
                        <tr>
                            <td>${valueOfElement.code_group}</td>
                            <td>${valueOfElement.code_main_group}</td>
                            <td>${valueOfElement.group_name}</td>
                            <td>
                                <button type="button" value="${valueOfElement.code_group}" class="btn btn-show-group btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_group}" class="btn btn-edit-group btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_group}" class="btn btn-delete-group btn-danger">
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