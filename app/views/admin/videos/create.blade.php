@extends('admin.master')
{{-- Content --}}
@section('content')

<h1>Create Gallery</h1>
{{ Form::open(array('method' => 'POST', 'action' => array('AdminVideosController@store'))) }}

    {{ Form::hidden('videoable_type', $videoableType ) }}
    {{ Form::hidden('videoable_id', $videoableId ) }}

    <div class="col-md-12">
        <div class="form-group">
            <lable>Video Url ( Youtube Only) </lable>
            {{Form::text('url',null,['class'=>'form-control'])}}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <lable>Video Title in Arabic </lable>
            {{Form::text('title_ar',null,['class'=>'form-control'])}}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <lable>Video Title in English </lable>
            {{Form::text('title_en',null,['class'=>'form-control'])}}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
        </div>
    </div>

{{ Form::close() }}

@if ($errors->any())
<ul>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif

@stop

@section('script')
    @parent

@stop


