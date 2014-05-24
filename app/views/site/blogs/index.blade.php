@extends('site.master')
@section('content')
<div class="row">
    @foreach ($posts as $post)
    <div class="col-md-6">
        @if(count($post->photos))
        {{ HTML::image('uploads/medium/'.$post->photos[0]->name.'','image1',array('class'=>'img-responsive news-image')) }}
        @else
            <img class="img-responsive news-image" src="http://placehold.it/650x500/bb3333" alt=""/>
        @endif
    </div>
    <div class="col-md-6">
        <h4>
            {{ LocaleHelper::getLocaled($post->title,$post->title_en) }}
        </h4>
        <p>
            {{ LocaleHelper::getLocaled($post->content,$post->content_en) }}
        </p>
    </div>
    <!-- end of news -->

    @endforeach
</div>

{{ $posts->links() }}


@stop


