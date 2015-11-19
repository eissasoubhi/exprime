<?php


View::share('title', "Exprime");
View::share('page_title', "");

$pictures_count = Picture::all()->count();
$users_count = User::all()->count();
$emails_count = Email::all()->count();
$bugs_count = 0;
$sugs_count = 0;

View::share('pictures_count', $pictures_count);
View::share('users_count', $users_count);
View::share('emails_count', $emails_count);
View::share('bugs_count', $bugs_count);
View::share('sugs_count', $sugs_count);

Route::when('admin/*', 'admin');
Route::when('admin', 'admin');

Route::group([ 'prefix' => 'admin', 'namespace' => 'backend' ], function () {

	Route::get('/', 'HomeController@index');
    Route::get('login', 'HomeController@isLogin');
    Route::post('login','HomeController@login');
    Route::get('logout','HomeController@logout');

    Route::post('picture/checkExists', array('as' => 'checkExists', 'uses' =>  'PictureController@checkExists'));
    Route::post('picture/upload', array('as' => 'upload', 'uses' =>  'PictureController@upload'));


	Route::resource('role', 'RoleController');
	Route::resource('user', 'UserController');
	Route::resource('email', 'EmailController');
	Route::resource('article', 'ArticleController');
	Route::resource('picture', 'PictureController');
	Route::resource('keyword', 'KeywordController');
	Route::resource('error', 'ErrorController');
	Route::resource('statistic', 'StatisticController');

});

Route::group(['namespace' => 'frontend' ], function () {
    //  auth filter
    Route::group(array('before' => 'auth'), function()
    {
        Route::get('profile', 'UserController@edit');
        Route::post('profile', 'UserController@update');
        Route::post('tempup', 'PictureController@uploadTemp');
        Route::get('upload', 'PictureController@create');
        Route::post('upload', 'PictureController@store');
        Route::get('likes', 'PictureController@likes');
        Route::post('img/comment/store', 'CommentController@store');
        Route::get('img/edit/{id}', 'PictureController@edit');
        Route::post('img/edit/{id}', 'PictureController@update');
    });
    //picture filter
    Route::group(array('before' => 'pic_permission'), function()
    {
        Route::delete('img/picture/destroy/{id}', 'PictureController@destroy');
    });

    //  comment filter
    Route::group(array('before' => 'comment_permission'), function()
    {
        Route::post('img/comment/update/{id}', 'CommentController@update');
        Route::delete('img/comment/destroy/{id}', 'CommentController@destroy');
    });


	Route::get('/', 'UserController@index');
	Route::get('sign-up', 'UserController@signUp');
	Route::post('sign-up', 'UserController@doSignUp');
	Route::post('password/reset', 'UserController@passwordResetLink');
	Route::get('password/reset/{token}', 'UserController@passwordReset');
	Route::post('password/reset/{token}', 'UserController@passwordChange');
	Route::get('logout', 'UserController@logout');
	Route::get('login', 'UserController@login');
	Route::post('login', 'UserController@doLogin');
	Route::get('explorer', 'PictureController@index');
	Route::get('ajax/keywords', 'PictureController@keywords');
	Route::get('img/search', 'PictureController@search');
    Route::get('img/show/{id}/{name?}', 'PictureController@show');
    Route::get('img/show/{id}/{name?}', 'PictureController@show');
    Route::get('img/show/{id}/{name?}', 'PictureController@show');
	Route::get('img/download/{name}', 'PictureController@download');
	Route::get('img/toggleLike/{id}', 'PictureController@toggleLike');
	Route::get('page/{name}', 'ArticleController@index');
	Route::get('contact', 'ArticleController@contact');
	Route::post('contact', 'ArticleController@send');
});
Route::get('fbauth/{auth?}',array('as'=>'facebookAuth','uses'=>'AuthController@getFacebookLogin'));
Route::get('gauth/{auth?}',array('as'=>'googleAuth','uses'=>'AuthController@getGoogleLogin'));
Route::get('register/verify/{confirmationCode}', ['as' => 'confirmation_path', 'uses' => 'RegistrationController@confirm']);
Route::post('queue/receive', function()
{
    return Queue::marshal();
});
// Route::get('ironmq',function ()
// {
//     $time = time();
//     Queue::push(function ($job) use($time)
//     {
//         File::append(app_path()."/time.txt",$time.PHP_EOL);
//     });
// });
/*Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});*/

/*array (size=5)
  'city' => string 'imlil' (length=5)
  'country' => string 'Italy' (length=5)
  'url' => string 'http://localhost:8000/page/about' (length=32)
  'time' => int 1436548913
  'count' => int 1*/