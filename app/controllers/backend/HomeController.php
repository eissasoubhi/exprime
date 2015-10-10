<?php namespace backend;
use Input; use View; use Auth; use Redirect; use User; use Hash; use Role; use Session; use Validator; use Picture;
class HomeController extends \BaseController {

	public function index()
	{
        // return dd(Auth::check());
		if (Auth::check() && Auth::user()->hasRole("admin")) {
            Session::flash('jscroll_resources', '1');
            $pictures = Picture::simplePaginate(12);
			return View::make('backend.user.index', compact('pictures'));
		} else {
			return Redirect::to('admin/login');
		}
	}


	public function isLogin()
	{
        // return dd(Auth::check());
        if (Auth::check() && Auth::user()->hasRole("admin")) {
            return Redirect::to('admin');
        }
		return View::make('backend.user.login');
	}


	public function login()
	{
		$rules = array(
            'login'    => 'required',
            'password' => 'required' 
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            $messages = $validator->messages();

            return Redirect::to("admin/login")->withInput(Input::except('password'))->withErrors($messages);
        }

        $userdata = array(
            'login' => Input::get('login'),
            'password' => Input::get('password'),
            'role_id' => Role::where('name','=','admin')->first()->id
        );
        if(Auth::attempt($userdata, Input::has("save_cnt"))) 
        {
            return Redirect::intended('admin');
        }
        else
        {
            $errors = array( "Vos identifiants sont incorrects ou vous n'avez pas le droit d'accès .");
            return Redirect::to('admin/login')->withErrors($errors);
        }
	}

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('admin/login');
    }

}
