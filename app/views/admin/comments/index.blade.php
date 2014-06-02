@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} :: @parent
@stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}
		</h3>
	</div>

    <div id="wrap">
        <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
            <thead>
            <tr>
                    <th class="col-md-3">{{{ Lang::get('admin/comments/table.title') }}}</th>
                    <th class="col-md-3">{{{ Lang::get('admin/blogs/table.post_id') }}}</th>
                    <th class="col-md-2">{{{ Lang::get('admin/users/table.username') }}}</th>
                    <th class="col-md-2">{{{ Lang::get('admin/comments/table.created_at') }}}</th>
                    <th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
            <tr class="gradeX">
                <td>{{ $comment->content }}</td>
                <td>{{ $comment->post_name }}</td>
                <td>{{ $comment->poster_name }}</td>
                <td>{{ $comment->created_at->toFormattedDateString() }}</td>
                <td>
                    <a href="{{  URL::to('admin/comments/' . $comment->id . '/edit' ) }}" class="iframe btn btn-xs btn-default">{{{ Lang::get('button.edit') }}}</a>
                    <a href="{{  URL::to('admin/comments/' . $comment->id . '/delete' ) }}" class="iframe btn btn-xs btn-danger">{{{ Lang::get('button.delete') }}}</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

@stop