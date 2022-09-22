{{-- add counter --}}
<div class="modal fade" id="addCounterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Counter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-counter mb-2"></div>
                <form method="POST" id="addCounterForm">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Ship</label>
                        <select class="form-control" name="ship_name" id="ship_counter">
                            
                        </select>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Date</label>
                        <div>
                            <input name="date" type="date" class="form-control" id="date_counter" placeholder="Date" value="{{ old('date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Item/Unit/Component/Part Description</label>
                        <select class="form-control" name="item_description" id="item_description_counter">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Part Number</label>
                        <div>
                            <input name="part_no" type="text" class="form-control" id="part_no_counter" placeholder="Part Number" value="{{ old('part_no') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Start of Running Hours</label>
                        <div class="row d-flex justify-content-between">
                            <div class="col-7">
                                <input name="starting_of_running_hours" type="number" class="form-control" id="starting_of_running_hours_counter" placeholder="...." value="{{ old('starting_of_running_hours') }}">
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="unit_runing" id="unit_runing_counter">
                                    <option value="HOURS">HOURS</option>
                                    <option value="DAYS">DAYS</option>
                                    <option value="MONTHS">MONTHS</option>
                                    <option value="YEARS">YEARS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Remarks</label>
                        <div>
                            <input name="remarks" type="text" class="form-control" id="remarks_counter" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_counter">
                            <option value="ACT">ACT</option>
                            <option value="DE">DE</option>
                        </select>
                    </div>                
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_store_counter" class="btn btn-primary">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- add counter --}}

{{-- edit counter --}}
<div class="modal fade" id="editCounterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Counter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-counter-edit mb-2"></div>
                <form method="POST" id="editCounterForm">
                    @csrf

                    <input type="hidden" name="id" id="real_id_counter">

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Ship</label>
                        <select class="form-control" name="ship_name" id="ship_counter_edit">
                            
                        </select>
                    </div>
            
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Date</label>
                        <div>
                            <input name="date" type="date" class="form-control" id="date_counter_edit" placeholder="Date" value="{{ old('date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Item/Unit/Component/Part Description</label>
                        <select class="form-control" name="item_description" id="item_description_counter_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Part Number</label>
                        <div>
                            <input name="part_no" type="text" class="form-control" id="part_no_counter_edit" placeholder="Part Number" value="{{ old('part_no') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Start of Running Hours</label>
                        <div class="row d-flex justify-content-between">
                            <div class="col-7">
                                <input name="starting_of_running_hours" type="number" class="form-control" id="starting_of_running_hours_counter_edit" placeholder="...." value="{{ old('starting_of_running_hours') }}">
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="unit_runing" id="unit_runing_counter_edit">
                                    <option value="HOURS">HOURS</option>
                                    <option value="DAYS">DAYS</option>
                                    <option value="MONTHS">MONTHS</option>
                                    <option value="YEARS">YEARS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Remarks</label>
                        <div>
                            <input name="remarks" type="text" class="form-control" id="remarks_counter_edit" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_counter_edit">
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
{{-- edit counter --}}