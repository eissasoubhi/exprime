<?php namespace frontend;
use Input; use View; use Auth; use Redirect; use User; use Hash; use Role; use Session; use Validator; use Picture; use Mail; use Flash;
class HomeController extends \BaseController {

	public function index()
	{
		return View::make('frontend.user.index');
	}


	public function isLogin()
	{
        if (Auth::check()) {
            return Redirect::to('/');
        }
		return View::make('frontend.user.login');
	}

    public function signUp()
    {
        if (Auth::check()) {
            return Redirect::to('/');
        }
        return View::make('frontend.user.sign-up');
    }

        public function doSignUp()
    {
        $rules = array(
            'email'    => 'required|email|unique:user',
            'login'    => 'required|min:5|unique:user',
            'password'    => 'required|min:8|confirmed',
            'terms'    => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput(Input::except('password'));;
        }

        $confirmation_code = str_random(30);

        $user = User::create(array('email' => Input::get('email'),
                            'login' => Input::get('login'),
                            'password' => Hash::make(Input::get('password')),
                            'role_id' => Role::where('name','=','user')->first()->id,
                            'confirmation_code' => $confirmation_code));

        Mail::queue('emails.auth.verify', array("confirmation_code" => $confirmation_code), function($message) {
            $message->to(Input::get('email'), Input::get('username'))
                ->subject('Verifiez votre adresse mail ');
        });
        // return dd($user);
        $messages = array('Félicitations ! Votre nouveau compte a été créé avec succès ! Merci de verifier votre email.');
        return Redirect::back()->withMessages($messages);
    }

	public function login()
	{
		$rules = array(
            'login'    => 'required',
            'password' => 'required:'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            $messages = $validator->messages();

            return Redirect::to("/login")->withInput(Input::except('password'))->withErrors($messages);
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
        return Redirect::to('login');
    }

}
