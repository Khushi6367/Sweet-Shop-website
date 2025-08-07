@extends('layouts.base')

@section('content')
    <style>
        .product-card {
            background: white;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            padding: 10px;
            border: none;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-card:hover {
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
        }

        .product-image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .filter-select {
            padding: 10px;
            color: maroon;
            font-weight: 500;
            width: 100%;
            display: inline-block;
        }

        .card-body h5 {
            color: maroon;
            font-weight: bold;
        }

        .card-body p {
            color: goldenrod;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .filter-select {
                font-size: 15px;
                padding: 8px 12px;
            }

            .product-card {
                padding: 10px;
            }

            .btn-warning,
            .btn-danger {
                padding: 6px 12px;
                font-size: 14px;
            }

            .card-body h5 {
                font-size: 16px;
            }

            .card-body p {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .product-image-container {
                aspect-ratio: 1 / 1;
            }

            .filter-select {
                width: 90%;
                font-size: 14px;
            }
        }
    </style>

    <section class="container py-5">
        <div class="filter-section mb-4">
            <label for="flavour-filter" class="fw-bold fs-5 text-danger">Filter by Flavour:</label>
            <select id="flavour-filter" class="filter-select w-auto d-inline-block ms-2">
                <option value="all">View All Products</option>
                @foreach ($data->unique('flavour') as $info)
                    <option value="{{ $info->flavour }}">{{ ucfirst($info->flavour) }}</option>
                @endforeach
            </select>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="product-list">
            @foreach ($data as $info)
                <div class="col product-item" data-flavour="{{ $info->flavour }}">
                    <div class="card product-card text-center">
                        <div class="product-image-container">
                            <img src="/images/{{ $info->main_image }}" alt="Soan Papdi" class="product-image">
                        </div>
                        <div class="card-body">
                            <h5>{{ $info->name }}</h5>
                            <p>Flavor: {{ ucfirst($info->flavour) }}</p>
                            <div class="action-buttons">
                                <a href="/product/{{ $info->id }}" class="btn btn-warning">View Details</a>
                                <form action="{{ route('wishlist.add') }}" method="POST"
                                    onsubmit="event.stopPropagation();">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $info->id }}">
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa-solid fa-heart"></i> Add to Wishlist
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const flavourFilter = document.getElementById("flavour-filter");
            const productItems = document.querySelectorAll(".product-item");

            flavourFilter.addEventListener("change", function() {
                const selectedFlavour = this.value;

                productItems.forEach(item => {
                    if (selectedFlavour === "all" || item.getAttribute("data-flavour") ===
                        selectedFlavour) {
                        item.style.display = "block";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });
    </script>
@endsection
