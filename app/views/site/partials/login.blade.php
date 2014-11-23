<div class="panel panel-default">
    <div class="panel-heading"> {{ trans('word.login') }} </div>
    <div class="panel-body">
        <ul class="dropdown">
            <!-- Hide this In Mobile -->
            <div class="hidden-xs">
                @if(!Auth::check())
                    @include('site.auth._login-form')
                @else
                    @include('site.auth._settings-button')
                @endif
            </div>

            <!-- Show this in mobile -->
            <div class="visible-xs">
                @if(!Auth::check())
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" >
                        <i class="fa  fa-lock"></i> &nbsp;{{ trans('word.login') }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        @include('site.auth._login-form')
                    </ul>
                @else
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" >
                        <i class="fa  fa-cog"></i> &nbsp;{{ trans('word.settings') }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        @include('site.auth._settings-button')
                    </ul>

                @endif
            </div>

        </ul>
    </div>
</div>



