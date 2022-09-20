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
        $("#file-book-scan-seaman-book").text(geekss);

    });

    $('#book_scan_seaman_book_edit').change(function(e) {
        var geekss = e.target.files[0].name;
        $("#file-book-scan-seaman-book-edit").text(geekss);

    });

    // store seaman book
    $("#form-add-seaman-book").on('submit', function (e) {
        e.preventDefault()
        let seaman_book = new FormData( $(this)[0] );

        $.ajax({
            type: "post",
            url: "seaman-book",
            data: seaman_book,
            processData: false,
            contentType: false,
            success: function (response) {
                if( response.status == 200 ) {
                    Swal.fire("Success!", `${response.message}`, 'success')
                    $("#add-seaman-book-modal").modal('hide')
                    fetch_seaman_book()
                    fetch_crew_list()

                    // reset form
                    $("#id_crew_seaman_book").val('')
                    $("#number_seaman_book").val('')
                    $("#institution_seaman_bank").val('')
                    $("#issued_date_seaman_book").val('')
                    $("#expired_date_seaman_book").val('')
                    $("#warning_period_seaman_book").val('')
                    $("#book_scan_seaman_book").val('')
                    $("#remarks_seaman_book").val('')
                }
                else {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-seaman-book').append(
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

    // show seaman book
    $(document).on('click', '.btn-show-seaman-book', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#show-seaman-book").modal('show')
        $.ajax({
            type: "get",
            url: `seaman-book/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#crew-name-seaman-book").text(response.crew_name)
                    $("#crew-id-seaman-book").text(response.seaman_book.id_crew)
                    $("#number-seaman-book").text(response.seaman_book.number)
                    $("#institution-seaman-book").text(response.seaman_book.institution_name)
                    $("#issued-date-seaman-book").text(response.seaman_book.issued_date)
                    $("#expired-date-seaman-book").text(response.seaman_book.expired_date)
                    $("#warning-periode-seaman-book").text(response.seaman_book.warning_period)
                    $("#remarks-seaman-book").text(response.seaman_book.remarks)
                    $("#status-seaman-book").text(response.seaman_book.status)
                    $("#created-at-seaman-book").text(response.seaman_book.created_at)
                    $("#updated-at-seaman-book").text(response.seaman_book.updated_at)

                    if( response.seaman_book.book_scan ) {
                        $("#book-scan-seaman-book").html(`
                        <a target="_blank" href="/storage/${response.seaman_book.book_scan}" class="btn btn-success btn-sm">
                            <i class="bi bi-download"></i>
                        </a>
                        `)
                    }
                    else {
                        $("#book-scan-seaman-book").html(`
                            <button class="btn btn-dark btn-sm disabled">
                                <i class="bi bi-exclamation-circle-fill"></i>
                            </button>
                        `)
                    }

                    let todayDate = new Date()
                    let expiredDate = new Date( response.seaman_book.expired_date )
                    let warningPeriod = new Date( response.seaman_book.warning_period )
                    
                    if( todayDate >= warningPeriod && todayDate < expiredDate ) {
                        $("#alert-show-seaman-book").html(`
                        <div class="alert alert-warning" role="alert">
                            <b>
                                This seaman book is on warning period & will be expired on ${response.seaman_book.expired_date} <span class="bi bi-exclamation-circle"></span>
                            </b>    
                        </div>
                        `);
                    }

                    if( todayDate >= expiredDate ) {
                        $("#alert-show-seaman-book").html(
                            `
                            <div class="alert alert-danger" role="alert">
                                <b>
                                    This seaman book is expired <span class="bi bi-exclamation-circle"></span>
                                </b>
                            </div>
                            `
                        )
                    }

                    $("#show-seaman-book").on("hidden.bs.modal", function() {
                        $("#alert-show-seaman-book").html('')
                    })

                }
                else {
                    Swal.fire("Not Found", `${response.message}`, 'error')
                }
            }
        });
    });

    // edit seaman book
    $(document).on('click', '.btn-edit-seaman-book', function (e) {
        e.preventDefault()
        let id = $(this).val()
        $("#edit-seaman-book-modal").modal('show')
        $.ajax({
            type: "get",
            url: `seaman-book/${id}`,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#real_id_seaman_book").val(response.seaman_book.id)
                    $("#id_crew_seaman_book_edit").val(response.seaman_book.id_crew)
                    $("#number_seaman_book_edit").val(response.seaman_book.number)
                    $("#institution_seaman_bank_edit").val(response.seaman_book.institution_name)
                    $("#issued_date_seaman_book_edit").val(response.seaman_book.issued_date)
                    $("#expired_date_seaman_book_edit").val(response.seaman_book.expired_date)
                    $("#warning_period_seaman_book_edit").val(response.seaman_book.warning_period)
                    $("#remarks_seaman_book_edit").val(response.seaman_book.remarks)
                    $("#status_crew_seaman_book_edit").val(response.seaman_book.status)

                    if( response.seaman_book.book_scan ) {
                        $("#file-book-scan-seaman-book-edit").text(response.seaman_book.book_scan)
                    } else {
                        $("#file-book-scan-seaman-book-edit").text('')
                    }
                    
                }
                else {
                    Swal.fire("Not Found", `${response.message}`, 'error')
                }
            }
        });
    });

    // update seaman book
    $("#form-edit-seaman-book").on('submit', function (e) {
        e.preventDefault()
        let new_seaman_book = new FormData( $(this)[0] )
        let id =  $("#real_id_seaman_book").val()

        $.ajax({
            type: "post",
            url: `seaman-book/${id}`,
            data: new_seaman_book,
            processData: false,
            contentType: false,
            success: function (response) {
                if( response.status == 200 ) {
                    $("#edit-seaman-book-modal").modal("hide")
                    Swal.fire('Success', `${response.message}`, 'success');

                    fetch_seaman_book()
                    fetch_crew_list()
                }
                else if( response.status == 400 ) {
                    $.each(response.errors, function (indexInArray, valueOfElement) { 
                        $('.alert-group-list-seaman-book-edit').append(
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
                    $("#edit-seaman-book-modal").modal("hide")
                    Swal.fire('Not Found', `${response.message}`, 'error')

                    fetch_seaman_book()
                    fetch_crew_list()
                }
            }
        });
    });

    // delete seaman book
    $(document).on('click', '.btn-delete-seaman-book', function (e) {
        e.preventDefault()
        let id = $(this).val()
        Swal.fire({
            title: 'Are you sure?',
            text: "The Seaman Book Status Will Change To 'DE'",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                url:`change-status-seaman-book/${id}`,
                success: function (response) {
                    if( response.status == 404 ) {
                        Swal.fire(
                            'Not Found',
                            `${response.message}`,
                            'error'
                        )
                        fetch_seaman_book()
                        fetch_crew_list()
                        
                    } else if( response.status == 200 ) {
                        Swal.fire(
                            'Success!',
                            `${response.message}`,
                            'success'
                        )
                        fetch_seaman_book()
                        fetch_crew_list()
                    }
                }
            });
        }
        })
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