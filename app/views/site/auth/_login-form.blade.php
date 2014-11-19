{{ Form::open(['action' => 'AuthController@postLogin', 'method' => 'post'], ['class'=>'form']) }}
<div class="form-group">
    <div class="input-group">
        <div class="input-icon">
            <i class="fa fa-user"></i>
            {{ Form::text('email',null,['class'=>'form-control', 'placeholder'=> trans('word.email')]) }}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="input-group">
        <div class="input-icon">
            <i class="fa fa-lock"></i>
                {{ Form::password('password',['class'=>'form-control', 'placeholder'=> trans('word.password')]) }}
        </div>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-default">{{ trans('word.login') }}</button>
    <a href="{{ action('AuthController@getSignup') }}" type="submit" class="btn btn-default">{{ trans('word.register') }}</a>
</div>

{{ Form::close() }}