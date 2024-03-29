@extends('admin.master')
{{-- Content --}}
@section('content')

{{ HTML::style('css/dropzone.css') }}
{{ HTML::script('js/dropzone.js') }}
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<h1>Create Gallery</h1>
{{ Form::open(array('method' => 'POST', 'action' => array('AdminGalleriesController@store'))) }}

<div class="form-group">
    {{ Form::label('event_id', 'Event:') }}
    {{ Form::select('event_id',$events ,NULL,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('category_id', 'Category:') }}
    {{ Form::select('category_id',$categories ,NULL,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Title Arabic:') }}
    {{ Form::text('title_ar', NULL,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Title English:') }}
    {{ Form::text('title_en', NULL,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Description Arabic:') }}
    {{ Form::textarea('description_ar', NULL,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Description English:') }}
    {{ Form::textarea('description_en', NULL,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('date_start', 'Event Date:') }}
    <div class="input-group">
        {{ Form::text('date_start',NULL,array('class'=>'form-control')) }}
        <span class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
</div>
{{ Form::close() }}

<script>
    $(function(){
        $('#date_start').datetimepicker({
            format:'Y-m-d H:i',
            onShow:function( ct ){
//                this.setOptions({
//                    maxDate:$('#date_end').val()?$('#date_end').val():false
//                })
            }
        });
     });
</script>
@stop


