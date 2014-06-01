@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Blogs administration @stop
@section('author')Laravel 4 Bootstrap Starter SIte @stop
@section('description')Blogs administration index @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}

			<div class="pull-right">
				<a href="{{{ URL::to('admin/blogs/create') }}}" class="btn btn-small btn-info "><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
			</div>
		</h3>
	</div>

<div id="wrap">
    <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
        <thead>
            <tr>
				<th class="col-md-4">{{{ Lang::get('admin/blogs/table.title') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/blogs/table.comments') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/blogs/table.created_at') }}}</th>
				<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
        <tbody>
            @foreach($posts as $post)
            <tr class="gradeX">
                <td>{{ $post->title }}</td>
                <td>{{ $post->comments }}</td>
                <td>{{ $post->created_at->toFormattedDateString() }}</td>
                <td>
                    <a href="{{  URL::to('admin/blogs/' . $post->id . '/edit' ) }}" class="iframe btn btn-xs btn-default">{{{ Lang::get('button.edit') }}}</a>
                    <a href="{{  URL::to('admin/blogs/' . $post->id . '/delete' ) }}" class="iframe btn btn-xs btn-danger">{{{ Lang::get('button.delete') }}}</a>
                </td>
            </tr>
            @endforeach
		</tbody>
	</table>
</div>

	<script type="text/javascript">
        $(document).ready(function() {
            $('.datatable').dataTable({
                "sPaginationType": "bs_four_button"
            });
            $('.datatable').each(function(){
                var datatable = $(this);
                // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.addClass('form-control');
                // LENGTH - Inline-Form control
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.addClass('form-control input-sm');
            });
        });
	</script>

@stop