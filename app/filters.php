<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	// return dd($request);
});

// App::after("frontend\StatisticController@create");

/*App::after(function($request, $response)
{
	// return print_r($response);
});*/

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/
// (Auth::check() && ! Auth::user()->hasRole("admin"))
Route::filter('admin', function () {
	// dd(Auth::user()->hasRole("admin"));
	if ( Auth::guest() && Route::current()->getPath() != "admin/login" ) {

		// return Redirect::guest('admin/login');
		return Redirect::guest('admin/login');
	}
	if (Auth::check()) {
		if (! Auth::user()->hasRole("admin") && Route::current()->getPath() != "admin/login") {
			return Redirect::guest('admin/login');
		}
	}
});


Route::filter('auth', function()
{
	if (Auth::guest())
	{
		$page_title = "page 401 :(";
		$article = Article::where('name','=', '401')->get()->first();
		if (!$article)
		{
			return Response::view('frontend.article.alternative-401-page', compact('page_title'), 401);
		}
	    return Response::view('frontend.article.index', compact('article','page_title'), 404);
	}
});

Route::filter('pic_permission', function($route)
{
	$id = $route->getParameter('id');
	$picture = Picture::find($id);
	if (!$picture)
	{
		App::abort(404);
	}
	if (Auth::guest() or !$picture->belongsToUser(Auth::user()) or !Auth::user()->hasAnyRole(array('admin','modirator')))
	{
		$page_title = "page 401 :(";
		$article = Article::where('name','=', '401')->get()->first();
		if (!$article)
		{
			return Response::view('frontend.article.alternative-401-page', compact('page_title'), 401);
		}
	    return Response::view('frontend.article.index', compact('article','page_title'), 404);
	}
});
Route::filter('comment_permission', function($route)
{
	$id = $route->getParameter('id');
	$comment = Comment::find($id);
	if (!$comment)
	{
		App::abort(404);
	}
	if (Auth::guest() or !$comment->belongsToUser(Auth::user()) or !Auth::user()->hasAnyRole(array('admin','modirator')))
	{
		$page_title = "page 401 :(";
		$article = Article::where('name','=', '401')->get()->first();
		if (!$article)
		{
			return Response::view('frontend.article.alternative-401-page', compact('page_title'), 401);
		}
	    return Response::view('frontend.article.index', compact('article','page_title'), 404);
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


