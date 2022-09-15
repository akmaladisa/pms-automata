$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetch_component()
    fetch_main_group_list()
    fetch_group_list()
    fetch_sub_group_list()
    fetch_unit_list()

    // store component
    $("#add_component_form").on('submit', function (e) {
        e.preventDefault();
        let component = {
            code_component: $("#code_component_component").val(),
            code_main_group: $("#code_main_group_in_component").val(),
            code_group: $("#code_group_in_component").val(),
            code_sub_group: $("#code_sub_group_in_component").val(),
            code_unit: $("#code_unit_in_component").val(),
            component_name: $("#name_component").val(),
            created_user: $("#created_user_component").val()
        };

        $.ajax({
            type: "post",
            url: "component",
            data: component,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success", `${response.message}`, 'success')
                    $("#add_component_modal").modal('hide')
                    $("#code_component_component").val('')
                    $("#name_component").val('')

                    refresh_other_item_based_on_component()
                }
                else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.error-list-component').append(
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
            error: function(e) {
                console.log(e.responseText);
            }
        });

    });

    //show component
    $(document).on('click', '.btn-show-component', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#show-component-modal").modal("show")

        $.ajax({
            type: "get",
            url: `component/${id}`,
            contentType:'application/json',
            dataType: "json",
            success: function (response) {
                if( response.status == 200 ) {
                    $("#code-component-in-component").text(response.component.code_component)
                    $("#name-component-in-component").text(response.component.component_name)
                    $("#code-unit-in-component").text(response.component.code_unit)
                    $("#name-unit-in-component").text(response.unit)
                    $("#code-sub-group-in-component").text(response.component.code_sub_group)
                    $("#name-sub-group-in-component").text(response.sub_group)
                    $("#code-group-in-component").text(response.component.code_group)
                    $("#name-group-in-component").text(response.group)
                    $("#code-main-group-in-component").text(response.component.code_main_group)
                    $("#main-group-in-component").text(response.main_group)
                    $("#created-at-in-component").text(response.component.created_at)
                    $("#updated-at-in-component").text(response.component.updated_at)
                    $("#created-by-in-component").text(response.component.created_user)
                    $("#updated-by-in-component").text(response.component.updated_user)
                }
                else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // edit component
    $(document).on('click', '.btn-edit-component', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#edit_component_modal").modal('show')

        $.ajax({
            type: "get",
            url: `component/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#id_component").val(response.component.code_component);
                    $("#code_component_component_edit").val(response.component.code_component);
                    $("#code_main_group_in_component_edit").val(response.component.code_main_group);
                    $("#code_group_in_component_edit").val(response.component.code_group);
                    $("#code_sub_group_in_component_edit").val(response.component.code_sub_group);
                    $("#code_unit_in_component_edit").val(response.component.code_unit);
                    $("#name_component_edit").val(response.component.component_name);
                } else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // update component
    $("#update_component_form").on('submit', function (e) {
        e.preventDefault()
        let id = $("#id_component").val()
        let new_component = {
            code_component: $("#code_component_component_edit").val(),
            code_main_group: $("#code_main_group_in_component_edit").val(),
            code_group: $("#code_group_in_component_edit").val(),
            code_sub_group: $("#code_sub_group_in_component_edit").val(),
            code_unit: $("#code_unit_in_component_edit").val(),
            component_name: $("#name_component_edit").val(),
            updated_user: $("#updated_user_component").val()
        }

        $.ajax({
            type: "post",
            url: `component/${id}`,
            data: new_component,
            success: function (response) {
                if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.error-list-component-edit').append(
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
                    $("#edit_component_modal").modal("hide")
                    refresh_other_item_based_on_component()
                }

                if( response.status == 404 ) {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });

    });

    // delete component
    $(document).on('click', '.btn-delete-component', function (e) {
        e.preventDefault()
        let id = $(this).val()

        Swal.fire({
            title: 'Are you sure?',
            text: "Component will be permanently deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`delete-component/${id}`,
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
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        refresh_other_item_based_on_component()
                    }
                }
            });
        }
        })
    });

})

function fetch_component() {
    $.ajax({
        type: "get",
        url: "read-component",
        dataType: "json",
        success: function (response) {
            $('tbody#component-item').html('');

            $.each(response.components, function (indexInArray, valueOfElement) { 
                $('tbody#component-item').append(
                    `
                        <tr>
                            <td>${valueOfElement.code_component}</td>
                            <td>${valueOfElement.component_name}</td>
                            <td>
                                <button type="button" value="${valueOfElement.code_component}" class="btn btn-show-component btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_component}" class="btn btn-edit-component btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_component}" class="btn btn-delete-component btn-danger">
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

function fetch_unit_list() {
    $.ajax({
        type: "get",
        url: "read-unit",
        dataType: "json",
        success: function (response) {
            $('#code_unit_in_component').html('');
            $.each(response.units, function (indexInArray, valueOfElement) { 
                $('#code_unit_in_component').append(`
                    <option value="${valueOfElement.code_unit}">${valueOfElement.code_unit} - ${valueOfElement.unit_name}</option>
                `);
            });

            $('#code_unit_in_component_edit').html('');
            $.each(response.units, function (indexInArray, valueOfElement) { 
                $('#code_unit_in_component_edit').append(`
                    <option value="${valueOfElement.code_unit}">${valueOfElement.code_unit} - ${valueOfElement.unit_name}</option>
                `);
            });

            $('#code_unit_in_part').html('');
            $.each(response.units, function (indexInArray, valueOfElement) { 
                $('#code_unit_in_part').append(`
                    <option value="${valueOfElement.code_unit}">${valueOfElement.code_unit} - ${valueOfElement.unit_name}</option>
                `);
            });

            $('#code_unit_in_part_edit').html('');
            $.each(response.units, function (indexInArray, valueOfElement) { 
                $('#code_unit_in_part_edit').append(`
                    <option value="${valueOfElement.code_unit}">${valueOfElement.code_unit} - ${valueOfElement.unit_name}</option>
                `);
            });

        }
    });
}

function refresh_other_item_based_on_component() {
    fetch_component()
    fetch_component_list()
}