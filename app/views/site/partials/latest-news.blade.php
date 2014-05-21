@if($latest_blog_posts)
<div class="panel panel-default">
    <div class="panel-heading">
        آخر الاخبار
    </div>
    <div class="panel-body">
        <ul>
            @foreach($latest_blog_posts as $post)
              <li><a href="{{URL::action('BlogsController@show',$post->slug)}}"> {{ $post->title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endif