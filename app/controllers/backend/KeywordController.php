<?php
namespace backend;
use View; use Keyword; use Input; use Redirect; use Validator; use Session;
class KeywordController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$keywords = Keyword::paginate(10);
		return View::make('backend.keyword.index', compact('keywords'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		Session::flash('ckeditor_resources', '1');
		return View::make('backend.keyword.create');
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
		    array('name' => 'required|min:5|unique:keyword')
		);
		if ($validator->fails())
		{
			$messages = $validator->messages();
		    return Redirect::to('admin/keyword/create')->withErrors($messages)->withInput();
		}
		// return $content;
		Keyword::create(array('name' => $name,
								'content' => $content));

		$messages = array('Un nouvel keyword vient de s\'inséré.');
		return Redirect::to('admin/keyword')->withMessages($messages);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$keyword = Keyword::find($id);
		return View::make('backend.keyword.show', compact('keyword'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$keyword = Keyword::find($id);
		return View::make('backend.keyword.edit', compact('keyword'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$keyword = Keyword::find($id);

		$Keyword = Input::get('keyword');
		
		$validator = Validator::make(
		    array('Keyword' => $Keyword),
		    array('Keyword' => 'required|min:3|unique:keyword')
		);
		if ($validator->fails())
		{
			$messages = $validator->messages();
		    return Redirect::to("admin/keyword/$id/edit")->withInput()->withErrors($messages);
		}
		
		$keyword->Keyword = $Keyword;
		$keyword->save();
		$messages = array('Le mot clé a été bien modifié.');
		return Redirect::route('admin.keyword.index')->withMessages($messages);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$keyword = Keyword::find($id);
		if ($keyword->delete()) {
			$messages = array('Le mot clé a été bien supprimé.');
			return Redirect::route('admin.keyword.index')->withMessages($messages);
		}
	}


}
