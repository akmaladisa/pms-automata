@extends('layout.main')

@section('css')
    <link href="/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
    <link href="/css/full-screen-modal.css" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')

    @include('sweetalert::alert')

    <h2>Crew List</h2>

    {{-- <a class="btn btn-dark mt-3" href="{{ route('crew.create') }}">Add New</a> --}}
    <button data-toggle="modal" data-target="#fullScreenModal" class="btn btn-dark mt-3">Add New</button>

    <div class="table-responsive mt-3" id="crewContent">
        <table class="table table-bordered table-hover table-striped mb-4">
            <thead>
                <tr>
                    <th>Crew ID</th>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>

    {{-- modal crew --}}
    <div class="modal animated modal-fullscreen fade" id="fullScreenModal" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="padding:2rem">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Add Crew</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <h2 style="font-size: 18px"><x-bi-person-fill class="fs-2 mb-1"></x-bi-person-fill> General Information</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <form id="crewAddForm" action="{{ route('crew.index') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Crew ID</label>
                                    <input type="text" lang="en" class="form-control form-control-sm" id="txtIdCrew" value="{{ $crewId }}" aria-describedby="txtIdCrew" placeholder="Crew ID" name="id_crew" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="txtFullName" lang="en">Full Name</label>
                                    <input type="text" lang="en" class="form-control form-control-sm" id="txtFullName" aria-describedby="txtFullName" required name="full_name" placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    <label for="txtEmail" lang="en">Email Active</label>
                                    <input type="email" lang="en" class="form-control form-control-sm" id="txtEmail" aria-describedby="txtEmail" required name="email" placeholder="Email Active">
                                </div>
                                <div class="form-group">
                                    <label for="txtIdentityType" lang="en">Identity Type</label>
                                    <select lang="en" required name="identity_type" class="form-control form-control-sm" id="txtIdentityType" aria-describedby="txtIdentityType" style="width:100%">
                                        <option selected disabled>Identity Type</option>
                                        @foreach ($identytiesType as $i)
                                            <option value="{{ $i->id }}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtWhatsapp" lang="en">Identity Number</label>
                                    <input type="number" lang="en" name="identity_number" required class="form-control form-control-sm" id="txtIdentityNumber" aria-describedby="txtIdentityNumber" placeholder="Identity Number">
                                </div>
                                <div class="form-group">
                                    <label for="txtJobTitle" lang="en">Job Title</label>
                                    <input type="text" lang="en" class="form-control form-control-sm" id="txtJobTitle" aria-describedby="txtJobTitle" required name="job_title" placeholder="Job Title">
                                </div>
                                <div class="form-group">
                                    <label for="txtCountry" lang="en">Country</label>
                                    <select lang="en" required name="country" class="form-control form-control-sm" id="txtCountry" aria-describedby="txtCountry" style="width:100%">
                                        <option selected disabled>Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id_country }}">{{ $country->country_nm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txtPhone" lang="en">Phone</label>
                                    <input type="text" lang="en" name="phone" required class="form-control form-control-sm" id="txtPhone" aria-describedby="txtPhone" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <label for="txtWhatsapp" lang="en">Whatsapp</label>
                                    <input type="text" lang="en" name="whatsapp_phone" required class="form-control form-control-sm" id="txtWhatsapp" aria-describedby="txtWhatsapp" placeholder="Whatsapp">
                                </div>
                                <div class="form-group">
                                    <label for="txtGender" lang="en">Gender</label>
                                    <select lang="en" required name="gender" class="form-control form-control-sm" id="txtGender" aria-describedby="txtGender" style="width:100%">
                                        <option value="MALE" selected="selected">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtStatusMerital" lang="en">Status Merital</label>
                                    <select lang="en" name="status_merital" required class="form-control form-control-sm" id="txtStatusMerital" aria-describedby="txtStatusMerital" style="width:100%">
                                        <option value="MARRIED" selected="selected">MARRIED</option>
                                        <option value="SINGLE">SINGLE</option>
                                        <option value="WIDOW">WIDOW</option>
                                        <option value="WIDOWER">WIDOWER</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtPob" lang="en">Place Of Birth</label>
                                    <input type="text" required name="pob" lang="en" class="form-control form-control-sm" id="txtPob" aria-describedby="txtPob" placeholder="Place Of Birth">
                                </div>
                                <div class="form-group">
                                    <label for="txtDob" lang="en">Date Of Birth</label>
                                    <input type="date" required name="dob" lang="en" class="form-control form-control-sm" id="txtDob" aria-describedby="txtDob" placeholder="Date Of Birth">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txtAddress" lang="en">Address</label>
                                    <textarea lang="en" name="address" required class="form-control form-control-sm" id="txtAddress" aria-describedby="txtAddress" placeholder="Address" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="txtJoinDate" lang="en">Join Date</label>
                                    <input type="datetime-local" lang="en" class="form-control form-control-sm" id="txtJoinDate" aria-describedby="txtJoinDate" placeholder="Join Date" required name="join_date">
                                </div>
                                <div class="form-group">
                                    <label for="txtNote" lang="en">Note</label>
                                    <textarea lang="en" name="note" required class="form-control form-control-sm" id="txtNote" aria-describedby="txtNote" placeholder="Note" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="txtStatusMerital" lang="en">Status </label>
                                    <select lang="en" name="status" required required class="form-control form-control-sm" id="txtStatus" aria-describedby="txtStatus" style="width:100%">
                                        <option value="ACT" selected="selected">ACT</option>
                                        <option value="DE">DE</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtJoinPort" lang="en">Join Port</label>
                                    <input type="datetime-local" lang="en" class="form-control form-control-sm" id="txtJoinPort" aria-describedby="txtJoinPort" placeholder="Join Port" required name="join_port">
                                </div>
                                <div class="form-group">
                                    <label for="imgCrew" lang="en">Photo</label>
                                    <img style="display: none" class="img-4" id="imgCrew" width="250" height="200" style="cursor:pointer" />
                                    <div class="cImage">
                                        <input type="file" onchange="preview()" id="filePhoto" name="photo">
                                        <input id="txtCreatedUser" type="hidden" name="created_user" value="{{ auth()->user()->id_login }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <br />
                    <fieldset>
                        <legend style="color:#000;font-size:18px"><i class="fa fa-user"></i>&nbsp;Education</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="button" class="btn btn-primary" id="btnShowFormMasterEducation"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table id="tblMasterEducation" class="table table-bordered table-sm table-striped table-hover text-nowrap">
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <br />
                    <fieldset>
                        <legend style="color: #000; font-size: 18px"><i class="fa fa-user"></i>&nbsp;Work Experient</legend>
                        <div class="col-md-12">
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="button" class="btn btn-primary" id="btnShowFormMasterWorkExperience"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tblMasterWorkExperience" class="table table-bordered table-sm table-striped table-hover text-nowrap">
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <br />
                    <fieldset>
                        <legend style="color: #000; font-size: 18px"><i class="fa fa-user"></i>&nbsp;Medical Record</legend>
                        <div class="col-md-12">
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="button" class="btn btn-primary" id="btnShowFormMasterMedicalRecord"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tblMasterMedicalRecord" class="table table-bordered table-sm table-striped table-hover text-nowrap">
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeFormModal" data-dismiss="modal" lang="en">Close</button>
                    <button class="btn btn-primary" id="btnCreate" type="submit" lang="en">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal crew end --}}

    {{-- modal edit crew --}}
    <div class="modal animated modal-fullscreen fade" id="modalEditCrew" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="padding:2rem">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Crew</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contentEditCrew">
                    <fieldset>
                        <h2 style="font-size: 18px"><x-bi-person-fill class="fs-2 mb-1"></x-bi-person-fill> General Information</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <form id="crewUpdateForm" enctype="multipart/form-data" method="POST">
                                
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Crew ID</label>
                                    <input type="text" lang="en" class="form-control form-control-sm" id="txtIdCrewEdit" aria-describedby="txtIdCrew" placeholder="Crew ID" name="id_crew" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="txtFullName" lang="en">Full Name</label>
                                    <input type="text" lang="en" class="form-control form-control-sm" id="txtFullNameEdit" aria-describedby="txtFullName" required name="full_name" placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    <label for="txtEmail" lang="en">Email Active</label>
                                    <input type="email" lang="en" class="form-control form-control-sm" id="txtEmailEdit" aria-describedby="txtEmail" required name="email" placeholder="Email Active">
                                </div>
                                <div class="form-group">
                                    <label for="txtIdentityType" lang="en">Identity Type</label>
                                    <select lang="en" required name="identity_type" class="form-control form-control-sm" id="txtIdentityTypeEdit" aria-describedby="txtIdentityType" style="width:100%">
                                        <option selected disabled>Identity Type</option>
                                        @foreach ($identytiesType as $i)
                                            <option value="{{ $i->id }}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtWhatsapp" lang="en">Identity Number</label>
                                    <input type="number" lang="en" name="identity_number" required class="form-control form-control-sm" id="txtIdentityNumberEdit" aria-describedby="txtIdentityNumber" placeholder="Identity Number">
                                </div>
                                <div class="form-group">
                                    <label for="txtJobTitle" lang="en">Job Title</label>
                                    <input type="text" lang="en" class="form-control form-control-sm" id="txtJobTitleEdit" aria-describedby="txtJobTitle" required name="job_title" placeholder="Job Title">
                                </div>
                                <div class="form-group">
                                    <label for="txtCountry" lang="en">Country</label>
                                    <select lang="en" required name="country" class="form-control form-control-sm" id="txtCountryEdit" aria-describedby="txtCountry" style="width:100%">
                                        <option selected disabled>Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id_country }}">{{ $country->country_nm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txtPhone" lang="en">Phone</label>
                                    <input type="text" lang="en" name="phone" required class="form-control form-control-sm" id="txtPhoneEdit" aria-describedby="txtPhone" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <label for="txtWhatsapp" lang="en">Whatsapp</label>
                                    <input type="text" lang="en" name="whatsapp_phone" required class="form-control form-control-sm" id="txtWhatsappEdit" aria-describedby="txtWhatsapp" placeholder="Whatsapp">
                                </div>
                                <div class="form-group">
                                    <label for="txtGender" lang="en">Gender</label>
                                    <select lang="en" required name="gender" class="form-control form-control-sm" id="txtGenderEdit" aria-describedby="txtGender" style="width:100%">
                                        <option value="MALE" selected="selected">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtStatusMerital" lang="en">Status Merital</label>
                                    <select lang="en" name="status_merital" required class="form-control form-control-sm" id="txtStatusMeritalEdit" aria-describedby="txtStatusMerital" style="width:100%">
                                        <option value="MARRIED" selected="selected">MARRIED</option>
                                        <option value="SINGLE">SINGLE</option>
                                        <option value="WIDOW">WIDOW</option>
                                        <option value="WIDOWER">WIDOWER</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtPob" lang="en">Place Of Birth</label>
                                    <input type="text" required name="pob" lang="en" class="form-control form-control-sm" id="txtPobEdit" aria-describedby="txtPob" placeholder="Place Of Birth">
                                </div>
                                <div class="form-group">
                                    <label for="txtDob" lang="en">Date Of Birth</label>
                                    <input type="date" required name="dob" lang="en" class="form-control form-control-sm" id="txtDobEdit" aria-describedby="txtDob" placeholder="Date Of Birth">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txtAddress" lang="en">Address</label>
                                    <textarea lang="en" name="address" required class="form-control form-control-sm" id="txtAddressEdit" aria-describedby="txtAddress" placeholder="Address" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="txtJoinDate" lang="en">Join Date</label>
                                    <input type="datetime-local" lang="en" class="form-control form-control-sm" id="txtJoinDateEdit" aria-describedby="txtJoinDate" placeholder="Join Date" required name="join_date">
                                </div>
                                <div class="form-group">
                                    <label for="txtNote" lang="en">Note</label>
                                    <textarea lang="en" name="note" required class="form-control form-control-sm" id="txtNoteEdit" aria-describedby="txtNote" placeholder="Note" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="txtStatusMerital" lang="en">Status </label>
                                    <select lang="en" name="status" required required class="form-control form-control-sm" id="txtStatusEdit" aria-describedby="txtStatus" style="width:100%">
                                        <option value="ACT" selected="selected">ACT</option>
                                        <option value="DE">DE</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtJoinPort" lang="en">Join Port</label>
                                    <input type="datetime-local" lang="en" class="form-control form-control-sm" id="txtJoinPortEdit" aria-describedby="txtJoinPort" placeholder="Join Port" required name="join_port">
                                </div>
                                <div class="form-group">
                                    <label for="imgCrew" lang="en">Photo</label>
                                    <img style="display: none" class="img-4" id="imgCrewEdit" width="250" height="200" style="cursor:pointer" />
                                    <div class="cImage">
                                        <input type="file" onchange="previewEdit()" id="filePhotoEdit" name="photo">
                                        <input id="txtUpdatedUser" type="hidden" name="updated_user" value="{{ auth()->user()->id_login }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeFormModal" data-dismiss="modal" lang="en">Close</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit crew end --}}

    {{-- modal show crew --}}
    <div class="modal animated modal-fullscreen fade" id="modalShowCrew" tabindex="-1" role="dialog" aria-labelledby="frmMaster" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="padding:2rem">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Show Crew</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contentShowCrew">
                    <fieldset>
                        <h2 style="font-size: 18px"><x-bi-person-fill class="fs-2 mb-1"></x-bi-person-fill> General Information</h2>
                        <div class="row">
                            <div class="col-10 pb-5">                    
                                <ul class="nav nav-tabs  mb-3 mt-3 nav-fill" id="justifyTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="justify-home-tab" data-toggle="tab" href="#justify-home" role="tab" aria-controls="justify-home" aria-selected="true">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="justify-profile-tab" data-toggle="tab" href="#justify-profile" role="tab" aria-controls="justify-profile" aria-selected="false">Contact</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="justify-contact-tab" data-toggle="tab" href="#justify-contact" role="tab" aria-controls="justify-contact" aria-selected="false">Employee Info</a>
                                    </li>
                                </ul>
                            
                                <div class="tab-content" id="justifyTabContent">
                                    <div class="tab-pane fade show active" id="justify-home" role="tabpanel" aria-labelledby="justify-home-tab">
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-12">
                                                {{-- @if ( $crew->photo )
                                                    <img src="{{ asset("storage/" . $crew->photo) }}" width="200px" height="200px" class="rounded-circle" alt="">
                                                @elseif ( !$crew->photo && $crew->gender == "FEMALE" )
                                                    <img src="/img/default-female.png" width="200px" height="200px" class="rounded-circle" alt="">
                                                @else
                                                    <img src="/img/default-male.png" width="200px" height="200px" class="rounded-circle" alt="">
                                                @endif --}}
                                                <img width="200px" height="200px" class="rounded-circle crewImgShow" >
                                            </div>
                                            <div class="col-lg-9 col-sm-12">
                                                <ul class="list-group ">
                                                    <li class="list-group-item active">
                                                        Name : <span id="crewNameShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Place Of Birth : <span id="crewPobShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Date Of Birth : <span id="crewDobShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Gender : <span id="crewGenderShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        ID : <span id="crewIdShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Identity Type : <span id="crewIdentityTypeShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Identity Number : <span id="crewIdentityNumberShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Merital Status : <span id="crewMeritalStatusShow"></span>
                                                    </li>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="justify-profile" role="tabpanel" aria-labelledby="justify-profile-tab">
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-12">
                                                {{-- @if ( $crew->photo )
                                                    <img src="{{ asset("storage/" . $crew->photo) }}" width="200px" height="200px" class="rounded-circle" alt="">
                                                @elseif ( !$crew->photo && $crew->gender == "FEMALE" )
                                                    <img src="/img/default-female.png" width="200px" height="200px" class="rounded-circle" alt="">
                                                @else
                                                    <img src="/img/default-male.png" width="200px" height="200px" class="rounded-circle" alt="">
                                                @endif --}}
                                                <img width="200px" height="200px" class="rounded-circle crewImgShow" >
                                            </div>
                                            <div class="col-lg-9 col-sm-12">
                                                <ul class="list-group ">
                                                    <li class="list-group-item active">
                                                        Email : <span id="crewEmailShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Phone : <span id="crewPhoneShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        WhatsApp Phone : <span id="crewWhatsappShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Address : <span id="crewAddressShow"></span>
                                                    </li>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="justify-contact" role="tabpanel" aria-labelledby="justify-contact-tab">
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-12">
                                                {{-- @if ( $crew->photo )
                                                    <img src="{{ asset("storage/" . $crew->photo) }}" width="200px" height="200px" class="rounded-circle" alt="">
                                                @elseif ( !$crew->photo && $crew->gender == "FEMALE" )
                                                    <img src="/img/default-female.png" width="200px" height="200px" class="rounded-circle" alt="">
                                                @else
                                                    <img src="/img/default-male.png" width="200px" height="200px" class="rounded-circle" alt="">
                                                @endif --}}
                                                <img width="200px" height="200px" class="rounded-circle crewImgShow" >
                                            </div>
                                            <div class="col-lg-9 col-sm-12">
                                                <ul class="list-group ">
                                                    <li class="list-group-item active">
                                                        Job Title : <span id="crewJobTitleShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Country : <span id="crewCountryShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Join Date : <span id="crewJoinDateShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Join Port : <span id="crewJoinPortShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Status : <span id="crewStatusShow"></span>
                                                    </li>
                                                    <li class="list-group-item active">
                                                        Note : <span id="crewNoteShow"></span>
                                                    </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeFormModal" data-dismiss="modal" lang="en">Close</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal show crew end --}}


@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            fetchCrew()

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            // reset input image, when edit modal is closed
            $("#modalEditCrew").on("hidden.bs.modal", function () {
                $("#filePhotoEdit").val("")
            });

            // show crew
            $(document).on('click', '.btn-show-crew', function (e) {
                e.preventDefault()

                $('#modalShowCrew').modal("show")

                let crew_id = $(this).val()

                $.ajax({
                    type: "get",
                    url: `crew/${crew_id}`,
                    dataType: "json",
                    contentType:'application/json',
                    success: function (response) {
                        if(response.status == 200) {
                            $('#crewNameShow').text(response.crew.full_name);
                            $('#crewDobShow').text(response.crew.dob);
                            $('#crewPobShow').text(response.crew.pob);
                            $('#crewPhoneShow').text(response.crew.phone);
                            $('#crewWhatsappShow').text(response.crew.whatsapp_phone);
                            $('#crewGenderShow').text(response.crew.gender);
                            $('#crewIdShow').text(response.crew.id_crew);
                            $('#crewIdentityNumberShow').text(response.crew.identity_number);
                            $('#crewMeritalStatusShow').text(response.crew.status_merital);
                            $('#crewAddressShow').text(response.crew.address);
                            $('#crewEmailShow').text(response.crew.email);
                            $('#crewJobTitleShow').text(response.crew.job_title);
                            $('#crewJoinDateShow').text(response.crew.join_date);
                            $('#crewJoinPortShow').text(response.crew.join_port);
                            $('#crewStatusShow').text(response.crew.status);
                            $('#crewNoteShow').text(response.crew.note);
                            
                            if( response.crew.photo ) {
                                $(".crewImgShow").attr("src", `/storage/${response.crew.photo}`)
                            } else if( response.crew.gender == 'MALE' && !response.crew.photo ) {
                                $(".crewImgShow").attr("src", '/img/default-male.png')
                            } else if( response.crew.gender == 'FEMALE' && !response.crew.photo ) {
                                $(".crewImgShow").attr("src", '/img/default-female.png')
                            }
                            
                        $("#crewCountryShow").text(response.crew.crewCountry.country_nm);
                            $('#crewIdentityTypeShow').text(response.crew.identity.name);

                        }
                        else{
                            Swal.fire(
                                'Not Found',
                                `${response.message}`,
                                'error'
                            )
                            fetchCrew()
                        }
                    }
                });
            });
    

            // edit crew
            $(document).on('click', '.btn-edit-crew', function (e) {
                e.preventDefault();

                let crew_id = $(this).val()
                // alert(crew_id)

                $("#modalEditCrew").modal("show")

                $.ajax({
                    type: "get",
                    url: `crew/${crew_id}`,
                    success: function (response) {
                        if( response.status == 404 )
                        {
                            Swal.fire(
                                'Not Found',
                                `${response.message}`,
                                'error'
                            )
                            $("#modalEditCrew").modal("hide")
                        }
                        else
                        {
                            $('#txtIdCrewEdit').val(crew_id)
                            $("#txtFullNameEdit").val(response.crew.full_name)
                            $("#txtEmailEdit").val(response.crew.email)
                            $("#txtIdentityTypeEdit").val(response.crew.identity_type)
                            $("#txtIdentityNumberEdit").val(response.crew.identity_number)
                            $("#txtJobTitleEdit").val(response.crew.job_title)
                            $("#txtCountryEdit").val(response.crew.country)
                            $("#txtPhoneEdit").val(response.crew.phone)
                            $("#txtWhatsappEdit").val(response.crew.whatsapp_phone)
                            $("#txtGenderEdit").val(response.crew.gender)
                            $("#txtStatusMeritalEdit").val(response.crew.status_merital)
                            $("#txtPobEdit").val(response.crew.pob)
                            $("#txtDobEdit").val(response.crew.dob)
                            $("#txtAddressEdit").val(response.crew.address)
                            $("#txtJoinDateEdit").val(response.crew.join_date)
                            $("#txtNoteEdit").val(response.crew.note)
                            $('#txtStatusEdit').val(response.crew.status)
                            $("#txtJoinPortEdit").val(response.crew.join_port)

                            if( response.crew.photo ) {
                                $("#imgCrewEdit").css('display', 'block');
                                $("#imgCrewEdit").attr("src", `/storage/${response.crew.photo}`)
                            } else {
                                $("#imgCrewEdit").css('display', 'none');
                            }
                        }
                    }
                });
            });

            // delete crew
            $(document).on('click', '.btn-delete-crew', function (e) {
                e.preventDefault()

                let crew_id = $(this).val()

                Swal.fire({
                    title: 'Are you sure?',
                    text: "The Crew Status Will Change To 'DE'",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url:`/change-status-crew/${crew_id}`,
                        success: function (response) {
                            if( response.status == 404 ) {
                                Swal.fire(
                                    'Not Found',
                                    `${response.message}`,
                                    'error'
                                )
                                fetchCrew()
                            } else if( response.status == 400 ) {
                                Swal.fire(
                                    'Error!',
                                    'Error To Delete Crew',
                                    'error'
                                )
                                fetchCrew()
                            } else if( response.status == 200 ) {
                                Swal.fire(
                                    'Success!',
                                    `${response.message}`,
                                    'success'
                                )
                                fetchCrew()
                            }
                        }
                    });
                }
                })
            });

            // update crew
            $(document).on('submit', '#crewUpdateForm', function (e) {
                e.preventDefault()

                let id = $('#txtIdCrewEdit').val();
                let editFormData = new FormData( $('#crewUpdateForm')[0] );

                $.ajax({
                    type: "post",
                    url: `update-crew/${id}`,
                    data: editFormData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if( response.status == 400 ) {
                            $("#modalEditCrew").modal("hide");
                            Swal.fire(
                                'Fail!',
                                `Failed To Update Crew`,
                                'error'
                            )
                            fetchCrew()
                        }
                        else if( response.status == 404 ) {
                            $("#modalEditCrew").modal("hide");
                            Swal.fire(
                                'Not Found',
                                `${response.message}`,
                                'error'
                            )
                            fetchCrew()
                        }
                        else if( response.status == 200 ) {
                            $("#modalEditCrew").modal("hide");
                            Swal.fire(
                                'Success!',
                                `${response.message}`,
                                'success'
                            )
                            fetchCrew()
                        }
                    }
                });

            });

        })


        function preview() {
            document.getElementById('imgCrew').src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('imgCrew').style.display = 'block'
        }

        function previewEdit() {
            document.getElementById('imgCrewEdit').src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('imgCrewEdit').style.display = 'block'
        }

        function fetchCrew() {
            $.ajax({
                type: "get",
                url: "/read-crew",
                dataType: "json",
                success: function (response) {
                    $('tbody').html('');
                    $.each(response.crews, function (key, crew) { 
                        $('tbody').append(`
                        <tr>
                            <td>${crew.id_crew}</td>
                            <td>${crew.full_name}</td>
                            <td>${crew.job_title}</td>
                            <td>${crew.status}</td>
                            <td>
                                <button type="button" value="${crew.id_crew}" class="btn btn-show-crew btn-info btn-sm">
                                    <x-bi-eye-fill></x-bi-eye-fill>
                                </button>
            
                                <button type="button" value="${crew.id_crew}" class="btn btn-edit-crew btn-warning btn-sm">
                                    <x-bi-pencil-square></x-bi-pencil-square>
                                </button>
            
                                <button type="button" value="${crew.id_crew}" class="btn btn-delete-crew btn-danger btn-sm">
                                    <x-bi-trash-fill></x-bi-trash-fill>
                                </button>
                            </td>
                        </tr>
                        `)
                    });
                }
            });
        }

    </script>
@endsection