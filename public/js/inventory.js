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
})

function fetch_inventory() {

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