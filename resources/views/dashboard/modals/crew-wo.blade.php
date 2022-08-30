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
                <form id="addShipForm" action="{{ route('crew-wo.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Crew</label>
                        <select id="id_crew_wo" class="form-control col-sm-8" name="id_crew" required>
                            
                        </select>
                    </div>
            
                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Company Name</label>
                        <div class="col-sm-10">
                            <input name="company_nm" type="text" required class="form-control" id="colFormLabel" placeholder="Company Name" value="{{ old('company_nm') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Last Position</label>
                        <div class="col-sm-10">
                            <input name="last_position" type="text" required class="form-control" id="colFormLabel" placeholder="Last Position" value="{{ old('last_position') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Year In</label>
                        <div class="col-sm-10">
                            <input name="year_in" type="number" required class="form-control" id="colFormLabel" placeholder="Year In" value="{{ old('year_in') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Year Out</label>
                        <div class="col-sm-10">
                            <input name="year_out" type="number" required class="form-control" id="colFormLabel" placeholder="Year Out" value="{{ old('year_out') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Job Status</label>
                        <div class="col-sm-10">
                            <input name="jobs_status" type="text" required class="form-control" id="colFormLabel" placeholder="Job Status" value="{{ old('jobs_status') }}">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">More Info</label>
                        <div class="col-sm-10">
                            <input name="more_info" type="text" required class="form-control" id="colFormLabel" placeholder="More Info" value="{{ old('more_info') }}">
                        </div>
                    </div>
            
                    <div class="input-group mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                        <select class="form-control col-sm-3" name="status" required>
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="colFormLabel" class="col-sm-2 col-form-label">Created User</label>
                        <div class="col-sm-10">
                            <input name="created_user" type="text" readonly value="{{ auth()->user()->id_login }}" class="form-control" id="colFormLabel" placeholder="col-form-label">
                        </div>
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