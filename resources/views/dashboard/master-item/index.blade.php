@extends('layout.main')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
    <link href="/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
@endsection

@section('container')

    @include('sweetalert::alert')

    <div class="row">
        <div class="col-12">
            <h3>Master Item</h3>

            <ul class="nav nav-tabs  mb-3 mt-3 nav-fill" id="justifyTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="justify-main-group-tab" data-toggle="tab" href="#justify-main-group" role="tab" aria-controls="justify-home" aria-selected="true">Main Group</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="justify-group-tab" data-toggle="tab" href="#justify-group" role="tab" aria-controls="justify-profile" aria-selected="false">Group</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="justify-sub-group-tab" data-toggle="tab" href="#justify-sub-group" role="tab" aria-controls="justify-sub-group" aria-selected="false">Sub Group</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="justify-unit-tab" data-toggle="tab" href="#justify-unit" role="tab" aria-controls="justify-unit" aria-selected="false">Unit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="justify-component-tab" data-toggle="tab" href="#justify-component" role="tab" aria-controls="justify-component" aria-selected="false">Component</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="justify-part-tab" data-toggle="tab" href="#justify-part" role="tab" aria-controls="justify-part" aria-selected="false">Part</a>
                </li>
            </ul>
            
            <div class="tab-content" id="justifyTabContent">
                <div class="tab-pane fade show active" id="justify-main-group" role="tabpanel" aria-labelledby="justify-main-group-tab">
                    <h5>Main Group</h5>
                    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#add_main_group_modal">Add New</button>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover table-striped mb-4">
                            <thead>
                                <tr>
                                    <th>Item Code</th>
                                    <th>Main Group Code</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="main-group-item">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="justify-group" role="tabpanel" aria-labelledby="justify-group-tab">
                    <h5>Group</h5>

                    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#add_group_modal">Add New</button>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover table-striped mb-4">
                            <thead>
                                <tr>
                                    <th>Group Code</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="group-item">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="justify-sub-group" role="tabpanel" aria-labelledby="justify-sub-group-tab">
                    <h5>Sub Group</h5>

                    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#add_sub_group_modal">Add New</button>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover table-striped mb-4">
                            <thead>
                                <tr>
                                    <th>Sub Group Code</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="sub-group-item">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="justify-unit" role="tabpanel" aria-labelledby="justify-unit-tab">
                    <h5>Unit</h5>

                    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#add_unit_modal">Add New</button>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover table-striped mb-4">
                            <thead>
                                <tr>
                                    <th>Unit Code</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="unit-item">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="justify-component" role="tabpanel" aria-labelledby="justify-component-tab">
                    <h5>Component</h5>

                    <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#add_component_modal">Add New</button>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-hover table-striped mb-4">
                            <thead>
                                <tr>
                                    <th>Component Code</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="component-item">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="justify-part" role="tabpanel" aria-labelledby="justify-part-tab">
                    <h5>Part</h5>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.modals.main-group')

    @include('dashboard.modals.group')

    @include('dashboard.modals.sub-group')

    @include('dashboard.modals.unit')

    @include('dashboard.modals.component')

    @include('dashboard.modals.part')

@endsection

@section('js')
    <script src="/js/main-group.js"></script>
    <script src="/js/group.js"></script>
    <script src="/js/sub-group.js"></script>
    <script src="/js/unit.js"></script>
    <script src="/js/component.js"></script>
    <script src="/js/part.js"></script>
@endsection