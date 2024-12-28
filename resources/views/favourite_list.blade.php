@extends('layouts.app')
@section('content')
    <!-- Breadcrumb End -->
    <div class="breadcrumb-option set-bg" data-setbg="{{ asset('front/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Favourite Vehical</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                            <span>Favourite Vehical</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Begin -->

    <!-- Car Section Begin -->
    <section class="car spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @forelse ($vehicals as $vehical)
                            <div class="col-lg-4 col-md-4">
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
                                            <h6>₹ {!! $vehical->price !!}</h6>
                                            <a class="favouriteVehical" data-href="{!! route('favourite.vehical',$vehical->id) !!}"><i class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <h5>No Vehical added in favourite list</h5>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Car Section End -->
@endsection
@section('scripts')
<script>
    jQuery(document).ready(function(){
        jQuery(".favouriteVehical").on("click",function(e){
            jQuery('#preloder, .loader').show();
            e.preventDefault();
            var url = jQuery(this).data('href');
            $.ajax({
                type: "GET",
                url: url,
            })
            .done(function (data) {
                console.log(data);
                jQuery('#preloder, .loader').hide();
            }).fail(function (error) {
                jQuery('#preloder, .loader').hide();
                console.log(error);
            });
        });
    });
</script>
@endsection
