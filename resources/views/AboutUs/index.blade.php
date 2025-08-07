@extends('layouts.base')

@section('content')
    <style>
        .about-section {
            padding: 50px 15px;
        }

        .about-section h1,
        .about-section h2 {
            color: #800000;
            font-weight: 700;
        }

        .about-section p {
            font-size: 1.05rem;
            line-height: 1.8;
        }

        .logo-img {
            max-width: 160px;
            border-radius: 12px;
            padding: 5px;
        }

        .card-custom {
            background: white;
            border: none;
            border-left: 5px solid #d4af37;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(128, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 25px rgba(128, 0, 0, 0.2);
        }

        .icon {
            color: #d4af37;
            margin-right: 12px;
            font-size: 1.4rem;
        }

        .section-title {
            margin-top: 40px;
            margin-bottom: 20px;
        }

        a {
            color: #800000;
            font-weight: 500;
        }

        a:hover {
            color: #d4af37;
        }

        .certificate-img {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: cover;
            border-radius: 15px;
            border: 2px solid gold;
        }

        @media (max-width: 768px) {
            .card-custom {
                padding: 20px;
            }

            .logo-img {
                max-width: 120px;
            }

            .certificate-img {
                max-height: 300px;
            }
        }
    </style>

    <div class="container about-section">
        <div class="text-center">
            <img src="{{ asset('images/L    ogo.png') }}" alt="Company Logo" class="logo-img mb-3">
            <h1 class="fw-bold">Ganpati Industries</h1>
            <p class="lead text-muted">Manufacturer of Soan Papdi</p>
        </div>

        <div class="row mt-5">
            <div class="col-lg-6 col-md-12">
                <div class="card-custom">
                    <h2><i class="fas fa-history icon"></i>Our Journey</h2>
                    <p>Founded in 2014 by Ramavtar Panwar, Ganpati Industries started with a vision to deliver the finest
                        Soan Papdi with the authentic taste of Bikaner. Today, we’re known for our purity, quality, and
                        unmatched consistency.</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card-custom">
                    <h2><i class="fas fa-bullseye icon"></i>Mission & Vision</h2>
                    <p>We aim to blend tradition with innovation. Our mission is to serve 100% natural, high-quality Soan
                        Papdi globally while staying affordable and authentic to our roots.</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6 col-md-12">
                <div class="card-custom">
                    <h2><i class="fas fa-box icon"></i>Our Products</h2>
                    <p>We manufacture and wholesale premium Bikaneri Soan Papdi, using only the finest ingredients. Each
                        bite reflects our passion and dedication to excellence.</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card-custom">
                    <h2><i class="fas fa-users icon"></i>Our Customers</h2>
                    <p>We proudly serve sweet shop owners, distributors, and corporate clients who value authentic Indian
                        sweets with traditional roots and modern quality standards.</p>
                </div>
            </div>
        </div>

        <div class="text-center section-title">
            <h2><i class="fas fa-trophy icon"></i>Achievements & Uniqueness</h2>
            <p>What makes us unique is our commitment to traditional handmade processes and natural ingredients, ensuring
                exceptional taste, texture, and freshness in every product.</p>
        </div>

        <div class="container my-5">
            <div class="text-center">
                <h2 class="fw-bold" style="color: #800000;"><i class="fas fa-award icon"></i> Our Certifications</h2>
                <p class="lead text-muted">We are proudly certified for food safety, quality, and compliance.</p>
            </div>

            <div class="row mt-4">
                <!-- FSSAI Certification -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-custom text-center">
                        <h4>FSSAI Certificate</h4>
                        <img src="https://img.freepik.com/premium-vector/certificate-template-design-a4-size_35986-453.jpg"
                            alt="FSSAI Certificate" class="certificate-img mt-2">
                        <p class="mt-2"><strong>FSSAI No:</strong> 12224017000443</p>
                    </div>
                </div>

                <!-- GST Certification -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-custom text-center">
                        <h4>GST Certificate</h4>
                        <img src="https://img.freepik.com/premium-vector/certificate-template-design-a4-size_35986-453.jpg"
                            alt="GST Certificate" class="certificate-img mt-2">
                        <p class="mt-2"><strong>GSTIN:</strong> 08AOZPP3505Q1ZX</p>
                    </div>
                </div>

                <!-- MSME Certification -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card-custom text-center">
                        <h4>MSME Certificate</h4>
                        <img src="https://img.freepik.com/premium-vector/certificate-template-design-a4-size_35986-453.jpg"
                            alt="MSME Certificate" class="certificate-img mt-2">
                        <p class="mt-2"><strong>MSME No:</strong> [Your MSME Number]</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center section-title">
            <h2><i class="fas fa-address-book icon"></i>Contact Information</h2>
            <p>
                <strong>Address:</strong> Road Number 7, Industrial Area, Rani Bazar, Bikaner - 334001, Rajasthan, India<br>
                <strong>Phone:</strong>
                <a href="tel:+916367600234"><i class="fas fa-phone icon"></i>+91 6367600234</a>,
                <a href="tel:+919413936555"><i class="fas fa-phone icon"></i>+91 9413936555</a><br>
                <strong>Email:</strong> <a href="mailto:gisoanpapdi@gmail.com"><i
                        class="fas fa-envelope icon"></i>gisoanpapdi@gmail.com</a><br>
                <strong>GSTIN:</strong> 08AOZPP3505Q1ZX<br>
                <strong>FSSAI:</strong> 12224017000443<br>
                <strong>Follow Us:</strong>
                <a href="#"><i class="fab fa-facebook icon"></i>Facebook</a> |
                <a href="#"><i class="fab fa-instagram icon"></i>Instagram</a>
            </p>
        </div>
    </div>
@endsection
