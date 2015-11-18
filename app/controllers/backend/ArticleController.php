<?php
namespace backend;
use View; use Article; use Input; use Redirect; use Validator; use Session;
class ArticleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = Article::paginate(10);
		return View::make('backend.article.index', compact('articles'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		Session::flash('ckeditor_resources', '1');
		return View::make('backend.article.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$name = Input::get('name');
		$content = Input::get('content');
		$validator = Validator::make(
		    array('name' => $name),
		    array('name' => 'required|min:2|unique:article')
		);
		if ($validator->fails())
		{
			$messages = $validator->messages();
		    return Redirect::to('admin/article/create')->withErrors($messages)->withInput();
		}
		// return $content;
		Article::create(array('name' => $name,
								'content' => $content));

		$messages = array('Un nouvel article vient de s\'inséré.');
		return Redirect::to('admin/article')->withMessages($messages);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$article = Article::find($id);
		return View::make('backend.article.show', compact('article'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		Session::flash('ckeditor_resources', '1');
		$article = Article::find($id);
		return View::make('backend.article.edit', compact('article'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$article = Article::find($id);
		$name = Input::get('name');
		$content = Input::get('content');
		$validator = Validator::make(
		    array('name' => $name),
		    array('name' => 'required|min:2|unique:article,id,'.$id)
		);
		if ($validator->fails())
		{
			$messages = $validator->messages();
		    return Redirect::to("admin/article/$id/edit")->withInput()->withErrors($messages);
		}

		$article->name = $name;
		$article->content = $content;
		$article->save();
		$messages = array('Le article a été bien modifié.');
		return Redirect::route('admin.article.index')->withMessages($messages);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$article = Article::find($id);
		if ($article->delete()) {
			$messages = array('L\'article a été bien supprimé.');
			return Redirect::route('admin.article.index')->withMessages($messages);
		}
	}


}
