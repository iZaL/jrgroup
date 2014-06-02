@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>All Categories</h1>

<p>{{ link_to_action('AdminGalleriesController@create', 'Add new Gallery') }}</p>

@if ($categories->count())
<div id="wrap">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
        <thead>
            <tr>
				<th>Name</th>
                <th>Date</th>
				<th>Type</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($categories as $category)
				<tr>
					<td>{{ $category->title }}</td>
                    <td>{{ $category->date_start->toFormattedDateString() }}</td>
                    <td><a href="{{ URL::action('AdminGalleriesController@getPhotos', $category->id ) }}" class="iframe btn btn-xs btn-default">Add / Edit Photos</a></td>
                    <td><a href="{{ URL::action('AdminGalleriesController@edit',  $category->id ) }}" class="iframe btn btn-xs btn-default">Edit</a>

                        {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminGalleriesController@destroy', $category->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	There are no categories
@endif

@stop
