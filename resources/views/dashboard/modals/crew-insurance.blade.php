{{-- add crew insurance --}}
<div class="modal fade" id="add-crew-insurance-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Crew Insurance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-insurance mb-4"></div>
                <form method="POST" id="form-add-crew-insurance">
                    @csrf
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                        <select class="form-control col-sm-8" name="id_crew" id="id_crew_insurance">
                            
                        </select>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Insurance Name</label>
                        <div class="col-sm-10">
                            <input name="insurance_name" type="text" class="form-control" id="crew_insurance_name_insurance" placeholder="Insurance Name" value="{{ old('insurance_name') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Account Number</label>
                        <div class="col-sm-10">
                            <input name="account_number" type="number" class="form-control" id="crew_account_number_insurance" placeholder="Account Number" value="{{ old('account_number') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Insurance Type</label>
                        <div class="col-sm-10">
                            <input name="insurance_type" type="text" class="form-control" id="crew_insurance_type_insurance" placeholder="Insurance Type" value="{{ old('insurance_type') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Name of Heritage</label>
                        <div class="col-sm-10">
                            <input name="name_of_heritage" type="text" class="form-control" id="crew_name_of_heritage_insurance" placeholder="Name of Heritage" value="{{ old('name_of_heritage') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="txtRemarks" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                            <textarea lang="en" name="remarks" class="form-control form-control-sm" id="crew_remarks_insurance" aria-describedby="txtRemarks" placeholder="Remarks" rows="2">{{ old('remarks') }}</textarea>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_insurance">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_store_crew_insurance" class="btn btn-primary">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- add crew insurance end --}}

{{-- edit crew insurance --}}
<div class="modal fade" id="edit-crew-insurance-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Crew Insurance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-insurance-edit mb-4"></div>
                <form method="POST" id="form-edit-crew-insurance">
                    @csrf
                    <div class="input-group mb-4">
                        <input type="hidden" name="id" id="real_ID_crew_insurance">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                        <select class="form-control col-sm-8" name="id_crew" id="id_crew_insurance_edit">
                            
                        </select>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Insurance Name</label>
                        <div class="col-sm-10">
                            <input name="insurance_name" type="text" class="form-control" id="crew_insurance_name_insurance_edit" placeholder="Insurance Name" value="{{ old('account_name') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Account Number</label>
                        <div class="col-sm-10">
                            <input name="account_number" type="number" class="form-control" id="crew_account_number_insurance_edit" placeholder="Account Number" value="{{ old('account_number') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Insurance Type</label>
                        <div class="col-sm-10">
                            <input name="insurance_type" type="text" class="form-control" id="crew_insurance_type_insurance_edit" placeholder="Insurance Type" value="{{ old('account_name') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Name of Heritage</label>
                        <div class="col-sm-10">
                            <input name="name_of_heritage" type="text" class="form-control" id="crew_name_of_heritage_insurance_edit" placeholder="Name of Heritage" value="{{ old('account_name') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="txtRemarks" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                            <textarea lang="en" name="remarks" class="form-control form-control-sm" id="crew_remarks_insurance_edit" aria-describedby="txtRemarks" placeholder="Remarks" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_insurance_edit">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_update_crew_insurance" class="btn btn-primary">Update</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- edit crew insurance end --}}

{{-- show crew insurance --}}
<div class="modal animated fade" id="show-crew-insurance" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding:2rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crew Insurance Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewInsurance">
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group ">
                            <li class="list-group-item active">Crew : <span id="crew-name-insurace"></span></li>
                            <li class="list-group-item active">ID : <span id="crew-id-insurace"></span></li>
                            <li class="list-group-item active">Insurance Name : <span id="crew-insurance-name-insurance"></span></li>
                            <li class="list-group-item active">Account Number : <span id="crew-account-number-insurance"></span></li>
                            <li class="list-group-item active">Insurance Type : <span id="crew-insurane-type-name-insurance"></span></li>
                            <li class="list-group-item active">Name of Heritage : <span id="crew-name-of-heritage-insurance"></span></li>
                            <li class="list-group-item active">Remarks: <span id="crew-remarks-insurance"></span></li>
                            <li class="list-group-item active">Status : <span id="crew-status-insurance"></span></li>
                            <li class="list-group-item active">Created At : <span id="crew-created-at-insurance"></span></li>
                            <li class="list-group-item active">Updated At : <span id="crew-updated-at-insurance"></span></li>
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
{{-- show crew insurance --}}