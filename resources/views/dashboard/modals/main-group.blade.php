<div class="modal fade" id="add_main_group_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Main Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <form method="POST" action="main-group">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Item Code</label>
                        <div>
                            <input name="kode_barang" readonly type="text" class="form-control" value="{{ $item_code }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Code</label>
                        <div>
                            <input placeholder="Main Group Code" name="code_main_group" required max="9" min="1" type="number" class="form-control" value="{{ old('code_main_group') }}">
                        </div>
                        <div class=" mt-1">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">Max: 9 - Min: 1</small>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Name</label>
                        <div>
                            <input name="main_group_name" required type="text" class="form-control"placeholder="Main Group Name" value="{{ old('main_group_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Created User</label>
                        <div>
                            <input name="created_user" readonly type="text" class="form-control"placeholder="Main Group Name" value="{{ auth()->user()->id_crew }}">
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

{{-- show main group --}}
<div class="modal animated fade" id="show-main-group" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
    <div class="modal-dialog mw-100 w-100" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Main Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewCertificate">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Main Group</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Updated At</th>
                                <th>Updated By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span id="item-code-main-group"></span></td>
                                <td><span id="code-main-group"></span> - <span id="name-main-group"></span></td>
                                <td><span id="created-at-main-group"></span></td>
                                <td><span id="created-by-main-group"></span></td>
                                <td><span id="updated-at-main-group"></span></td>
                                <td><span id="updated-by-main-group"></span></td>
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

{{-- edit main group --}}
<div class="modal fade" id="edit_main_group_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Main Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                {{-- alert if any error exist --}}
                <form method="POST" action="main-group" id="update_main_group_form">
                    @csrf

                    <input type="hidden" name="code_main_group" id="id_main_group">
                    <div class="form-group mb-4">
                        <label for="colFormLabel">Item Code</label>
                        <div>
                            <input name="kode_barang" id="item_code_main_group_edit" readonly type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Code</label>
                        <div>
                            <input readonly placeholder="Main Group Code" name="code_main_group" id="code_main_group_edit" required max="9" min="1" type="number" class="form-control" value="{{ old('code_main_group') }}">
                        </div>
                        <div class=" mt-1">
                            <span class="badge badge-primary">
                                <small id="sh-text4" class="form-text mt-0">Max: 9 - Min: 1</small>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Name</label>
                        <div>
                            <input required name="main_group_name" id="name_main_group_edit" type="text" class="form-control"placeholder="Main Group Name" value="{{ old('main_group_name') }}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="colFormLabel">Updated User</label>
                        <div>
                            <input name="updated_user" id="updated_user_main_group" readonly type="text" class="form-control"placeholder="Main Group Name" value="{{ auth()->user()->id_crew }}">
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