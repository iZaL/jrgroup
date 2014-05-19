@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>Request Certificate</h1>

{{ Form::model($request,array('method' => 'PATCH', 'role'=>'form', 'action' => array('AdminCertificateRequestsController@update', $request->id))) }}

<div class="form-group">
    {{ Form::label('type', 'Type:') }}
    {{ Form::select('type_id',$types,NULL,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    <?php $i = 1; ?>
    @foreach($metas as $meta)
        <?php $option = [0 => 'Select Certificate options'] + $meta->options->lists('name','id'); ?>
        @if($option)
            <label>{{ $meta->name }} </label>
            <div class="form-group">
                {{ Form::select('option_id'.$i,$option,$option,array('class'=>'form-control')) }}
            </div>
        @endif
        <?php $i++; ?>
    @endforeach
</div>

<div class="form-group">
    {{ Form::label('quantity', 'Quantity:') }}
    {{ Form::text('quantity', NULL,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
</div>
{{ Form::close() }}

@if ($errors->any())
<ul>
    <div class="alert alert-danger alert-block">
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </div>
</ul>
@endif

@stop