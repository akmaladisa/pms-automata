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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Main Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentShowCrewCertificate">
                <div class="row">
                    <div class="col-12">
                        <div id="alert-show-certificate"></div>
                        <ul class="list-group ">
                            <li class="list-group-item active">Item Code : <span id="item-code-main-group"></span></li>
                            <li class="list-group-item active">Main Group Code : <span id="code-main-group"></span></li>
                            <li class="list-group-item active">Main Group Name : <span id="name-main-group"></span></li>
                            <li class="list-group-item active">Created At : <span id="created-at-main-group"></span></li>
                            <li class="list-group-item active">Updated At : <span id="updated-at-main-group"></span></li>
                            <li class="list-group-item active">Created By : <span id="created-by-main-group"></span></li>
                            <li class="list-group-item active">Updated By : <span id="updated-by-main-group"></span></li>
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