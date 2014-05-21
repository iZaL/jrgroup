@if($latest_event_posts)
<div class="panel panel-default">
    <div class="panel-heading">
        آخر الدورات
    </div>
    <div class="panel-body">
        <ul>
            @foreach($latest_event_posts as $event)
                <li><a href="{{ URL::action('EventsController@show',$event->id)}} "> {{ (LaravelLocalization::getCurrentLocaleName() == 'English') ? $event->title_en : $event->title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endif