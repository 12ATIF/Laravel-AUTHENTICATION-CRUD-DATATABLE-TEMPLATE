@extends('dashboard')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('save', ['customer_id' => $customer->id]) }}" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ $customer->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ $customer->email }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="{{ $customer->address }}" required>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" class="form-control" id="age" placeholder="Enter age" name="age" value="{{ $customer->age }}" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($customer->image)
                <img src="{{ asset('images/' . $customer->image) }}" alt="Customer Image" style="max-width: 150px; max-height: 150px;">
            @else
                <p>No image uploaded</p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
