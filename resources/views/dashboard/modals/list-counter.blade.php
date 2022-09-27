{{-- select list counter --}}
<div class="modal animated fade" id="selectCounterModal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog mw-100 w-100" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Counter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewCertificate">
                <div class="table-responsive mt-3">
                    <table class="table mt-3 table-bordered table-hover table-striped mb-4">
                        <thead>
                            <tr>
                                <th>SELECT</th>
                                <th>Ship</th>
                                <th>Item Description</th>
                                <th>Part No</th>
                                <th>Starting Of Running Hours</th>
                            </tr>
                        </thead>
                        <tbody id="select-counter-for-list-counter">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeFormModal" data-dismiss="modal" lang="en">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- select list counter end --}}

{{-- add list counter modal --}}
<div class="modal fade" id="addListCounterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New List Counter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-counter-list mb-2"></div>
                <form method="POST" id="addListCounterForm">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Ship</label>
                        <select class="form-control" name="ship_name" id="ship_list_counter">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Item/Unit/Component/Part Description</label>
                        <select class="form-control" name="item_description" id="item_description_list_counter">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Part Number</label>
                        <div>
                            <input name="part_no" type="text" class="form-control" id="part_no_list_counter" placeholder="Part Number" value="{{ old('part_no') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Last Running Hours</label>
                        <div class="row d-flex justify-content-between">
                            <div class="col-7">
                                <input name="last_running_hours" type="number" class="form-control" id="last_running_hours_list_counter" placeholder="...." value="{{ old('last_running_hours') }}">
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="unit_running" id="unit_runing_list_counter">
                                    <option value="HOURS">HOURS</option>
                                    <option value="DAYS">DAYS</option>
                                    <option value="MONTHS">MONTHS</option>
                                    <option value="YEARS">YEARS</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Start Date</label>
                        <div>
                            <input name="start_date" type="datetime-local" class="form-control" id="start_date_list_counter" placeholder="Start Date" value="{{ old('start_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">End Date</label>
                        <div>
                            <input name="end_date" type="datetime-local" class="form-control" id="end_date_list_counter" placeholder="End Date" value="{{ old('end_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Running Hours Today</label>
                        <div>
                            <input name="running_hours_today" readonly type="text" class="form-control" id="running_hours_today_list_counter" placeholder="Running Hours Today" value="{{ old('running_hours_today') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_list_counter">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_store_list_counter" class="btn btn-primary">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- add list counter modal end --}}

{{-- edit list counter modal --}}
<div class="modal fade" id="editListCounterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit List Counter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-counter-list-edit mb-2"></div>
                <form method="POST" id="addListCounterForm">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Ship</label>
                        <select class="form-control" name="ship_name" id="ship_list_counter_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Item/Unit/Component/Part Description</label>
                        <select class="form-control" name="item_description" id="item_description_list_counter_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Part Number</label>
                        <div>
                            <input name="part_no" type="text" class="form-control" id="part_no_list_counter_edit" placeholder="Part Number" value="{{ old('part_no') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Last Running Hours</label>
                        <div class="row d-flex justify-content-between">
                            <div class="col-7">
                                <input name="last_running_hours" type="number" class="form-control" id="last_running_hours_list_counter_edit" placeholder="...." value="{{ old('last_running_hours') }}">
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="unit_runing" id="unit_runing_list_counter_edit">
                                    <option value="HOURS">HOURS</option>
                                    <option value="DAYS">DAYS</option>
                                    <option value="MONTHS">MONTHS</option>
                                    <option value="YEARS">YEARS</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Start Date</label>
                        <div>
                            <input name="start_date" type="datetime-local" class="form-control" id="start_date_list_counter_edit" placeholder="Start Date" value="{{ old('start_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">End Date</label>
                        <div>
                            <input name="end_date" type="datetime-local" class="form-control" id="end_date_list_counter_edit" placeholder="End Date" value="{{ old('end_date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Running Hours Today</label>
                        <div>
                            <input name="running_hours_today" readonly type="text" class="form-control" id="running_hours_today_list_counter_edit" placeholder="Running Hours Today" value="{{ old('running_hours_today') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_list_counter_edit">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Update</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- edit list counter modal end --}}