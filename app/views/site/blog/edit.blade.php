@extends('site.layouts._two_column')

@section('style')
@parent
{{ HTML::style('css/wysihtml5/bootstrap-wysihtml5.css') }}
{{ HTML::style('css/wysihtml5/prettify.css') }}

@stop

@section('scripts')

@parent
{{ HTML::script('js/wysihtml5/wysihtml5-0.3.0.js') }}
{{ HTML::script('js/wysihtml5/bootstrap-wysihtml5.js') }}


<script type="text/javascript">
    $('.wysihtml5').wysihtml5();
    $(prettyPrint);
</script>
@stop

@section('content')

    <h1>{{ trans('site.general.add_blog_post') }}</h1>

    {{ Form::model($post, array('method' => 'POST', 'action' => array('BlogsController@store'), 'class'=> 'well','role'=>'form', 'files' => true)) }}

        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            {{ Form::label('category_id', 'Category:', ['class'=>'control-label']) }}
            {{ Form::select('category_id', $category, NULL, array('class'=>'form-control')) }}
            {{ $errors->first('category_id', '<span class="red">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {{ Form::label('title', 'Title :', ['class'=>'control-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control']) }}
            {{ $errors->first('title', '<span class="red">:message</span>') }}
        </div>


        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
            {{ Form::label('content', 'Content :', ['class'=>'control-label']) }}
            {{ Form::textarea('content',null,['class'=>'form-control wysihtml5']) }}
            {{ $errors->first('content', '<span class="red">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('thumbnail') ? 'has-error' : '' }}">
            {{ Form::label('thumbnail', 'Upload Image :', ['class'=>'control-label']) }}

            {{ Form::file('thumbnail',null,['id'=>'thumbnail' , 'class'=>'form-control']) }}
            {{{ $errors->first('thumbnail', '<span class="red">:message</span>') }}}
        </div>

		<!-- Form Actions -->
		<div class="form-group">
            <button type="submit" class="btn btn-success">Save</button>
		</div>
		<!-- ./ form actions -->
	{{ Form::close() }}

    @if ($errors->any())
    <div class="alert alert-danger">
        <b>Please Fix these Errors</b>
        <ul>
            {{ implode('', $errors->all('<li class="error"> :message</li>')) }}
        </ul>
    </div>
    @endif

@stop
