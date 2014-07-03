@if($latest_blog_posts)
<div class="panel panel-default">
    <div class="panel-heading">
        {{  Lang::get('site.general.latest_news') }}
    </div>
    <div class="panel-body">
        <ul>
            @foreach($latest_blog_posts as $post)
                <li class="unstyled"><i class="glyphicon glyphicon-book"></i>
                    <a href="{{URL::action('BlogsController@show',$post->id)}}">
                        {{ LocaleHelper::getLocaled($post->title,$post->title_en) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif