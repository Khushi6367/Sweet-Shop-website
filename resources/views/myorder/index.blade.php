@extends('layouts.base')

@section('content')
    <style>
        .container.order-section {
            padding: 20px;
            width: 100%;
        }

        .status-container {
            background: linear-gradient(135deg, #ffffff, #f9f9f9);
            padding: 40px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .status-container:hover {
            transform: translateY(-5px);
        }

        /* Order Status Badges */
        .order-message-badge {
            padding: 10px;
            font-weight: 600;
            text-align: center;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }

        .badge-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        /* Tracking Steps */
        .tracking-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 30px 0;
            padding: 20px;
            background: #fff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            overflow-x: auto;
            white-space: nowrap;
            gap: 15px;
        }

        .tracking-step {
            text-align: center;
            flex: none;
            min-width: 120px;
        }

        .tracking-step .tracking-icon {
            width: 50px;
            height: 50px;
            background: lightgrey;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            color: white;
            font-size: 24px;
            transition: background 0.3s ease;
        }

        .tracking-step.completed .tracking-icon {
            background: green;
        }

        /* Shipping Details */
        .shipping-details {
            margin-top: 20px;
            text-align: left;
            transition: background 0.3s ease;
        }

        /* Product Details */
        .product-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 30px;
        }

        .product-item {
            display: flex;
            background: white;
            padding: 25px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            align-items: center;
            width: 100%;
        }

        .product-image img {
            width: 160px;
            height: auto;
            margin-right: 25px;
        }

        .product-info {
            text-align: left;
        }

        .product-info h5 {
            color: goldenrod;
            font-weight: bold;
        }

        .product-info p {
            margin: 5px 0;
        }

        .product-price .strike-text {
            text-decoration: line-through;
            color: red;
        }

        /* Buttons */
        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 35px;
        }

        .btn {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .tracking-container {
                flex-direction: row;
                justify-content: flex-start;
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 12px;
            }

            .tracking-step {
                flex: none;
            }

            .product-item {
                flex-direction: column;
                text-align: center;
            }

            .product-image img {
                margin: 0 auto 14px;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>

    <div class="container order-section">
        <h2 class="text-center p-4 text-success">Your Orders</h2>

        @if (count($data) == 0)
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="order-message-badge badge-pending">
                        You have not placed any orders yet.
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <a href="/product/all" class="btn btn-outline-dark">
                            <i class="fas fa-shopping-cart"></i> Start Shopping Now
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @foreach ($data as $billno => $product)
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="status-container">
                        <div class="order-info-box">
                            <h5 class="text-success">Order Number: <span>{{ $billno }}</span></h5>
                            @if ($product[1] == 'Pending')
                                <div class="order-message-badge badge-pending">
                                    <i class="fas fa-hourglass-half"></i> Thanks for your order! Our team is reviewing it
                                    and will get back to you shortly.
                                </div>
                            @elseif ($product[1] == 'Rejected')
                                <div class="order-message-badge badge-rejected">
                                    <i class="fas fa-times-circle"></i> Your order request has not been approved. If you
                                    have any queries, feel free to contact our team.
                                </div>
                            @endif
                        </div>

                        <div class="shipping-details">
                            <h5>Shipping & Billing Address</h5>
                            <p><strong>Name:</strong> {{ $product[0][0]['name'] }}</p>
                            <p><strong>Mobile:</strong> {{ $product[0][0]['mobile'] }}</p>
                            <p><strong>Address:</strong>
                                {{ $product[0][0]['address'] }}</p>
                            <p><strong>Payment Method:</strong>
                                {{ $product[0][0]['payment_method'] }}</p>
                        </div>

                        @if ($product[1] != 'Rejected')
                            @php
                                $statusMessages = [
                                    'Order Placed' => [
                                        'message' => 'Order successfully placed!',
                                        'icon' => 'fas fa-clipboard-list',
                                    ],
                                    'Approved' => [
                                        'message' => 'Order confirmed. Preparing now.',
                                        'icon' => 'fas fa-check-circle',
                                    ],
                                    'Processing' => [
                                        'message' => 'Crafting your order with care.',
                                        'icon' => 'fas fa-cogs',
                                    ],
                                    'Dispatched' => [
                                        'message' => 'Shipped! On its way to you.',
                                        'icon' => 'fas fa-truck',
                                    ],
                                    'Delivered' => [
                                        'message' => 'Delivered successfully. Enjoy!',
                                        'icon' => 'fas fa-box-open',
                                    ],
                                ];
                                $currentIndex = array_search($product[1], array_keys($statusMessages));
                            @endphp

                            <div class="tracking-container">
                                @foreach ($statusMessages as $status => $data)
                                    @php $isCompleted = $currentIndex >= array_search($status, array_keys($statusMessages)); @endphp
                                    <div class="tracking-step {{ $isCompleted ? 'completed' : '' }}">
                                        <div class="tracking-icon">
                                            <i class="{{ $data['icon'] }}"></i>
                                        </div>
                                        <p>{{ $status }}</p>
                                        @if ($status == array_keys($statusMessages)[$currentIndex])
                                            <div class="order-message-badge">{{ $data['message'] }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <h5>Product Details</h5>
                        <div class="product-details">
                            @foreach ($product[0] as $info)
                                <div class="product-item">
                                    <div class="product-image">
                                        <img src="/images/{{ $info['product']['main_image'] }}"
                                            alt="{{ $info['product_name'] }}">
                                    </div>
                                    <div class="product-info">
                                        <h5>{{ $info['product_name'] }}</h5>
                                        <p>Flvour: {{ $info['flavour'] }}</p>
                                        <p>Made With: {{ $info['madewith'] }}</p>
                                        <p>Weight: {{ $info['weight'] }} - {{ $info['weight_type'] }}</p>
                                        <p class="product-price"> M.R.P. (inclusive of all taxex):
                                            <span class="strike-text">₹{{ $info['mrp'] }}</span>
                                        <p>Discount: <strong class="text-success">{{ $info['discount'] }}% Off</strong></p>
                                        <p>Wholesale Price: <strong>₹{{ $info['price'] }}</strong> * Quantity:
                                            <strong>{{ $info['qty'] }}</strong> <br> Grand
                                            Total
                                            = <strong class="text-success">₹{{ $info['finalprice'] }}</strong>
                                        </p>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="button-group">
                            <a href="{{ route('order.invoice', ['billno' => $billno]) }}" class="btn btn-info">Download
                                Invoice</a>
                            <a href="/product/all" class="btn btn-warning"><i class="fas fa-shopping-cart"></i> Continue
                                Shopping</a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
