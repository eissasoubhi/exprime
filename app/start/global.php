<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',
	app_path().'/classes',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);

	$url = Request::url();
	$code = $exception->getCode();
	$msg = $exception->getMessage();
	$file = $exception->getFile();
	$line =$exception->getLine();
	$file_in_db = mysql_real_escape_string ($file);
	$line_in_db =mysql_real_escape_string ($line);

	$fatal = 0;

	if(!Error::whereRaw("url = '$url' and code = '$code' and file = '$file_in_db' and line = $line_in_db")->exists()){

		$type = str_contains($msg, "SQL") ? "mysql" : "php" ;

		Error::create(array('url' => url($url),
							'code' => $code,
							'msg' => $msg,
							'file' => $file,
							'line' => $line,
							'fatal' => $fatal,
							'type' => $type));
	}

});

App::fatal(function($exception)
{
	$url = Request::url();
	$code = $exception->getCode();
	$msg = $exception->getMessage();
	$file = $exception->getFile();
	$line =$exception->getLine();
	$file_in_db = mysql_real_escape_string ($file);
	$line_in_db =mysql_real_escape_string ($line);
	$fatal = 1;

	if(!Error::whereRaw("url = '$url' and code = '$code' and file = '$file_in_db' and line = $line_in_db")->exists()){

		$type = str_contains($msg, "SQL") ? "mysql" : "php" ;

		Error::create(array('url' => url($url),
							'code' => $code,
							'msg' => $msg,
							'file' => $file,
							'line' => $line,
							'fatal' => $fatal,
							'type' => $type));
	}

});
App::missing(function($exception)
{
	$page_title = "page 404 :(";
	$article = Article::where('name','=', '404')->get()->first();
	if (!$article) {
		return Response::view('frontend.article.alternative-404-page', compact('page_title'), 404);
	}
    return Response::view('frontend.article.index', compact('article','page_title'), 404);
});
/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';
