@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Manage Barbers</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Shop Name</th>
                            <th>Owner</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barbers as $barber)
                            <tr>
                                <td>{{ $barber->id }}</td>
                                <td>{{ $barber->shop_name }}</td>
                                <td>{{ $barber->user->name }}</td>
                                <td>{{ $barber->address }}</td>
                                <td>{{ $barber->phone }}</td>
                                <td>
                                    <a href="{{ route('barber.profile', $barber) }}" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $barbers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
