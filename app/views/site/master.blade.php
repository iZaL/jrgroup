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

        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}

        @if ( App::getLocale() == 'ar')
            {{ HTML::style('css/bootstrap-rtl.min.css') }}
        @endif
        <style>
            @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
            body {
                font-family: 'Droid Arabic Kufi','Noto Sans Lao UI', serif;
                background: rgb(227,33,21); /* Old browsers */
                background: -moz-linear-gradient(top,  rgba(227,33,21,1) 0%, rgba(114,11,11,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(227,33,21,1)), color-stop(100%,rgba(114,11,11,1))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  rgba(227,33,21,1) 0%,rgba(114,11,11,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  rgba(227,33,21,1) 0%,rgba(114,11,11,1) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  rgba(227,33,21,1) 0%,rgba(114,11,11,1) 100%); /* IE10+ */
                background: linear-gradient(to bottom,  rgba(227,33,21,1) 0%,rgba(114,11,11,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e32115', endColorstr='#720b0b',GradientType=0 ); /* IE6-9 */
            }
            h1,h2,h3,h4,span,p,div,table {
                font-family: 'Droid Arabic Kufi' !important;
            }
            .container {
                background-color: white;
            }
        </style>

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