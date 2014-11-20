@extends('admin.master')
{{-- Content --}}
@section('content')

{{ HTML::style('css/dropzone.css') }}
{{ HTML::script('js/dropzone.js') }}
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<h1>Create Gallery</h1>
{{ Form::open(array('method' => 'POST', 'action' => array('AdminVideosController@store'))) }}

{{ Form::hidden('videoable_type', $videoableType ) }}
{{ Form::hidden('videoable_id', $videoableId ) }}

<div class="form-group">
    <div class="col-md-12">
        <lable>Video Url ( Youtube Only) </lable>
        {{Form::text('url',null,['class'=>'form-control'])}}
    </div>
</div>

<div class="form-group">
    {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
</div>
{{ Form::close() }}

@if ($errors->any())
<ul>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif

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


