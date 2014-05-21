@extends('site.layouts._one_columns_right_sidebar')

@section('style')
    @parent
@stop
@section('scripts')
    @parent
@stop

@section('content')
<div class="col-lg-12">
    <div class="row">
        @for ($i = 0; $i < 10; $i++)
        <div class="col-sm-6 col-lg-4">
            <div class="thumbnail gallery">
                <img src="http://placehold.it/350x150" alt="...">
                <div class="caption">
                    <p class="text-center">
                        هنا يوضع العنوان
                    </p>
                    <a href="#" class="pull-right"><span class="glyphicon glyphicon-camera"></span>
                        5 ابريل
                    </a>
                    <a href="#" class="pull-left"><span class="glyphicon glyphicon-camera"></span>
                        K.D 345
                    </a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@stop