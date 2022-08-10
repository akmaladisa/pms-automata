@extends('layout.main')

@section('container')

    <div class="mt-3">
        <h1>Edit Customer</h1>
    </div>

    <a href="/customer" class="btn my-3 btn-primary text-white fw-bold btn-sm">
        <span data-feather="chevron-left"></span>
    </a>

    <div class="row">
        <div class="col-6">
            <div class="card card-body">
                <form action="/customer/{{ $customer->id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="form-floating mb-3">
                        <input value="{{ old('nameCustomer', $customer->nameCustomer) }}" name="nameCustomer" type="text" required placeholder="Name" class="form-control" id="floatingInput">
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input value="{{ old('emailCustomer', $customer->emailCustomer) }}" name="emailCustomer" type="email" required placeholder="Name" class="form-control" id="floatingInput">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input value="{{ old('phoneCustomer', $customer->phoneCustomer) }}" name="phoneCustomer" type="text" required placeholder="Name" class="form-control" id="floatingInput">
                        <label for="floatingInput">Phone</label>
                    </div>
                    <div class="form-check mb-3">
                        <input {{ ($customer->member) ? "checked" : "" }} class="form-check-input" name="member" type="checkbox" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Member
                        </label>
                    </div>
                    <div class="input-group">
                        <button class="btn btn-success rounded me-1" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection