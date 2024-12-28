@extends('layouts.app')
@section('content')
<!-- Hero Section Begin -->
<section class="hero spad set-bg" data-setbg="{!! asset('front/img/hero-bg.jpg') !!}">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="hero__text">
                    <div class="hero__text__title">
                        <span>FIND YOUR DREAM CAR</span>
                        <h2>Porsche Cayenne S</h2>
                    </div>
                    <div class="hero__text__price">
                        <div class="car-model">Model 2019</div>
                        <h2>₹2 CR</h2>
                    </div>
                    <a href="{!! route('vehicals.list') !!}" class="primary-btn"><img src="{!! asset('front/img/wheel.png') !!}" alt=""> Test Drive</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero__tab">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-2" role="tabpanel">
                            <div class="hero__tab__form">
                                <h2>Search Your Dream</h2>
                                <form action="{!! route('vehicals.list') !!}" method="GET">
                                    <div class="select-list">
                                        <div class="select-list-item">
                                            <p>Select Category</p>
                                            <select id="CategoryId" name="category_id">
                                                <option data-display=" " value="">Select</option>
                                                @foreach (App\Models\Category::pluck('name','id')->toArray() as $id => $name)
                                                    <option value="{!! $id !!}">{!! $name !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Brand</p>
                                            <select id="BrandId" name="brand_id">
                                                <option data-display=" " value="">Select</option>
                                                @foreach (App\Models\Brand::pluck('name','id')->toArray() as $id => $name )
                                                <option value="{!!  $id  !!}">{!!  $name !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Model</p>
                                            <select id="ModelId" name="model_id">
                                                <option data-display=" " value="">Select</option>
                                                @foreach (App\Models\VehicalModel::pluck('name','id')->toArray() as $id => $name )
                                                <option value="{!!  $id  !!}">{!!  $name !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Select Year</p>
                                            <select id="year" name="year">
                                                <option data-display=" " value="">Select</option>
                                                @for ($i=0;$i < 23;$i++)
                                                    <option>{!! Carbon\Carbon::now()->subYear($i)->format('Y') !!}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="car-price">
                                        <p>Price Range:</p>
                                        <div class="price-range-wrap">
                                            <div class="price-range"></div>
                                            <div class="range-slider">
                                                <div class="price-input">
                                                    <input type="text" id="amount" name="price">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="site-btn">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Services</span>
                    <h2>What We Offers</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('front/img/services/services-1.png') }}" alt="">
                    <h5>Selling A Vehicals</h5>
                    <p>Consectetur adipiscing elit incididunt ut labore et dolore magna aliqua. Risus commodo
                        viverra maecenas.</p>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('front/img/services/services-2.png') }}" alt="">
                    <h5>Buying A Vehicals</h5>
                    <p>Consectetur adipiscing elit incididunt ut labore et dolore magna aliqua. Risus commodo
                        viverra maecenas.</p>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('front/img/services/services-3.png') }}" alt="">
                    <h5>Vehical Maintenance</h5>
                    <p>Consectetur adipiscing elit incididunt ut labore et dolore magna aliqua. Risus commodo
                        viverra maecenas.</p>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('front/img/services/services-4.png') }}" alt="">
                    <h5>Support 24/7</h5>
                    <p>Consectetur adipiscing elit incididunt ut labore et dolore magna aliqua. Risus commodo
                        viverra maecenas.</p>
                    <a href="{!! route('contact') !!}"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<!-- Feature Section Begin -->
<section class="feature spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="feature__text">
                    <div class="section-title">
                        <span>Our Feature</span>
                        <h2>We Are a Trusted Name In Auto</h2>
                    </div>
                    <div class="feature__text__desc">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo
                            viverra maecenas accumsan lacus vel facilisis.</p>
                    </div>
                    <div class="feature__text__btn">
                        <a href="{!! route('about') !!}" class="primary-btn">About Us</a>
                        <a href="{!! route('about') !!}" class="primary-btn partner-btn">Our Partners</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-4">
                <div class="row">
                    <div class="col-lg-6 col-md-4 col-6">
                        <div class="feature__item">
                            <div class="feature__item__icon">
                                <img src="{{ asset('front/img/feature/feature-1.png') }}" alt="">
                            </div>
                            <h6>Engine</h6>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 col-6">
                        <div class="feature__item">
                            <div class="feature__item__icon">
                                <img src="{{ asset('front/img/feature/feature-2.png') }}" alt="">
                            </div>
                            <h6>Turbo</h6>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 col-6">
                        <div class="feature__item">
                            <div class="feature__item__icon">
                                <img src="{{ asset('front/img/feature/feature-3.png') }}" alt="">
                            </div>
                            <h6>Colling</h6>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 col-6">
                        <div class="feature__item">
                            <div class="feature__item__icon">
                                <img src="{{ asset('front/img/feature/feature-4.png') }}" alt="">
                            </div>
                            <h6>Suspension</h6>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 col-6">
                        <div class="feature__item">
                            <div class="feature__item__icon">
                                <img src="{{ asset('front/img/feature/feature-5.png') }}" alt="">
                            </div>
                            <h6>Electrical</h6>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 col-6">
                        <div class="feature__item">
                            <div class="feature__item__icon">
                                <img src="{{ asset('front/img/feature/feature-6.png') }}" alt="">
                            </div>
                            <h6>Brakes</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Feature Section End -->

<!-- Car Section Begin -->
<section class="car spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Vehicle</span>
                    <h2>Best Vehicle Offers</h2>
                </div>
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Most Popular</li>
                    <li data-filter=".sale">Latest on sale</li>
                </ul>
            </div>
        </div>
        <div class="row car-filter">
            @foreach (App\Models\Vehical::orderByDesc('created_at')->limit(8)->get() as $vehical)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {!! !$vehical->status ? 'sale' : '' !!}">
                    <div class="car__item">
                        <div class="car__item__pic__slider owl-carousel">
                            @foreach ($vehical->gallery as $photo)
                                <img src="{{ $photo->file_url('thumb') }}" alt="">
                            @endforeach
                        </div>
                        <div class="car__item__text">
                            <div class="car__item__text__inner">
                                <div class="label-date">{!! $vehical->year !!}</div>
                                <h5><a href="{!! route('vehical.show',$vehical->slug) !!}">{!! $vehical->title !!}</a></h5>
                                <ul>
                                    <li><span>{!! $vehical->color !!}</span></li>
                                    <li>{!! App\Models\Vehical::$fules[$vehical->fuel] !!}</li>
                                    <li><span>{!! $vehical->mileage !!}</span> km</li>
                                </ul>
                            </div>
                            <div class="car__item__price">
                                <span class="car-option">{!! $vehical->status ? "Sold" : "For sale" !!}</span>
                                <h6>₹{!! $vehical->price !!}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Car Section End -->

<!-- Chooseus Section Begin -->
<section class="chooseus spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="chooseus__text">
                    <div class="section-title">
                        <h2>Why People Choose Us</h2>
                        <p>Duis aute irure dolorin reprehenderits volupta velit dolore fugiat nulla pariatur
                            excepteur sint occaecat cupidatat.</p>
                    </div>
                    <ul>
                        <li><i class="fa fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit.</li>
                        <li><i class="fa fa-check-circle"></i> Integer et nisl et massa tempor ornare vel id orci.
                        </li>
                        <li><i class="fa fa-check-circle"></i> Nunc consectetur ligula vitae nisl placerat tempus.
                        </li>
                        <li><i class="fa fa-check-circle"></i> Curabitur quis ante vitae lacus varius pretium.</li>
                    </ul>
                    <a href="#" class="primary-btn">About Us</a>
                </div>
            </div>
        </div>
    </div>
    <div class="chooseus__video set-bg">
        <img src="{{ asset('front/img/chooseus-video.png') }}" alt="">
        <a href="https://www.youtube.com/watch?v=Xd0Ok-MkqoE"
            class="play-btn video-popup"><i class="fa fa-play"></i></a>
    </div>
</section>
<!-- Chooseus Section End -->
@endsection
@section('scripts')
<script>
    var fetchData = "{!! route('fetchData') !!}";
    jQuery(document).ready(function() {
        $(document).on('change','#CategoryId', function() {
            var id = $(this).val();
            $.ajax({
                url: fetchData,
                type: "GET",
                data: {
                    id: id,
                    type: "brand"
                },
                success: function (response) {
                    $('#BrandId').html(response);
                    $('#BrandId').niceSelect('update');
                }
            });
        });

        $(document).on('change','#BrandId', function() {
            var id = $(this).val();
            $.ajax({
                url: fetchData,
                type: "GET",
                data: {
                    id: id,
                    type: "model"
                },
                success: function (response) {
                    $('#ModelId').html(response);
                    $('#ModelId').niceSelect('update');
                }
            });
        });
    });
</script>
@endsection
