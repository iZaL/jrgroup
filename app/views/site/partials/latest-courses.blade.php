@if($latest_event_posts)
<div class="panel panel-default">
    <div class="panel-heading">
        {{ Lang::get('site.general.latest_courses') }}
    </div>
    <div class="panel-body">
        <ul>
            @foreach($latest_event_posts as $event)
            <li>
                <a href="{{ URL::action('EventsController@show',$event->id)}} ">
                    {{ LocaleHelper::getLocaled($event->title,$event->title_en) }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endif