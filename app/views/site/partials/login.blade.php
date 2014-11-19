<div class="panel panel-default">
    <div class="panel-heading"> {{ trans('word.login') }} </div>
    <div class="panel-body">
        <ul class="dropdown">
            <!-- Hide this In Mobile -->
            <div class="hidden-xs">
                @if(!Auth::user())
                    @include('site.auth._login-form')
                @else
                    @include('site.auth._settings-button')
                @endif
            </div>
            <!-- mobile -->
            <div class="visible-xs">
                @if(!Auth::check())
                    <a type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="glyphicon  glyphicon-lock"></i> &nbsp;{{ trans('word.login') }}
                        <span class="caret"></span>
                    </a>
                    @include('site.auth._login-form')
                @else
                    @include('site.auth._settings-button')
                @endif

            </div>

        </ul>
    </div>
</div>



