<!-- Extends From Two Column Layou -->
@extends('site.layouts._two_column')

@section('sidebar')
    @include('site.partials.login')
    @parent
@stop

<!-- Content Section -->
@section('content')
    <div class="row">
        @include('site.partials.ads')
    </div>
@stop