@extends('admin.master')
{{-- Content --}}
@section('content')

<h1>Certificate Options</h1>

<p>{{ link_to_action('AdminCertificateOptionTypesController@create', 'Add new Price') }}</p>

@if ($records->count())
    @foreach ($records as $record)
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-10">
                    <h4>({{ $record->type->name }}) {{ $record->option->name }} ( {{ (float)round($record->price) }} KD  ) </h4>
                </div>
                <div class="col-md-1">
                    <a href="{{ URL::action('AdminCertificateOptionTypesController@edit',  array($record->id), array('class' => 'btn btn-info')) }}">Edit</a>
                </div>
                <div class="col-md-1">
                    {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminCertificateOptionTypesController@destroy', $record->id))) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                </div>
            </div>

    </div>
@endforeach

@else
There are no categories
@endif

@stop
