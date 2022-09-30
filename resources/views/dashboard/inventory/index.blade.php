@extends('layout.main')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('container')
    <h2>STOCK</h2>

    <button class="btn btn-dark mt-2" data-toggle="modal" data-target="#addInventoryModal">Add New</button>

    <div class="table-responsive mt-3">
        <table class="table mt-3 table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>NO</td>
                    <th>Ship Name</th>
                    <th>Item Description</th>
                    <th>Part No</th>
                    <th>Stock</th>
                    <th>Stock Minimum</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody-inventory-list"></tbody>
        </table>
    </div>
@endsection

@include('dashboard.modals.inventory')

@section('js')
    <script src="/js/inventory.js"></script>
    <script src="/js/counter.js"></script>
@endsection