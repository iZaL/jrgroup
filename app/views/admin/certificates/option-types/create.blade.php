@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>Add Certificate Option</h1>

{{ Form::open(array('action' => 'AdminCertificateOptionsController@store')) }}

<div class="form-group">
    {{ Form::select('type_id',$types,NULL,array('class'=>'form-control')) }}
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
    {{ Form::text('price',NULL,array('class'=>'form-control')) }}
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