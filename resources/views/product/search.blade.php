@extends('layouts.base')

@section('content')
    <div class="container mt-4">
        @if (!empty(request('query')))
            <h2 class="text-center mb-4">
                Search Results For: <span class="text-primary">"{{ request('query') }}"</span>
            </h2>
        @endif


        {{-- <form action="/search" method="GET" class="mb-4">
            <div class="input-group shadow rounded-pill overflow-hidden">
                <input type="text" name="query" class="form-control border-0" placeholder="Search for products..."
                    value="{{ request('query') }}">
                <button type="submit" class="btn btn-primary d-flex align-items-center">
                    <i class="fas fa-search me-1"></i>
                </button>
            </div>
        </form> --}}


        @php
            $search = request('query');
            $filteredProducts = $products->filter(function ($product) use ($search) {
                return stripos($product->name, $search) !== false ||
                    stripos($product->flavour, $search) !== false ||
                    stripos($product->description, $search) !== false ||
                    $product->price->contains(function ($price) use ($search) {
                        return stripos($price->madewith, $search) !== false || $price->weight == $search;
                    });
            });
        @endphp

        @if (empty($search))
            <div class="alert alert-warning text-center">
                Please enter a search query.
            </div>
        @elseif($filteredProducts->isEmpty())
            <div class="text-center my-5">
                <h4 class="text-danger mb-3">Sorry, No Results Found!</h4>
                <p class="text-muted mb-4">Please check the spelling or try different keywords. Explore our premium
                    <strong>Soan Papdi</strong> collection at <strong>Ganpati Industries</strong>.
                </p>
                <a href="/product/all" class="btn btn-danger">
                    <i class="fas fa-arrow-left me-2"></i>Back to Products
                </a>
            </div>
        @else
            <div class="row">
                @foreach ($filteredProducts as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card bg-light border-0 h-100 shadow-sm">
                            <img src="/images/{{ $product->main_image }}" class="card-img-top" alt="{{ $product->name }}"
                                style="aspect-ratio: 1/1; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><strong>{{ $product->name }}</strong></h5>
                                <p class="mb-1">Flavour: <strong>{{ $product->flavour }}</strong></p>
                                <p class="small text-truncate mb-2">Description: {{ $product->description }}</p>
                                @foreach ($product->price as $price)
                                    <p class="mb-1">Weight: <strong>{{ $price->weight }}
                                            {{ $price->weight_type }}</strong></p>
                                    <p class="mb-1">Made with: <strong>{{ $price->madewith }}</strong></p>
                                @endforeach
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-dark mt-2">
                                    View Product
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
