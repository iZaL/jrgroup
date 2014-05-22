@extends('site.layouts._one_columns_right_sidebar')

@section('style')
    @parent
@stop
@section('scripts')
    @parent
@stop

@section('content')
<div class="row">
    @foreach($events as $event)
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail gallery">
            @if(count($event->photos))
            <a href="{{ action('EventsController@show',$event->id) }}" >
                {{ HTML::image('uploads/medium/'.$event->photos[0]->name.'','image1',array('class'=>'img-responsive img-thumbnail')) }}
            </a>
            @else
            <a href="{{ action('EventsController@show',$event->id) }}">
                <img src="http://placehold.it/350x310" class="img-responsive img-thumbnail" >
            </a>
            @endif
            <div class="caption">
                <p class="text-center">
                    <a href="{{ action('EventsController@show',$event->id) }}" >
                        {{ App::make('Acme\\Services\\LangHelper')->getLocaled($event->title,$event->title_en) }}
                    </a>
                </p>
                <a href="#" class="pull-right"><span class="glyphicon glyphicon-camera"></span>

                    {{ $event->date_start->format('Y m D') }}
                </a>
                <a href="#" class="pull-left"><span class="glyphicon glyphicon-camera"></span>
                    K.D 345
                </a>
            </div>
        </div>
    </div>
    @endforeach
    <?php echo $events->appends(Request::except('page'))->links(); ?>
</div>
@stop