@extends('layouts.base')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        /* Hero Section */
        .hero-section {
            width: 100%;
        }

        .hero-slide {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            animation: zoomIn 8s ease-in-out infinite;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .content-box {
            max-width: 800px;
            z-index: 3;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        .hero-desc {
            font-size: 1.25rem;
            text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.6);
        }

        .animate-text {
            animation: fadeInUp 1.2s ease-out;
        }

        /* Animations */
        @keyframes zoomIn {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Dots */
        .carousel-indicators [data-bs-target] {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #fff;
            opacity: 0.6;
        }

        .carousel-indicators .active {
            background-color: #ffc107;
            opacity: 1;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .hero-slide {
                height: 100vw;
            }

            .hero-title {
                font-size: 1.75rem;
            }

            .hero-desc {
                font-size: 1rem;
            }

            .btn {
                font-size: 0.85rem;
                padding: 0.6rem 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-slide {
                height: 100vw;
            }

            .hero-title {
                font-size: 1.5rem;
            }

            .hero-desc {
                font-size: 0.95rem;
            }

            .btn {
                font-size: 0.8rem;
                padding: 0.5rem 1rem;
            }
        }

        /* latest products */
        .product-card {
            overflow: hidden;
        }

        .card-body h5 {
            color: goldenrod;
        }

        .card-body p {
            color: maroon;
        }

        .product-image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .product-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .heading-underline {
            border-bottom: 3px solid gold;
            display: inline-block;
            padding-bottom: 5px;
        }

        .product-slider-container {
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .product-slider-container::-webkit-scrollbar {
            display: none;
        }

        .product-slider {
            display: flex;
            gap: 15px;
            padding: 10px;
            cursor: grab;
            transition: all 0.3s ease-in-out;
        }

        .product-item {
            flex: 0 0 auto;
            width: 25%;
            max-width: 25%;
            transition: transform 0.3s ease;
        }

        .product-item:hover {
            transform: scale(1.03);
        }

        .filter-select {
            min-width: 200px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .product-item {
                width: 33.33%;
                max-width: 33.33%;
            }
        }

        @media (max-width: 768px) {
            .product-item {
                width: 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 576px) {
            .product-item {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .filter-select {
                width: 100%;
                margin-top: 10px;
            }
        }

        .border-gold {
            border-color: gold !important;
        }


        /* feature card  */
        .text-maroon {
            color: #7a0000;
        }

        .premium-card {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            padding: 2rem;
            margin: 0 0.25rem;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1),
                0 4px 6px rgba(255, 255, 255, 0.4) inset;
            transition: all 0.4s ease;
        }

        .premium-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 18px 36px rgba(0, 0, 0, 0.2),
                0 6px 8px rgba(255, 255, 255, 0.5) inset;
        }

        .premium-icon {
            width: 75px;
            height: 75px;
            background: maroon;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow:
                0 8px 16px rgba(0, 0, 0, 0.3),
                inset 0 2px 6px rgba(255, 255, 255, 0.2);
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.7s ease;
        }

        .animate-on-scroll.show {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .premium-card {
                margin: 0 0.5rem;
                padding: 1.5rem;
            }

            .premium-icon {
                width: 65px;
                height: 65px;
            }
        }

        /* about */
        .about-section {
            background: beige;
            padding-top: 80px;
            padding-bottom: 80px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #800000;
        }

        .section-title .highlight {
            color: #d4af37;
        }

        .about-description {
            font-size: 1.15rem;
            line-height: 1.8;
        }

        .btn-custom {
            background-color: maroon;
            color: #fff8f0;
            padding: 12px 30px;
            border-radius: 30px;
            border: none;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease-in-out;
            display: inline-block;
        }

        .btn-custom:hover {
            background-color: gold;
            transform: translateY(-3px);
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .section-title {
                font-size: 2.1rem;
            }

            .about-description {
                font-size: 1.05rem;
            }
        }

        @media (max-width: 767.98px) {

            .section-title,
            .about-description {
                text-align: center;
            }

            .btn-custom {
                display: block;
                margin: 20px auto 0 auto;
            }
        }

        /* instagram */
        .text-maroon {
            color: #800000;
        }

        .btn-maroon-glow {
            background-color: maroon;
            color: #fff;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(128, 0, 0, 0.3);
        }

        .btn-maroon-glow:hover {
            background-color: goldenrod;
            box-shadow: 0 6px 16px rgba(250, 150, 0, 0.5);
            transform: scale(1.05);
            color: #fff;
            text-decoration: none;
        }

        @media (max-width: 767.98px) {
            .btn-maroon-glow {
                width: 100%;
                justify-content: center;
            }
        }
    </style>


    <section class="hero-section">
        <div class="container-fluid px-0">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000"
                data-bs-touch="true">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="hero-slide">
                            <img src="{{ asset('images/hero/slide1.jpg') }}" class="hero-img" alt="Slide 1">
                            <div class="overlay">
                                <div class="content-box text-center">
                                    <h1 class="hero-title text-white animate-text">Welcome to Ganpati Industries</h1>
                                    <p class="hero-desc text-white animate-text">Delicious Soan Papdi crafted with tradition
                                        & taste</p>
                                    <a href="/product/all" class="btn btn-warning fw-bold mt-3 px-4 py-2">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="hero-slide">
                            <img src="{{ asset('images/hero/slide2.jpg') }}" class="hero-img" alt="Slide 2">
                            <div class="overlay">
                                <div class="content-box text-center">
                                    <h1 class="hero-title text-white animate-text">Bulk Orders Made Easy</h1>
                                    <p class="hero-desc text-white animate-text">Affordable & customizable Soan Papdi
                                        solutions</p>
                                    <a href="/product/all" class="btn btn-warning fw-bold mt-3 px-4 py-2">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="hero-slide">
                            <img src="{{ asset('images/hero/slide3.jpg') }}" class="hero-img" alt="Slide 3">
                            <div class="overlay">
                                <div class="content-box text-center">
                                    <h1 class="hero-title text-white animate-text">Celebrate Festivals with Us</h1>
                                    <p class="hero-desc text-white animate-text">Special festive combo packs available now!
                                    </p>
                                    <a href="/product/all" class="btn btn-warning fw-bold mt-3 px-4 py-2">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="carousel-indicators mb-3">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
            </div>
        </div>
    </section>


    @php
        $latestProducts = \App\Models\Product::latest()->take(8)->get();
    @endphp

    <section class="container py-5 text-center">
        <h2 class="text-gold mb-3 animated-heading">Latest Soan Papdi Collection by Ganpati Industries – The Real Taste of
            Bikaner</h2>
        <p class="text-maroon">
            Experience the authentic sweetness of Bikaner with <strong>Ganpati Industries</strong> latest Soan Papdi
            collection. Crafted
            with care, tradition, and the finest ingredients, our Soan Papdi offers the perfect balance of rich flavor and
            signature flakiness. From timeless classics to exciting new twists, every piece reflects our commitment to
            quality and heritage. Discover <strong>“The Real Taste of Bikaner”</strong> in every delightful bite - only from
            Ganpati
            Industries.
        </p>

        <!-- Filter by Flavour -->
        <div class="filter-section my-4">
            <label for="flavour-filter" class="text-maroon fw-bold me-2">Filter by Flavour:</label>
            <select id="flavour-filter" class="filter-select px-3 py-2 rounded border border-gold text-maroon">
                <option value="all">View All</option>
                @foreach ($latestProducts->unique('flavour') as $info)
                    <option value="{{ $info->flavour }}">{{ ucfirst($info->flavour) }}</option>
                @endforeach
            </select>
        </div>

        <!-- Latest Products Scrolling Slider -->
        <div class="product-slider-container">
            <div class="product-slider">
                @foreach ($latestProducts as $product)
                    <div class="product-item" data-flavour="{{ $product->flavour }}">
                        <div class="card product-card shadow-sm text-center">
                            <div class="product-image-container">
                                <img src="/images/{{ $product->main_image }}" alt="Soan Papdi" class="product-image">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                <p>{{ ucfirst($product->flavour) }}</p>
                                <a href="/product/{{ $product->id }}" class="btn btn-warning">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4">
            <a href="/product/all" class="btn btn-danger">Explore All</a>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const slider = document.querySelector(".product-slider");
            const flavourFilter = document.getElementById("flavour-filter");

            // Slider Drag Scroll
            let isDown = false,
                startX, scrollLeft;

            slider.addEventListener("mousedown", (e) => {
                isDown = true;
                slider.classList.add("active");
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            slider.addEventListener("mouseleave", () => {
                isDown = false;
                slider.classList.remove("active");
            });

            slider.addEventListener("mouseup", () => {
                isDown = false;
                slider.classList.remove("active");
            });

            slider.addEventListener("mousemove", (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - slider.offsetLeft;
                const walk = (x - startX) * 2;
                slider.scrollLeft = scrollLeft - walk;
            });

            // Flavour Filter Logic
            flavourFilter.addEventListener("change", function() {
                const selectedFlavour = this.value;
                const items = document.querySelectorAll(".product-item");
                items.forEach(item => {
                    if (selectedFlavour === "all" || item.dataset.flavour === selectedFlavour) {
                        item.style.display = "block";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });
    </script>

    <section id="why-choose-us" class="py-5" style="background-color: antiquewhite;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold display-4" style="color: maroon; font-family: 'Times New Roman', Times, serif;">Why
                    Choose
                    Ganpati Industries</h2>
                <p class="text-muted fs-6" style="max-width: 640px; margin: auto;">Premium sweets crafted in Bikaner using
                    traditional recipes and pure ingredients.</p>
            </div>

            <div class="row gy-4">
                @php
                    $features = [
                        [
                            'icon' => 'fa-leaf',
                            'title' => '100% Natural',
                            'desc' => 'Only natural ingredients – no chemicals, no shortcuts.',
                        ],
                        [
                            'icon' => 'fa-boxes-stacked',
                            'title' => 'Bulk Quantity',
                            'desc' => 'Wholesale supply with consistent quality and taste.',
                        ],
                        [
                            'icon' => 'fa-certificate',
                            'title' => 'Certified',
                            'desc' => 'FSSAI certified and quality guaranteed every batch.',
                        ],

                        [
                            'icon' => 'fa-cart-shopping',
                            'title' => 'My Order',
                            'desc' => 'Track, manage, and reorder your favorites easily.',
                        ],
                        [
                            'icon' => 'fa-heart',
                            'title' => 'Made With Love',
                            'desc' => 'Handcrafted with passion and care by skilled artisans.',
                        ],
                        [
                            'icon' => 'fa-star',
                            'title' => 'Premium Quality',
                            'desc' => 'Only the best ingredients, textures, and flavor.',
                        ],
                    ];
                @endphp

                @foreach ($features as $feature)
                    <div class="col-lg-4 col-md-6">
                        <div class="premium-card text-center p-4 animate-on-scroll">
                            <div class="premium-icon mx-auto mb-3">
                                <i class="fas {{ $feature['icon'] }} fa-xl text-white"></i>
                            </div>
                            <h5 class="fw-bold text-maroon mb-2" style="font-family: 'Times New Roman', Times, serif;">
                                {{ $feature['title'] }}</h5>
                            <p class="text-muted small">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    }
                });
            }, {
                threshold: 0.15
            });

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });
    </script>

    <!-- All Festivals Grand Offer Section -->
    <section class="all-festival-offer py-5">
        <div class="container text-center">
            <h2 class="subtitle">Ganpati Industries Presents</h2>
            <h1 class="title">🎉 Grand Festival Offers on Soan Papdi</h1>
            <p class="description">
                Celebrate **every festival** with sweetness! Avail special **bulk & wholesale deals** on our premium Soan
                Papdi.<br>
                Perfect for gifting, events, and reselling during Diwali, Holi, Raksha Bandhan, Eid, Christmas & more.
            </p>

            <div class="row justify-content-center mt-5 g-4">
                <!-- Offer Card 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="offer-card">
                        <div class="icon-circle bounce-anim">
                            <i class="fas fa-boxes-stacked"></i>
                        </div>
                        <h4 class="text-gold fw-bold mt-3">Bulk Orders</h4>
                        <p>Get best rates on large quantity packs. Perfect for wholesalers and corporates.</p>
                    </div>
                </div>

                <!-- Offer Card 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="offer-card">
                        <div class="icon-circle bounce-anim delay-1">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h4 class="text-gold fw-bold mt-3">Festival Gifting</h4>
                        <p>Customized Soan Papdi boxes ideal for Diwali, Eid, Christmas & wedding gifts.</p>
                    </div>
                </div>

                <!-- Offer Card 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="offer-card">
                        <div class="icon-circle bounce-anim delay-2">
                            <i class="fas fa-percent"></i>
                        </div>
                        <h4 class="text-gold fw-bold mt-3">Flat Discounts</h4>
                        <p>Enjoy flat festive discounts on orders. Limited period offers available now!</p>
                    </div>
                </div>
            </div>

            <a href="/contact" class="btn btn-outline-light mt-5">Enquire Now</a>
        </div>
    </section>

    <!-- CSS Styling -->
    <style>
        .all-festival-offer {
            background: url({{ asset('images/hero/slide5.jpg') }}) center center / cover no-repeat;
        }

        .subtitle {
            font-size: 1.4rem;
            font-weight: 600;
            color: snow;
            text-transform: uppercase;
        }

        .title {
            font-size: 2.5rem;
            font-weight: 700;
            color: goldenrod;
            margin-top: 10px;
        }

        .description {
            font-size: 1.1rem;
            color: white;
            max-width: 760px;
            margin: 0 auto;
        }

        /* Offer Cards */
        .offer-card {
            background: white;
            border-radius: 16px;
            padding: 25px 20px;
            border: 1px solid #d4af37;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
            height: 100%;
        }

        .offer-card:hover {
            transform: translateY(-6px);
        }

        .icon-circle {
            width: 70px;
            height: 70px;
            background-color: darkgoldenrod;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto;
        }

        /* Bounce Animation */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .bounce-anim {
            animation: bounce 2s infinite;
        }

        .bounce-anim.delay-1 {
            animation-delay: 0.2s;
        }

        .bounce-anim.delay-2 {
            animation-delay: 0.4s;
        }

        .text-gold {
            color: #D4AF37;
        }

        .btn-maroon {
            background-color: maroon;
            color: white;
            padding: 12px 28px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-maroon:hover {
            background-color: #800000;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .title {
                font-size: 2rem;
            }

            .description {
                font-size: 1rem;
            }

            .offer-card {
                margin-top: 20px;
            }
        }
    </style>


    <section id="about" class="about-section py-5">
        <div class="container px-4 px-md-5">
            <div class="row align-items-center g-5">

                <!-- Image Column -->
                <div class="col-lg-6 text-center" data-aos="fade-up">
                    <img src="{{ asset('images/hero/slide3.jpg') }}" alt="Ganpati Industries"
                        class="img-fluid rounded shadow w-100">
                </div>

                <!-- Text Column -->
                <div class="col-lg-6" data-aos="fade-up">
                    <h2 class="section-title mb-4">
                        About <span class="highlight">Ganpati Industries</span>
                    </h2>
                    <p class="about-description mb-4">
                        Based in Bikaner, Rajasthan, Ganpati Industries proudly crafts premium Soan Papdi using a blend of
                        traditional recipes and modern standards. With every bite, we promise unmatched taste, purity, and
                        quality.
                    </p>
                    <div data-aos="fade-up">
                        <a href="/about" class="btn btn-custom">Know More</a>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <section class="instagram-section py-5 bg-light">
        <div class="container">
            <div class="card border-0 rounded-4 shadow-lg p-4 d-flex flex-column flex-md-row align-items-center justify-content-between text-center text-md-start"
                style="background: linear-gradient(135deg, #fff7f7, #fffbea);">
                <div class="mb-3 mb-md-0">
                    <h2 class="fw-bold text-maroon mb-2">Connect with Us on Instagram</h2>
                    <p class="text-muted mb-0">Stay connected with us for the latest updates, exciting offers, and
                        delightful Soan Papdi moments!</p>
                </div>
                <div>
                    <a href="https://www.instagram.com/gisoanpapdi" target="_blank"
                        class="btn btn-maroon-glow px-4 py-2 rounded-pill d-inline-flex align-items-center">
                        <i class="fab fa-instagram me-2 fs-5"></i>@gisoanpapdi
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex">
        <iframe width="100%" height="300" frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d880.7903783200456!2d73.31983398410243!3d27.988954537050653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393fe799b643ba41%3A0x62eb352740f952bd!2sBikaneri%20Soan%20Papdi!5e0!3m2!1sen!2sin!4v1745147677976!5m2!1sen!2sin"
            allowfullscreen></iframe>
    </div>

    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: false
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endsection
