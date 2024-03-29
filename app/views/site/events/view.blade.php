<!-- Extends From Two Column Layou -->
@extends('site.layouts._two_column')

@section('style')
    @parent
    {{ HTML::style('http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css') }}
    {{ HTML::style('css/bootstrap-image-gallery.min.css') }}
@stop

@section('script')
    @parent
    {{ HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAvY9Begj4WZQpP8b6IGFBACdnUhulMCok&sensor=false') }}
    {{ HTML::script('http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js') }}
    {{ HTML::script('js/bootstrap-image-gallery.js') }}
    {{ HTML::script('js/app.js') }}
    <script>
        var id = '<?php echo $event->id; ?>';

        function toggleTooltip(action) {
            switch (action) {
                case 'subscribe':
                    var ttip = '{{ trans('word.unsubscribe') }}'
                    $('.subscribe_btn')
                        .attr('title', ttip)
                        .tooltip('fixTitle');
                    break;
                case 'unsubscribe':
                    var ttip = '{{ trans('word.subscribe') }}'
                    $('.subsribe_btn')
                        .attr('title', ttip)
                        .tooltip('fixTitle');
                    break;
                default:
            }
        }

    </script>
    @if($event->latitude && $event->longitude)
        <script>
            var latitude = '<?php echo $event->latitude?>';
            var longitude = '<?php echo $event->longitude ?>';
            function initialize() {
                var myLatlng = new google.maps.LatLng(latitude, longitude);
                var mapOptions = {
                    zoom: 10,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map
                });

                // collapse the map div
                $('.collapse').collapse();
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
    @endif

@stop

<!-- Content Section -->
@section('content')
    @parent

    @include('site.partials.gallery-modal')

    <!-- sidecontent division -->

    <div class="row">
        <div class="col-md-7">
            <h1>
                {{ $event->title }}
            </h1>
        </div>

        <div class="col-md-5">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">

                    @if(!$eventExpired)
                        @if( !$subscribed)
                            {{ Form::open(['action' => 'SubscriptionsController@subscribe', 'method' => 'post'], ['class'=>'form']) }}
                                {{ Form::hidden('event_id',$event->id) }}
                                {{ Form::hidden('registration_type','VIP') }}
                                {{ Form::submit( trans('word.subscribe') , ['class'=>'btn btn-default btn-block']) }}
                            {{ Form::close() }}
                        @else
                            <a href="{{  URL::action('SubscriptionsController@unsubscribe', array('id'=>$event->id)) }}"/>
                                <button type="submit" class=" col-md-12 col-sm-12 col-xs-12 events_btns btn btn-default btn-sm subscribe_btn bg-blue "
                                    data-toggle="tooltip" data-placement="top" title="{{ trans('word.unsubscribe')  }}">
                                    <i class="subscribe glyphicon glyphicon-check active "></i>  </br>
                                    <span class="buttonText">
                                        {{  trans('word.unsubscribe')  }}
                                    </span>
                                </button>
                            </a>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
    <hr>
    @if(count($event->photos))
        <div class="row">
            <div id="links" class="event-images">
                @foreach($event->photos as $photo)
                    <a href="{{ asset('uploads/medium/'.$photo->name) }}" title="{{ $event->title }}" data-gallery>
                        {{ HTML::image('uploads/thumbnail/'.$photo->name.'',$photo->name,array('class'=>'img-responsive thumbnail-img')) }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="description">
                {{ $event->description }}
            </div>
            <hr>
            <table class="table table-striped">
                <tr>
                    <h4>{{ trans('word.description') }}</h4>
                </tr>

                @if($event->location)
                    <tr>
                        <td> <b>{{ trans('word.country') }} </b></td>
                        <td> {{ $event->location->country ? $event->location->country->name : '' }} </td>
                        <td> <b>{{ trans('word.location') }}</b></td>
                        <td> {{ $event->location->name }} </td>
                    </tr>
                @endif

                <tr>
                    <td><b>{{ trans('word.date_start') }}</b></td>
                    <td> {{ $event->formatEventDate($event->date_start) }}</td>
                    <td><b> {{ trans('word.date_end') }} </b></td>
                    <td> {{ $event->formatEventDate($event->date_end) }}</td>
                </tr>

                @if($event->phone || $event->email)
                    <tr>
                        @if($event->phone)
                            <td><b>{{ trans('word.phone') }}</b></td>
                            <td> {{ $event->phone }}</td>
                        @endif
                        @if($event->email)
                            <td><b>{{ trans('word.email') }}</b></td>
                            <td> {{ $event->email }}</td>
                        @endif
                    </tr>
                @endif
                <tr>
                    <td><b>{{ trans('word.price') }}</b></td>
                    <td>{{ $event->isFreeEvent() ? trans('word.free') : $event->convertPrice }}</td>
                </tr>
            </table>
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
            <b>{{ trans('word.address') }} </b>
            <address>
                <strong>
                    {{ $event->address }}
                    -
                    {{ $event->street }}
                </strong>
                <br>
                @if($event->phone)
                    <abbr title="Phone">Phone:</abbr>
                    {{ $event->phone }}
                @endif
            </address>
        </div>

    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            @if(count($event->comments) > 0)
                <h3><i class=" glyphicon glyphicon-comment"></i>&nbsp;{{trans('word.comment') }}</h3>
                @foreach($event->comments as $comment)
                    <div class="comments_dev">
                        <p>{{ $comment->content }}</p>
                        <p
                        @if ( App::getLocale() == 'en')
                            class="text-left text-primary"
                        @else
                            class="text-right text-primary"
                        @endif
                        >{{ $comment->user ?  $comment->user->username : ''}}
                        <span class="text-muted"> - {{ $comment->created_at }} </span></p>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-md-12">
            @if(Auth::User())
                {{ Form::open(array( 'action' => array('CommentsController@store', $event->id))) }}
                    {{ Form::hidden('commentable_id',$event->id)}}
                    {{ Form::hidden('commentable_type','EventModel')}}
                    <div class="form-group">
                        <label for="comment"></label>
                        <textarea type="text" class="form-control" id="content" name="content" placeholder="{{ trans('word.comment')}}"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default"> {{ trans('word.add_comment') }}</button>
                {{ Form::close() }}
            @endif
        </div>
    </div>

@stop