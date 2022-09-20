$(document).ready( function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetch_crew_list()
    fetch_seaman_book()

    $("#seaman_book_add_btn_modal").on('click', function(e) {
        e.preventDefault();
        $("#add-seaman-book-modal").modal('show')

        remove_required_attribute_from_crew_master_modal_input()
        remove_required_attribute_from_crew_master_modal_edit_input()
    })

    $("#add-seaman-book-modal").on("hidden.bs.modal", function() {
        add_required_attribute_from_crew_master_modal_edit_input()
        add_required_attribute_from_crew_master_modal_input()

        $("#book_scan_seaman_book").val('')
        $("#file-book-scan-seaman-book").text('')
    })

    $("#edit-seaman-book-modal").on("hidden.bs.modal", function() {
        $("#book_scan_seaman_book_edit").val('')
        $("#file-book-scan-seaman-book-edit").text('')
    })

    $('#book_scan_seaman_book').change(function(e) {
        var geekss = e.target.files[0].name;
        $("#file-certificate-scan-certificate").text(geekss);

    });

    $('#book_scan_seaman_book_edit').change(function(e) {
        var geekss = e.target.files[0].name;
        $("#file-certificate-scan-certificate-edit").text(geekss);

    });

} )

function fetch_seaman_book() {
    $.ajax({
        type: "get",
        url: "read-seaman-book",
        dataType: "json",
        success: function (response) {
            $('tbody#seaman-book-tbody').html('');
            $.each(response.seaman_books, function (indexInArray, value) { 
                
                
                let todayDate = new Date()
                let expiredDate = new Date( value.expired_date )
                let warningPeriod = new Date( value.warning_period )

                let badge = `<span class="badge badge-success">Safe</span>`;

                if( todayDate >= warningPeriod && todayDate < expiredDate ) {
                    badge = `<span class="badge badge-warning">Warning</span>`
                }

                if( todayDate >= expiredDate ) {
                    badge = `<span class="badge badge-danger">Expired</span>`
                }
                
                let UI_scan_certificate;

                if( value.book_scan ) {
                    UI_scan_certificate = `<a target="_blank" href="/storage/${value.book_scan}" class="btn btn-success btn-sm">
                    <i class="bi bi-download"></i>
                    </a>`
                } else {
                    UI_scan_certificate = `<button class="btn btn-dark btn-sm disabled">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    </button>`
                }

                $('tbody#seaman-book-tbody').append(`
                <tr>
                    <td>
                        ${badge}
                        ${value.id_crew}
                    </td>
                    <td>${value.number}</td>
                    <td>${UI_scan_certificate}</td>
                    <td>
                        <button type="button" value="${value.id}" class="btn btn-show-seaman-book btn-info">
                            <i class="bi bi-eye-fill"></i>
                        </button>
    
                        <button type="button" value="${value.id}" class="btn btn-edit-seaman-book btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </button>
    
                        <button type="button" value="${value.id}" class="btn btn-delete-seaman-book btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>
                </tr>`
                )

            });
        }
    });
}