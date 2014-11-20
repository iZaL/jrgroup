<div class="pull-left">
    <li class="dropdown-header">
        <a type="button" class="btn btn-default btn-sm" href="{{ action('UsersController@getProfile', Auth::user()->id) }}">
            <i class="glyphicon glyphicon-user" style="font-size: 11px;"></i>&nbsp;{{ trans('word.profile') }}
        </a>
    </li>
    <li class="dropdown-header">
        {{ (Helper::isMod()) ? '<a type="button" class="btn btn-default btn-sm" href="'. URL::to('admin') .'">
            <i class="glyphicon glyphicon-user" style="font-size: 11px;"></i>&nbsp;'. trans('word.admin_panel') .'
        </a>' : '' }}
    </li>
    <li class="dropdown-header">
        {{ (Helper::isMod()) ? '<a type="button" class="btn btn-default btn-sm" href="'. URL::action('BlogsController@create') .'">
            <i class="fa fa-cog" style="font-size: 11px;"></i>&nbsp;'. Lang::get('word.add_blog_post') .'
        </a>' : '' }}
    </li>
    <li class="dropdown-header">
        {{ (Helper::isMod()) ? '<a type="button" class="btn btn-default btn-sm" href="'. URL::action('CertificateRequestsController@create') .'">
            <i class="fa fa-cog" style="font-size: 11px;"></i>&nbsp;'. Lang::get('word.request_certificate') .'
        </a>' : '' }}
    </li>
    <li class="dropdown-header">
        <a type="button" class="btn btn-default btn-sm" href="{{ action('AuthController@getLogout') }}">
            <i class="fa fa-sign-out" style="font-size: 11px;"></i>&nbsp;{{ trans('word.logout') }}
        </a>
    </li>
</div>