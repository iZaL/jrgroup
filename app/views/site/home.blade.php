@extends('site.master')

@section('style')
    @parent
@stop
@section('scripts')
    @parent
@stop

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-3">
        @include('site.partials.login')
        @include('site.partials.latest-courses')
        @include('site.partials.latest-news')
    </div>
    <div class="col-md-9 col-sm-9">
        @if(isset($event->photos))
            @if(count($event->photos))
            <a href="{{ action('EventsController@show',$event->id) }}" >
                {{ HTML::image('uploads/large/'.$event->photos[0]->name.'','image1',array('class'=>'img-responsive img-thumbnail')) }}
            </a>
            @endif
        @else
        <img class="img-responsive" src="http://placehold.it/800x500" alt=""/>
        @endif
    </div>
</div>
@stop