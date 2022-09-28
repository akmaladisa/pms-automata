$(document).ready(function() {
    fetch_report_counter()

    // show report counter
    $(document).on('click', '.btn-history-list-counter', function (e) {
        e.preventDefault();
        let ship = $(this).val()
        $("#show-report-counter-modal").modal("show")
        $.ajax({
            type: "get",
            url: `show-report-counter/${ship}`,
            success: function (response) {
                $('tbody#tbody-report-counter').html('');
                let no = 0
                $.each(response.report_counter, function (key, record) {
                $('tbody#tbody-report-counter').append(`
                    <tr>
                        <td>${no+=1}</td>
                        <td>${record.ship_name}</td>
                        <td>${record.item_description}</td>
                        <td>${record.part_no}</td>
                        <td>${record.start_date}</td>
                        <td>${record.end_date}</td>
                        <td>${record.last_running_hours}</td>
                        <td>${record.update_running_hours}</td>
                        <td>${record.total_running_hours}</td>
                    </tr>
                    `)
                });
            }
        });
    });
})

function fetch_report_counter() {
    $.ajax({
        type: "get",
        url: "read-report-counter",
        success: function (response) {
            $('tbody#report-counter-list').html('');
            let no = 0
            $.each(response.report_counters, function (key, record) {
            $('tbody#report-counter-list').append(`
                <tr>
                    <td>${no+=1}</td>
                    <td>${record.ship_name}</td>
                    <td>${record.item_description}</td>
                    <td>${record.part_no}</td>
                    <td>${record.start_date}</td>
                    <td>${record.end_date}</td>
                    <td>${record.last_running_hours}</td>
                    <td>${record.update_running_hours}</td>
                    <td>${record.total_running_hours}</td>
                </tr>
                `)
            });
        }
    });
}
