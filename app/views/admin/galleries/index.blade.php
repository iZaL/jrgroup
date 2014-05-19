@extends('admin.layouts.default')

{{-- Content --}}
@section('content')

<h1>All Categories</h1>

<p>{{ link_to_action('AdminGalleriesController@create', 'Add new Gallery') }}</p>

@if ($categories->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Type</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($categories as $category)
				<tr>
					<td>{{ $category->title }}</td>
                    <td>{{ $category->date_start->format('D y m') }}</td>
                    <td><a href="{{ URL::action('AdminGalleriesController@getPhotos',  array($category->id), array('class' => 'btn btn-info')) }}">Add / Edit Photos</a></td>
                    <td><a href="{{ URL::action('AdminGalleriesController@edit',  array($category->id), array('class' => 'btn btn-info')) }}">Edit</a></td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminGalleriesController@destroy', $category->id))) }}
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
