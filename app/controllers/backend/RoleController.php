<?php
namespace backend;
use View; use Role; use Input; use Redirect; use Validator;
class RoleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = Role::paginate(10);
		return View::make('backend.role.index', compact('roles'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('backend.role.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$name = Input::get('name');
		$validator = Validator::make(
		    array('name' => $name),
		    array('name' => 'required|min:5|unique:role')
		);
		if ($validator->fails())
		{
			$messages = $validator->messages();
		    return Redirect::to('admin/role/create')->withErrors($messages);
		}
		Role::create(array('name' => $name));

		$messages = array('Un nouveau role vient de s\'inséré.');
		return Redirect::to('admin/role')->withMessages($messages);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = Role::find($id);
		return View::make('backend.role.edit', compact('role'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$role = Role::find($id);
		$name = Input::get('name');
		$validator = Validator::make(
		    array('name' => $name),
		    array('name' => 'required|min:5')
		);
		if ($validator->fails())
		{
			$messages = $validator->messages();
		    return Redirect::to("admin/role/$id/edit")->withInput()->withErrors($messages);
		}
		
		$role->name = $name;
		$role->save();
		$messages = array('Le role a été bien modifié.');
		return Redirect::route('admin.role.index')->withMessages($messages);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$role = Role::find($id);
		if ($role->delete()) {
			$messages = array('Le role a été bien supprimé.');
			return Redirect::route('admin.role.index')->withMessages($messages);
		}
	}


}
