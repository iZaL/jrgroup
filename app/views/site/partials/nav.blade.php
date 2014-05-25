<div class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ action('HomeController@index') }}">{{ HTML::image('images/Logo.jpg' ,'logo', array('class'=>'img-responsive')) }}</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
            <li class="{{ (Request::is('en') || Request::is('/') )? 'active' : '' }}" ><a href="{{ action('HomeController@index') }}">{{ Lang::get('site.nav.home')}}</a></li>
            <li><a href="{{ action('EventsController@index') }}">الدورات</a></li>
            <li><a href="{{ action('GalleriesController@index') }}">معرض الدورات</a></li>
            <li class="{{ (Request::is('en/blog*')|| Request::is('blog*'))? 'active' : '' }}"><a href="{{ action('BlogsController@index') }}">{{ Lang::get('site.nav.posts') }}</a></li>
            <li class="{{ (Request::is('en/contact-us')|| Request::is('contact-us'))? 'active' : '' }}"><a href="{{ action('ContactsController@index') }}">{{ Lang::get('site.nav.contactus') }}</a></li>
            <li><a class="ads" href="#">Ads</a></li>
        </ul>
    </div>
</div>