@extends('admin.master')
{{-- Content --}}
@section('content')

<h1>Gallery</h1>

<p>{{ link_to_action('AdminGalleriesController@create', 'Add new Gallery') }}</p>

@if ($videos->count())
<div id="wrap">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
        <thead>
            <tr>
				<th>Name</th>
				<th>URL</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($videos as $video)
				<tr>
					<td>{{ $video->name }}</td>
					<td>{{ $video->url }}</td>
                    <td><a href="{{ URL::action('AdminGalleriesController@edit',  $video->id ) }}" class="iframe btn btn-xs btn-default">Edit</a>
                        {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminVideosController@destroy', $video->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endif

@stop
