@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-maroon">Order Details (Order #{{ $orders[0]->billno_id }})</h2>
            <a href="/admin/orders" class="btn btn-secondary">Back</a>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>Customer Details</h4>
                <p><strong>Name:</strong> {{ $orders[0]->name }}</p>
                <p><strong>Phone:</strong> {{ $orders[0]->mobile }}</p>
                <p><strong>Address:</strong> {{ $orders[0]->address }}</p>
            </div>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-gold">
                    <tr>
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
                        <th>Transaction ID</th>
                        <th>Screenshot</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
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
                                {{ $order->payment_method === 'COD' ? 'NULL' : $order->utr }}
                            </td>
                            <td>
                                @if ($order->payment_method === 'COD')
                                    NULL
                                @else
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#imagePreviewModal"
                                        data-image="/images/screenshot/{{ $order->screenshot }}">
                                        <img src="/images/screenshot/{{ $order->screenshot }}" alt="screenshot"
                                            width="60" height="60" class="rounded shadow-sm img-fluid">
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Image Preview Modal -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagePreviewModalLabel">Payment Screenshot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="/images/screenshot/{{ $order->screenshot }}" alt="Screenshot"
                        class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const imagePreviewModal = document.getElementById('imagePreviewModal');
            imagePreviewModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const imageUrl = button.getAttribute('data-image');
                const modalImage = document.getElementById('modalImage');
                modalImage.src = imageUrl;
            });
        </script>
    @endpush
@endsection
