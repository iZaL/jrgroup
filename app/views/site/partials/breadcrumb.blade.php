<div class="breadcrumb-wrapper">
    <ol class="breadcrumb">
        <li><i class="fa fa-home"></i>&nbsp;<a href="{{ action('HomeController@index') }}">{{ trans('word.home') }}</a></li>
        @yield('breadcrumb')
        @include('site.partials.locale')
    </ol>
</div>