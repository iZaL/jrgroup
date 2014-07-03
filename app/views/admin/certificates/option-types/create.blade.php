@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>Add Price</h1>

{{ Form::open(array('action' => 'AdminCertificateOptionTypesController@store')) }}

<div class="form-group">
    {{ Form::label('type_id', 'Type') }}
    {{ Form::select('type_id',$types,NULL,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('option_id', 'Option') }}
    {{ Form::select('option_id',$options,NULL,array('class'=>'form-control')) }}
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