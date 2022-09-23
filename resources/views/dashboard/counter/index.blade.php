@extends('layout.main')

@section('css')
<link href="/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
<link href="/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')

    <ul class="nav nav-tabs  mb-3 mt-3 nav-fill" id="justifyTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="justify-counter-tab" data-toggle="tab" href="#justify-counter" role="tab" aria-controls="justify-counter" aria-selected="true">Counter</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="justify-counter-list-tab" data-toggle="tab" href="#justify-counter-list" role="tab" aria-controls="justify-counter-list" aria-selected="false">Counter List</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="justify-counter-report-tab" data-toggle="tab" href="#justify-counter-report" role="tab" aria-controls="justify-counter-report" aria-selected="false">Counter Report</a>
        </li>
    </ul>

    <div class="tab-content" id="justifyTabContent">
        <div class="tab-pane fade show active" id="justify-counter" role="tabpanel" aria-labelledby="justify-counter-tab">
            <h3>Counter</h3>

            <button class="btn btn-dark mt-2" data-toggle="modal" data-target="#addCounterModal">Add New</button>

            <div class="table-responsive mt-3">
                <table class="table mt-3 table-bordered table-hover table-striped mb-4">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Ship</th>
                            <th>Item Description</th>
                            <th>Part No</th>
                            <th>Starting Of Running Hours</th>
                            <th>Date</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="counter-list">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="justify-counter-list" role="tabpanel" aria-labelledby="justify-counter-list-tab">
            <h3>Counter List</h3>
        </div>
        <div class="tab-pane fade" id="justify-counter-report" role="tabpanel" aria-labelledby="justify-counter-report-tab">
            <h3>Counter Report</h3>
        </div>
    </div>

    @include('dashboard.modals.counter')

@endsection

@section('js')
    <script src="/js/counter.js"></script>
    <script src="/js/list-counter.js"></script>
@endsection