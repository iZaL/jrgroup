@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>Add Certificate Type</h1>

{{ Form::model($record, array('method' => 'PATCH', 'role'=>'form', 'action' => array('AdminCertificateMetasController@update', $record->id))) }}
<div class="form-group">
    {{ Form::label('type', 'Meta Title:') }}
    {{ Form::text('name',NULL,array('class'=>'form-control')) }}
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