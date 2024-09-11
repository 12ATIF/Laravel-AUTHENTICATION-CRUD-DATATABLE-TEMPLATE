@extends('dashboard')

@section('content')
<div class="container">
    <div class="row">

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('customers') }}" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search by name" value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <!-- Form Penyaringan -->
        <form method="GET" action="{{ route('customers') }}" class="mb-3">
            <div class="input-group">
                <input type="number" class="form-control" name="age_filter" placeholder="Filter by age" value="{{ request('age_filter') }}">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </form>
        <div class="col-md-3 text-left mb-3">
            <a href="{{ route('create') }}" class="btn btn-primary">Create New</a>
        </div>

        <!-- Tabel Data Pelanggan -->
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Age</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->age }}</td>
                        <td>
                            @if($customer->image)
                                <img src="{{ asset('images/' . $customer->image) }}" alt="Customer Image" style="max-width: 100px; max-height: 100px;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('update', ['customer_id' => $customer->id]) }}" class="btn btn-warning btn-sm">Update</a>
                            <form action="{{ route('delete', ['customer_id' => $customer->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        <!-- Pagination Links -->
        {{ $customers->appends(request()->query())->links() }}
</div>
@endsection
