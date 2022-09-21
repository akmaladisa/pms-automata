@extends('layout.main')

@section('css')
    <link href="/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
    <link href="/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
    <link href="/css/full-screen-modal.css" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')

    @include('sweetalert::alert')

    <div class="row">
        <div class="col-12">

            <h3>Crew List</h3>

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
                    <tbody id="crew-master">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('dashboard.modals.crew-master')

    @include('dashboard.modals.crew-medical')

    @include('dashboard.modals.crew-education')

    @include('dashboard.modals.crew-wo')

    @include('dashboard.modals.crew-bank')

    @include('dashboard.modals.crew-certificate')

    @include('dashboard.modals.crew-insurance')

    @include('dashboard.modals.seaman-book')

    @include('dashboard.modals.crew-coc')

@endsection

@section('js')
    <script src="/js/crew-medical-record.js"></script>
    <script src="/js/crew-master.js"></script>
    <script src="/js/crew-education.js"></script>
    <script src="/js/crew-wo.js"></script>
    <script src="/js/crew-bank.js"></script>
    <script src="/js/crew-insurance.js"></script>
    <script src="/js/crew-certificate.js"></script>
    <script src="/js/seaman-book.js"></script>
    <script src="/js/crew-coc.js"></script>
@endsection