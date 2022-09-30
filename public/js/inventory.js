$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetch_inventory()
    fetch_ship_for_counter()
    fetch_vendor()
    fetch_departement()

    // store inventory
    $("#addInventoryForm").on('submit', function (e) {
        e.preventDefault();
        let data = {
            ship_name: $("#ship_inventory").val(),
            item_description: $("#item_description_inventory").val(),
            part_no: $("#part_no_inventory").val(),
            departement: $("#departement_inventory").val(),
            vendor: $("#vendor_inventory").val(),
            stock: $("#stock_inventory").val(),
            unit_stock: $("#unit_stock_inventory").val(),
            stock_minimum: $("#stock_minimum_inventory").val(),
            unit_stock_minimum: $("#unit_stock_minimum_inventory").val(),
            location: $("#location_inventory").val(),
            date: $("#date_inventory").val(),
            remarks: $("#remarks_inventory").val(),
            status: $("#status_inventory").val(),
        }
        $.ajax({
            type: "post",
            url: "inventory",
            data: data,
            success: function (response) {
                if(response.status == 200) {
                    Swal.fire("Success", `${response.message}`, 'success')
                    $("#addInventoryModal").modal("hide")

                    fetch_inventory()
                    fetch_ship_for_counter()
                    fetch_vendor()
                    fetch_departement()
                    fetch_item_description()

                    $("#ship_inventory").val('')
                    $("#item_description_inventory").val('')
                    $("#part_no_inventory").val('')
                    $("#vendor_inventory").val('')
                    $("#stock_inventory").val('')
                    $("#unit_stock_inventory").val('PCS')
                    $("#stock_minimum_inventory").val('')
                    $("#unit_stock_minimum_inventory").val('PCS')
                    $("#date_inventory").val('')
                    $("#remarks_inventory").val('')
                    $("#status_inventory").val('ACT')
                } else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-inventory').append(
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

    $(document).on('click', '.btn-show-inventory', function(e) {
        e.preventDefault()
        let id = $(this).val()
        $("#showInventoryModal").modal("show")
        $.ajax({
            type: "get",
            url: `inventory/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $('tbody#tbody-show-inventory').html('');
                    $('tbody#tbody-show-inventory').html(
                        `
                            <tr>
                                <td>${response.inventory.ship_name}</td>
                                <td>${response.inventory.item_description}</td>
                                <td>${response.inventory.part_no}</td>
                                <td>${response.inventory.departement}</td>
                                <td>${response.inventory.vendor}</td>
                                <td>${response.inventory.stock} ${response.inventory.unit_stock}</td>
                                <td>${response.inventory.stock_minimum} ${response.inventory.unit_stock_minimum}</td>
                                <td>${response.inventory.location}</td>
                                <td>${response.inventory.date}</td>
                                <td>${response.inventory.remarks}</td>
                            </tr>
                        `
                    );
                }
                else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    })

    $(document).on("click", '.btn-edit-inventory', function(e) {
        e.preventDefault()
        let id = $(this).val()
        $("#editInventoryModal").modal("show")
        $.ajax({
            type: "get",
            url: `inventory/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#ship_inventory_edit").val(response.inventory.ship_name)
                    $("#item_description_inventory_edit").val(response.inventory.item_description)
                    $("#part_no_inventory_edit").val(response.inventory.part_no)
                    $("#departement_inventory_edit").val(response.inventory.departement)
                    $("#vendor_inventory_edit").val(response.inventory.vendor)
                    $("#stock_inventory_edit").val(response.inventory.stock)
                    $("#unit_stock_inventory_edit").val(response.inventory.unit_stock)
                    $("#stock_minimum_inventory_edit").val(response.inventory.stock_minimum)
                    $("#unit_stock_minimum_inventory_edit").val(response.inventory.unit_stock_minimum)
                    $("#location_inventory_edit").val(response.inventory.location)
                    $("#date_inventory_edit").val(response.inventory.date)
                    $("#remarks_inventory_edit").val(response.inventory.remarks)
                    $("#status_inventory_edit").val(response.inventory.status)
                    $("#real_id_inventory").val(response.inventory.id)
                }
                else {
                    Swal.fire("404", `${response.message}`, 'error')
                }
            }
        });
    });

    $('#editInventoryForm').on('submit', function (e) {
        e.preventDefault()
        let id = $("#real_id_inventory").val()
        let data = {
            ship_name: $("#ship_inventory_edit").val(),
            item_description: $("#item_description_inventory_edit").val(),
            part_no: $("#part_no_inventory_edit").val(),
            departement: $("#departement_inventory_edit").val(),
            vendor: $("#vendor_inventory_edit").val(),
            stock: $("#stock_inventory_edit").val(),
            unit_stock: $("#unit_stock_inventory_edit").val(),
            stock_minimum: $("#stock_minimum_inventory_edit").val(),
            unit_stock_minimum: $("#unit_stock_minimum_inventory_edit").val(),
            location: $("#location_inventory_edit").val(),
            date: $("#date_inventory_edit").val(),
            remarks: $("#remarks_inventory_edit").val(),
            status: $("#status_inventory_edit").val(),
        }
        $.ajax({
            type: "post",
            url: `inventory/${id}`,
            data: data,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success!", `${response.message}`, 'success')
                    $("#editInventoryModal").modal("hide")
                    
                    fetch_inventory()
                    fetch_ship_for_counter()
                    fetch_vendor()
                    fetch_departement()
                    fetch_item_description()
                }
                else if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-inventory-edit').append(
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
                    Swal.fire("Success", `${response.message}`, 'success')
                }
            }
        });
    });

    $(document).on('click', '.btn-delete-inventory', function (e) {
        e.preventDefault()
        let id = $(this).val()
        Swal.fire({
            title: 'Are you sure?',
            text: "Inventory Status Will Change To 'DE'",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`change-status-inventory/${id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                        fetch_inventory()
                        
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        fetch_inventory()
                    }
                }
            });
        }
        })
    });

})

function fetch_inventory() {
    $.ajax({
        type: "get",
        url: "read-inventory",
        dataType: "json",
        success: function (response) {
            $('tbody#tbody-inventory-list').html('');
            let no = 0;
            $.each(response.inventories, function (key, record) { 
            $('tbody#tbody-inventory-list').append(`
            <tr>
                <td>${no+=1}</td>
                <td>${record.ship_name}</td>
                <td>${record.item_description}</td>
                <td>${record.part_no}</td>
                <td>${record.stock} ${record.unit_stock}</td>
                <td>${record.stock_minimum} ${record.unit_stock_minimum}</td>
                <td>
                    <button type="button" value="${record.id}" class="btn btn-show-inventory btn-info">
                        <i class="bi bi-eye-fill"></i>
                    </button>

                    <button type="button" value="${record.id}" class="btn btn-edit-inventory btn-warning">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <button type="button" value="${record.id}" class="btn btn-delete-inventory btn-danger">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
            `)
    });
        }
    });
}


function fetch_vendor() {
    $.ajax({
        type: "get",
        url: "read-vendors",
        success: function (response) {
            $("#vendor_inventory").html('')
            $.each(response.vendors, function (indexInArray, valueOfElement) { 
                $('#vendor_inventory').append(`
                    <option value="${valueOfElement.vendor_name}">${valueOfElement.vendor_name}</option>
                `);
            });

            $("#vendor_inventory_edit").html('')
            $.each(response.vendors, function (indexInArray, valueOfElement) { 
                $('#vendor_inventory_edit').append(`
                    <option value="${valueOfElement.vendor_name}">${valueOfElement.vendor_name}</option>
                `);
            });
        }
    });
}

function fetch_departement() {
    $.ajax({
        type: "get",
        url: "read-departement",
        success: function (response) {
            $("#departement_inventory").html('')
            $.each(response.departements, function (indexInArray, valueOfElement) { 
                $('#departement_inventory').append(`
                    <option value="${valueOfElement.departement_name}">${valueOfElement.departement_name}</option>
                `);
            });

            $("#departement_inventory_edit").html('')
            $.each(response.departements, function (indexInArray, valueOfElement) { 
                $('#departement_inventory_edit').append(`
                    <option value="${valueOfElement.departement_name}">${valueOfElement.departement_name}</option>
                `);
            });
        }
    });
}