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
            <li class="{{ (Request::is('en') || Request::is('ar')) ? 'active' : '' }}" ><a href="{{ action('HomeController@index') }}">{{ Lang::get('site.nav.home')}}</a></li>
            <li class="{{ (Request::is('*/course')) ? 'active' : '' }}"><a href="{{ action('EventsController@index') }}">{{ Lang::get('site.general.courses')}}</a></li>
            <li class="{{ (Request::is('*/gallery')) ? 'active' : '' }}"><a href="{{ action('GalleriesController@index') }}">{{ Lang::get('site.general.coursesgallery') }} </a></li>
            <li class="{{ (Request::is('*/blog')) || (Request::is('ar/blog/*'))? 'active' : '' }}"><a href="{{ action('BlogsController@index') }}">{{ Lang::get('site.nav.posts') }}</a></li>
            <li class="{{ (Request::is('en/contact-us')|| Request::is('ar/contact-us'))? 'active' : '' }}"><a href="{{ action('ContactsController@index') }}">{{ Lang::get('site.nav.contactus') }}</a></li>
            <li><a class="ads" href="#"  data-toggle="modal" data-target="#myModal">
                    <span class="fa-rotate-270" style="float: right; width: 220%; position: relative; bottom: 20%; left: 50%;">Ad Goes here</span>
            </a></li>
        </ul>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img class="img-responsive" src="http://placehold.it/650x650?text=usama-ahmed" alt=""/>
            </div>

        </div>
    </div>
</div>