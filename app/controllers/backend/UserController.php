<?php 
namespace backend;
use User; use View; use Input; use Validator; use Redirect;  use Hash;  use Role;   use Auth; 
class UserController extends \BaseController {

	public function index()
	{
		$users = User::paginate(10);
		return View::make('backend.user.all_users', compact('users'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = Role::all();
		return View::make('backend.user.create',array('roles' => $roles));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$email = Input::get('email');
		$login = Input::get('login');
		$password = Input::get('password');
		$password_confirmation = Input::get('password_confirmation');
		$role_id = Input::get('role');
		$l_name = Input::get('l_name');
		$f_name = Input::get('f_name');
		$country = Input::get('country');
		$city = Input::get('city');

		$validator = Validator::make(
		    array('email' => $email,
				'login' => $login,
				'password' => $password,
				'password_confirmation' => $password_confirmation,
				'role_id' => $role_id,
				'l_name' => $l_name,
				'f_name' => $f_name,
				'country' => $country,
				'city' => $city),
		    array('email' => 'required|email|unique:user',
		    	'login' => 'required|min:5|unique:user',
		    	'password' => 'required|confirmed|min:8',
		    	'password_confirmation' => 'required|min:8',
		    	'role_id' => 'required|integer',
		    	'l_name' => 'min:3',
		    	'f_name' => 'min:3',
		    	'country' => 'min:3',
		    	'city' => 'min:2')
		);
		if ($validator->fails())
		{
			$messages = $validator->messages();
		    return Redirect::to('admin/user/create')->withErrors($messages)->withInput(Input::except('password'));;
		}
		User::create(array('email' => $email,
							'login' => $login,
							'password' => Hash::make($password),
							'role_id' => $role_id,
							'l_name' => $l_name,
							'f_name' => $f_name,
							'country' => $country,
							'city' => $city));
		$messages = array('Un nouvel utilisateur vient de s\'inséré.');
		return Redirect::to('admin/user')->withMessages($messages);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::all();
		return View::make('backend.user.edit', compact('user', 'roles'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);

		$email = Input::get('email');
		$login = Input::get('login');
		$old_password = Input::get('old_password');
		$new_password = Input::get('new_password');
		$new_password_confirmation = Input::get('new_password_confirmation');
		$role_id = Input::get('role');
		$l_name = Input::get('l_name');
		$f_name = Input::get('f_name');
		$country = Input::get('country');
		$city = Input::get('city');

		$validator = Validator::make(
		    array('email' => $email,
				'login' => $login,
				'old_password' => $old_password,
				'new_password' => $new_password,
				'new_password_confirmation' => $new_password_confirmation,
				'role_id' => $role_id,
				'l_name' => $l_name,
				'f_name' => $f_name,
				'country' => $country,
				'city' => $city),
		    array('email' => 'required|email|unique:user,email,'.$id,
		    	'login' => 'required|min:5|unique:user,login,'.$id,
		    	'old_password' => 'required_with:new_password,new_password_confirmation|min:8',
		    	'new_password' => 'required_with:old_password,new_password_confirmation|confirmed|min:8|different:old_password',
		    	'new_password_confirmation' => 'required_with:old_password,new_password|min:8',
		    	'role_id' => 'required|integer',
		    	'l_name' => 'min:3',
		    	'f_name' => 'min:3',
		    	'country' => 'min:3',
		    	'city' => 'min:2')
		);
		if ($validator->fails())
		{
			$messages = $validator->messages();
		    return Redirect::to('admin/user/'.$id.'/edit')->withErrors($messages)->withInput(Input::except('password'));
		}
		if (Input::has('old_password'))
		{
		   	if (!Hash::check($old_password, $user->password))
			{
				$errors = array(0 => 'Anicien mot de passe incorrect.');
			    return Redirect::to('admin/user/'.$id.'/edit')->withErrors($errors)->withInput(Input::except('password'));;
			}
		}		
		$user->email = $email;
		$user->login = $login;
		$user->password = Hash::make($new_password);
		$user->role_id = $role_id;
		$user->l_name = $l_name;
		$user->f_name = $f_name;
		$user->country = $country;
		$user->city = $city;
		$user->save();

		$messages = array('L\'utilisateur a été bien modifié.');
		return Redirect::to('admin/user')->withMessages($messages);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		if ($user->delete()) {
			$messages = array('L\'utilisateur a été bien supprimé.');
			return Redirect::route('admin.user.index')->withMessages($messages);
		}
	}


}
