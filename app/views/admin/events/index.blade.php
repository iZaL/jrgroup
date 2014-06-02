@extends('admin.layouts.default')

{{-- Content --}}
@section('content')
<h1>Events</h1>
<p>{{ link_to_action('AdminEventsController@create', 'Add new event') }}</p>

@if ($events->count())
<div id="wrap">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
        <thead>
			<tr>
                <td>ID</td>
				<th>Category</th>
				<th>Location</th>
				<th>Title</th>
				<th>Date_start</th>
				<th>Date_end</th>
				<th>Address</th>
                <th>Posted</th>
                <th>Settings</th>
                <th>Action</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($events as $event)
				<tr>
                    <td>{{{ $event->id }}}</td>
					<td>{{{ $event->category->name }}}</td>
					<td>{{{ $event->location->name }}}</td>
					<td>{{{ $event->title }}}</td>
					<td>{{{ $event->date_start }}}</td>
					<td>{{{ $event->date_end }}}</td>
					<td>{{{ $event->address }}}</td>
                    <td>{{{ $event->getHumanCreatedAtAttribute() }}} </td>
                    <td><a href="{{ URL::action('AdminEventsController@settings',$event->id)}}">Settings</a></td>
                    <td><a href="{{ URL::action('AdminEventsController@edit', $event->id) }}" class="btn btn-xs btn-default">Edit</a>
                        {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminEventsController@destroy', $event->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	There are no events
@endif

@stop
