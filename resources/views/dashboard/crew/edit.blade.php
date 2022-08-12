@extends('layout.main')

@section('container')

<div class="row pb-5">
    <div class="col-8">
        <h2>Edit Crew</h2>

        <a class="btn btn-dark mt-3" href="{{ route('crew.index') }}">
            <x-bi-arrow-left-circle-fill></x-bi-arrow-left-circle-fill>
        </a>

        <form action="{{ route('crew.update',$crew->id_crew) }}" enctype="multipart/form-data" method="post" class="mt-3">
            @method('put')
            @csrf
            <div class="form-group mb-4">
                <label for="formGroupExampleInput">Crew ID</label>
                <input type="text" readonly required class="form-control" id="formGroupExampleInput" name="id_crew" placeholder="Example input" value="{{ $crew->id_crew }}">
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Full Name</label>
                <input type="text" required class="form-control" id="formGroupExampleInput2" placeholder="Crew Name" name="full_name" value="{{ $crew->full_name }}">
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Email</label>
                <input type="email" required class="form-control" id="formGroupExampleInput2" placeholder="Email" name="email" value="{{ $crew->email }}">
            </div>
            <div class="form-group mb-4">
                <label for="">Identity Type</label>
                <select class="custom-select mb-4" name="identity_type" required>
                    <option  selected disabled>Identity Type</option>
                    @foreach ($identytiesType as $i)
                        <option  @if( $crew->identity_type == $i->name ) selected @endif value="{{ $i->name }}">{{ $i->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Identity Number</label>
                <input type="text" required class="form-control" id="formGroupExampleInput2" placeholder="Identity Number" name="identity_number" value="{{ $crew->identity_number }}">
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Job Title</label>
                <input type="text" required class="form-control" id="formGroupExampleInput2" placeholder="Job Title" name="job_title" value="{{ $crew->job_title }}">
            </div>
            <div class="form-group mb-4">
                <label for="">Country</label>
                <select class="custom-select mb-4" name="country" required>
                    <option  selected disabled>Country</option>
                    @foreach ($countries as $country)
                        <option @if( $crew->country == $country->country_nm ) selected @endif value="{{ $country->country_nm }}">{{ $country->country_nm }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Phone</label>
                <input type="text" required class="form-control" id="formGroupExampleInput2" placeholder="Phone" name="phone" value="{{ $crew->phone }}">
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Whatsapp Phone</label>
                <input type="text" required class="form-control" id="formGroupExampleInput2" placeholder="Whatsapp Phone" name="whatsapp_phone" value="{{ $crew->whatsapp_phone }}">
            </div>
            <div class="form-group mb-4">
                <label for="">Gender</label>
                <select class="custom-select mb-4" name="gender" required>
                    <option @if( $crew->gender == 'MALE' ) selected @endif value="MALE">Male</option>
                    <option @if( $crew->gender == 'FEMALE' ) selected @endif value="FEMALE">Female</option>
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="">Status Merital</label>
                <select class="custom-select mb-4" name="status_merital" required>
                    <option @if( $crew->status_merital == 'MARRIED' ) selected @endif value="MARRIED">Married</option>
                    <option @if( $crew->status_merital == 'SINGLE' ) selected @endif value="SINGLE">Single</option>
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Place Of Birth</label>
                <input type="text" required class="form-control" id="formGroupExampleInput2" placeholder="Place Of Birth" name="pob" value="{{ $crew->pob }}">
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Date Of Birth</label>
                <input type="date" required class="form-control" id="formGroupExampleInput2" placeholder="Date Of Birth" name="dob" value="{{ $crew->dob }}">
            </div>
            <div class="form-group mb-4">
                <label for="">Address</label>
                <textarea class="form-control" name="address" required aria-label="With textarea">{{ $crew->address }}</textarea>
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Join Date</label>
                <input type="datetime-local" required class="form-control" id="formGroupExampleInput2" placeholder="Join Date" name="join_date" value="{{ $crew->join_date }}">
            </div>
            <div class="form-group mb-4">
                <label for="">Note</label>
                <textarea class="form-control" name="note" required aria-label="With textarea">{{ $crew->note }}</textarea>
            </div>
            <div class="form-group mb-4">
                <label>Status</label>
                <select class="custom-select mb-4" name="status" required>
                    <option @if( $crew->status == 'ACT' ) selected @endif value="ACT">ACT</option>
                    <option @if( $crew->status == 'DE' ) selected @endif value="DE">DE</option>
                </select>
            </div>
            <div class="form-group mb-5">
                <label for="formGroupExampleInput2">Join Port</label>
                <input type="datetime-local" required class="form-control" id="formGroupExampleInput2" placeholder="Join Port" name="join_port" value="{{ $crew->join_port }}">
            </div>
            <div class="custom-file mb-4 form-group">
                <input name="photo" onchange="preview()" type="file" class="custom-file-input" id="imgCrewInput">
                <label class="custom-file-label" for="customFile">Crew Image</label>
            </div>
            <img class="mb-4" id="imgCrew" width="200px" height="150px" src="{{ asset("storage/" . $crew->photo) }}">
            <div class="form-group mb-4">
                <label for="formGroupExampleInput">Updated User</label>
                <input name="updated_user" type="text" readonly required class="form-control" id="formGroupExampleInput" placeholder="Example input" value="{{ auth()->user()->id_login }}">
            </div>

            <input type="submit" value="Update" class="btn btn-success">
        </form>
    </div>
</div>
    
@endsection

@section('js')
    <script>
        function preview() {
            document.getElementById('imgCrew').src = URL.createObjectURL(event.target.files[0]);
            document.getElementById('imgCrew').style.display = 'block'
        }
    </script>
@endsection