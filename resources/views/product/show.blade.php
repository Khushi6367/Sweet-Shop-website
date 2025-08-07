@extends('layouts.base')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @php $product = $info; @endphp
    <style>
        .product-gallery {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-image-container {
            width: 100%;
            max-width: 500px;
            position: relative;
            aspect-ratio: 1 / 1;
            overflow: hidden;
        }

        .main-image,
        .main-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .main-image:hover {
            cursor: zoom-in;
        }

        .thumbnails {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .thumbnail,
        .thumbnails video {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 1px solid gold;
            cursor: pointer;
            aspect-ratio: 1 / 1;
        }

        .zoom-container {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 10;
            display: none;
        }

        .zoomed-image {
            width: 600px;
            height: 600px;
            object-fit: contain;
            position: absolute;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .main-image-container {
                max-width: 100%;
            }

            .zoomed-image {
                width: 100%;
                height: auto;
            }

        }
    </style>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="product-gallery">
                    <div class="main-image-container border shadow-sm">
                        <img id="mainImage" src="/images/{{ $product['main_image'] }}" class="main-image"
                            alt="{{ $product['name'] }}">
                        <video id="mainVideo" class="main-video" controls style="display:none;">
                            <source src="/images/{{ $product['video'] }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div id="zoomContainer" class="zoom-container">
                            <img id="zoomedImage" src="/images/{{ $product['main_image'] }}" class="zoomed-image"
                                alt="{{ $product['name'] }}">
                        </div>
                    </div>
                    <div class="thumbnails">
                        <img src="/images/{{ $product['main_image'] }}" class="thumbnail"
                            onclick="changeImage('{{ $product['main_image'] }}')">
                        @foreach ($product['media'] as $media)
                            @if ($media['file_type'] == 'image')
                                <img src="/images/{{ $media['file_path'] }}" class="thumbnail"
                                    onclick="changeImage('{{ $media['file_path'] }}')">
                            @elseif ($media['file_type'] == 'video')
                                <video class="thumbnail" onclick="changeToVideo('{{ $media['file_path'] }}')" muted>
                                    <source src="/images/{{ $media['file_path'] }}" type="video/mp4">
                                </video>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 mx-auto px-3 py-4">
                <div class="product-details text-center">
                    <h1 class="mb-3 text-primary">{{ $product['name'] }}</h1>
                    <h3 class="mb-4">Flavour: {{ $product['flavour'] }}</h3>
                    <div class="row justify-content-center">
                        @foreach ($product['price'] as $price)
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-4">
                                <div class="card bg-light border shadow-sm">
                                    <div class="card-body text-center">
                                        <p> <strong>{{ $price['madewith'] }}</strong> </p>
                                        <p>Weight: {{ $price['weight'] }}
                                            {{ $price['weight_type'] }}</p>

                                        <div class="mb-2">
                                            @if ($price['availability'] === 'In Stock')
                                                <span class="badge bg-success">In Stock</span>
                                            @else
                                                <span class="badge bg-danger">Out of Stock</span>
                                            @endif
                                        </div>

                                        <div class="price-container mb-2">
                                            <span
                                                class="text-danger text-decoration-line-through">₹{{ $price['price'] }}</span>
                                            &nbsp;
                                            <span class="fw-bold text-success fs-2">₹{{ $price['finalprice'] }}</span>
                                            &nbsp;
                                            <span
                                                class="text-danger">{{ round((($price['price'] - $price['finalprice']) / $price['price']) * 100, 2) }}%
                                                off</span>
                                                <p>Inclusive of all taxes</p>
                                        </div>
                                        <div>
                                            @if (Auth::user())
                                                <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                                                    <input type="number" name="qty" min="20"
                                                        class="form-control w-100 text-center fw-bold" placeholder="Enter Qty"
                                                        id="qty_{{ $price['id'] }}">
                                                    <button class="btn btn-outline-danger"
                                                        onclick="addToCart('{{ $product['id'] }}', {{ Auth::user()->id }}, '{{ $price['id'] }}')">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <a href="/login" class="btn btn-success">Order Now</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <ul class="nav nav-tabs mt-4" id="productTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="desc-tab" data-bs-toggle="tab" href="#desc"
                                role="tab">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ingredients-tab" data-bs-toggle="tab" href="#ingredients"
                                role="tab">Ingredients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="shelf-tab" data-bs-toggle="tab" href="#shelf" role="tab">Shelf
                                Life</a>
                        </li>
                    </ul>
                    <div class="tab-content p-3 border border-top-0" id="productTabContent">
                        <div class="tab-pane fade show active" id="desc" role="tabpanel">{{ $product['description'] }}
                        </div>
                        <div class="tab-pane fade" id="ingredients" role="tabpanel">{{ $price['ingredients'] }}</div>
                        <div class="tab-pane fade" id="shelf" role="tabpanel">{{ $price['shelflife'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    <script>
        const mainImage = document.getElementById('mainImage');
        const mainVideo = document.getElementById('mainVideo');
        const zoomContainer = document.getElementById('zoomContainer');
        const zoomedImage = document.getElementById('zoomedImage');

        mainImage.addEventListener('mousemove', function(e) {
            const rect = mainImage.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            zoomContainer.style.display = 'block';
            zoomedImage.style.transform = `translate(-${x}px, -${y}px) scale(2)`;
        });

        mainImage.addEventListener('mouseleave', function() {
            zoomContainer.style.display = 'none';
        });

        function changeImage(image) {
            mainVideo.style.display = 'none';
            mainImage.style.display = 'block';
            mainImage.src = '/images/' + image;
            zoomedImage.src = '/images/' + image;
        }

        function changeToVideo(video) {
            mainImage.style.display = 'none';
            mainVideo.style.display = 'block';
            mainVideo.src = '/images/' + video;
            mainVideo.play();
        }

        function addToCart(product_id, user_id, price_id) {
            let token = '@csrf';
            token = token.substr(42, 40);
            let qty = document.getElementById('qty_' + price_id).value;
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
                        alert(r);
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            } else {
                alert("Enter Quantity!");
            }
        }
    </script>
@endsection
