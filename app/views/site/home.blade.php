<!-- Extends From Two Column Layou -->
@extends('site.layouts._two_column')

@section('style')
    @parent
    <style>
    .image-home img {
        height:500px;
        width: 100%;
    }
    </style>
@stop

@section('sidebar')
    @include('site.partials.login')
    @parent
@stop

<!-- Content Section -->
@section('content')
    <div class="image-home">
        @if(isset($event->photos))
            @if(count($event->photos))
            <a href="{{ action('EventsController@show',$event->id) }}" >
                {{ HTML::image('uploads/large/'.$event->photos[0]->name.'','image1',array('class'=>'img-responsive img-thumbnail')) }}
            </a>
            @endif
        @else
        <div class="row">
            <div class="col-md-12">
                <img class="img-responsive" src="http://placehold.it/800x500" alt=""/>
                </br>
            </div>
        </div>
        @endif
    </div>

    @include('site.partials.ads')
@stop