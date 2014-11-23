@extends('site.layouts._two_column')

@section('breadcrumb')
    <li class="active">{{ Lang::get('word.events') }}</li>
@stop

@section('content')
<div class="row">
    @foreach($events as $event)
    <div class="col-sm-6 col-md-6">
        <div class="thumbnail gallery">
            @if(count($event->photos))
            <a href="{{ action('EventsController@show',$event->id) }}" >
                {{ HTML::image('uploads/medium/'.$event->photos[0]->name.'','image1',array('class'=>'img-responsive img-thumbnail')) }}
            </a>
            @else
            <a href="{{ action('EventsController@show',$event->id) }}">
                <img src="http://placehold.it/350x315" class="img-responsive img-thumbnail" >
            </a>
            @endif
            <div class="caption">
                <p class="text-center">
                    <a href="{{ action('EventsController@show',$event->id) }}" >
                        {{ Str::limit(strip_tags($event->title),25) }}
                    </a>
                </p>
                <a href="#" class="pull-right"><span class="glyphicon glyphicon-camera"></span>
                    {{ $event->date_start->format('Y m D') }}
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
<?php echo $events->appends(Request::except('page'))->links(); ?>
@stop