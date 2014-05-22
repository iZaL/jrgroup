<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | JR Group</title>
    <meta name="description" content="Jrgroup">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
    @yield('meta')

    @section('style')
    {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') }}

    @if ( LaravelLocalization::getCurrentLocaleName() == 'Arabic')
        {{-- HTML::style('css/bootstrap-rtl.min.css') --}}
        {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.1.2/css/bootstrap-rtl.min.css') }}
    @endif
    {{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css') }}
    {{ HTML::style(asset('css/custom.css')) }}
    <style type="text/css">
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
        body {
            font-family: 'Droid Arabic Kufi', serif;
        }
    </style>
    @show

</head>
<body>
<div class="container">
    <!-- HEADER & NAV -->

    @include('site.partials.nav')
    <!-- END OF HEADER -->
    @include('site.partials.notifications')
    <!-- CONTENT -->
    @section('content')

    @show
    <!-- END OF CONTENT -->

    @include('site.layouts.footer')

    @section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js') }}
    {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js') }}
    <!-- <script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script> -->
    @show
</div>
<!-- end of container -->
</body>
</html>