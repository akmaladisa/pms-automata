<div class="modal fade" id="add_component_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Component</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <form method="POST" id="add_component_form">
                    @csrf

                    <div class="error-list-component"></div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Code</label>
                        <div>
                            <input id="code_component_component" placeholder="Component Code" name="code_component" required max="999999999" min="100000000" type="number" class="form-control" value="{{ old('code_component') }}">
                        </div>
                        <div class=" mt-1">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">Max: 999999999 - Min: 100000000</small>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Main Group</label>
                        <select class="form-control" name="code_main_group" id="code_main_group_in_component">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Group</label>
                        <select class="form-control" name="code_group" id="code_group_in_component">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Sub Group</label>
                        <select class="form-control" name="code_sub_group" id="code_sub_group_in_component">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Unit</label>
                        <select class="form-control" name="code_unit" id="code_unit_in_component">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Name</label>
                        <div>
                            <input name="component_name" id="name_component" required type="text" class="form-control" placeholder="Component Name" value="{{ old('component_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Created User</label>
                        <div>
                            <input name="created_user" id="created_user_component" readonly type="text" class="form-control" value="{{ auth()->user()->id_crew }}">
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

{{-- show component --}}
<div class="modal animated fade" id="show-component-modal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Component</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewCertificate">
                <div class="row">
                    <div class="col-12">
                        <div id="alert-show-certificate"></div>
                        <ul class="list-group ">
                            <li class="list-group-item active">Component Code : <span id="code-component-in-component"></span></li>
                            <li class="list-group-item active">Component Name : <span id="name-component-in-component"></span></li>
                            <li class="list-group-item active">Unit Code : <span id="code-unit-in-component"></span></li>
                            <li class="list-group-item active">Unit Name : <span id="name-unit-in-component"></span></li>
                            <li class="list-group-item active">Sub Group Code : <span id="code-sub-group-in-component"></span></li>
                            <li class="list-group-item active">Sub Group Name : <span id="name-sub-group-in-component"></span></li>
                            <li class="list-group-item active">Group Code : <span id="code-group-in-component"></span></li>
                            <li class="list-group-item active">Group Name : <span id="name-group-in-component"></span></li>
                            <li class="list-group-item active">Main Group Code : <span id="code-main-group-in-component"></span></li>
                            <li class="list-group-item active">Main Group Name : <span id="main-group-in-component"></span></li>
                            <li class="list-group-item active">Created At : <span id="created-at-in-component"></span></li>
                            <li class="list-group-item active">Updated At : <span id="updated-at-in-component"></span></li>
                            <li class="list-group-item active">Created By : <span id="created-by-in-component"></span></li>
                            <li class="list-group-item active">Updated By : <span id="updated-by-in-component"></span></li>
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
{{-- show component --}}

{{-- edit component --}}
<div class="modal fade" id="edit_component_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Component</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <form method="POST" id="update_component_form">
                    @csrf

                    <div class="error-list-component-edit"></div>

                    <input type="hidden" name="code_component" id="id_component">

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Code</label>
                        <div>
                            <input readonly id="code_component_component_edit" placeholder="Component Code" name="code_component" required max="999999999" min="100000000" type="number" class="form-control" value="{{ old('code_component') }}">
                        </div>
                        <div class=" mt-1">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">Max: 999999999 - Min: 100000000</small>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Main Group</label>
                        <select class="form-control" name="code_main_group" id="code_main_group_in_component_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Group</label>
                        <select class="form-control" name="code_group" id="code_group_in_component_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Sub Group</label>
                        <select class="form-control" name="code_sub_group" id="code_sub_group_in_component_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Unit</label>
                        <select class="form-control" name="code_unit" id="code_unit_in_component_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Name</label>
                        <div>
                            <input name="component_name" id="name_component_edit" required type="text" class="form-control" placeholder="Component Name" value="{{ old('component_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Updated User</label>
                        <div>
                            <input name="updated_user" id="updated_user_component" readonly type="text" class="form-control" value="{{ auth()->user()->id_crew }}">
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