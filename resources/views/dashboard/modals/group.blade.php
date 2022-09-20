<div class="modal fade" id="add_group_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <form method="POST" id="add_group_form">
                    @csrf

                    <div class="error-list-group"></div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Code</label>
                        <div>
                            <input id="code_group_group" placeholder="Group Code" name="code_group" required max="99" min="10" type="number" class="form-control" value="{{ old('code_group') }}">
                        </div>
                        <div class=" mt-1">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">Max: 99 - Min: 10</small>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Main Group</label>
                        <select class="form-control" name="code_main_group" id="code_main_group_in_group">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Name</label>
                        <div>
                            <input name="group_name" id="name_group_group" required type="text" class="form-control"placeholder="Group Name" value="{{ old('group_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Created User</label>
                        <div>
                            <input name="created_user" id="created_user_group" readonly type="text" class="form-control" value="{{ auth()->user()->id_crew }}">
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

{{-- show group --}}
<div class="modal animated fade" id="show-group-modal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog mw-100 w-100" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Group</h5>
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
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Updated At</th>
                                <th>Updated By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span id="code-main-group-in-group"></span> - <span id="main-group-in-group"></span></td>
                                <td><span id="code-group-in-group"></span> - <span id="name-group-in-group"></span></td>
                                <td><span id="created-at-in-group"></span></td>
                                <td><span id="created-by-in-group"></span></td>
                                <td><span id="updated-at-in-group"></span></td>
                                <td><span id="updated-by-in-group"></span></td>
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
{{-- show main group --}}

{{-- edit group --}}
<div class="modal fade" id="edit_group_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <form method="POST" id="update_group_form">
                    @csrf

                    <input type="hidden" name="code_group" id="id_group">

                    <div class="error-list-group-edit"></div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Code</label>
                        <div>
                            <input readonly placeholder="Group Code" name="code_group" id="code_group_group_edit" required max="99" min="10" type="number" class="form-control" value="{{ old('code_group') }}">
                        </div>
                        <div class=" mt-1">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">Max: 99 - Min: 10</small>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Main Group</label>
                        <select class="form-control" name="code_main_group" id="code_main_group_in_group_edit">
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Name</label>
                        <div>
                            <input required name="group_name" id="name_group_group_edit" type="text" class="form-control"placeholder="Main Name" value="{{ old('group_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Updated User</label>
                        <div>
                            <input name="updated_user" id="updated_user_group" readonly type="text" class="form-control"placeholder="Main Group Name" value="{{ auth()->user()->id_crew }}">
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
{{-- edit main group --}}