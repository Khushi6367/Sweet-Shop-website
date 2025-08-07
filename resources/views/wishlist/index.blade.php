@extends('layouts.base')

@section('content')
    <style>
        .product-image-container {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
    </style>
    <div class="container py-5">
        <h2 class="text-center mb-4">My Wishlist</h2>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @elseif (session('info'))
            <div class="alert alert-info text-center">{{ session('info') }}</div>
        @elseif (session('danger'))
            <div class="alert alert-danger text-center">{{ session('danger') }}</div>
        @endif


        @if ($wishlist->count())
            <div class="row">
                @foreach ($wishlist as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card product-card text-center h-100 shadow-sm">
                            <div class="product-image-container p-2">
                                <img src="/images/{{ $item->product->main_image }}" alt="{{ $item->product->name }}"
                                    class="product-image img-fluid rounded">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->product->name }}</h5>
                                <p class="text-muted mb-2">Flavor: {{ ucfirst($item->product->flavour) }}</p>

                                <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
                                    <a href="/product/{{ $item->product->id }}" class="btn btn-sm btn-info">View Details</a>

                                    <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center mt-5">
                <p class="fs-5">You have no items in your wishlist.</p>
            </div>
        @endif
    </div>
@endsection
