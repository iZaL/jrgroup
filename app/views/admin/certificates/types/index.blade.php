@extends('admin.master')
{{-- Content --}}
@section('content')

<h1>Certificat Types</h1>

<p>{{ link_to_action('AdminCertificateTypesController@create', 'Add new Type') }}</p>

@if ($records->count())
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Name</th>
        <th>Price</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($records as $record)
    <tr>
        <td>{{ $record->name }}</td>
        <td>{{ $record->price }} KD</td>
        <td><a href="{{ URL::action('AdminCertificateTypesController@edit',  array($record->id), array('class' => 'btn btn-info')) }}">Edit</a></td>
        <td>
            {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminCertificateTypesController@destroy', $record->id))) }}
            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@else
There are no categories
@endif

@stop
