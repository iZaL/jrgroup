@extends('site.master')
@section('content')
<div class="row">
@foreach ($posts as $post)

    <div class="col-md-6">
        <img class="img-responsive news-image" src="http://placehold.it/650x500/bb3333" alt=""/>
    </div>
    <div class="col-md-6">
        <h4>
            العنوان
        </h4>
        <p>
            الموضوع الموضوع الموضوع الموضوع الموضوع الموضوع الموضوع الموضوع الموضوع الموضوع الموضوع الموضوع الموضوع الموضوعالموضوع الموضوعالموضوع الموضوعالموضوع الموضوعالموضوع الموضوع
        </p>
    </div>
    <!-- end of news -->

@endforeach
</div>

    {{ $posts->links() }}


@stop
