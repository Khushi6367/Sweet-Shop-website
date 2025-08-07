<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganpati Industries</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .navbar .navbar-brand img {
            height: 80px;
            max-height: 100%;
            object-fit: contain;
            width: auto;
        }

        .navbar .form-control:focus {
            outline: none;
            box-shadow: none;
        }

        .navbar-nav .nav-link {
            color: maroon;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: goldenrod;
        }

        .user-icons a {
            color: maroon;
            font-weight: 500;
            transition: color 0.3s;
        }

        .user-icons a:hover {
            color: goldenrod;
        }

        @media (max-width: 991.98px) {
            #mainNavbar {
                margin: 10px;
                padding: 1rem;
            }

            .navbar-nav {
                text-align: center;
            }
        }

        /* whatsapp button */
        .whatsapp-button {
            position: fixed;
            bottom: 10px;
            left: 10px;
            background-color: green;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out;
        }

        .whatsapp-button img {
            width: 35px;
            height: 35px;
        }

        .whatsapp-button:hover {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .whatsapp-button {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }
        }

        #backToTop {
            position: fixed;
            bottom: 10px;
            right: 10px;
            width: 50px;
            height: 50px;
            background: goldenrod;
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: transform 0.3s ease-in-out;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        #backToTop:hover {
            background: white;
            color: maroon;
            transform: scale(1.1);

        }

        @media (max-width: 768px) {
            #backToTop {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }
        }

        /* footer */
        .footer {
            background-color: #800000;
            color: white;
        }

        .footer h2,
        .footer h5 {
            color: gold;
            font-weight: 500;
        }

        .footer .tagline {
            font-family: 'Times New Roman', Times, serif;
            font-style: italic;
        }

        .footer-link {
            color: white;
            text-decoration: none;
        }

        .footer-link:hover {
            color: goldenrod;
        }

        .footer ul {
            list-style: none;
        }

        .footer a i:hover {
            color: goldenrod;
        }


        .footer .border-top {
            border-color: white;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .footer h2 {
                font-size: 1.5rem;
            }

            .footer h5 {
                font-size: 1.1rem;
            }

            .footer .tagline {
                font-size: 0.85rem;
            }

            .footer p,
            .footer a {
                font-size: 0.85rem;
            }

            .footer .d-flex.gap-3,
            .footer .d-flex.gap-2 {
                justify-content: center !important;
            }

            .footer .container>.row {
                text-align: center;
            }
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container" style="max-width: 1440px;">
            <!-- Logo -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/Logo.png') }}" alt="Ganpati Industries">
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" id="navbarToggleBtn" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible Content -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <!-- Center Links -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/product/all">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                </ul>

                <!-- Right Side Content -->
                <div class="d-flex flex-column flex-lg-row align-items-center gap-3">
                    <!-- Search -->
                    <form action="/search" method="GET" class="d-flex">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="query" class="form-control border-0 shadow-sm"
                                placeholder="Search Products" value="{{ request('query') }}">
                            <button class="btn btn-danger" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Welcome -->
                    <div class="text-success text-center text-lg-start">
                        @guest
                            Welcome, Guest
                        @else
                            Welcome, <strong>{{ Auth::user()->name }}</strong>
                            @if (Auth::user()->is_admin)
                                <a href="/admin/dashboard" class="text-danger p-2">Dashboard</a>
                            @endif
                        @endguest
                    </div>

                    <!-- User Icons -->
                    <div class="user-icons d-flex align-items-center gap-3">
                        @guest
                            <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                            <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
                        @else
                            <a href="/wishlist" class="text-decoration-none">Wishlist</a>
                            <a href="/myorder" class="text-decoration-none">My Order</a>
                            <a href="/cart" class="text-decoration-none"><i class="fas fa-shopping-cart"></i></a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="text-decoration-none">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="text-center mb-4">
                <img src="/images/Logo.png" alt="Ganpati Industries Logo" class="footer-logo mb-2"
                    style="max-width: 150px;">
                <h2 class="mb-1">Ganpati Industries</h2>
                <p class="tagline">The Real Taste of Bikaner</p>
            </div>

            <div class="row text-center text-md-start gy-4">
                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/" class="footer-link">Home</a></li>
                        <li><a href="/about" class="footer-link">About Us</a></li>
                        <li><a href="/product/all" class="footer-link">Our Product</a></li>
                        <li><a href="/contact" class="footer-link">Bulk Order</a></li>
                        <li><a href="/contact" class="footer-link">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-3">Contact</h5>
                    <p class="mb-1"><strong>Address:</strong><br>Road No. 7, Industrial Area, Rani Bazar, Bikaner</p>
                    <p class="mb-1"><strong>Call:</strong> <a href="tel:+918239070019" class="footer-link">+91
                            8239070019</a></p>
                    <p class="mb-1"><strong>Email:</strong> <a href="mailto:gisoanpapdi@gmail.com"
                            class="footer-link">gisoanpapdi@gmail.com</a></p>
                    <p><strong>Working Hours:</strong> Mon–Sat: 10AM–6PM<br>Sunday: Closed</p>
                </div>

                <!-- Policies -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-3">Policies</h5>
                    <ul class="list-unstyled">
                        <li><a href="/privacy-policy" class="footer-link">Privacy Policy</a></li>
                        <li><a href="/shipping-policy" class="footer-link">Shipping Policy</a></li>
                        <li><a href="/return-refund-policy" class="footer-link">Return & Refund Policy</a></li>
                        <li><a href="/terms-and-conditions" class="footer-link">Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- Social & Certificates -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-3">Follow Us</h5>
                    <div class="d-flex justify-content-center justify-content-md-start gap-3 mb-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin fa-lg"></i></a>
                    </div>
                    <h5 class="mb-2">Certificates</h5>
                    <div class="d-flex justify-content-center justify-content-md-start gap-2">
                        <img src="https://upload.wikimedia.org/wikipedia/en/e/e2/FSSAI_logo.png" alt="FSSAI"
                            width="50" class="bg-light">
                        <img src="https://www.iihr.edu.in/wp-content/uploads/2020/02/MSME-Logo.png" alt="GSTIN"
                            width="50">
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="border-top pt-3 text-center">
                <p class="mb-0">&copy; 2025 <strong>Ganpati Industries</strong>. All Rights Reserved. Developed by
                    <strong>Axixa Technologies</strong>.
                </p>
            </div>
        </div>
    </footer>


    <button id="backToTop" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </button>

    <a href="https://wa.me/918239070019" target="_blank" class="whatsapp-button">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" />
    </a>

    <script>
        const backToTopButton = document.getElementById("backToTop");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                backToTopButton.style.opacity = "1";
                backToTopButton.style.visibility = "visible";
            } else {
                backToTopButton.style.opacity = "0";
                backToTopButton.style.visibility = "hidden";
            }
        });

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggler = document.getElementById('navbarToggleBtn');
            const navbar = document.getElementById('mainNavbar');

            toggler.addEventListener('click', () => {
                navbar.classList.toggle('show');
            });
        });
    </script>


    <script src="https://releases.jquery.com/git/jquery-git.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
