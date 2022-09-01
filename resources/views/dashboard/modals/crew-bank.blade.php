{{-- add crew bank --}}
<div class="modal fade" id="add-crew-bank-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Crew Bank Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-bank mb-4"></div>
                <form method="POST" id="form-add-crew-bank">
                    @csrf
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                        <select class="form-control col-sm-8" name="id_crew" id="id_crew_bank">
                            
                        </select>
                    </div>
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Bank</label>
                        <select class="form-control col-sm-8" name="bank_name" id="fetched_bank">
                            
                        </select>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Account Number</label>
                        <div class="col-sm-10">
                            <input name="account_number" type="number" class="form-control" id="crew_account_number_bank" placeholder="Account Number" value="{{ old('account_number') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Account Name</label>
                        <div class="col-sm-10">
                            <input name="account_name" type="text" class="form-control" id="crew_account_name_bank" placeholder="Account Name" value="{{ old('account_name') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Salary Amount</label>
                        <div class="col-sm-10">
                            <input name="salary_transfer" type="text" class="form-control" id="crew_salary_transfer_bank" placeholder="Salary Amount" value="{{ old('salary_transfer') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="txtRemarks" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                            <textarea lang="en" name="remarks" class="form-control form-control-sm" id="crew_remarks_bank" aria-describedby="txtRemarks" placeholder="Remarks" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_bank">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_store_crew_bank" class="btn btn-primary">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- add crew bank end --}}

{{-- edit crew bank --}}
<div class="modal fade" id="edit-crew-bank-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit New Crew Bank Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-bank-edit mb-4"></div>
                <form method="POST" id="form-edit-crew-bank">
                    @csrf
                    <div class="input-group mb-4">
                        <input type="hidden" name="name" id="id_crew_bank_real">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                        <select class="form-control col-sm-8" name="id_crew" id="id_crew_bank_edit">
                            
                        </select>
                    </div>
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Bank</label>
                        <select class="form-control col-sm-8" name="bank_name" id="fetched_bank_edit">
                            
                        </select>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Account Number</label>
                        <div class="col-sm-10">
                            <input name="account_number" type="number" class="form-control" id="crew_account_number_bank_edit" placeholder="Account Number" value="{{ old('account_number') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Account Name</label>
                        <div class="col-sm-10">
                            <input name="account_name" type="text" class="form-control" id="crew_account_name_bank_edit" placeholder="Account Name" value="{{ old('account_name') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Salary Amount</label>
                        <div class="col-sm-10">
                            <input name="salary_transfer" type="text" class="form-control" id="crew_salary_transfer_bank_edit" placeholder="Salary Amount" value="{{ old('salary_transfer') }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="txtRemarks" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                            <textarea lang="en" name="remarks" class="form-control form-control-sm" id="crew_remarks_bank_edit" aria-describedby="txtRemarks" placeholder="Remarks" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_bank_edit">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_update_crew_bank" class="btn btn-primary">Update</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- edit crew bank end --}}

{{-- modal show crew bank --}}
<div class="modal animated fade" id="show-crew-bank" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding:2rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crew Bank Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewMedicalRecord">
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group ">
                            <li class="list-group-item active">Crew : <span id="crew-name-bank"></span></li>
                            <li class="list-group-item active">ID : <span id="crew-id-bank"></span></li>
                            <li class="list-group-item active">Bank Name : <span id="crew-bank-name-bank"></span></li>
                            <li class="list-group-item active">Account Number : <span id="crew-account-number-bank"></span></li>
                            <li class="list-group-item active">Account Name: <span id="crew-account-name-bank"></span></li>
                            <li class="list-group-item active">Salary Transfer : <span id="crew-salary-transfer-bank"></span></li>
                            <li class="list-group-item active">Remarks: <span id="crew-remarks-bank"></span></li>
                            <li class="list-group-item active">Status : <span id="crew-status-bank"></span></li>
                            <li class="list-group-item active">Created At : <span id="crew-created-at-bank"></span></li>
                            <li class="list-group-item active">Updated At : <span id="crew-updated-at-bank"></span></li>
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
{{-- modal show crew bank --}}