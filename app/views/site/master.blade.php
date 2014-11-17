<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | JR Group</title>
    <meta name="description" content="Jrgroup">
    <meta name="viewport" content="width=device-width, , initial-scale = 1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"/>
    @yield('meta')

    @section('style')
    <style>
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
        html,body {
            font-family: 'Droid Arabic Kufi' !important;
            background: #f5f5f5 !important;
        }
        h1,h2,h3,h4,span,p,div,table {
        font-family: 'Droid Arabic Kufi' !important;
        }
        </style>
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}
        @if ( App::getLocale() == 'ar')
            {{ HTML::style('css/bootstrap-rtl.min.css') }}
        @endif

        {{ HTML::style('css/custom.css') }}

        @if ( App::getLocale() == 'en')
            {{ HTML::style('css/custom-en.css') }}
        @endif
    @show

</head>
<body>
<div class="container">
    <!-- HEADER & NAV -->

    @include('site.partials.navigation')
    <!-- END OF HEADER -->
    @include('site.partials.notifications')
    <!-- CONTENT -->
    @include('site.partials.breadcrumb')

    {{ $content }}
    <!-- END OF CONTENT -->

    @include('site.layouts.footer')

    @section('script')
    <!-- Latest compiled and minified JavaScript -->
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/custom.js') }}
    @show
</div>
<!-- end of container -->
</body>
</html>