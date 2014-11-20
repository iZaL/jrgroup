@extends('site.layouts._two_column')

@section('content')
<div class="breadcrumb-wrapper">
    @foreach ($posts as $post)
        @section('breadcrumb')
            <li><a href="{{ action('BlogsController@index') }} ">{{ trans('word.blog') }}</a></li>
            <li class="active"> {{ $post->title  }}</li>
        @stop
        <div class="col-md-6">
            @if(count($post->photos))
            {{ HTML::image('uploads/medium/'.$post->photos[0]->name.'','image1',array('class'=>'img-responsive news-image')) }}
            @else
                <img class="img-responsive news-image" src="http://placehold.it/650x500/bb3333" alt=""/>
            @endif
        </div>
        <div class="col-md-6">
            <h4>
                {{ $post->title }}
            </h4>
            <p>
                {{ $post->description }}
            </p>
        </div>
    <!-- end of news -->
    @endforeach
</div>

{{ $posts->links() }}


@stop


