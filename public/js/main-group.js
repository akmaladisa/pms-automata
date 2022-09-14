$(document).ready( function() {

    fetch_main_group()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // show main group
    $(document).on('click', '.btn-show-main-group', function (e) {
        e.preventDefault();
        let id = $(this).val();
        $("#show-main-group").modal('show')

        $.ajax({
            type: "get",
            url: `main-group/${id}`,
            contentType:'application/json',
            dataType: "json",
            success: function (response) {
                if( response.status == 200 ) {
                    $('#item-code-main-group').text(response.main_group.kode_barang);
                    $('#code-main-group').text(response.main_group.code_main_group);
                    $('#name-main-group').text(response.main_group.main_group_name);
                    $('#created-at-main-group').text(response.main_group.created_at);
                    $('#updated-at-main-group').text(response.main_group.updated_at);
                    $('#created-by-main-group').text(response.main_group.created_user);
                    $('#updated-by-main-group').text(response.main_group.updated_user);
                } else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // edit main group
    $(document).on('click', '.btn-edit-main-group', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#edit_main_group_modal").modal('show')

        $.ajax({
            type: "get",
            url: `main-group/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#id_main_group").val(response.main_group.code_main_group);
                    $('#item_code_main_group_edit').val(response.main_group.kode_barang);
                    $('#code_main_group_edit').val(response.main_group.code_main_group);
                    $("#name_main_group_edit").val(response.main_group.main_group_name);
                }
                else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    // update main group
    $("#update_main_group_form").on('submit', function (e) {
        e.preventDefault()
        let id = $("#id_main_group").val();
        let new_main_group = {
            kode_barang: $("#item_code_main_group_edit").val(),
            code_main_group: $("#code_main_group_edit").val(),
            main_group_name: $('#name_main_group_edit').val(),
            updated_user: $("#updated_user_main_group").val()
        }

        $.ajax({
            type: "post",
            url: `main-group/${id}`,
            data: new_main_group,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success", `${response.message}`, 'success')
                    $("#edit_main_group_modal").modal('hide')
                    fetch_main_group()
                    fetch_main_group_list()
                }

                if( response.status == 404 ) {
                    Swal.fire('404', `${response.message}`, 'error')
                }
            },
            error: function(e) {
                console.log(e.responseText);
            }
        });
    });

    // delete main group
    $(document).on('click', '.btn-delete-main-group', function (e) {
        e.preventDefault()
        let id = $(this).val()

        Swal.fire({
            title: 'Are you sure?',
            text: "Main Group will be permanently deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`delete-main-group/${id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                        fetch_main_group()
                    } else if( response.status == 400 ) {
                        Swal.fire(
                            'Error!',
                            'Error To Delete Main Group',
                            'error'
                        )
                        fetch_main_group()
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        fetch_main_group()
                        fetch_main_group_list()
                    }
                }
            });
        }
        })
    });

} )

function fetch_main_group() {
    $.ajax({
        type: "get",
        url: "read-main-group",
        dataType: "json",
        success: function (response) {
            $('tbody#main-group-item').html('');

            $.each(response.main_groups, function (indexInArray, valueOfElement) { 
                $('tbody#main-group-item').append(
                    `
                        <tr>
                            <td>${valueOfElement.kode_barang}</td>
                            <td>${valueOfElement.code_main_group}</td>
                            <td>${valueOfElement.main_group_name}</td>
                            <td>
                                <button type="button" value="${valueOfElement.code_main_group}" class="btn btn-show-main-group btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_main_group}" class="btn btn-edit-main-group btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
            
                                <button type="button" value="${valueOfElement.code_main_group}" class="btn btn-delete-main-group btn-danger">
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