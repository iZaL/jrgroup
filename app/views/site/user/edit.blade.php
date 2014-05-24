@extends('site.master')
@section('title')
    Edit Profile
@stop
@section('content')
<div class="alert alert-warning">{{ Lang::get('site.general.warning_msg')}}</div>

{{ Form::model($user,array('method' => 'PATCH', 'action'=>array('UserController@update',$user->id),'class'=>'form')) }}

    @if ( Session::get('errors') )
        <div class="alert alert-danger">Please fix the Errors<br/>{{ implode('', $errors->all('<p> - :message</p>')) }}</div>
    @endif
    <div class="row">
        <div class="col-xs-6 col-md-6">
            {{ Form::text('name_en',NULL,array('class'=>'form-control input-lg','placeholder'=>Lang::get('site.general.name_en'))) }}
        </div>
        <div class="col-xs-6 col-md-6">
            {{ Form::text('name_ar',NULL,array('class'=>'form-control input-lg','placeholder'=> Lang::get('site.general.name_ar'))) }}
        </div>
    </div>
    </br>
    {{ Form::password('password',array('class' => 'form-control input-lg','placeholder' => Lang::get('site.general.pass'))) }}
    </br>
    {{ Form::password('password_confirmation',array('class' => 'form-control input-lg','placeholder' => Lang::get('site.general.pass_confirm'))) }}
    </br>
    {{ Form::text('civilid',NULL,array('class'=>'form-control input-lg','placeholder'=> Lang::get('site.general.civilid'))) }}
    </br>
    {{ Form::text('phone',NULL,array('class'=>'form-control input-lg','placeholder'=> Lang::get('site.general.mobile'))) }}
    </br>
    {{ Form::text('address',NULL,array('class'=>'form-control input-lg','placeholder'=> Lang::get('site.general.address'))) }}
    </br>
    <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit">
        Update my account
    </button>
    <br>
{{ Form::close() }}

@stop