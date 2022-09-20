<div class="modal fade" id="add_unit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <form method="POST" id="add_unit_form">
                    @csrf

                    <div class="error-list-unit"></div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Code</label>
                        <div>
                            <input id="code_unit_unit" placeholder="Unit Code" name="code_unit" required max="999999" min="100000" type="number" class="form-control" value="{{ old('code_unit') }}">
                        </div>
                        <div class=" mt-1">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">Max: 999999 - Min: 100000</small>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Main Group</label>
                        <select class="form-control" name="code_main_group" id="code_main_group_in_unit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Group</label>
                        <select class="form-control" name="code_group" id="code_group_in_unit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Sub Group</label>
                        <select class="form-control" name="code_sub_group" id="code_sub_group_in_unit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Name</label>
                        <div>
                            <input name="unit_name" id="name_unit" required type="text" class="form-control"placeholder="Unit Name" value="{{ old('unit_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Created User</label>
                        <div>
                            <input name="created_user" id="created_user_unit" readonly type="text" class="form-control" value="{{ auth()->user()->id_crew }}">
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

{{-- show unit --}}
<div class="modal animated fade" id="show-unit-modal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog mw-100 w-100" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewCertificate">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Main Group</th>
                                <th>Group</th>
                                <th>Sub Group</th>
                                <th>Unit</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Updated At</th>
                                <th>Updated By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span id="code-main-group-in-unit"></span> - <span id="main-group-in-unit"></span></td>
                                <td><span id="code-group-in-unit"></span> - <span id="name-group-in-unit"></span></td>
                                <td><span id="code-sub-group-in-unit"></span> - <span id="name-sub-group-in-unit"></span></td>
                                <td><span id="code-unit-in-unit"></span> - <span id="name-unit-in-unit"></span></td>
                                <td><span id="created-at-in-unit"></span></td>
                                <td><span id="created-by-in-unit"></span></td>
                                <td><span id="updated-at-in-unit"></span></td>
                                <td><span id="updated-by-in-unit"></span></td>
                            </tr>
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
{{-- show unit --}}

{{-- edit unit --}}
<div class="modal fade" id="edit_unit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <form method="POST" id="update_unit_form">
                    @csrf

                    <div class="error-list-unit-edit"></div>

                    <input type="hidden" name="code_unit" id="id_unit">

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Code</label>
                        <div>
                            <input readonly id="code_unit_unit_edit" placeholder="Unit Code" name="code_unit" required max="999999" min="100000" type="number" class="form-control" value="{{ old('code_unit') }}">
                        </div>
                        <div class=" mt-1">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">Max: 999999 - Min: 100000</small>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Main Group</label>
                        <select class="form-control" name="code_main_group" id="code_main_group_in_unit_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Group</label>
                        <select class="form-control" name="code_group" id="code_group_in_unit_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Sub Group</label>
                        <select class="form-control" name="code_sub_group" id="code_sub_group_in_unit_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Name</label>
                        <div>
                            <input name="unit_name" id="name_unit_edit" required type="text" class="form-control" placeholder="Unit Name" value="{{ old('unit_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Updated User</label>
                        <div>
                            <input name="updated_user" id="updated_user_unit" readonly type="text" class="form-control" value="{{ auth()->user()->id_crew }}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_update_main_group" class="btn btn-primary">Update</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- edit unit--}}