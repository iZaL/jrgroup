@extends('site.master')

@section('breadcrumb')
    <li>{{ Lang::get('user/user.forgot_password') }} </li>
@stop
@section('content')
<h1>{{ Lang::get('user/user.forgot_password') }} </h1>

{{ Form::open(['action' => 'UserController@postForgot', 'method' => 'post']) }}
<div class="form-group">
    <div class="input-append input-group">
        <div class="input-icon">
            <i class="fa fa-user"></i>

        {{ Form::text('email', null , ['class' => 'form-control','placeholder'=> Lang::get('confide::confide.e_mail') ]) }}
        </div>
        <span class="input-group-btn">
            <input class="btn btn-success" type="submit" value="{{{ Lang::get('confide::confide.forgot.submit') }}}">
        </span>
    </div>
</div>
{{ Form::close() }}

@stop
