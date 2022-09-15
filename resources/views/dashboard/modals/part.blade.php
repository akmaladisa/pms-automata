<div class="modal fade" id="add_part_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Part</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <form method="POST" id="add_part_form">
                    @csrf

                    <div class="error-list-part"></div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Code</label>
                        <div>
                            <input id="code_part_part" placeholder="Part Code" name="code_part" required max="999999999999" min="100000000000" type="number" class="form-control" value="{{ old('code_part') }}">
                        </div>
                        <div class=" mt-1">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">Max: 999999999999 - Min: 100000000000</small>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Main Group</label>
                        <select class="form-control" name="code_main_group" id="code_main_group_in_part">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Group</label>
                        <select class="form-control" name="code_group" id="code_group_in_part">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Sub Group</label>
                        <select class="form-control" name="code_sub_group" id="code_sub_group_in_part">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Unit</label>
                        <select class="form-control" name="code_unit" id="code_unit_in_part">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Component</label>
                        <select class="form-control" name="code_component" id="code_component_in_part">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Name</label>
                        <div>
                            <input name="part_name" id="name_part" required type="text" class="form-control" placeholder="Part Name" value="{{ old('part_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Created User</label>
                        <div>
                            <input name="created_user" id="created_user_part" readonly type="text" class="form-control" value="{{ auth()->user()->id_crew }}">
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

{{-- show part --}}
<div class="modal animated fade" id="show-part-modal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Part</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewCertificate">
                <div class="row">
                    <div class="col-12">
                        <div id="alert-show-certificate"></div>
                        <ul class="list-group ">
                            <li class="list-group-item active">Part Code : <span id="code-part-in-part"></span></li>
                            <li class="list-group-item active">Part Name : <span id="name-part-in-part"></span></li>
                            <li class="list-group-item active">Component Code : <span id="code-component-in-part"></span></li>
                            <li class="list-group-item active">Component Name : <span id="name-component-in-part"></span></li>
                            <li class="list-group-item active">Unit Code : <span id="code-unit-in-part"></span></li>
                            <li class="list-group-item active">Unit Name : <span id="name-unit-in-part"></span></li>
                            <li class="list-group-item active">Sub Group Code : <span id="code-sub-group-in-part"></span></li>
                            <li class="list-group-item active">Sub Group Name : <span id="name-sub-group-in-part"></span></li>
                            <li class="list-group-item active">Group Code : <span id="code-group-in-part"></span></li>
                            <li class="list-group-item active">Group Name : <span id="name-group-in-part"></span></li>
                            <li class="list-group-item active">Main Group Code : <span id="code-main-group-in-part"></span></li>
                            <li class="list-group-item active">Main Group Name : <span id="main-group-in-part"></span></li>
                            <li class="list-group-item active">Created At : <span id="created-at-in-part"></span></li>
                            <li class="list-group-item active">Updated At : <span id="updated-at-in-part"></span></li>
                            <li class="list-group-item active">Created By : <span id="created-by-in-part"></span></li>
                            <li class="list-group-item active">Updated By : <span id="updated-by-in-part"></span></li>
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
{{-- show part --}}

{{-- edit part --}}
<div class="modal fade" id="edit_part_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Part</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <form method="POST" id="update_part_form">
                    @csrf

                    <div class="error-list-part-edit"></div>

                    <input type="hidden" name="code_part" id="id_part">

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Code</label>
                        <div>
                            <input readonly id="code_part_part_edit" placeholder="Part Code" name="code_part" required max="999999999999" min="100000000000" type="number" class="form-control" value="{{ old('code_part') }}">
                        </div>
                        <div class=" mt-1">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">Max: 999999999999 - Min: 100000000000</small>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Main Group</label>
                        <select class="form-control" name="code_main_group" id="code_main_group_in_part_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Group</label>
                        <select class="form-control" name="code_group" id="code_group_in_part_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Sub Group</label>
                        <select class="form-control" name="code_sub_group" id="code_sub_group_in_part_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Unit</label>
                        <select class="form-control" name="code_unit" id="code_unit_in_part_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Component</label>
                        <select class="form-control" name="code_component" id="code_component_in_part_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Name</label>
                        <div>
                            <input name="part_name" id="name_part_edit" required type="text" class="form-control" placeholder="Part Name" value="{{ old('part_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Updated User</label>
                        <div>
                            <input name="updated_user" id="updated_user_part" readonly type="text" class="form-control" value="{{ auth()->user()->id_crew }}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-close" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="btn_update_part" class="btn btn-primary">Update</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
{{-- edit part--}}