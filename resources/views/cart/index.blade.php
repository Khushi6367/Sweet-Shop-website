@extends('layouts.base')

@section('content')
    <style>
        .bank-details {
            display: none;
            transition: all 0.3s ease-in-out;
        }

        .bank-details p {
            margin-bottom: 0.5rem;
        }

        @media (max-width: 576px) {
            .bank-details {
                font-size: 0.95rem;
            }
        }
    </style>
    <style>
        body {
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .card {
            background: snow;
        }

        .cart-heading {
            background-color: maroon;
            padding: 10px;
        }

        .cart-container {
            padding: 20px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            table-layout: auto;
        }

        .table th,
        .table td {
            text-align: center;
            padding: 15px;
            word-wrap: break-word;
        }

        .delete-icon {
            color: darkred;
            cursor: pointer;
        }

        .delete-icon:hover {
            color: goldenrod;
        }

        .radio {
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .cart-container {
                padding: 10px;
            }

            .table-responsive {
                overflow-x: auto;
                display: block;
                width: 100%;
            }

            .cart-table {
                width: 100%;
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .cart-table th,
            .cart-table td {
                font-size: 12px;
                padding: 6px;
            }
        }
    </style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-12 cart-container">
                <h3 class="text-center text-white cart-heading">Shopping Cart</h3>
                @if ($data->count() > 0)
                    @php
                        $showspping = true;
                    @endphp
                    <div class="table-responsive">
                        <table class="table cart-table mt-4">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>MRP</th>
                                    <th>Discount</th>
                                    <th>Final Price </th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $maintot = 0;
                                @endphp
                                @foreach ($data as $item)
                                    @php
                                        $total = $item->price->finalprice * $item->qty;
                                        $maintot += $total;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->product->name }} ({{ $item->product->flavour }} )</td>
                                        <td>₹{{ $item->price->price }}</td>
                                        <td>{{ round((($item->price['price'] - $item->price['finalprice']) / $item->price['price']) * 100, 2) }}%
                                        </td>
                                        <td>₹{{ $item->price->finalprice }}</td>
                                        <td>
                                            <input type="number" style="width: 80px"
                                                onchange="addToCart('{{ $item->product['id'] }}','{{ Auth::user()->id }}','{{ $item->price['id'] }}',this.value)"
                                                value="{{ $item->qty }}">
                                        </td>
                                        <td>₹{{ $total }}</td>
                                        <td>
                                            <form action="/cart/{{ $item->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0">
                                                    <i class="fas fa-trash delete-icon"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5 " class="text-end"><strong>Grand Total:</strong></td>
                                    <td colspan="2">₹{{ $maintot }}
                                    </td>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    @php
                        $showspping = false;
                    @endphp
                    <p class="text-center">Your cart is empty!</p>
                @endif
            </div>
        </div>

        @if ($showspping)
            <div class="row justify-content-center my-5">
                <div class="col-lg-10 col-md-12">
                    <form method="post" action="/myorder" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-center mb-4">Shipping and Billing Address</h3>

                        <!-- Default Address -->
                        <div class="row mb-4">
                            <div class="col-1 d-flex align-items-center">
                                <input type="radio" name="address" checked class="radio" value="default">
                            </div>
                            <div class="col-11">
                                <div class="card">
                                    <div class="card-description p-2">
                                        <span class="text-muted">Name:</span>
                                        <span><b>{{ Auth::user()->name }}</b></span> <br>
                                        <span class="text-muted">Address:</span>
                                        <span>{{ Auth::user()->address }}</span> <br>
                                        <span class="text-muted">Phone Number:</span>
                                        <span>(+91{{ Auth::user()->mobile }})</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Other Addresses -->
                        @foreach (Auth::user()->shipping as $ship)
                            <div class="row mb-3">
                                <div class="col-1 d-flex align-items-center">
                                    <input type="radio" name="address" class="radio" value="{{ $ship->id }}">
                                </div>
                                <div class="col-11">
                                    <div class="card">
                                        <div class="card-description p-2">
                                            <span class="text-muted">Name:</span>
                                            <span><b>{{ $ship->name }}</b></span> <br>
                                            <span class="text-muted">Address:</span>
                                            <span>{{ $ship->address }}</span> <br>
                                            <span class="text-muted">Phone Number:</span>
                                            <span>(+91{{ $ship->mobile }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Payment Method Section -->
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8 col-sm-10">
                                <div class="card p-4">
                                    <h4 class="mb-4 text-center">Select Payment Method</h4>

                                    <!-- Cash on Delivery (COD) Option -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cod"
                                            value="COD" required checked onclick="toggleBankDetails(false)">
                                        <label class="form-check-label" for="cod">
                                            Cash on Delivery (COD)
                                        </label>
                                    </div>

                                    <!-- Bank Transfer Option -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="bank"
                                            value="Bank" onclick="toggleBankDetails(true)">
                                        <label class="form-check-label" for="bank">
                                            Bank Transfer
                                        </label>
                                    </div>

                                    <!-- Bank Details Section -->
                                    <div class="bank-details border rounded p-3 bg-light mt-3" id="bankDetails"
                                        style="display: none;">
                                        <p class="text-center fw-bold text-danger mb-4">
                                            Your order will be placed only after payment and uploading the UTR and
                                            screenshot.
                                        </p>

                                        <h5 class="mb-3 text-primary">Bank Account Details</h5>
                                        <p><strong>Account Holder Name:</strong> GANPATI INDUSTRIES</p>
                                        <p><strong>Account Number:</strong> 08111131005627</p>
                                        <p><strong>Account Type:</strong> Current</p>
                                        <p><strong>Bank Name:</strong> Punjab National Bank</p>
                                        <p><strong>Branch:</strong> BIKANER-GANGA SHAHAR ROAD</p>
                                        <p><strong>IFSC Code:</strong> PUNB0081110</p>

                                        <!-- Transaction Confirmation Form -->
                                        <div class="mt-4">
                                            <h6>Transaction Confirmation</h6>
                                            <div class="mb-3">
                                                <label for="utr" class="form-label">UTR / Reference No.</label>
                                                <input type="text" class="form-control" name="utr" id="utr"
                                                    placeholder="Enter UTR / Transaction ID">
                                            </div>
                                            <div class="mb-3">
                                                <label for="screenshot" class="form-label">Upload Screenshot / Proof of
                                                    Payment</label>
                                                <input type="file" class="form-control" name="screenshot" id="screenshot"
                                                    accept="image/*">
                                                <small class="text-muted">Only JPG, PNG, or PDF formats allowed.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add New Address Button & Submit Button -->
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Add a new address</button>
                            <button type="submit" class="btn btn-success">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

            <div class="container my-5">
                <div class="empty-cart-ganpati text-center p-5 rounded mx-auto">
                    <h3 class="mb-3 text-danger fw-bold">Your cart is currently empty!</h3>
                    <p class="text-dark">You have no products in your shopping cart.</p>
                    <a href="/product/all" class="btn btn-warning mt-3 px-4 py-2">
                        <i class="fas fa-store"></i> Shop Now
                    </a>
                </div>
            </div>
        @endif
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/shipping">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Shipping Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Name Field -->
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Mobile Field -->
                        <div class="mb-3 row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">+91</span>
                                    <input id="mobile" type="text" maxlength="10" oninput="validateInput(this)"
                                        class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                        value="{{ old('mobile') }}" required autocomplete="mobile">
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Address Field -->
                        <div class="mb-3 row">
                            <label for="address"
                                class="col-md-4 col-form-label text-md-end">{{ __('Enter Address') }}</label>
                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required
                                    autocomplete="address">{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <script src="https://releases.jquery.com/git/jquery-git.js"></script> --}}
    <script>
        function addToCart(product_id, user_id, price_id, qty) {
            let token = '@csrf';
            token = token.substr(42, 40);
            if (qty) {
                let info = {
                    product_id,
                    user_id,
                    price_id,
                    qty,
                    _token: token
                };
                $.ajax({
                    url: '/cart/',
                    type: 'post',
                    data: info,
                    success: function(r) {
                        location.href = location.href;
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            } else {
                alert("Enter Quantity!");
            }
        }
        var exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalTitle = exampleModal.querySelector('.modal-title')
            var modalBodyInput = exampleModal.querySelector('.modal-body input')

            modalTitle.textContent = 'New message to ' + recipient
            modalBodyInput.value = recipient
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleBankDetails(show) {
            const bankDetails = document.getElementById('bankDetails');
            const utrInput = document.getElementById('utr');
            const screenshotInput = document.getElementById('screenshot');

            if (show) {
                bankDetails.style.display = 'block';
                utrInput.setAttribute('required', true);
                screenshotInput.setAttribute('required', true);
            } else {
                bankDetails.style.display = 'none';
                utrInput.removeAttribute('required');
                screenshotInput.removeAttribute('required');
            }
        }

        // Trigger toggle on page load (e.g., if user refreshes)
        window.onload = () => {
            const bankRadio = document.getElementById('bank');
            toggleBankDetails(bankRadio.checked);
        }
    </script>

@endsection
