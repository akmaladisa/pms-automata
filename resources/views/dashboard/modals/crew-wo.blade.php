<div class="modal fade" id="add-crew-wo-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Crew Work Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- show error list if exist --}}
                <div class="alert-group-list-crew-wo-error mb-4"></div>
                <form id="add-crew-wo-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                        <select id="id_crew_wo" class="form-control col-sm-8" name="id_crew">
                            
                        </select>
                    </div>
            
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Company Name</label>
                        <div class="col-sm-10">
                            <input name="company_nm" type="text" class="form-control" id="company_name_crew_wo" placeholder="Company Name" value="{{ old('company_nm') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Last Position</label>
                        <div class="col-sm-10">
                            <input name="last_position" type="text" class="form-control" id="last_position_crew_wo" placeholder="Last Position" value="{{ old('last_position') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Year In</label>
                        <div class="col-sm-10">
                            <input name="year_in" type="number" class="form-control" id="year_in_crew_wo" placeholder="Year In" value="{{ old('year_in') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Year Out</label>
                        <div class="col-sm-10">
                            <input name="year_out" type="number" class="form-control" id="year_out_crew_wo" placeholder="Year Out" value="{{ old('year_out') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label mr-3">Certificate</label>
                        <div class="col-sm-8">
                            <input type="file" class="custom-file-input" id="certificate_crew_wo" name="certificate">
                            <label class="custom-file-label" for="customFile">Choose Certificate</label>
                            <div class=" mt-2">
                                <span class="badge badge-primary">
                                    <small id="sh-text4" class="form-text mt-0">PDF,DOCX,DOC</small>
                                </span>
                                <small id="file-certificate-name-crew-wo"></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                            <input name="remarks" type="text" class="form-control" id="more_info_crew_wo" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>
            
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_wo">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Created User</label>
                        <div class="col-sm-10">
                            <input name="created_user" id="created_user_crew_wo" type="text" readonly value="{{ auth()->user()->id_login }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_store_crew_wo" class="btn btn-primary">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

{{-- modal show crew WO --}}
<div class="modal animated fade" id="show-crew-wo" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding:2rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crew Work Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewMedicalRecord">
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group ">
                            <li class="list-group-item active">Name : <span id="crew-name-wo"></span></li>
                            <li class="list-group-item active">ID : <span id="crew-id-wo"></span></li>
                            <li class="list-group-item active">Company : <span id="crew-company-wo"></span></li>
                            <li class="list-group-item active">Last Position : <span id="crew-last-position-wo"></span></li>
                            <li class="list-group-item active">Year In : <span id="crew-year-in-wo"></span></li>
                            <li class="list-group-item active">Year Out : <span id="crew-year-out-wo"></span></li>
                            <li class="list-group-item active">Certificate : <span id="crew-certificate-wo"></span></li>
                            <li class="list-group-item active">Remarks : <span id="crew-more-info-wo"></span></li>
                            <li class="list-group-item active">Status : <span id="crew-status-wo"></span></li>
                            <li class="list-group-item active">Created At : <span id="crew-created-at-wo"></span></li>
                            <li class="list-group-item active">Updated At : <span id="crew-updated-at-wo"></span></li>
                            <li class="list-group-item active">Created By : <span id="crew-created-user-wo"></span></li>
                            <li class="list-group-item active">Updated By : <span id="crew-updated-user-wo"></span></li>
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
{{-- modal show crew WO --}}

{{-- edit crew WO modal --}}
<div class="modal fade" id="edit-crew-wo-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Crew Work Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- show error list if exist --}}
                <div class="alert-group-list-crew-wo-edit-error mb-4"></div>
                <form id="edit-crew-wo-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="real_id_crew_WO">
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                        <select id="id_crew_wo_edit" class="form-control col-sm-8" name="id_crew">
                            
                        </select>
                    </div>
            
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Company Name</label>
                        <div class="col-sm-10">
                            <input name="company_nm" type="text" class="form-control" id="company_name_crew_wo_edit" placeholder="Company Name" value="{{ old('company_nm') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Last Position</label>
                        <div class="col-sm-10">
                            <input name="last_position" type="text" class="form-control" id="last_position_crew_wo_edit" placeholder="Last Position" value="{{ old('last_position') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Year In</label>
                        <div class="col-sm-10">
                            <input name="year_in" type="number" class="form-control" id="year_in_crew_wo_edit" placeholder="Year In" value="{{ old('year_in') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Year Out</label>
                        <div class="col-sm-10">
                            <input name="year_out" type="number" class="form-control" id="year_out_crew_wo_edit" placeholder="Year Out" value="{{ old('year_out') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label mr-3">Certificate</label>
                        <div class="col-sm-8">
                            <input type="file" class="custom-file-input" id="certificate_crew_wo_edit" name="certificate">
                            <label class="custom-file-label" for="customFile">Choose Certificate</label>
                            <div class=" mt-2">
                                <span class="badge badge-primary">
                                    <small id="sh-text4" class="form-text mt-0">PDF,DOCX,DOC</small>
                                </span>
                                <small id="file-certificate-name-crew-wo-edit"></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                            <input name="remarks" type="text" class="form-control" id="more_info_crew_wo_edit" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>
            
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_wo_edit">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Updated User</label>
                        <div class="col-sm-10">
                            <input name="updated_user" id="updated_user_crew_wo" type="text" readonly value="{{ auth()->user()->id_login }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_update_crew_wo" class="btn btn-primary">Update</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- edit crew WO modal --}}