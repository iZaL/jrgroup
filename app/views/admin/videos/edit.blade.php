@extends('admin.master')
{{-- Content --}}
@section('content')

{{ HTML::style('css/dropzone.css') }}
{{ HTML::script('js/dropzone.js') }}
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<h1 >Edit Gallery</h1>

{{ Form::model($gallery, array('method' => 'PATCH', 'role'=>'form', 'action' => array('AdminGalleriesController@update', $gallery->id))) }}

<div class="form-group">
    {{ Form::label('event_id', 'Event:') }}
    {{ Form::select('event_id',$events ,$gallery->event_id,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('category_id', 'Category:') }}
    {{ Form::select('category_id',$categories ,$gallery->category_id,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Title Arabic:') }}
    {{ Form::text('title_ar', null,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Title English:') }}
    {{ Form::text('title_en', null,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Description Arabic:') }}
    {{ Form::textarea('description_ar', null,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Description English:') }}
    {{ Form::textarea('description_en', null,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('date_start', 'Event Date:') }}
    <div class="input-group">
        {{ Form::text('date_start',null,array('class'=>'form-control')) }}
        <span class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span>
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

<h1>Delete Photos </h1>

<div class="row ">
    <div class="col-md-12">
        <table class="table table-striped custab well">
            <thead>
            <tr>
                <th>Image </th>
            </tr>
            @foreach($gallery->photos as $photo)
            <tr>
                <td> {{ HTML::image('uploads/thumbnail/'.$photo->name.'','image1',array('class'=>'img-responsive img-thumbnail')) }} </td>
                <td>
                    {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminPhotosController@destroy', $photo->id))) }}
                    {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}

                    {{ Form::close() }}
                </td>
            </tr>

            @endforeach
        </table>
    </div>
</div>
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


