@extends('layouts.base')
@section('content')
    <style>
        .text-maroon {
            color: maroon;
        }

        .btn-success {
            padding: 10px 20px;
            border: none;
            width: 100%;
        }


        .social-icon {
            font-size: 24px;
            margin-right: 15px;
            color: #800000;
            text-decoration: none;
        }

        .social-icon:hover {
            color: goldenrod;
        }

        @media (max-width: 768px) {
            .btn-success {
                padding: 8px 15px;
            }

            .contact-us-section .row {
                flex-direction: column;
            }
        }
    </style>

    <section class="contact-us-section py-5">
        <div class="container">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @foreach ($errors->all() as $er)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $er }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
            <div class="row align-items-start">
                <div class="col-lg-6 col-md-12">
                    <h2 class="text-maroon mb-4">Get in Touch</h2>
                    <p class="text-maroon">We would love to hear from you! Please fill out the form below and we will get
                        back to you as soon as possible.</p>
                    <form action="/contact/store" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name" id="name"
                                name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <div class="input-group">
                                <span class="input-group-text">+91</span>
                                <input id="mobile" type="text" class="form-control" name="mobile"
                                    value="{{ old('mobile') }}" required maxlength="10" placeholder="Enter Mobile Number">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Enter Email" id="email"
                                name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="enquiry_type" class="form-label">Select Enquiry Type</label>
                            <select class="form-select" id="enquiry_type" name="enquiry_type" required>
                                <option value="">Select Enquiry Type</option>
                                <option value="bulk_order">Bulk Order</option>
                                <option value="corporate_gifting">Corporate Gifting</option>
                                <option value="dealership">Dealership & Franchise</option>
                                <option value="feedback">Complaints & Feedback</option>
                                <option value="delivery">Delivery Information</option>
                                <option value="manufacturing">Manufacturing</option>
                                <option value="wholesale">Wholesale</option>
                                <option value="careers">Careers</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" placeholder="Message" name="message" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
                <div class="col-lg-6 col-md-12 mt-4 mt-lg-0">
                    <h2 class="text-maroon mb-4">Business Information</h2>
                    <h5 class="text-maroon mt-4">Ganpati Industries</h5>
                    <p class="text-maroon">Road Number 7, Industrial Area, Rani Bazar, Bikaner - 334001, Rajasthan, India
                    </p>
                    <h5 class="text-maroon mt-4">Online Order Enquiry:</h5>
                    <a href="tel:6367600234" class="text-decoration-none text-maroon"><i
                            class="fas fa-phone contact-icon"></i> 6367600234 </a> <br>
                    <a href="tel:9413936555" class="text-decoration-none text-maroon"><i
                            class="fas fa-phone contact-icon"></i> 9413936555 </a> <br>
                    <a href="mailto:gisoanpapdi@gmail.com" class="text-decoration-none text-maroon"><i
                            class="fas fa-envelope contact-icon"></i> gisoanpapdi@gmail.com </a>
                    <div class="social-icon mt-4">
                        <h5 class="text-maroon">Follow Us On:</h5>
                        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-x-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                    <div class="mt-4">
                        <iframe width="100%" height="300" frameborder="0" style="border:0"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d880.7903783200456!2d73.31983398410243!3d27.988954537050653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393fe799b643ba41%3A0x62eb352740f952bd!2sBikaneri%20Soan%20Papdi!5e0!3m2!1sen!2sin!4v1745147677976!5m2!1sen!2sin"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var mobile = document.getElementById("mobile").value;
            var email = document.getElementById("email").value;
            var enquiry = document.getElementById("enquiry_type").value;
            if (!name || !mobile || !email || !enquiry) {
                alert("Please fill all required fields");
                return false;
            }
            return true;
        }
    </script>
@endsection
