{{-- add crew certificate modal --}}
<div class="modal fade" id="add-crew-cerficate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Crew Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-certificate mb-4"></div>
                <form method="POST" id="form-add-crew-certificate" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Crew</label>
                        <select class="form-control" name="id_crew" id="id_crew_certificate">
                            
                        </select>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Certificate Name</label>
                        <select class="form-control" name="certificate_name" id="certificate_name_certificate">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Certificate Number</label>
                        <div>
                            <input name="certificate_number" type="text" class="form-control" id="certificate_number_certificate" placeholder="Certificate Number" value="{{ old('certificate_number') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Certificate Type</label>
                        <select class="form-control" name="certificate_type" id="certificate_type_certificate">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Issued At</label>
                        <div>
                            <input name="issued_at" type="text" class="form-control" id="issued_at_certificate" placeholder="Issued At" value="{{ old('issued_at') }}">
                        </div>
                    </div>

                    <div class="form-group custom-file mb-4">
                        <input type="file" class="custom-file-input" id="certificate_scan_certificate" name="certificate_scan">
                        <label class="custom-file-label" for="colFormLabel">Certificate Scan</label>
                        <div class="mt-3">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">PDF,DOCX,DOC</small>
                            </span>
                            <small id="file-certificate-scan-certificate"></small>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Issued Date</label>
                        <div>
                            <input name="issued_date" type="date" class="form-control" id="issued_date_certificate" placeholder="Issued Date" value="{{ old('issued_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Expired Date</label>
                        <div>
                            <input name="expired_date" type="date" class="form-control" id="expired_date_certificate" placeholder="Expired Date" value="{{ old('expired_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Warning Periode</label>
                        <div>
                            <input name="warning_periode" type="date" class="form-control" id="warning_periode_certificate" placeholder="Warning Periode" value="{{ old('warning_periode') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Remarks</label>
                        <div>
                            <input name="remarks" type="text" class="form-control" id="remarks_certificate" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_certificate">
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
{{-- add crew certificate modal --}}

{{-- edit crew certificate --}}
<div class="modal fade" id="edit-crew-cerficate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit New Crew Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-certificate-edit mb-4"></div>
                <form method="POST" id="form-edit-crew-certificate" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Crew</label>
                        <select class="form-control" name="id_crew" id="id_crew_certificate_edit">
                            
                        </select>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Certificate Name</label>
                        <select class="form-control" name="certificate_name" id="certificate_name_certificate_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Certificate Number</label>
                        <div>
                            <input name="certificate_number" type="text" class="form-control" id="certificate_number_certificate_edit" placeholder="Certificate Number" value="{{ old('certificate_number') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Certificate Type</label>
                        <select class="form-control" name="certificate_type" id="certificate_type_certificate_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Issued At</label>
                        <div>
                            <input name="issued_at" type="text" class="form-control" id="issued_at_certificate_edit" placeholder="Issued At" value="{{ old('issued_at') }}">
                        </div>
                    </div>

                    <div class="form-group custom-file mb-4">
                        <input type="file" class="custom-file-input" id="certificate_scan_certificate_edit" name="certificate_scan">
                        <label class="custom-file-label" for="colFormLabel">Certificate Scan</label>
                        <div class="mt-3">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">PDF,DOCX,DOC</small>
                            </span>
                            <small id="file-certificate-scan-certificate-edit"></small>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Issued Date</label>
                        <div>
                            <input name="issued_date" type="date" class="form-control" id="issued_date_certificate_edit" placeholder="Issued Date" value="{{ old('issued_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Expired Date</label>
                        <div>
                            <input name="expired_date" type="date" class="form-control" id="expired_date_certificate_edit" placeholder="Expired Date" value="{{ old('expired_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Warning Periode</label>
                        <div>
                            <input name="warning_periode" type="date" class="form-control" id="warning_periode_certificate_edit" placeholder="Warning Periode" value="{{ old('warning_periode') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Remarks</label>
                        <div>
                            <input name="remarks" type="text" class="form-control" id="remarks_certificate_edit" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_certificate_edit">
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
{{-- edit crew certificate --}}

{{-- show crew certificate --}}
<div class="modal animated fade" id="show-crew-certificate" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding:2rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crew Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewCertificate">
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group ">
                            <li class="list-group-item active">Name : <span id="crew-name-certificate"></span></li>
                            <li class="list-group-item active">ID : <span id="crew-id-certificate"></span></li>
                            <li class="list-group-item active">Certificate Name : <span id="certificate-name-certificate"></span></li>
                            <li class="list-group-item active">Certificate Number : <span id="certificate-number-certificate"></span></li>
                            <li class="list-group-item active">Certificate Type : <span id="certificate-type-certificate"></span></li>
                            <li class="list-group-item active">Issued At : <span id="issued-at-certificate"></span></li>
                            <li class="list-group-item active">Certificate Scan : <span id="certificate-scan-certificate"></span></li>
                            <li class="list-group-item active">Issued Date : <span id="issued-date-certificate"></span></li>
                            <li class="list-group-item active">Expired Date : <span id="expired-date-certificate"></span></li>
                            <li class="list-group-item active">Warning Periode : <span id="warning-periode-certificate"></span></li>
                            <li class="list-group-item active">Remarks : <span id="remarks-certificate"></span></li>
                            <li class="list-group-item active">Status : <span id="crew-status-certificate"></span></li>
                            <li class="list-group-item active">Created At : <span id="crew-created-at-certificate"></span></li>
                            <li class="list-group-item active">Updated At : <span id="crew-updated-at-certificate"></span></li>
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
{{-- show crew certificate --}}