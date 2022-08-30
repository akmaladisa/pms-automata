{{-- modal show crew medical record --}}
<div class="modal animated fade" id="show-crew-medical-record" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding:2rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crew Medical Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewMedicalRecord">
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group ">
                            <li class="list-group-item active">Name : <span id="crew-name-medical-record"></span></li>
                            <li class="list-group-item active">ID : <span id="crew-id-medical-record"></span></li>
                            <li class="list-group-item active">Height: <span id="crew-height-medical-record"></span></li>
                            <li class="list-group-item active">Weight : <span id="crew-weight-medical-record"></span></li>
                            <li class="list-group-item active">MCU Issued : <span id="crew-mcu-issued-medical-record"></span></li>
                            <li class="list-group-item active">MCU Expired : <span id="crew-mcu-expired-medical-record"></span></li>
                            <li class="list-group-item active">History Of Pain : <span id="crew-history-pain-medical-record"></span></li>
                            <li class="list-group-item active">Status : <span id="crew-status-medical-record"></span></li>
                            <li class="list-group-item active">Created At : <span id="crew-created-at-medical-record"></span></li>
                            <li class="list-group-item active">Updated At : <span id="crew-updated-at-medical-record"></span></li>
                            <li class="list-group-item active">Created By : <span id="crew-created-user-medical-record"></span></li>
                            <li class="list-group-item active">Updated By : <span id="crew-updated-user-medical-record"></span></li>
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
{{-- modal show crew medical record end --}}

{{-- modal add crew medical record --}}
<div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Medical Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- alert if any error exist --}}
                <div class="alert-group-list mb-4"></div>
                <form id="addCrewMedical" method="POST">
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                        <select class="form-control col-sm-8" name="id_crew" id="id_crew_medical">
                            @foreach ($crew as $c)
                                <option value="{{ $c->id_crew }}">{{ $c->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Height</label>
                        <div class="col-sm-10">
                            <input name="height" id="crew_height_medical" type="number" class="form-control" placeholder="Crew Height" value="{{ old('height') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-10">
                            <input name="weight" type="number" class="form-control" id="crew_weight_medical" placeholder="Crew Weight" value="{{ old('weight') }}">
                        </div>
                    </div>
            
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">MCU Issued</label>
                        <div class="col-sm-10">
                            <input name="mcu_issued" type="text" class="form-control" id="crew_mcu_issued_medical" placeholder="MCU Issued" value="{{ old('mcu_issued') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">MCU Expired</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" name="mcu_expired" placeholder="MCU Expired" class="form-control" id="crew_mcu_expired_medical" placeholder="col-form-label">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">History Of Pain</label>
                        <div class="col-sm-10">
                            <input name="history_of_pain" type="text" class="form-control" id="crew_history_medical" placeholder="History Of Pain" value="{{ old('history_of_pain') }}">
                        </div>
                    </div>
            
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                        <select id="crew_status_medical" class="form-control col-sm-3" name="status">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Created User</label>
                        <div class="col-sm-10">
                            <input name="created_user" type="text" readonly value="{{ auth()->user()->id_login }}" class="form-control" id="crew_created_medical" placeholder="col-form-label">
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_crew_medical_record_store" class="btn btn-primary">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- modal add crew medical record end --}}

{{-- modal edit crew medical record --}}
<div class="modal fade" id="medical_record_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Medical Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-edit-error mb-4"></div>
                <form id="addCrewMedical" method="POST">
                    <input type="hidden" name="id" id="id_medical_record_edit">

                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                        <select class="form-control col-sm-8" name="id_crew" id="id_crew_medical_edit">
                            @foreach ($crew as $c)
                                <option value="{{ $c->id_crew }}">{{ $c->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Height</label>
                        <div class="col-sm-10">
                            <input name="height" id="crew_height_medical_edit" type="number" class="form-control" placeholder="Crew Height" value="{{ old('height') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-10">
                            <input name="weight" type="number" class="form-control" id="crew_weight_medical_edit" placeholder="Crew Weight" value="{{ old('weight') }}">
                        </div>
                    </div>
            
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">MCU Issued</label>
                        <div class="col-sm-10">
                            <input name="mcu_issued" type="text" class="form-control" id="crew_mcu_issued_medical_edit" placeholder="MCU Issued" value="{{ old('mcu_issued') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">MCU Expired</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" name="mcu_expired" placeholder="MCU Expired" class="form-control" id="crew_mcu_expired_medical_edit" placeholder="col-form-label">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">History Of Pain</label>
                        <div class="col-sm-10">
                            <input name="history_of_pain" type="text" class="form-control" id="crew_history_medical_edit" placeholder="History Of Pain" value="{{ old('history_of_pain') }}">
                        </div>
                    </div>
            
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                        <select id="crew_status_medical_edit" class="form-control col-sm-3" name="status">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Updated User</label>
                        <div class="col-sm-10">
                            <input name="updated_user" type="text" readonly value="{{ auth()->user()->id_login }}" class="form-control" id="crew_updated_medical" placeholder="col-form-label">
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_crew_medical_record_update" class="btn btn-primary">Update</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- modal edit crew medical record end --}}