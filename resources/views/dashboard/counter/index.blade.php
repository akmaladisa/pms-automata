@extends('layout.main')

@section('css')
<link href="/css/components/custom-list-group.css" rel="stylesheet" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')
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

    @include('dashboard.modals.counter')

@endsection

@section('js')
    <script src="/js/counter.js"></script>
@endsection