@extends('site.master')

@section('title')
    {{ $event->title }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-7">
            <h1>
                {{ LocaleHelper::getLocaled($event->title,$event->title_en) }}
            </h1>
        </div>

        <div class="col-md-5 {{ !Auth::user()? 'btns_disabled' :'' }}">

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <a href="{{ action('SubscriptionsController@subscribe',$event->id) }}">
                        <button
                            type="button" class="col-md-12 col-sm-12 col-xs-12 events_btns btn btn-default btn-sm subscribe_btn "
                            data-toggle="tooltip" data-placement="top" title="{{ $subscribed? Lang::get('site.event.unsubscribe') : Lang::get('site.event.subscribe')  }}">
                            <i class="subscribe glyphicon glyphicon-check {{ $subscribed? 'active' :'' ;}}"></i>  </br>
                            <span class="buttonText">{{ Lang::get('site.general.subscribe_btn_desc')}}</span></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <tr>
                    <h4>{{ Lang::get('site.event.summaryevent') }}</h4>
                </tr>
                <tr>
                    <td><b>{{ Lang::get('site.general.country') }} </b></td>
                    <td>
                        {{ LocaleHelper::getLocaled($event->location->country->name,$event->location->country->name_en) }}
                    </td>
                    <td><b>{{ Lang::get('site.general.location') }}</b></td>
                    <td>
                        {{ LocaleHelper::getLocaled($event->location->name,$event->location->name_en) }}
                    </td>
                </tr>
                <tr>
                    <td><b>{{ Lang::get('site.event.totalseats') }}</b></td>
                    <td> {{ $event->total_seats}}</td>
                    <td><b> {{ Lang::get('site.event.seatsavail') }} </b></td>
                    <td> {{ $event->available_seats}}</td>
                </tr>
                <tr>
                    <td><b>{{ Lang::get('site.event.date_start') }}</b></td>
                    <td> {{ $event->date_start->toFormattedDateString() }}</td>
                    <td><b> {{ Lang::get('site.event.date_end') }} </b></td>
                    <td> {{ $event->date_end->toFormattedDateString() }}</td>
                </tr>
                <tr>
                    <td><b>{{ Lang::get('site.event.time_start') }}</b></td>
                    <td> {{ $event->date_start->format('g a') }}</td>
                    <td><b> {{ Lang::get('site.event.time_end') }}</b></td>
                    <td> {{ $event->date_end->format('g a') }}</td>
                </tr>
                @if($event->phone || $event->email)
                <tr>
                    @if($event->phone)
                    <td><b>{{ Lang::get('site.general.phone') }}</b></td>
                    <td> {{ $event->phone }}</td>
                    @endif
                    @if($event->email)
                    <td><b>{{ Lang::get('site.general.email') }}</b> </td>
                    <td> {{ $event->email }}</td>
                    @endif
                </tr>
                @endif
                <tr>
                    <td><b>{{ Lang::get('site.event.price') }}</b></td>
                    @if($event->price)
                    <td>{{ $event->price }}</td>
                    @else
                    <td>{{ Lang::get('site.event.free') }}</td>
                    @endif
                </tr>
            </table>
        </div>

        <div class="col-md-12">
            <p>
                {{ LocaleHelper::getLocaled($event->description,$event->description_en) }}
            </p>
        </div>

        @if($event->latitude && $event->longitude)

        <div class="col-md-12">
            <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#map">
                <b><i class="glyphicon glyphicon-map-marker"></i> Show / Hide Map </b>
            </button>
            <div id="map" class="collapse in top10">
                <div id="map_canvas"></div>
            </div>
        </div>

        @endif
        <div class="col-md-12 top15">
            <b>{{ Lang::get('site.general.address') }} </b>
            <address>
                <strong>
                    {{ LocaleHelper::getLocaled($event->address,$event->address_en) }}
                        -
                    {{ LocaleHelper::getLocaled($event->street,$event->street_en) }}
                </strong>
                <br>
                @if($event->phone)
                    <abbr title="Phone">Phone:</abbr>
                    {{ $event->phone }}
                @endif
            </address>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <a href="{{ action('SubscriptionsController@subscribe',$event->id) }}">
                <button type="button" class="col-md-12 col-sm-12 col-xs-12 btn btn-default btn-sm subscribe_btn "
                        data-toggle="tooltip" data-placement="top" title="{{ $subscribed? Lang::get('site.event.unsubscribe') : Lang::get('site.event.subscribe')  }}">
                    <h2><i class="subscribe glyphicon glyphicon-check {{ $subscribed? 'active' :'' ;}}"></i>&nbsp;
                       {{ Lang::get('site.event.subscribe') }}
                    </h2></button>
            </a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            @if(count($event->comments) > 0)
            <h3> <i class=" glyphicon glyphicon-comment"></i>&nbsp;{{Lang::get('site.event.comment') }}</h3>
                @foreach($event->comments as $comment)
                    <div class="comments_dev">
                        <p>{{ $comment->content }}</p>
                        <p
                        @if ( LaravelLocalization::getCurrentLocaleName() == 'English')
                            class="text-left text-primary"
                        @else
                            class="text-right text-primary"
                        @endif
                        >{{ $comment->user->username}}
                        <span class="text-muted"> - {{ $comment->created_at->diffForHumans()}} </span></p>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-md-12">
            @if(Auth::User())
            {{ Form::open(array( 'action' => array('CommentsController@store', $event->id))) }}
            <div class="form-group">
                <label for="comment"></label>
                <textarea type="text"  class="form-control" id="content" name="content" placeholder="{{ Lang::get('site.event.comment')}}"></textarea>
            </div>
            <button type="submit" class="btn btn-default"> {{ Lang::get('site.event.addcomment') }}</button>
            {{ Form::close() }}
            @endif
            @if ($errors->any())
            <ul> {{ implode('', $errors->all('  <li class="error">:message</li> ')) }} </ul>
            @endif
        </div>
    </div>


@stop