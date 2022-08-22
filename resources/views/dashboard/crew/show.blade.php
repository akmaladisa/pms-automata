@extends('layout.main')

@section('css')
<link href="/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
@endsection

@section('container')
    <div class="row">
        <div class="col-10 pb-5">
            <div>
                <a href="{{ route('crew.index') }}" class="btn btn-secondary mb-3 btn-sm">
                    <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
                </a>
            </div>


            <div class="btn-group mt-3">
                <a href="{{ route('crew.edit', $crew->id_crew) }}" class="btn btn-warning mr-1 btn-sm">
                    <x-bi-pencil-square></x-bi-pencil-square>
                </a>
        
                <a href="/change-status-crew/{{ $crew->id_crew }}" class="btn btn-danger mr-1 btn-sm">
                    <x-bi-trash-fill></x-bi-trash-fill>
                </a>
            </div>
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
                            @if ( $crew->photo )
                                <img src="{{ asset("storage/" . $crew->photo) }}" width="200px" height="200px" class="rounded-circle" alt="">
                            @elseif ( !$crew->photo && $crew->gender == "FEMALE" )
                                <img src="/img/default-female.png" width="200px" height="200px" class="rounded-circle" alt="">
                            @else
                                <img src="/img/default-male.png" width="200px" height="200px" class="rounded-circle" alt="">
                            @endif
                        </div>
                        <div class="col-lg-9 col-sm-12">
                            <ul class="list-group ">
                                <li class="list-group-item active">
                                    Name : {{ $crew->full_name }}
                                </li>
                                <li class="list-group-item active">
                                    Place Of Birth : {{ $crew->pob }}
                                </li>
                                <li class="list-group-item active">
                                    Date Of Birth : {{ $crew->dob }}
                                </li>
                                <li class="list-group-item active">
                                    Gender : {{ $crew->gender }}
                                </li>
                                <li class="list-group-item active">
                                    ID : {{ $crew->id_crew }}
                                </li>
                                <li class="list-group-item active">
                                    Identity Type : {{ $crew->identity->name }}
                                </li>
                                <li class="list-group-item active">
                                    Identity Number : {{ $crew->identity_number }}
                                </li>
                                <li class="list-group-item active">
                                    Merital Status : {{ $crew->status_merital }}
                                </li>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="justify-profile" role="tabpanel" aria-labelledby="justify-profile-tab">
                    <div class="row">
                        <div class="col-lg-3 col-sm-12">
                            @if ( $crew->photo )
                                <img src="{{ asset("storage/" . $crew->photo) }}" width="200px" height="200px" class="rounded-circle" alt="">
                            @elseif ( !$crew->photo && $crew->gender == "FEMALE" )
                                <img src="/img/default-female.png" width="200px" height="200px" class="rounded-circle" alt="">
                            @else
                                <img src="/img/default-male.png" width="200px" height="200px" class="rounded-circle" alt="">
                            @endif
                        </div>
                        <div class="col-lg-9 col-sm-12">
                            <ul class="list-group ">
                                <li class="list-group-item active">
                                    Email : {{ $crew->email }}
                                </li>
                                <li class="list-group-item active">
                                    Phone : {{ $crew->phone }}
                                </li>
                                <li class="list-group-item active">
                                    WhatsApp Phone : {{ $crew->whatsapp_phone }}
                                </li>
                                <li class="list-group-item active">
                                    Address : {{ $crew->address }}
                                </li>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="justify-contact" role="tabpanel" aria-labelledby="justify-contact-tab">
                    <div class="row">
                        <div class="col-lg-3 col-sm-12">
                            @if ( $crew->photo )
                                <img src="{{ asset("storage/" . $crew->photo) }}" width="200px" height="200px" class="rounded-circle" alt="">
                            @elseif ( !$crew->photo && $crew->gender == "FEMALE" )
                                <img src="/img/default-female.png" width="200px" height="200px" class="rounded-circle" alt="">
                            @else
                                <img src="/img/default-male.png" width="200px" height="200px" class="rounded-circle" alt="">
                            @endif
                        </div>
                        <div class="col-lg-9 col-sm-12">
                            <ul class="list-group ">
                                <li class="list-group-item active">
                                    Job Title : {{ $crew->job_title }}
                                </li>
                                <li class="list-group-item active">
                                    Country : {{ $crew->crewCountry->country_nm }}
                                </li>
                                <li class="list-group-item active">
                                    Join Date : {{ $crew->join_date }}
                                </li>
                                <li class="list-group-item active">
                                    Join Port : {{ $crew->join_port }}
                                </li>
                                <li class="list-group-item active">
                                    Status : {{ $crew->status }}
                                </li>
                                <li class="list-group-item active">
                                    Note : {{ $crew->note }}
                                </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection