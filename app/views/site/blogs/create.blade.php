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

    <h1>{{ trans('word.add_blog_post') }}</h1>

    {{ Form::open(array('method' => 'POST', 'action' => array('BlogsController@store'), 'class'=> 'well','role'=>'form', 'files' => true)) }}

        {{ Form::hidden('user_id',Auth::user()->id) }}
        {{ Form::hidden('imageable_type','Blog') }}
        {{ Form::hidden('imageable_id',2) }}

        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            {{ Form::label('category_id', trans('word.choose_category'), ['class'=>'control-label']) }}
            {{ Form::select('category_id', $category, NULL, array('class'=>'form-control')) }}
            {{ $errors->first('category_id', '<span class="red">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {{ Form::label('title', trans('word.title').trans('word.in_arabic'), ['class'=>'control-label']) }}

            {{ Form::text('title_ar', null, ['class' => 'form-control']) }}
            {{ $errors->first('title_ar', '<span class="red">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('title_en') ? 'has-error' : '' }}">
            {{ Form::label('title', trans('word.title').trans('word.in_english'), ['class'=>'control-label']) }}

            {{ Form::text('title_en', null, ['class' => 'form-control']) }}
            {{ $errors->first('title_en', '<span class="red">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('description_ar') ? 'has-error' : '' }}">
            {{ Form::label('content', trans('word.content').trans('word.in_arabic'), ['class'=>'control-label']) }}
            {{ Form::textarea('description_ar',null,['class'=>'form-control wysihtml5']) }}
            {{ $errors->first('description_ar', '<span class="red">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('description_en') ? 'has-error' : '' }}">
            {{ Form::label('description_en', trans('word.content').trans('word.in_english'), ['class'=>'control-label']) }}
            {{ Form::textarea('description_en',null,['class'=>'form-control wysihtml5']) }}
            {{ $errors->first('description_en', '<span class="red">:message</span>') }}
        </div>

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {{ Form::label('name', trans('word.image'), ['class'=>'control-label']) }}

            {{ Form::file('name',null,['id'=>'name' , 'class'=>'form-control']) }}
            {{{ $errors->first('name', '<span class="red">:message</span>') }}}
        </div>

		<!-- Form Actions -->
		<div class="form-group">
            <button type="submit" class="btn btn-success">Save</button>
		</div>
		<!-- ./ form actions -->
	{{ Form::close() }}

@stop
