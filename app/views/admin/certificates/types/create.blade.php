@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>Add Certificate Type</h1>

{{ Form::open(array('action' => 'AdminCertificateTypesController@store')) }}

<div class="form-group">
    {{ Form::label('type', 'Type:') }}
    {{ Form::text('name',NULL,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('price', 'Price:') }}
    {{ Form::text('price', NULL,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
</div>
{{ Form::close() }}

@if ($errors->any())
<div class="alert alert-danger alert-block">
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</div>
@endif

@stop