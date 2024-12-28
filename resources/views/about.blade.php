@extends('layouts.app')
@section('content')
<!-- Breadcrumb End -->
<div class="breadcrumb-option set-bg" data-setbg="{{ asset('front/img/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>About Us</h2>
                    <div class="breadcrumb__links">
                        <a href="{{ route('about') }}"><i class="fa fa-home"></i> Home</a>
                        <span>About Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Begin -->

<!-- About Us Section Begin -->
<section class="about spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title about-title">
                    <h2>Wellcome To HVSC Auto Online <br />We Provide Everything You Need To A Car</h2>
                    <p>First I will explain what contextual advertising is. Contextual advertising means the
                        advertising of products on a website according to<br /> the content the page is displaying.
                        For example if the content of a website was information on a Ford truck then the
                        advertisements</p>
                </div>
            </div>
        </div>
        <div class="about__feature">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="about__feature__item">
                        <img src="{{ asset('front/img/about/af-1.png') }}" alt="">
                        <h5>Quality Assurance System</h5>
                        <p>It seems though that some of the biggest problems with the internet advertising trends
                            are the lack of</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="about__feature__item">
                        <img src="{{ asset('front/img/about/af-2.png') }}" alt="">
                        <h5>Accurate Testing Processes</h5>
                        <p>Where do you register your complaints? How can you protest in any form against companies
                            whose</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="about__feature__item">
                        <img src="{{ asset('front/img/about/af-3.png') }}" alt="">
                        <h5>Infrastructure Integration Technology</h5>
                        <p>So in final analysis: it’s true, I hate peeping Toms, but if I had to choose, I’d take
                            one any day over an</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="about__pic">
                    <img src="{{ asset('front/img/about/about-pic.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="about__item">
                    <h5>Our Mission</h5>
                    <p>Now, I’m not like Robin, that weirdo from my cultural anthropology class; I think that
                        advertising is something that has its place in our society; which for better or worse is
                        structured along a marketplace economy. But, simply because I feel advertising has a right
                        to exist, doesn’t mean that I like or agree with it, in its</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="about__item">
                    <h5>Our Vision</h5>
                    <p>Where do you register your complaints? How can you protest in any form against companies
                        whose advertising techniques you don’t agree with? You don’t. And on another point of
                        difference between traditional products and their advertising and those of the internet
                        nature, simply ignoring internet advertising is </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us Section End -->

<!-- Call Section Begin -->
<section class="call spad set-bg" data-setbg="{{ asset('front/img/about/call-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="call__text">
                    <div class="section-title">
                        <h2>Request A Call Back</h2>
                        <p>Posters had been a very beneficial marketing tool because it had paved to deliver an
                            effective message that conveyed customer’s</p>
                    </div>
                    <a href="#">Contact Us</a>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1 col-md-6">
                <form action="{!! route('store.inquiry') !!}" method="post" class="call__form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" name="name" placeholder="Name*" required>
                        </div>
                        <div class="col-lg-6">
                            <input type="email" name="email" placeholder="Email*" required email>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" name="phone" placeholder="Phone*" required>
                        </div>
                        <div class="col-lg-6">
                            <select name="cateogry_id">
                                <option value="">Choose Our Vehical</option>
                                @foreach (App\Models\Category::pluck('name','id')->toArray() as $id => $name)
                                    <option value="{!! $id !!}">{!! $name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="site-btn">Submit Now</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Call Section End -->


<!-- Testimonial Section Begin -->
<section class="testimonial spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title testimonial-title">
                    <span>Testimonials</span>
                    <h2>What People Say About Us</h2>
                    <p>Our customers are our biggest supporters. What do they think of us? Lorem</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="testimonial__slider owl-carousel">
                <div class="col-lg-6">
                    <div class="testimonial__item">
                        <div class="testimonial__item__author">
                            <div class="testimonial__item__author__pic">
                                <img src="{{ asset('front/img/testimonial/testimonial-1.png') }}" alt="">
                            </div>
                            <div class="testimonial__item__author__text">
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <h5>John Smith /<span> CEO Colorlib</span></h5>
                            </div>
                        </div>
                        <p>For one thing they usually step all over the hedges and plants on the side of someone’s
                            house killing</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="testimonial__item">
                        <div class="testimonial__item__author">
                            <div class="testimonial__item__author__pic">
                                <img src="{{ asset('front/img/testimonial/testimonial-2.png') }}" alt="">
                            </div>
                            <div class="testimonial__item__author__text">
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <h5>Emma Sandoval /<span> Marketing Manager</span></h5>
                            </div>
                        </div>
                        <p>It seems though that some of the biggest problems with the internet advertising trends
                            are the lack of</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="testimonial__item">
                        <div class="testimonial__item__author">
                            <div class="testimonial__item__author__pic">
                                <img src="{{ asset('front/img/testimonial/testimonial-1.png') }}" alt="">
                            </div>
                            <div class="testimonial__item__author__text">
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <h5>John Smith /<span> CEO Colorlib</span></h5>
                            </div>
                        </div>
                        <p>For one thing they usually step all over the hedges and plants on the side of someone’s
                            house killing</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="testimonial__item">
                        <div class="testimonial__item__author">
                            <div class="testimonial__item__author__pic">
                                <img src="{{ asset('front/img/testimonial/testimonial-2.png') }}" alt="">
                            </div>
                            <div class="testimonial__item__author__text">
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <h5>Emma Sandoval /<span> Marketing Manager</span></h5>
                            </div>
                        </div>
                        <p>It seems though that some of the biggest problems with the internet advertising trends
                            are the lack of</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Section End -->

<!-- Counter Begin -->
<div class="counter spad set-bg" data-setbg="{{ asset('front/img/counter-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <h2 class="counter-num">1922</h2>
                    <p>Vehicles Stock</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <h2 class="counter-num">1500</h2>
                    <strong>+</strong>
                    <p>Vehicles Sale</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <h2 class="counter-num">1922</h2>
                    <p>Dealer Reviews</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter__item">
                    <h2 class="counter-num">5100</h2>
                    <p>Happy Clients</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Counter End -->

<!-- Clients Begin -->
<div class="clients spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title client-title">
                    <span>Partner</span>
                    <h2>Our Clients</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="client__item">
                    <img src="{{ asset('front/img/clients/client-1.png') }}" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="client__item">
                    <img src="{{ asset('front/img/clients/client-2.png') }}" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="client__item">
                    <img src="{{ asset('front/img/clients/client-3.png') }}" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="client__item">
                    <img src="{{ asset('front/img/clients/client-2.png') }}" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="client__item">
                    <img src="{{ asset('front/img/clients/client-4.png') }}" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="client__item">
                    <img src="{{ asset('front/img/clients/client-5.png') }}" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="client__item">
                    <img src="{{ asset('front/img/clients/client-6.png') }}" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="#" class="client__item">
                    <img src="{{ asset('front/img/clients/client-7.png') }}" alt="">
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Clients End -->
@endsection
