@extends('site.master')

@section('content')
<div class="col-lg-12">
    <div class="row">
        @for ($i = 0; $i < 10; $i++)
        <div class="col-sm-6 col-lg-4">
            <div class="thumbnail gallery">
                <img src="http://placehold.it/350x150" alt="...">
                <div class="caption">
                    <a href="#"><span class="glyphicon glyphicon-camera"></span>
                        عنوان الدورة
                    </a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@stop