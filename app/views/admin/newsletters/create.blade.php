@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>Edit Course</h1>
{{ Form::open(array('method' => 'POST', 'action' => array('AdminNewslettersController@store'), 'role'=>'form', 'files' => true)) }}
<div class="row">
    <div class="form-group col-md-12">
        {{ Form::label('subject', 'Title in Arabic:*') }}
        {{ Form::text('title',NULL,array('class'=>'form-control')) }}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        {{ Form::label('body', 'Body:') }}
        {{ Form::textarea('body',NULL,array('class'=>'form-control')) }}
    </div>
</div>

@stop
