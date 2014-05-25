<?php

/**
 * Route Model Binding
 */
Route::model('comment', 'Comment');
Route::model('role', 'Role');
Route::model('user', 'User');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('id', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/**
 * Route Group for Localized url
 */
Route::group(
    array(
        'prefix' => LaravelLocalization::setLocale(),
        'before' => ['LaravelLocalizationRedirectFilter'] // LaravelLocalization filter
    ),
    function() {
        Route::get('/', array('as'=>'home', 'uses' => 'HomeController@index'));
        Route::resource('/gallery', 'GalleriesController', array('index','view') );
        Route::get('gallery/{id}/album', ['as'=>'album','uses'=>'GalleriesController@showAlbum']);
        Route::resource('/courses','EventsController', array('index','view'));
        Route::resource('/news', 'BlogsController@index', array('index','view'));


        Route::get('event/{id}/subscribe',array('as'=>'event.subscribe','uses'=>'SubscriptionsController@subscribe'));
        Route::get('event/{id}/unsubscribe',array('as'=>'event.unsubscribe','uses'=>'EventsController@unsubscribe'));

        Route::resource('event.comments', 'CommentsController', array('only' => array('store')));

        Route::resource('blog','BlogsController', array('only' => array('index', 'show','view')));

        // User reset routes
        Route::get ('user/reset/{token}', 'UserController@getReset');
        Route::post('user/reset/{token}', 'UserController@postReset');
        Route::post('user/{id}/edit', 'UserController@postEdit');
        Route::get ('user/login', array('as' => 'user.getLogin', 'uses' => 'UserController@getLogin'));
        Route::post('user/login', array('as' => 'login', 'uses' => 'UserController@postLogin'));
        Route::get ('user/logout', array('as' => 'logout', 'uses' => 'UserController@getLogout'));
        Route::get ('user/{id}/profile', array('as' => 'profile', 'uses' => 'UserController@getProfile'));
        Route::get ('user/register', array('as'=>'register','uses'=>'UserController@create'));
        Route::post('user/register', array('uses'=>'UserController@store'));
        Route::get ('user/forgot', array('as'=>'forgot','uses'=>'UserController@getForgot'));
        Route::post('user/forgot', array('uses'=>'UserController@postForgot'));
        Route::get('user/{id}/edit', array('as'=>'user.edit','uses'=>'UserController@edit'));
        Route::get('user/confirm/{token}', array('as'=>'token','uses'=>'UserController@confirm'));
        Route::resource('user', 'UserController');

        // Contact Us Page
        Route::resource('contact-us','ContactsController', array('only' => array('index')));
        Route::post('contact-us/contact','ContactsController@contact');
    }
);

/* Admin Route Group */
Route::group(array('prefix' => 'admin','before'=>array('Auth','Moderator')), function() {
    # Comment Management

    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    # Blog Management
    Route::get('blogs/{id}/delete', 'AdminBlogsController@getDelete');
    Route::get('blogs/data', 'AdminBlogsController@getData');
    Route::resource('blogs', 'AdminBlogsController');

    # User Management
    Route::get('users/{user}/show', array('uses'=>'AdminUsersController@getShow'));
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::get('users/{id}/report','AdminUsersController@getReport');
    Route::post('users/{id}/report','AdminUsersController@postReport');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    // Admin Event Route
    Route::get('event/{id}/followers','AdminEventsController@getFollowers');
    Route::get('event/{id}/favorites','AdminEventsController@getFavorites');
    Route::get('event/{id}/subscriptions','AdminEventsController@getSubscriptions');
    Route::get('event/{id}/country','AdminEventsController@getCountry');
    Route::get('event/{id}/location','AdminEventsController@getLocation');
    Route::post('event/{id}/mailFollowers', 'AdminEventsController@mailFollowers');
    Route::post('event/{id}/mailSubscribers', 'AdminEventsController@mailSubscribers');
    Route::post('event/{id}/mailFavorites', 'AdminEventsController@mailFavorites');
    Route::get('event/{id}/location','AdminEventsController@getLocation');
    Route::get('event/{id}/settings','AdminEventsController@settings');
    Route::resource('event','AdminEventsController');

    //category
    Route::resource('category','AdminCategoriesController');

    //countries
    Route::resource('country', 'AdminCountriesController');

    //Location Routes
    Route::get('location/{id}/events', array('as'=>'LocationEvents','uses'=>'AdminLocationsController@getEvents'));
    Route::resource('locations','AdminLocationsController');

    //ads
    Route::resource('ads','AdminAdsController',array('only' => array('index','store')));

    //contact-us
    Route::resource('contact-us','AdminContactsController',array('only'=>array('index','store')));

    Route::resource('photo','AdminPhotosController');
    Route::resource('video','AdminVideosController');
    Route::resource('requests','AdminStatusesController');
    Route::resource('type','AdminTypesController');

    Route::get('event/{id}/requests',array('uses'=>'AdminEventsController@getRequests'));
    Route::resource('requests','AdminStatusesController');

    //certificates
    Route::resource('certificate-request','AdminCertificateRequestsController');
    Route::resource('certificate-status','AdminCertificateStatusesController');
    Route::resource('certificate-type','AdminCertificateTypesController');
    Route::resource('certificate-meta','AdminCertificateMetasController');
    Route::resource('certificate-option','AdminCertificateOptionsController');
    Route::resource('certificate-option-type','AdminCertificateOptionTypesController');
    Route::resource('certificates','AdminCertificateDashboardController');
    Route::resource('gallery','AdminGalleriesController');
    Route::get('gallery/{id}/photos','AdminGalleriesController@getPhotos');
    Route::post('gallery/{id}/photos','AdminGalleriesController@postPhotos');
    Route::post('gallery/{id}/video','AdminGalleriesController@postVideos');
    Route::get('/', 'AdminEventsController@index');
    Route::get('certificate-type/{id}/get-price','AdminCertificateTypesController@getPrice');

});

Route::get('forbidden',function() {
   return View::make('error.forbidden');
});


Route::get('/',
    function() {
    }
);
Route::get('/', array('uses' => 'HomeController@index', 'as'=>'home'));

//push queue worker
Route::post('queue/mails',function(){
   return Queue::marshal();
});

