<?php
Route::pattern('id', '[0-9]+');

Route::pattern('token', '[0-9a-z]+');

/*********************************************************************************************************
 * Event Routes
 ********************************************************************************************************/
Route::get('event/{id}/online', 'EventsController@streamEvent');

Route::get('event/{id}/offline', 'EventsController@streamEventOld');

Route::get('event/{id}/category', 'EventsController@getCategory');

Route::get('event/{id}/author', 'EventsController@getAuthor');

Route::get('event/{id}/follow', array('as' => 'event.follow', 'uses' => 'EventsController@follow'));

Route::get('event/{id}/unfollow', array('as' => 'event.unfollow', 'uses' => 'EventsController@unfollow'));

Route::get('event/{id}/favorite', array('as' => 'event.favorite', 'uses' => 'EventsController@favorite'));

Route::get('event/{id}/unfavorite', array('as' => 'event.unfavorite', 'uses' => 'EventsController@unfavorite'));

Route::get('events/featured', array('as' => 'event.featured', 'uses' => 'EventsController@getSliderEvents'));

Route::get('event/{id}/country', 'EventsController@getCountry');

Route::get('event/{id}/options', 'EventsController@showSubscriptionOptions');

Route::get('event/{id}/suggest', 'EventsController@getSuggestedEvents');

Route::post('event/{id}/organize', 'EventsController@reorganizeEvents');

Route::get('event/{id}/organize', 'EventsController@reorganizeEvents');

Route::resource('event.comments', 'CommentsController', array('only' => array('store')));

Route::get('online-event', 'EventsController@onlineTestEvent');

Route::resource('event', 'EventsController', array('only' => array('index', 'show')));

/*********************************************************************************************************
 * Subscription Route
 ********************************************************************************************************/
Route::get('package', 'SubscriptionsController@subscribePackage');

Route::post('subscribe', 'SubscriptionsController@subscribe');

Route::get('subscribe', 'SubscriptionsController@subscribe');

Route::get('event/{id}/confirm', 'SubscriptionsController@confirmSubscription');

Route::get('event/{id}/unsubscribe', 'SubscriptionsController@unsubscribe');

/*********************************************************************************************************
 * Contact Us Route
 ********************************************************************************************************/
Route::resource('contact', 'ContactsController', array('only' => array('index')));

Route::post('contact/contact', 'ContactsController@contact');

/*********************************************************************************************************
 * Auth Routes
 ********************************************************************************************************/
Route::get('account/login', ['as' => 'user.login.get', 'uses' => 'AuthController@getLogin']);

Route::post('account/login', ['as' => 'user.login.post', 'uses' => 'AuthController@postLogin']);

Route::get('account/logout', ['as' => 'user.logout', 'uses' => 'AuthController@getLogout']);

Route::get('account/signup', ['as' => 'user.register.get', 'uses' => 'AuthController@getSignup']);

Route::post('account/signup', ['as' => 'user.register.post', 'uses' => 'AuthController@postSignup']);

Route::get('account/forgot', ['as' => 'user.forgot.get', 'uses' => 'AuthController@getForgot']);

Route::post('account/forgot', ['as' => 'user.forgot.post', 'uses' => 'AuthController@postForgot']);

Route::get('password/reset/{token}', ['as' => 'user.token.get', 'uses' => 'AuthController@getReset']);

Route::post('password/reset', ['as' => 'user.token.post', 'uses' => 'AuthController@postReset']);

Route::get('account/activate/{token}', ['as' => 'user.token.confirm', 'uses' => 'AuthController@activate']);

Route::post('account/send-activation-link', ['as' => 'user.token.send-activation', 'uses' => 'AuthController@sendActivationLink']);

/*********************************************************************************************************
 * Posts
 ********************************************************************************************************/

Route::resource('blog', 'BlogsController', array('only' => array('index', 'show', 'view')));

/*********************************************************************************************************
 * User Routes
 ********************************************************************************************************/
Route::get('user/{id}/profile', array('as' => 'profile', 'uses' => 'UserController@getProfile'));

Route::resource('user', 'UserController');

/*********************************************************************************************************
 * Category Routes
 ********************************************************************************************************/
Route::get('category/{id}/event', array('as' => 'CategoryEvents', 'uses' => 'CategoriesController@getEvents'));

Route::get('category/{id}/blog', array('as' => 'CategoryPosts', 'uses' => 'CategoriesController@getPosts'));

/*********************************************************************************************************
 * Newsletter Routes
 ********************************************************************************************************/
Route::post('newsletter/subscribe', 'NewslettersController@subscribe');

/*********************************************************************************************************
 * Gallery Routes
 ********************************************************************************************************/
Route::resource('gallery', 'GalleriesController', array('index','view') );

Route::get('gallery/{id}/album', ['as'=>'album','uses'=>'GalleriesController@showAlbum']);


/*********************************************************************************************************
 * Cerificate Routes
 ********************************************************************************************************/
Route::get('certificate-request/{id}/print/','CertificateRequestsController@printDetail');

Route::resource('certificate-request','CertificateRequestsController');

/*********************************************************************************************************
 * MISC ROUTES
 ********************************************************************************************************/
Route::get('forbidden', function () {
    return View::make('error.forbidden');
});

Route::get('country/{country}', 'LocaleController@setCountry');

/*********************************************************************************************************
 * Home Route
 ********************************************************************************************************/

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

/*********************************************************************************************************
 * Admin Routes
 ********************************************************************************************************/

/* Admin Route Group */
Route::group(array('prefix' => 'admin','before'=>array('Auth','Moderator')), function() {

    /*********************************************************************************************************
     * Cerificate Routes
     ********************************************************************************************************/

    Route::get('certificate-request/{id}/print/','AdminCertificateRequestsController@printDetail');
    Route::resource('certificate-request','AdminCertificateRequestsController');
    Route::resource('certificate-status','AdminCertificateStatusesController');
    Route::resource('certificate-type','AdminCertificateTypesController');
    Route::resource('certificate-meta','AdminCertificateMetasController');
    Route::resource('certificate-option','AdminCertificateOptionsController');
    Route::resource('certificate-option-type','AdminCertificateOptionTypesController');
    Route::resource('certificates','AdminCertificateDashboardController');
    Route::get('certificate-type/{id}/get-price','AdminCertificateTypesController@getPrice');
    Route::get('certificate-option/{typeId}/option/{optionId}/get-price','AdminCertificateOptionTypesController@getPrice');

    /*********************************************************************************************************
     * Gallery Routes
     ********************************************************************************************************/

    Route::get('gallery/{id}/photos','AdminGalleriesController@getPhotos');
    Route::post('gallery/{id}/photos','AdminGalleriesController@postPhotos');
    Route::post('gallery/{id}/video','AdminGalleriesController@postVideos');
    Route::resource('gallery','AdminGalleriesController');

    //Newsletters
    Route::resource('newsletters','AdminNewslettersController');

    Route::get('/', 'AdminEventsController@index');
});



