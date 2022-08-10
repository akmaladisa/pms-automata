@extends('layout.main')

@section('container')

    <!-- alert customer -->
    @if ( session()->has('success') )
    <div class="alert mt-4 alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="mt-3">
        <h1>Customer Page</h1>
    </div>

    <a href="/customer/create" class="btn my-3 btn-success btn-sm">
        <span data-feather="plus"></span>
    </a>

    <div class="row">
        <div class="col-10">
            <table class="table table-responsive table-hover table-striped text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Member</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->nameCustomer }}</td>
                        <td>{{ $customer->emailCustomer }}</td>
                        <td>{{ $customer->phoneCustomer }}</td>
                        <td>
                            {{ ($customer->member) ? "Member" : "Not" }}
                        </td>
                        <td>
                            <a href="/customer/{{ $customer->id }}/edit" class="btn me-1 text-white btn-sm btn-warning">
                                <span data-feather="edit"></span>
                            </a>
                            <form action="/customer/{{ $customer->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" onclick="return confirm('Sure?')" class="btn btn-danger btn-sm">
                                    <span data-feather="trash-2"></span>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                </tbody>       
            </table>
        </div>
    </div>
    
@endsection