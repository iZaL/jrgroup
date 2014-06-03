@if(!Auth::check())
{{ Form::open(array('action'=>'UserController@postLogin','method'=>'POST')) }}
    <div class="form-group">
        <div class="input-group">
            <div class="input-icon">
                <i class="fa fa-user"></i>
                {{ Form::text('email', NULL,array('class'=>'form-control','placeholder' => Lang::get('confide.username_e_mail'))) }}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                {{ Form::password('password', array('class'=>'form-control','placeholder' => Lang::get('confide.password'))) }}
            </div>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default">{{ Lang::get('site.nav.login') }}</button>
        <a href="{{ action('UserController@create') }}" type="submit" class="btn btn-default">
            {{ Lang::get('site.nav.register') }}
        </a>
    </div>
{{ Form::close() }}
@else
    <div class="bottom20">
        <li class="dropdown-header">
            <a type="button" class="btn btn-default btn-sm" href="{{ action('UserController@getLogout') }}">
                <i class="fa fa-sign-out" style="font-size: 11px;"></i>&nbsp;{{ Lang::get('site.nav.logout') }}
            </a>
        </li>
        <li class="dropdown-header">
            <a type="button" class="btn btn-default btn-sm" href="{{ action('UserController@getProfile', Auth::user()->id) }}">
                <i class="fa fa-user" style="font-size: 11px;"></i>&nbsp;{{ Lang::get('site.general.profile') }}
            </a>
        </li>
        <li class="dropdown-header">
            {{ (Helper::isMod()) ? '<a type="button" class="btn btn-default btn-sm" href="'. URL::to('admin') .'">
                <i class="fa fa-cog" style="font-size: 11px;"></i>&nbsp;'. Lang::get('site.general.admin_panel') .'
            </a>' : '' }}
        </li>
    </div>

@endif
