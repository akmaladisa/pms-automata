@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8">
        <a href="{{ route('ship-access.index') }}" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        <form action="{{ route('ship-access.update',$shipAccess->id) }}" method="post">
            @csrf
            @method('put')
            <select class="custom-select mb-4" required name="id_ship">
                <option selected disabled>Ship</option>
                @foreach ($ships as $ship)
                    <option value="{{ $ship->id_ship }}" @if( $shipAccess->id_ship == $ship->id_ship ) selected @endif>{{ $ship->ship_nm }}</option>
                @endforeach
            </select>
            <select class="custom-select mb-4" required name="id_crew">
                <option selected disabled>Crew</option>
                @foreach ($crews as $crew)
                    <option value="{{ $crew->id_crew }}" @if( $shipAccess->id_crew == $crew->id_crew ) selected @endif>{{ $crew->full_name }}</option>
                @endforeach
            </select>
        
            <input type="submit" value="Update" class="btn btn-success">
        </form>
    </div>
</div>



@endsection