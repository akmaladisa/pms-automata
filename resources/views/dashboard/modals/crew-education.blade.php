<div class="modal fade" id="addCrewEducationdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Crew Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-education mb-4"></div>
                <form method="POST" id="form-add-crew-education" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                        <select class="form-control col-sm-8" name="id_crew" id="id_crew_education">
                            
                        </select>
                    </div>
            
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Instance</label>
                        <div class="col-sm-10">
                            <input name="instance_nm" type="text" class="form-control" id="instance_crew_education" placeholder="Instance" value="{{ old('instance_nm') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label mr-3">Certificate</label>
                        <div class="col-sm-8">
                            <input type="file" class="custom-file-input" id="certificate_crew_education" name="scan_certificate">
                            <label class="custom-file-label" for="customFile">Choose Certificate</label>
                            <div class=" mt-2">
                                <span class="badge badge-primary">
                                    <small id="sh-text4" class="form-text mt-0">PDF,DOCX,DOC</small>
                                </span>
                                <small id="file-certificate-name"></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">More Information</label>
                        <div class="col-sm-10">
                            <input name="more_information" type="text" class="form-control" id="more_info_crew_education" placeholder="More Information" value="{{ old('more_information') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Year In</label>
                        <div class="col-sm-10">
                            <input name="year_in" type="number" class="form-control" id="year_in_crew_education" placeholder="Year In" value="{{ old('year_in') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Year Out</label>
                        <div class="col-sm-10">
                            <input name="year_out" type="number" class="form-control" id="year_out_crew_education" placeholder="Year Out" value="{{ old('year_out') }}">
                        </div>
                    </div>
            
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_crew_education">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>
            
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Created User</label>
                        <div class="col-sm-10">
                            <input name="created_user" type="text" readonly value="{{ auth()->user()->id_login }}" class="form-control" id="created_user_crew_education" placeholder="col-form-label">
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_store_crew_education" class="btn btn-primary">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>