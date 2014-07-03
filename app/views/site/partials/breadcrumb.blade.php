<div class="breadcrumb-wrapper">
    <ol class="breadcrumb">
        <li><i class="fa fa-home"></i>&nbsp;<a href="{{ action('HomeController@index') }}">{{ Lang::get('site.nav.home') }}</a></li>
        @yield('breadcrumb')
        @include('site.partials.locale')
    </ol>
</div>