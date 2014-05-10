@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>Add Certificate Type</h1>
{{ Form::model($record, array('method' => 'PATCH', 'role'=>'form', 'action' => array('AdminCertificateOptionsController@update', $record->id))) }}
<div class="form-group">
    {{ Form::select('type_id',$types,$type,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::select('meta_id',$metas,NULL,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('name', 'Option Name:') }}
    {{ Form::text('name',NULL,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('name', 'Price:') }}
    {{ Form::text('price',$price,array('class'=>'form-control')) }}
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