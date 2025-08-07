@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-4 text-primary">Admin Dashboard</h2>
    <hr>

    {{-- Top Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow text-center p-3 rounded">
                <h5>Total Orders</h5>
                <h3>{{ $totalOrders }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow text-center p-3 rounded">
                <h5>Total Users</h5>
                <h3>{{ $totalUsers }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow text-center p-3 rounded">
                <h5>Total Products</h5>
                <h3>{{ $totalProducts }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark text-white shadow text-center p-3 rounded">
                <h5>Total Revenue</h5>
                <h3>₹{{ number_format($totalRevenue, 2) }}</h3>
            </div>
        </div>
    </div>

    {{-- Order Status Overview --}}
    <div class="card shadow rounded">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Order Status Overview</h5>
        </div>
        <div class="card-body">
            <div class="row text-center">
                @foreach ($orderStatusSummary as $status => $count)
                    @php
                        $badgeColors = [
                            'Pending' => 'warning',
                            'Approved' => 'primary',
                            'Rejected' => 'danger',
                            'Order Placed' => 'secondary',
                            'Processing' => 'info',
                            'Dispatched' => 'dark',
                            'Delivered' => 'success',
                        ];
                        $badge = $badgeColors[$status] ?? 'secondary';
                    @endphp
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h6 class="text-muted">{{ $status }}</h6>
                            <span class="badge bg-{{ $badge }} fs-5">{{ $count }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
