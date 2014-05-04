@extends('site.layouts.home')
@section('maincontent')
<style>
    .padded {
        padding:0;
        margin:0 5px 0 5px;
    }
</style>
@include('site.layouts.search')
</br>
@if(count($events))
@foreach($events as $event)
<div class="row">
    <div class="col-sm-2 col-md-2">
        <div id="links">
            @if(count($event->photos))
            <a href="{{ action('EventsController@show',$event->id) }}" >
                {{ HTML::image('uploads/thumbnail/'.$event->photos[0]->name.'','image1',array('class'=>'img-responsive img-thumbnail')) }}
            </a>
            @else
            <a href="{{ action('EventsController@show',$event->id) }}">
                <img src="http://placehold.it/70x70" class="img-thumbnail">
            </a>
            @endif
        </div>
    </div>
    <div class="col-sm-10 col-md-10">
                <span class="event-title">
                    <a href="event/{{$event->id}}">
                        @if ( LaravelLocalization::getCurrentLocaleName() == 'English')
                        @if($event->description_en)
                        {{ $event->title_en }}
                        @else
                        {{ $event->title }}

                        @endif
                        @else
                        {{ $event->title }}
                        @endif
                    </a>
                </span>

        <p>
            @if ( LaravelLocalization::getCurrentLocaleName() == 'English')

            @if($event->description_en)
            {{ Str::limit($event->description, 150) }}
            @else
            {{ $event->description }}
            @endif
            @else
            {{ Str::limit($event->description, 150) }}
            @endif
            <a href="event/{{ $event->id}}">{{ Lang::get('site.general.more')}}</a>
        </p>

    </div>
</div>

<div class="row" style="margin: 9px; ">

    <i class="glyphicon glyphicon-user">
        {{ link_to_action('EventsController@index', $event->author->username,array('search'=>'','author'=>$event->author->id))  }}
        |</i>
    <i class="glyphicon glyphicon-calendar"></i> {{ $event->date_start->format('Y-m-d')}} -
    {{ $event->date_end->format('Y-m-d')}} |

    <i class="glyphicon glyphicon-globe">
        @if ( LaravelLocalization::getCurrentLocaleName() == 'English')
            <?php $country =  ($event->location->country->name_en) ? $event->location->country->name_en : $event->location->country->name ;?>
            <?php $category =  ($event->category->name_en) ? $event->category->name_en : $event->category->name ;?>
        @else
            <?php $country =  ($event->location->country->name) ? $event->location->country->name : $event->location->country->name_en ;?>
            <?php $category =  ($event->category->name) ? $event->category->name : $event->category->name_en ;?>
        @endif
        {{ link_to_action('EventsController@index', $country ,array('search'=>'','country'=>$event->location->country->id))  }}
        |</i>
    @if ( LaravelLocalization::getCurrentLocaleName() == 'English')
    <i class="glyphicon glyphicon-tag"></i>&nbsp;&nbsp;
    {{ link_to_action('EventsController@index', $event->category->name_en,array('search'=>'','category'=>$event->category->id))  }}
    @else
    <i class="glyphicon glyphicon-tag"></i>&nbsp;&nbsp;
    {{ link_to_action('EventsController@index', $category,array('search'=>'','category'=>$event->category->id))  }}
    @endif</div>
<hr>
@endforeach
<?php echo $events->appends(Request::except('page'))->links(); ?>
@else
<h1> No Events Returned </h1>
@endif
@stop
