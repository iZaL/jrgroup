@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} :: @parent
@stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			Role Management
			<div class="pull-right">
				<a href="{{{ URL::to('admin/roles/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
			</div>
		</h3>
	</div>

    <div id="wrap">
        <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
            <thead>
                <tr>
                    <th>{{{ Lang::get('admin/roles/table.name') }}}</th>
                    <th>{{{ Lang::get('admin/roles/table.users') }}}</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($roles as $user)
            <tr class="gradeX">
                <td>{{ $user->name }}</td>
                <td>{{ $user->users }}</td>
                <td>
                    <a href="{{  URL::to('admin/roles/' . $user->id . '/edit' ) }}" class=" btn btn-xs btn-default">{{{ Lang::get('button.edit') }}}</a>
                    <a href="{{  URL::to('admin/roles/' . $user->id . '/delete' ) }}" class=" btn btn-xs btn-danger">{{{ Lang::get('button.delete') }}}</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@stop