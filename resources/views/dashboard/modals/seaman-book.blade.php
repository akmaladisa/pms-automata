{{-- add seaman book modal --}}
<div class="modal fade" id="add-seaman-book-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Seaman Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-seaman-book mb-4"></div>
                <form method="POST" id="form-add-seaman-book" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Crew</label>
                        <select class="form-control" name="id_crew" id="id_crew_seaman_book">
                            
                        </select>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Seaman Book Number</label>
                        <div>
                            <input name="number" type="text" class="form-control" id="number_seaman_book" placeholder="Seaman Book Number" value="{{ old('number') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Institution Name</label>
                        <div>
                            <input name="institution_name" type="text" class="form-control" id="institution_seaman_bank" placeholder="Institution Name" value="{{ old('institution_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Issued Date</label>
                        <div>
                            <input name="issued_date" type="date" class="form-control" id="issued_date_seaman_book" placeholder="Issued Date" value="{{ old('issued_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Expired Date</label>
                        <div>
                            <input name="expired_date" type="date" class="form-control" id="expired_date_seaman_book" placeholder="Expired Date" value="{{ old('expired_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Warning Periode</label>
                        <div>
                            <input name="warning_period" type="date" class="form-control" id="warning_period_seaman_book" placeholder="Warning Period" value="{{ old('warning_periode') }}">
                        </div>
                    </div>

                    <div class="form-group custom-file mb-4">
                        <input type="file" class="custom-file-input" id="book_scan_seaman_book" name="book_scan">
                        <label class="custom-file-label" for="colFormLabel">Book Scan</label>
                        <div class="mt-3">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">PDF,DOCX,DOC</small>
                            </span>
                            <small id="file-book-scan-seaman-book"></small>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Remarks</label>
                        <div>
                            <input name="remarks" type="text" class="form-control" id="remarks_seaman_book" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_seaman_book">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_store_crew_certificate" class="btn btn-primary">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- add crew seaman book --}}

{{-- show seaman book--}}
<div class="modal animated fade" id="show-seaman-book" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding:2rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seaman Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewCertificate">
                <div class="row">
                    <div class="col-12">
                        <div id="alert-show-seaman-book"></div>
                        <ul class="list-group">
                            <li class="list-group-item active">Crew : <span id="crew-name-seaman-book"></span></li>
                            <li class="list-group-item active">Crew ID : <span id="crew-id-seaman-book"></span></li>
                            <li class="list-group-item active">Book Number : <span id="number-seaman-book"></span></li>
                            <li class="list-group-item active">Institution : <span id="institution-seaman-book"></span></li>
                            <li class="list-group-item active">Issued Date : <span id="issued-date-seaman-book"></span></li>
                            <li class="list-group-item active">Expired Date : <span id="expired-date-seaman-book"></span></li>
                            <li class="list-group-item active">Warning Period : <span id="warning-periode-seaman-book"></span></li>
                            <li class="list-group-item active">Book Scan : <span id="book-scan-seaman-book"></span></li>
                            <li class="list-group-item active">Remarks : <span id="remarks-seaman-book"></span></li>
                            <li class="list-group-item active">Status : <span id="status-seaman-book"></span></li>
                            <li class="list-group-item active">Created At : <span id="created-at-seaman-book"></span></li>
                            <li class="list-group-item active">Updated At : <span id="updated-at-seaman-book"></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeFormModal" data-dismiss="modal" lang="en">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- show seaman book --}}

{{-- edit seaman book --}}
<div class="modal fade" id="edit-seaman-book-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Seaman Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-seaman-book-edit mb-4"></div>
                <form method="POST" id="form-edit-seaman-book" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="real_id_seaman_book">
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Crew</label>
                        <select class="form-control" name="id_crew" id="id_crew_seaman_book_edit">
                            
                        </select>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Seaman Book Number</label>
                        <div>
                            <input name="number" type="text" class="form-control" id="number_seaman_book_edit" placeholder="Seaman Book Number" value="{{ old('number') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Institution Name</label>
                        <div>
                            <input name="institution_name" type="text" class="form-control" id="institution_seaman_bank_edit" placeholder="Institution Name" value="{{ old('institution_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Issued Date</label>
                        <div>
                            <input name="issued_date" type="date" class="form-control" id="issued_date_seaman_book_edit" placeholder="Issued Date" value="{{ old('issued_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Expired Date</label>
                        <div>
                            <input name="expired_date" type="date" class="form-control" id="expired_date_seaman_book_edit" placeholder="Expired Date" value="{{ old('expired_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Warning Periode</label>
                        <div>
                            <input name="warning_period" type="date" class="form-control" id="warning_period_seaman_book_edit" placeholder="Warning Period" value="{{ old('warning_periode') }}">
                        </div>
                    </div>

                    <div class="form-group custom-file mb-4">
                        <input type="file" class="custom-file-input" id="book_scan_seaman_book_edit" name="book_scan">
                        <label class="custom-file-label" for="colFormLabel">Book Scan</label>
                        <div class="mt-3">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">PDF,DOCX,DOC</small>
                            </span>
                            <small id="file-book-scan-seaman-book-edit"></small>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Remarks</label>
                        <div>
                            <input name="remarks" type="text" class="form-control" id="remarks_seaman_book_edit" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_seaman_book_edit">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_update_crew_certificate" class="btn btn-primary">Update</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- edit seaman book --}}
