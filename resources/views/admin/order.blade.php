@extends('layouts.admin')

@section('content')
<form method="GET" action="{{ url('/admin/orders') }}" class="row g-3 mb-4">
    {{-- Search input --}}
    <div class="col-md-6">
        <input type="text" name="search" class="form-control" placeholder="Search by any order detail..."
            value="{{ $filters['search'] ?? '' }}">
    </div>

    {{-- Status filter --}}
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="All">All Status</option>
            @foreach (['Pending', 'Approved', 'Rejected', 'Order Placed', 'Processing', 'Dispatched', 'Delivered'] as $status)
                <option value="{{ $status }}" {{ ($filters['status'] ?? '') === $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Buttons --}}
    <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-primary w-100">Search</button>
        <a href="{{ url('/admin/orders') }}" class="btn btn-secondary w-100">Reset</a>
    </div>
</form>

    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Order List</h2>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-gold">
                    <tr>
                        <th>Order Number</th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Product Name</th>
                        <th>Flavor</th>
                        <th>Made With</th>
                        <th>Weight</th>
                        <th>Quantity</th>
                        <th>MRP</th>
                        <th>Price</th>
                        <th>Final Price</th>
                        <th>Discount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $billno_id => $orderGroup)
                        @foreach ($orderGroup[0] as $order)
                            <tr>
                                <td>{{ $order->billno_id }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->mobile }}</td>
                                <td class="text-truncate" style="max-width: 150px;">{{ $order->address }}</td>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->flavour }}</td>
                                <td>{{ $order->madewith }}</td>
                                <td>{{ $order->weight }} {{ $order->weight_type }}</td>
                                <td>{{ $order->qty }}</td>
                                <td>₹{{ $order->mrp }}</td>
                                <td>₹{{ $order->price }}</td>
                                <td>₹{{ $order->finalprice }}</td>
                                <td class="text-success">
                                    {{ round((($order->mrp - $order->price) / $order->mrp) * 100, 2) }}% off
                                </td>
                                <td>{{ $order->payment_method }} </td>
                                <td>
                                    <form method="POST" action="/admin/orders/{{ $order->billno_id }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="dropdown">
                                            @php
                                                $statusColors = [
                                                    'Pending' => 'warning',
                                                    'Approved' => 'primary',
                                                    'Rejected' => 'danger',
                                                    'Order Placed' => 'secondary',
                                                    'Processing' => 'warning',
                                                    'Dispatched' => 'info',
                                                    'Delivered' => 'success',
                                                ];
                                                $statusColor = $statusColors[$orderGroup[1]] ?? 'secondary';
                                            @endphp
                                            <button class="btn btn-{{ $statusColor }} dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $orderGroup[1] }}
                                            </button>
                                            <ul class="dropdown-menu">
                                                @foreach ($statusColors as $status => $color)
                                                    <li>
                                                        <button class="dropdown-item text-{{ $color }}"
                                                            type="submit" name="status" value="{{ $status }}">
                                                            {{ $status }}
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <a href="/admin/orders/{{ $order->billno_id }}" class="btn btn-sm btn-dark">View</a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
