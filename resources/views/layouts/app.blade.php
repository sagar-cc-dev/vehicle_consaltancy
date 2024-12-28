<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{!! asset('front/css/bootstrap.min.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('front/css/font-awesome.min.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('front/css/elegant-icons.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('front/css/nice-select.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('front/css/magnific-popup.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('front/css/jquery-ui.min.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('front/css/owl.carousel.min.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('front/css/slicknav.min.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('css/star-rating-svg.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('front/css/style.css') !!}" type="text/css">
    @yield('styles')
</head>
<body>
    @include('shared.loader')

    @include('shared.header')

    @yield('content')

    @include('shared.footer')
    <!-- Js Plugins -->
    <script src="{!! asset('front/js/jquery-3.3.1.min.js') !!}"></script>
    <script src="{!! asset('front/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{!! asset('front/js/jquery.nice-select.min.js') !!}"></script>
    <script src="{!! asset('front/js/jquery-ui.min.js') !!}"></script>
    <script src="{!! asset('front/js/jquery.magnific-popup.min.js') !!}"></script>
    <script src="{!! asset('front/js/mixitup.min.js') !!}"></script>
    <script src="{!! asset('front/js/jquery.slicknav.js') !!}"></script>
    <script src="{!! asset('front/js/owl.carousel.min.js') !!}"></script>
    <script src="{!! asset('front/js/main.js') !!}"></script>
    <script src="{!! asset('js/jquery.star-rating-svg.js') !!}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery(document).on("click", "[data-confirm]", function(e) {
                e.preventDefault();
                var message = jQuery(this).data('confirm') ? jQuery(this).data('confirm') : 'Are you sure?';
                if (confirm(message)) {
                    var form = jQuery('<form />').attr('method', 'post').attr('action', jQuery(this).attr('href'));
                    message != "Are you sure want to logout?" ? jQuery('<input />').attr('type', 'hidden').attr('name', '_method').attr('value', 'delete').appendTo(form) : "";
                    jQuery('<input />').attr('type', 'hidden').attr('name', '_token').attr('value', jQuery('meta[name="csrf-token"]').attr('content')).appendTo(form);
                    jQuery('body').append(form);
                    form.submit();
                }
            });

            jQuery(".place_feedback").on("click",function(e){
                var _f = jQuery("#FeedbackForm");
                jQuery('#preloder, .loader').show();
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{!! route('feedback') !!}",
                    data: jQuery(_f).serialize(),
                })
                .done(function (data) {
                    jQuery('#preloder, .loader').hide();
                    jQuery("#FeedbackModel").modal('hide');
                }).fail(function (error) {
                    jQuery('#preloder, .loader').hide();
                    jQuery(_f).find(".has-error").remove();
                    var response = JSON.parse(error.responseText);
                    $.each(error.responseJSON, function (key, value) {
                            var input = '[name=' + key + ']';
                            jQuery(_f).find(input).parent().find(".has-error").length == 0 ? jQuery(_f).find(input).parent().append("<span class='has-error'>"+ value +"</span>") : jQuery(_f).find(input).parent().find('.has-error').html(value);
                    });
                });
            });

            $(".my-rating").starRating({
                initialRating: 4,
                strokeColor: '#894A00',
                strokeWidth: 10,
                starSize: 25,
                minRating: 1,
                callback: function(currentRating, $el){
                    $("#rateInput").val(currentRating);
                }
            });
        })
    </script>
    @yield('scripts')
</body>
</html>
