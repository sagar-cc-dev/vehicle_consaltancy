<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__widget">
    </div>
    <div class="offcanvas__logo">
        <a href="{!! route('home') !!}"><img src="{!! asset('front/img/logo.png') !!}" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <ul class="offcanvas__widget__add">
        <li><i class="fa fa-clock-o"></i> Week day: 08:00 am to 18:00 pm</li>
        <li><i class="fa fa-envelope-o"></i> HVSC@gmail.com</li>
    </ul>
    <div class="offcanvas__phone__num">
        <i class="fa fa-phone"></i>
        <span>(91 + 9157541292)</span>
    </div>
    <div class="offcanvas__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-google"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <ul class="header__top__widget">
                        <li><i class="fa fa-clock-o"></i> Week day: 08:00 am to 18:00 pm</li>
                        <li><i class="fa fa-envelope-o"></i> hvsc@gmail.com</li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="header__top__right">
                        <div class="header__top__phone">
                            <i class="fa fa-phone"></i>
                            <span>(91+ 9157541292) </span>
                        </div>
                        <div class="header__top__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="{!! route('home') !!}"><img src="{!! asset('front/img/logo.png') !!}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="header__nav">
                    <nav class="header__menu">
                        <ul>
                            <li class="{!! request()->route()->getName() == "home" ? "active" : "" !!}"><a href="{!! route('home') !!}">Home</a></li>
                            <li class="{!! request()->route()->getName() == "vehicals.list" ? "active" : "" !!}"><a href="{!! route('vehicals.list') !!}">Vehicals</a></li>
                            <li class="{!! request()->route()->getName() == "about" ? "active" : "" !!}"><a href="{!! route('about') !!}">About</a></li>
                            <li class="{!! request()->route()->getName() == "contact" ? "active" : "" !!}"><a href="{!! route('contact') !!}">Contact</a></li>
                        </ul>
                    </nav>
                    <div class="header__nav__widget">
                        @if(Auth::check())
                        <div class="dropdown show">
                            <a class="btn primary-btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {!! Auth::user()->first_name !!}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <a href="{!! route('profile') !!}" class="dropdown-item">Profile</a>
                              <a href="{!! route('favourite.list') !!}" class="dropdown-item">Favourite Vehical</a>
                              <a href="{!! route('logout') !!}" class="dropdown-item" data-confirm="Are you sure want to logout?">Sign Out</a>
                            </div>
                          </div>
                        @else
                            <a href="{!! route('login') !!}" class="primary-btn">Sign In</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <span class="fa fa-bars"></span>
        </div>
    </div>
</header>
<!-- Header Section End -->
