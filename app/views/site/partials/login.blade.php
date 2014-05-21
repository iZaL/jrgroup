@if(!Auth::check())
{{ Form::open(array('action'=>'UserController@postLogin','method'=>'POST')) }}
    <div class="form-group">
        {{ Form::text('email', NULL,array('class'=>'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::password('password', array('class'=>'form-control')) }}
    </div>
    <div class="form-group">

        <button type="submit" class="btn btn-default">{{ Lang::get('site.nav.login') }}</button>
        <a href="{{ action('UserController@create') }}" type="submit" class="btn btn-default">{{ Lang::get('site.nav.register') }}</a>

    </div>
{{ Form::close() }}
@else
    <div>
        <li class="dropdown-header">
            <a type="button" class="btn btn-default btn-sm" href="{{ action('UserController@getLogout') }}">
                <i class="glyphicon glyphicon-log-out" style="font-size: 11px;"></i>&nbsp;{{ Lang::get('site.nav.logout') }}
            </a>
        </li>
        <li class="dropdown-header">
            <a type="button" class="btn btn-default btn-sm" href="{{ action('UserController@getProfile', Auth::user()->id) }}">
                <i class="glyphicon glyphicon-user" style="font-size: 11px;"></i>&nbsp;{{ Lang::get('site.general.profile') }}
            </a>
        </li>
        <li class="dropdown-header">
            {{ (Helper::isMod()) ? '<a type="button" class="btn btn-default btn-sm" href="'. URL::to('admin') .'">
                <i class="glyphicon glyphicon-user" style="font-size: 11px;"></i>&nbsp;'. Lang::get('site.general.admin_panel') .'
            </a>' : '' }}
        </li>
    </div>

@endif
