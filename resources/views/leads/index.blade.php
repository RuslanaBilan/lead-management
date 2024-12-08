@extends('layouts.app')

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <h1>Lead Statuses</h1>

        <form method="GET" action="{{ route('leads.index') }}">
            <div class="row mb-3">
                <div class="col">
                    <label for="date_from" class="form-label">Date from</label>
                    <input type="date" name="date_from" class="form-control" value="{{ $dateFrom }}" placeholder="From">
                </div>
                <div class="col">
                    <label for="date_to" class="form-label">Date to</label>
                    <input type="date" name="date_to" class="form-control" value="{{ $dateTo }}" placeholder="To">
                </div>
                <div class="col">
                    <label for="limit" class="form-label">Limit</label>
                    <input type="text" name="limit" class="form-control" value="{{ $limit }}" placeholder="Limit">
                </div>
                <div class="col">
                    <label for="page" class="form-label">Pages</label>
                    <input type="text" name="page" class="form-control" value="{{ $page }}" placeholder="Page">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Status</th>
                <th>FTD</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $status)
                <tr>
                    <td>{{ $status['id'] }}</td>
                    <td>{{ $status['email'] }}</td>
                    <td>{{ $status['status'] }}</td>
                    <td>{{ $status['ftd'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
