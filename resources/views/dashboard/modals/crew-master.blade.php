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
                                <input type="text" lang="en" class="form-control form-control-sm" id="txtIdCrew" value="{{ $crewId }}" aria-describedby="txtIdCrew" placeholder="Crew ID" name="id_crew" readonly>
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
                            <div class="form-group">
                                <label for="txtDutyOnShip" lang="en">Duty On Ship</label>
                                <select lang="en" required name="duty_on_ship" class="form-control form-control-sm" id="txtDutyOnShip" aria-describedby="txtDutyOnShip" style="width:100%">
                                    @foreach ($ships as $ship)
                                        <option value="{{ $ship->id_ship }}">{{ $ship->ship_nm }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtAddress" lang="en">Address</label>
                                <textarea lang="en" name="address" required class="form-control form-control-sm" id="txtAddress" aria-describedby="txtAddress" placeholder="Address" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="txtJoinDate" lang="en">Join Date</label>
                                <input type="date" lang="en" class="form-control form-control-sm" id="txtJoinDate" aria-describedby="txtJoinDate" placeholder="Join Date" required name="join_date">
                            </div>
                            <div class="form-group">
                                <label for="txtNote" lang="en">Note</label>
                                <textarea lang="en" name="note" required class="form-control form-control-sm" id="txtNote" aria-describedby="txtNote" placeholder="Note" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="txtEmploymentStatus" lang="en">Employment Status</label>
                                <select lang="en" name="employment_status" required class="form-control form-control-sm" id="txtEmploymentStatus" aria-describedby="txtEmploymentStatus" style="width:100%">
                                    <option value="Contract">Contract</option>
                                    <option value="Permanent">Permanent</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtStatusMerital" lang="en">Status </label>
                                <select lang="en" name="status" required class="form-control form-control-sm" id="txtStatus" aria-describedby="txtStatus" style="width:100%">
                                    <option value="ACT" selected="selected">ACT</option>
                                    <option value="DE">DE</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtJoinPort" lang="en">Join Port</label>
                                <input type="date" lang="en" class="form-control form-control-sm" id="txtJoinPort" aria-describedby="txtJoinPort" required placeholder="Join Port" name="join_port">
                            </div>
                            <div class="form-group">
                                <label for="imgCrew" lang="en">Photo</label>
                                <img style="display: none" class="img-4" id="imgCrew" width="250" height="200" style="cursor:pointer" />
                                <div class="cImage">
                                    <input type="file" onchange="preview()" id="filePhoto" name="photo">
                                    <input id="txtCreatedUser" type="hidden" name="created_user" value="{{ auth()->user()->id_login }}">
                                </div>
                            </div>
                            @error('photo')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </fieldset>
                <br />
                <ul class="nav nav-tabs  mb-3 mt-3 nav-fill" id="justifyTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="justify-meidcal-tab" data-toggle="tab" href="#justify-medical-record" role="tab" aria-controls="justify-home" aria-selected="true">Medical Record</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="justify-education-tab" data-toggle="tab" href="#justify-education" role="tab" aria-controls="justify-profile" aria-selected="false">Education</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="justify-wo-tab" data-toggle="tab" href="#justify-work-experience" role="tab" aria-controls="justify-contact" aria-selected="false">Work Experience</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="justify-bank-tab" data-toggle="tab" href="#justify-bank-account" role="tab" aria-controls="justify-contact" aria-selected="false">Bank Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="justify-insurance-tab" data-toggle="tab" href="#justify-crew-insurance" role="tab" aria-controls="justify-contact" aria-selected="false">Insurance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="justify-certificate-tab" data-toggle="tab" href="#justify-crew-certificate" role="tab" aria-controls="justify-contact" aria-selected="false">Certificate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="justify-seaman-tab" data-toggle="tab" href="#justify-seaman-book" role="tab" aria-controls="justify-contact" aria-selected="false">Seaman Book</a>
                    </li>
                </ul>
                
                <div class="tab-content" id="justifyTabContent">
                    <div class="tab-pane fade show active" id="justify-medical-record" role="tabpanel" aria-labelledby="justify-home-tab">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h2 style="font-size: 18px"><x-bi-heart-pulse-fill class="fs-2 mb-1 text-white mr-2"></x-bi-heart-pulse-fill>Crew Medical Record</h2>
                                <button id="crew_medical_record_add_btn_modal" class="btn btn-dark mt-3">Add New</button>

                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover table-striped mb-4">
                                        <thead>
                                            <tr>
                                                <th>Crew ID</th>
                                                <th>Pain History</th>
                                                <th>MCU Expired</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="crew-medical-record">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-education" role="tabpanel" aria-labelledby="justify-profile-tab">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h2 style="font-size: 18px"><x-bi-mortarboard-fill class="fs-2 mb-1 text-white mr-2"></x-bi-mortarboard-fill>Crew Education</h2>

                                <button id="crew_education_add_btn_modal" class="btn btn-dark mt-3">Add New</button>

                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover table-striped mb-4">
                                        <thead>
                                            <tr>
                                                <th>Crew ID</th>
                                                <th>Instance</th>
                                                <th>Certificate</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="crew-education">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-work-experience" role="tabpanel" aria-labelledby="justify-contact-tab">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h2 style="font-size: 18px"><x-bi-briefcase-fill class="fs-2 mb-1 text-white mr-2"></x-bi-briefcase-fill>Crew Work Experience</h2>

                                <button id="crew_wo_add_btn_modal" class="btn btn-dark mt-3">Add New</button>

                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover table-striped mb-4">
                                        <thead>
                                            <tr>
                                                <th>Crew ID</th>
                                                <th>Company</th>
                                                <th>Last Position</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="crew-wo-tbody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-bank-account" role="tabpanel" aria-labelledby="justify-contact-tab">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h2 style="font-size: 18px"><x-bi-bank2 class="fs-2 mb-1 text-white mr-2"></x-bi-bank2>Crew Bank Account</h2>

                                <button id="crew_bank_add_btn_modal" class="btn btn-dark mt-3">Add New</button>

                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover table-striped mb-4">
                                        <thead>
                                            <tr>
                                                <th>Crew ID</th>
                                                <th>Bank Name</th>
                                                <th>Account Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="crew-bank-tbody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-crew-insurance" role="tabpanel" aria-labelledby="justify-contact-tab">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h2 style="font-size: 18px"><x-bi-file-medical-fill class="fs-2 mb-1 text-white mr-2"></x-bi-file-medical-fill>Crew Insurance</h2>

                                <button id="crew_insurance_add_btn_modal" class="btn btn-dark mt-3">Add New</button>

                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover table-striped mb-4">
                                        <thead>
                                            <tr>
                                                <th>Crew ID</th>
                                                <th>Insurance Name</th>
                                                <th>Account Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="crew-insurance-tbody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-crew-certificate" role="tabpanel" aria-labelledby="justify-contact-tab">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h2 style="font-size: 18px"><x-bi-clipboard2-data-fill class="fs-2 mb-1 text-white mr-2"></x-bi-clipboard2-data-fill>Crew Certificate</h2>

                                <button id="crew_certificate_add_btn_modal" class="btn btn-dark mt-3">Add New</button>

                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover table-striped mb-4">
                                        <thead>
                                            <tr>
                                                <th>Crew ID</th>
                                                <th>Certificate Name</th>
                                                <th>Certificate</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="crew-certificate-tbody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="justify-seaman-book" role="tabpanel" aria-labelledby="justify-contact-tab">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h2 style="font-size: 18px"><x-bi-journal-album class="fs-2 mb-1 text-white mr-2"></x-bi-journal-album>Seaman Book</h2>

                                <button id="seaman_book_add_btn_modal" class="btn btn-dark mt-3">Add New</button>

                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover table-striped mb-4">
                                        <thead>
                                            <tr>
                                                <th>Crew ID</th>
                                                <th>Book Number</th>
                                                <th>Book</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="seaman-book-tbody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <div class="alert-group-list-crew-master-edit"></div>
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
                                    <option value="MARRIED">MARRIED</option>
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
                            <div class="form-group">
                                <label for="txtDutyOnShip" lang="en">Duty On Ship</label>
                                <select lang="en" required name="duty_on_ship" class="form-control form-control-sm" id="txtDutyOnShipEdit" aria-describedby="txtDutyOnShip" style="width:100%">
                                    <option selected disabled>Ship</option>
                                    @foreach ($ships as $ship)
                                        <option value="{{ $ship->id_ship }}">{{ $ship->ship_nm }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="txtAddress" lang="en">Address</label>
                                <textarea lang="en" name="address" required class="form-control form-control-sm" id="txtAddressEdit" aria-describedby="txtAddress" placeholder="Address" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="txtJoinDate" lang="en">Join Date</label>
                                <input type="date" lang="en" class="form-control form-control-sm" id="txtJoinDateEdit" aria-describedby="txtJoinDate" required placeholder="Join Date" name="join_date">
                            </div>
                            <div class="form-group">
                                <label for="txtNote" lang="en">Note</label>
                                <textarea lang="en" name="note" required class="form-control form-control-sm" id="txtNoteEdit" aria-describedby="txtNote" placeholder="Note" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="txtEmploymentStatus" lang="en">Employment Status</label>
                                <select lang="en" name="employment_status" required class="form-control form-control-sm" id="txtEmploymentStatusEdit" aria-describedby="txtEmploymentStatus" style="width:100%">
                                    <option value="Contract">Contract</option>
                                    <option value="Permanent">Permanent</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtStatusMerital" lang="en">Status </label>
                                <select lang="en" name="status" required class="form-control form-control-sm" id="txtStatusEdit" aria-describedby="txtStatus" style="width:100%">
                                    <option value="ACT" selected="selected">ACT</option>
                                    <option value="DE">DE</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtJoinPort" lang="en">Join Port</label>
                                <input type="date" required lang="en" class="form-control form-control-sm" id="txtJoinPortEdit" aria-describedby="txtJoinPort" placeholder="Join Port" name="join_port">
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
                        <div class="col-12 pb-5">                    
                            <ul class="nav nav-tabs  mb-3 mt-3 nav-fill" id="justifyTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="justify-home-tab" data-toggle="tab" href="#justify-profile" role="tab" aria-controls="justify-home" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="justify-profile-tab" data-toggle="tab" href="#justify-contact" role="tab" aria-controls="justify-profile" aria-selected="false">Contact</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="justify-contact-tab" data-toggle="tab" href="#justify-info" role="tab" aria-controls="justify-contact" aria-selected="false">Employee Info</a>
                                </li>
                            </ul>
                        
                            <div class="tab-content" id="justifyTabContent">
                                <div class="tab-pane fade show active" id="justify-profile" role="tabpanel" aria-labelledby="justify-home-tab">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-12">
                                            <img width="300px" height="300px" class="rounded-circle crewImgShow" >
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
                                <div class="tab-pane fade" id="justify-contact" role="tabpanel" aria-labelledby="justify-profile-tab">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-12">
                                            <img width="300px" height="300px" class="rounded-circle crewImgShow" >
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
                                <div class="tab-pane fade" id="justify-info" role="tabpanel" aria-labelledby="justify-contact-tab">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-12">
                                            <img width="300px" height="300px" class="rounded-circle crewImgShow" >
                                        </div>
                                        <div class="col-lg-9 col-sm-12">
                                            <ul class="list-group ">
                                                <li class="list-group-item active">
                                                    Job Title : <span id="crewJobTitleShow"></span>
                                                </li>
                                                <li class="list-group-item active">
                                                    Employment Status : <span id="crewEmploymentStatus"></span>
                                                </li>
                                                <li class="list-group-item active">
                                                    Duty On Ship : <span id="dutyOnShip"></span>
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
            </div>
        </div>
    </div>
</div>
{{-- modal show crew end --}}