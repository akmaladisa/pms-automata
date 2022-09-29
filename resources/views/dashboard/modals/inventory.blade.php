{{-- add --}}
<div class="modal fade" id="addInventoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-counter-list mb-2"></div>
                <form method="POST" id="addInventoryForm">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Ship</label>
                        <select class="form-control" name="ship_name" id="ship_inventory">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Item/Unit/Component/Part Description</label>
                        <select class="form-control" name="item_description" id="item_description_inventory">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Part Number</label>
                        <div>
                            <input name="part_no" type="text" class="form-control" id="part_no_inventory" placeholder="Part Number" value="{{ old('part_no') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Departement</label>
                        <select class="form-control" name="departement" id="departement_inventory">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Vendor</label>
                        <select class="form-control" name="vendor" id="vendor_inventory">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Stock</label>
                        <div class="row d-flex justify-content-between">
                            <div class="col-7">
                                <input name="stock" type="number" class="form-control" id="stock_inventory" placeholder="...." value="{{ old('stock') }}">
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="unit_stock" id="unit_stock_inventory">
                                    <option value="PCS">PCS</option>
                                    <option value="UNIT">UNIT</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Stock Minimum</label>
                        <div class="row d-flex justify-content-between">
                            <div class="col-7">
                                <input name="stock_minimum" type="number" class="form-control" id="stock_minimum_inventory" placeholder="...." value="{{ old('stock_minimum') }}">
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="unit_stock_minimum" id="unit_stock_minimum_inventory">
                                    <option value="PCS">PCS</option>
                                    <option value="UNIT">UNIT</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Location</label>
                        <div>
                            <input name="location" type="text" class="form-control" id="location_inventory" placeholder="Location" value="{{ old('location') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Date</label>
                        <div>
                            <input name="date" type="date" class="form-control" id="date_inventory" placeholder="Date" value="{{ old('date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Remarks</label>
                        <div>
                            <input name="remarks" type="remarks" class="form-control" id="remarks_inventory" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_inventory">
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

{{-- edit --}}
<div class="modal fade" id="editInventoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <div class="alert-group-list-counter-list mb-2"></div>
                <form method="POST" id="editInventoryForm">
                    @csrf

                    <input type="hidden" name="id" id="real_id_inventory">

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Ship</label>
                        <select class="form-control" name="ship_name" id="ship_inventory_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Item/Unit/Component/Part Description</label>
                        <select class="form-control" name="item_description" id="item_description_inventory_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Part Number</label>
                        <div>
                            <input name="part_no" type="text" class="form-control" id="part_no_inventory_edit" placeholder="Part Number" value="{{ old('part_no') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Departement</label>
                        <select class="form-control" name="departement" id="departement_inventory_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Vendor</label>
                        <select class="form-control" name="vendor" id="vendor_inventory_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Stock</label>
                        <div class="row d-flex justify-content-between">
                            <div class="col-7">
                                <input name="stock" type="number" class="form-control" id="stock_inventory_edit" placeholder="...." value="{{ old('stock') }}">
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="unit_stock" id="unit_stock_inventory_edit">
                                    <option value="PCS">PCS</option>
                                    <option value="UNIT">UNIT</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Stock Minimum</label>
                        <div class="row d-flex justify-content-between">
                            <div class="col-7">
                                <input name="stock_minimum" type="number" class="form-control" id="stock_minimum_inventory_edit" placeholder="...." value="{{ old('stock_minimum') }}">
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="unit_stock_minimum" id="unit_stock_minimum_inventory_edit">
                                    <option value="PCS">PCS</option>
                                    <option value="UNIT">UNIT</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Location</label>
                        <div>
                            <input name="location" type="text" class="form-control" id="location_inventory_edit" placeholder="Location" value="{{ old('location') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Date</label>
                        <div>
                            <input name="date" type="date" class="form-control" id="date_inventory_edit" placeholder="Date" value="{{ old('date') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Remarks</label>
                        <div>
                            <input name="remarks" type="remarks" class="form-control" id="remarks_inventory_edit" placeholder="Remarks" value="{{ old('remarks') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Status</label>
                        <select class="form-control col-sm-3" name="status" id="status_inventory_edit">
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

{{-- show --}}
<div class="modal animated fade" id="showInventoryModal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog mw-100 w-100" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewCertificate">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Ship</th>
                                <th>Item Description</th>
                                <th>Part No</th>
                                <th>Departement</th>
                                <th>Vendor</th>
                                <th>Stock</th>
                                <th>Stock Minimum</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-show-inventory">

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