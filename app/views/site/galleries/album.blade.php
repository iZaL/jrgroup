@extends('site.master')
@section('title')
    Album {{$album->title}}
@stop
@section('style')
    @parent
    {{ HTML::style('css/royalslider.css') }}
    <link class="rs-file" href="{{ asset('css/rs-default.css') }}" rel="stylesheet">
    <style>
        #gallery-1 {
            width: 100%;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
    </style>
@stop
@section('scripts')
    @parent
    {{ HTML::script('js/jquery.royalslider.min.js') }}
    <script id="addJS">
        jQuery(document).ready(function ($) {
            $('#gallery-1').royalSlider({
                fullscreen: {
                    enabled: true,
                    nativeFS: true
                },
                controlNavigation: 'thumbnails',
                autoScaleSlider: true,
                autoScaleSliderWidth: 960,
                autoScaleSliderHeight: 850,
                loop: false,
                imageScaleMode: 'fit-if-smaller',
                navigateByClick: true,
                numImagesToPreload: 2,
                arrowsNav: true,
                arrowsNavAutoHide: true,
                arrowsNavHideOnTouch: true,
                keyboardNavEnabled: true,
                fadeinLoadedSlide: true,
                globalCaption: false,
                globalCaptionInside: false,
                thumbs: {
                    appendSpan: true,
                    firstMargin: true,
                    paddingBottom: 4
                }
            });
        });
    </script>
@stop

@section('breadcrumb')
<li><a href="{{ action('GalleriesController@index') }} ">{{ Lang::get('site.general.coursesgallery') }}</a></li>
<li><a href="{{ action('GalleriesController@show', $album->category->id) }} "> {{ LocaleHelper::getLocaled($album->category->name,$album->category->name_en) }}</a></li>
<li class="active">{{ $album->title }}</li>
@stop

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1 ">
        <div id="gallery-1" class="royalSlider rsDefault">
            <?php $i =0 ; ?>
            @foreach($album->photos as $photo)
                @if($i==0)
                    <a class="rsImg bugaga"  data-rsbigimg="{{  asset('uploads/'.$photo->name) }}" href="{{  asset('uploads/large/'.$photo->name) }}">{{ $photo->title }}
                @else
                    <a class="rsImg" data-rsbigimg="{{  asset('uploads/'.$photo->name) }}" href="{{  asset('uploads/large/'.$photo->name) }}">{{ $photo->title }}
                @endif
                    {{ HTML::image('uploads/thumbnail/'.$photo->name.'','image1',array('class'=>'rsTmb','width'=> '96', 'height'=>'72')) }}
                </a>
                <?php $i++; ?>
            @endforeach
        </div>
    </div>
</div>
@stop