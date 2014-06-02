@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>All Countries</h1>

<p>{{ link_to_action('AdminCountriesController@create', 'Add new country') }}</p>

@if ($countries->count())
<div id="wrap">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
        <thead>
			<tr>
				<th>Name</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($countries as $country)
				<tr>
					<td>{{{ $country->name }}}</td>
                    <td>{{ link_to_action('AdminCountriesController@edit', 'Edit', array($country->id), array('class' => 'btn btn-xs btn-default')) }}
                        {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminCountriesController@destroy', $country->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	There are no countries
@endif

@stop
