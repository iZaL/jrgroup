@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>Edit Price For {{ $record->type->name }} - {{ $record->option->name }}</h1>
{{ Form::model($record, array('method' => 'PATCH', 'role'=>'form', 'action' => array('AdminCertificateOptionTypesController@update', $record->id))) }}

<div class="form-group">
    {{ Form::label('name', 'Price:') }}
    {{ Form::text('price',$record->price,array('class'=>'form-control')) }}
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