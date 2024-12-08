@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Lead</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('leads.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" name="firstName" id="firstName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" name="lastName" id="lastName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
