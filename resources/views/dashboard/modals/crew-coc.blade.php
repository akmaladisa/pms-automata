{{-- add crew COC --}}
<div class="modal fade" id="add-crew-coc-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Crew COC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-coc mb-2"></div>
                <form method="POST" id="form-add-crew-coc" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Crew</label>
                        <select class="form-control" name="id_crew" id="id_crew_coc">
                            
                        </select>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Certificate Rank</label>
                        <select class="form-control" name="certificate_rank" id="certificate_rank_coc">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Certificate Number</label>
                        <div>
                            <input name="certificate_number" type="text" class="form-control" id="certificate_number_coc" placeholder="Certificate Number" value="{{ old('certificate_number') }}">
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Confirmed Date</label>
                        <div>
                            <input name="confirmed" type="date" class="form-control" id="confirmed_coc" placeholder="Expired Date" value="{{ old('confirmed') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Institution Name</label>
                        <div>
                            <input name="institution_name" type="text" class="form-control" id="institution_name_coc" placeholder="Institution Name" value="{{ old('institution_name') }}">
                        </div>
                    </div>
                    
                    <div class="form-group custom-file mb-4">
                        <input type="file" class="custom-file-input" id="certificate_scan_coc" name="certificate_scan">
                        <label class="custom-file-label" for="colFormLabel">Certificate Scan</label>
                        <div class="mt-3">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">PDF,DOCX,DOC</small>
                            </span>
                            <small id="file-certificate-scan-coc"></small>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Remarks</label>
                        <div>
                            <input name="remarks" type="text" class="form-control" id="remarks_coc" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_coc">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_store_crew_coc" class="btn btn-primary">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- add crew COC --}}

{{-- edit crew COC --}}
<div class="modal fade" id="edit-crew-coc-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Crew COC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-coc-edit mb-2"></div>
                <form method="POST" id="form-edit-crew-coc" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="real_id_coc">

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Crew</label>
                        <select class="form-control" name="id_crew" id="id_crew_coc_edit">
                            
                        </select>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Certificate Rank</label>
                        <select class="form-control" name="certificate_rank" id="certificate_rank_coc_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Certificate Number</label>
                        <div>
                            <input name="certificate_number" type="text" class="form-control" id="certificate_number_coc_edit" placeholder="Certificate Number" value="{{ old('certificate_number') }}">
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Confirmed Date</label>
                        <div>
                            <input name="confirmed" type="date" class="form-control" id="confirmed_coc_edit" placeholder="Expired Date" value="{{ old('confirmed') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Institution Name</label>
                        <div>
                            <input name="institution_name" type="text" class="form-control" id="institution_name_coc_edit" placeholder="Institution Name" value="{{ old('institution_name') }}">
                        </div>
                    </div>
                    
                    <div class="form-group custom-file mb-4">
                        <input type="file" class="custom-file-input" id="certificate_scan_coc_edit" name="certificate_scan">
                        <label class="custom-file-label" for="colFormLabel">Certificate Scan</label>
                        <div class="mt-3">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">PDF,DOCX,DOC</small>
                            </span>
                            <small id="file-certificate-scan-coc-edit"></small>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Remarks</label>
                        <div>
                            <input name="remarks" type="text" class="form-control" id="remarks_coc_edit" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_coc_edit">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- edit crew COC --}}

{{-- show crew COC --}}
<div class="modal animated fade" id="show-crew-coc" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding:2rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crew COC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewCOC">
                <div class="row">
                    <div class="col-12">
                        <div id="alert-show-certificate"></div>
                        <ul class="list-group ">
                            <li class="list-group-item active">Crew : <span id="crew-name-in-coc"></span></li>
                            <li class="list-group-item active">Crew ID : <span id="crew-id-in-coc"></span></li>
                            <li class="list-group-item active">Certificate Rank : <span id="certificate-rank-in-coc"></span></li>
                            <li class="list-group-item active">Certificate Number : <span id="certificate-number-in-coc"></span></li>
                            <li class="list-group-item active">Confirmed Date : <span id="confirmed-in-coc"></span></li>
                            <li class="list-group-item active">Institution : <span id="institution-name-in-coc"></span></li>
                            <li class="list-group-item active">Certificate Scan : <span id="certificate-scan-in-coc"></span></li>
                            <li class="list-group-item active">Remarks : <span id="remarks-in-coc"></span></li>
                            <li class="list-group-item active">Status : <span id="status-in-coc"></span></li>
                            <li class="list-group-item active">Created At : <span id="created-at-in-coc"></span></li>
                            <li class="list-group-item active">Updated At : <span id="updated-at-in-coc"></span></li>
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
{{-- show crew COC --}}