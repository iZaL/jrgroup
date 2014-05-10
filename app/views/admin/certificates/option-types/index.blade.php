@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>Certificate Options</h1>

<p>{{ link_to_action('AdminCertificateOptionsController@create', 'Add new option') }}</p>

@if ($records->count())
    @foreach ($records as $record)
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $record->name }}</h2>
                @foreach($record->options as $option)

                    <div class="col-md-10">
                        <h4>({{ $option->meta->name }}) {{ $option->name }} ( {{ (float)round($option->pivot->price) }} KD  ) </h4>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ URL::action('AdminCertificateOptionsController@edit',  array($record->id), array('class' => 'btn btn-info')) }}">Edit</a>
                    </div>
                    <div class="col-md-1">
                        {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminCertificateOptionsController@destroy', $record->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </div>
                @endforeach

            </div>

    </div>
@endforeach

@else
There are no categories
@endif

@stop
