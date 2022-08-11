@extends('layout.main')

@section('container')

<div class="row">
    <div class="col-8">
        <a href="/identity-type" class="btn btn-secondary mb-3 btn-sm">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>
        <form action="{{ route('identity-type.update',$identity->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Identity Type</label>
                <div class="col-sm-10">
                    <input name="name" type="text" required class="form-control" id="colFormLabel" placeholder="Identity Type" value="{{ $identity->name }}">
                </div>
            </div>
        
            <input type="submit" value="Update" class="btn btn-success">
        </form>
    </div>
</div>



@endsection