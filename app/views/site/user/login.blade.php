@extends('site.master')
@section('title')
{{ Lang::get('confide.login.submit') }}
@stop
@section('content')
<div class="row">
    <div class="col-md-3 col-sm-3">
        @include('site.partials.latest-courses')
        @include('site.partials.latest-news')
    </div>
    <div class="col-md-9 col-sm-9">
        <div class="page-header">
            <h1>{{ Lang::get('site.general.entry')}}</h1>
        </div>
        {{ Form::open(array('action'=>'UserController@postLogin','method'=>'POST')) }}
            <div class="form-group">
                <label class="control-label" for="email">{{ Lang::get('confide.username_e_mail') }}</label>
                {{ Form::text('email', NULL,array('class'=>'form-control','placeholder' => Lang::get('confide.username_e_mail'))) }}
            </div>
            <div class="form-group">
                <label class="control-label" for="password"> {{ Lang::get('confide.password') }} </label>
                {{ Form::password('password', array('class'=>'form-control','placeholder' => Lang::get('confide.password'))) }}
            </div>
            <div class="form-group">
                <label for="remember">{{ Lang::get('confide.login.remember') }}
                    <input type="hidden" name="remember" value="0">
                    <input tabindex="4" type="checkbox" name="remember" id="remember" value="1">
                </label>
            </div>
            <div class="form-group">
                <button tabindex="3" type="submit" class="btn btn-primary">{{ Lang::get('confide.login.submit') }}</button>
                <a class="btn btn-default" href="forgot">{{ Lang::get('confide.login.forgot_password') }}</a>
            </div>
        </form>
    </div>
</div>
@stop
