@extends('layouts.app')
@section('content')
    <!-- Breadcrumb End -->
    <div class="breadcrumb-option set-bg" data-setbg="{{ asset('front/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Begin -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <h2>Let’s Work Together</h2>
                            <p>To make requests for further information, contact us via our social channels.</p>
                        </div>
                        <ul>
                            <li><span>Email</span> hvsc65@gmail.com</li>
                            <li><span>Contact</span> +91 9865896636</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email" required email>
                                </div>
                            </div>
                            <input type="text" placeholder="Subject" required>
                            <textarea placeholder="Your Question"></textarea>
                            <button type="submit" class="site-btn">Submit Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Contact Address Begin -->
    <div class="contact-address">
        <div class="container">
            <div class="contact__address__text">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact__address__item">
                            <h4>Thaltej Showroom(Home Branch)</h4>
                            <p>605 Titenium Square, Ahmedabad, Gujarat, India india.gujarat@gmail.com</p>
                            <span>(+91) 756 678 9100</span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact__address__item">
                            <h4>New York Showroom</h4>
                            <p>8235 South Ave. Jamestown, NewYork Colorlib.Newyork@gmail.com</p>
                            <span>(+12) 456 678 9100</span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact__address__item">
                            <h4>Florida Showroom</h4>
                            <p>497 Beaver Ridge St. Daytona Beach, Florida Colorlib.california@gmail.com</p>
                            <span>(+12) 456 678 9100</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Address End -->
@endsection
