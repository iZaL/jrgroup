@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>All Locations</h1>

<p>{{ link_to_action('AdminLocationsController@create', 'Add new location') }}</p>

@if ($locations->count())

<div id="wrap">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Country</th>
            <th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($locations as $location)
				<tr>
					<td>{{{ $location->name }}}</td>
					<td>{{{ $location->country->name }}}</td>
                    <td>{{ link_to_action('AdminLocationsController@edit', 'Edit', $location->id) }}
                        {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminLocationsController@destroy', $location->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	There are no locations
@endif

@stop
