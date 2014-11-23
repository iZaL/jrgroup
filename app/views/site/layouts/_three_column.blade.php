@extends('site.layouts._two_column')

<div class="col-md-3 col-sm-3">
    @section('sidebar-right')
        @include('site.partials.login')
        @include('site.partials.latest-courses')
        @include('site.partials.latest-news')
        @include('site.partials.newsletter')
    @stop
</div>


    <div class="col-md-9 col-sm-9">
        @section('content')
        @stop
    </div>

<div class="col-md-3 col-sm-3">
    @section('sidebar-right')
    @include('site.partials.login')
    @include('site.partials.latest-courses')
    @include('site.partials.latest-news')
    @include('site.partials.newsletter')
</div>

