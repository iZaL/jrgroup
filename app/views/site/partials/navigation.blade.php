<div class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ action('HomeController@index') }}">{{ HTML::image('images/Logo.jpg' ,'logo', array('class'=>'img-responsive logo')) }}</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
            <li class="{{ (Request::is('en') || Request::is('ar') || Request::is('/')) ? 'active' : '' }}" ><a href="{{ action('HomeController@index') }}">{{ trans('word.home')}}</a></li>
            <li class="{{ (Request::segment('1') == 'course' ? 'active' :  false ) }}"><a href="{{ action('EventsController@index') }}">{{ trans('word.events')}}</a></li>
            <li class="{{ (Request::segment('1') == 'gallery' ? 'active' : false  ) }}"><a href="{{ action('GalleriesController@index') }}">{{ trans('word.gallery') }} </a></li>
            <li class="{{ (Request::segment('1') == 'blog' ? 'active' :   false ) }} "><a href="{{ action('BlogsController@index') }}">{{ trans('word.blog') }}</a></li>
            <li class="{{ (Request::segment('1') == 'contact-us' ? 'active' : false  ) }}"><a href="{{ action('ContactsController@index') }}">{{ trans('word.contact_us') }}</a></li>
        </ul>
    </div>
</div>