$(document).ready( function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    fetch_list_counter()
    fetch_counter_for_list_counter_input()

    $("#selectCounterModal").on('show.bs.modal', function() {
        fetch_counter_for_list_counter_input()
    })

    $(document).on('click', '.btn-select-counter-for-list-counter', function(e) {
        e.preventDefault();
        let id = $(this).val()
        $("#addListCounterModal").modal("show")
        $.ajax({
            type: "get",
            url: `counter/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#ship_list_counter").val(response.counter.ship_name)
                    $("#item_description_list_counter").val(response.counter.item_description)
                    $("#part_no_list_counter").val(response.counter.part_no)
                    $("#last_running_hours_list_counter").val(response.counter.starting_of_running_hours)
                    $("#unit_runing_list_counter").val(response.counter.unit_runing)
                }
            }
        });
    })

    // store list counter
    $("#addListCounterForm").on("submit", function(e) {
        e.preventDefault()

        let data = {
            ship_name: $("#ship_list_counter").val(),
            item_description: $("#item_description_list_counter").val(),
            part_no: $("#part_no_list_counter").val(),
            start_date: $("#start_date_list_counter").val(),
            end_date: $("#end_date_list_counter").val(),
            last_running_hours: $("#last_running_hours_list_counter").val(),
            unit_running: $("#unit_runing_list_counter").val(),
            running_hours_today: $("#running_hours_today_list_counter").val(),
            update_running_hours: parseInt( $("#last_running_hours_list_counter").val() )  + parseInt( $("#running_hours_today_list_counter").val() ),
            status: $("#status_list_counter").val()
        }

        $.ajax({
            type: "post",
            url: "list-counter",
            data: data,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success!", `${response.message}`, 'success')
                    $("#addListCounterModal").modal("hide")
                    $("#selectCounterModal").modal("hide")
                    fetch_list_counter()
                    fetch_counter_for_list_counter_input()

                    $("#unit_runing_list_counter").val("HOURS")
                    $("#start_date_list_counter").val('')
                    $("#end_date_list_counter").val('')
                    $("#running_hours_today_list_counter").val('')
                    $("#status_list_counter").val("ACT")
                }
                else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-counter-list').append(
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
    })

} )

function fetch_counter_for_list_counter_input() {
    $.ajax({
        type: "get",
        url: "read-counter",
        success: function (response) {
            $('tbody#select-counter-for-list-counter').html('');
            $.each(response.counters, function (key, record) {
            $('tbody#select-counter-for-list-counter').append(`
                <tr>
                    <td>
                        <button type="button" value="${record.id}" class="btn btn-sm btn-info btn-select-counter-for-list-counter">SELECT THIS</button>
                    </td>
                    <td>${record.ship_name}</td>
                    <td>${record.item_description}</td>
                    <td>${record.part_no}</td>
                    <td>${record.starting_of_running_hours} ${record.unit_runing}</td>
                </tr>
                `)
            });
        }
    });
}

function fetch_list_counter() {
    $.ajax({
        type: "get",
        url: "read-list-counter",
        success: function (response) {
            $('tbody#list-counter-list').html('');
            let no = 0
            $.each(response.list_counters, function (key, record) {
            $('tbody#list-counter-list').append(`
                <tr>
                    <td>${no+=1}</td>
                    <td>${record.ship_name}</td>
                    <td>${record.item_description}</td>
                    <td>${record.part_no}</td>
                    <td>${record.start_date}</td>
                    <td>${record.end_date}</td>
                    <td>${record.last_running_hours} ${record.unit_running}</td>
                    <td>${record.running_hours_today}</td>
                    <td>${record.update_running_hours}</td>
                    <td class="d-flex justify-content-between">
                        <button type="button" value="${record.id}" class="btn mr-1 btn-history-list-counter btn-info">
                            <i class="bi bi-clock-history"></i>
                        </button>
                    
                        <button type="button" value="${record.id}" class="btn mr-1 btn-edit-list-counter btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <button type="button" value="${record.id}" class="btn ml-1 btn-delete-list-counter btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>
                `)
            });
        }
    });
}

document.querySelector("#end_date_list_counter").addEventListener("change", function() {
    let start = Date.parse( document.querySelector("#start_date_list_counter").value )
    let end = Date.parse( document.querySelector("#end_date_list_counter").value )

    let totalHours = NaN
    if( start < end ) {
        totalHours = Math.floor((end - start) / 1000 / 60 / 60)
    }

    document.querySelector("#running_hours_today_list_counter").value = totalHours
})