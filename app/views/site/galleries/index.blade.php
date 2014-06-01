@extends('site.master')
@section('title')
    Events
@stop
@section('style')
    @parent
@stop
@section('scripts')
    @parent
@stop

@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{ action('HomeController@index') }}">{{ Lang::get('site.nav.home') }}</a></li>
        <li><a href="{{ action('GalleriesController@index') }} ">{{ Lang::get('site.general.coursesgallery') }}</a></li>
    </ol>
</div>
<div class="row">
    @foreach($categories as $category)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail gallery">
                @if(count($category->galleries))
                <a href="{{ action('GalleriesController@show',$category->id) }}">
                    {{
                    HTML::image('uploads/medium/'.$category->galleries[0]->photos[0]->name.'','image1',array('class'=>'img-responsive
                    img-thumbnail')) }}
                </a>
                @else
                <a href="{{ action('GalleriesController@show',$category->id) }}">
                    <img src="http://placehold.it/350x310" class="img-responsive img-thumbnail">
                </a>
                @endif
                <div class="caption">
                    <p class="text-center">
                        <a href="{{ action('GalleriesController@show',$category->id) }}">
                            {{ LocaleHelper::getLocaled($category->name,$category->name_en ) }}
                        </a>
                    </p>
                    <a href="#" class="pull-right"><span class="glyphicon glyphicon-camera"></span>
                        {{ count($category->galleries) }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $categories->appends(Request::except('page'))->links() }}
@stop