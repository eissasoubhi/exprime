<?php
namespace frontend;
use User; use View; use Input; use Validator; use Redirect;  use Hash;  use Role; use Auth; use Mail; use Hybrid_Auth;  use Session;
class UserController extends \BaseController {

    public function index()
    {
        $page_title = 'Accueil';
        return View::make('frontend.user.index', compact('page_title'));
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

        public function doSignUp($user_info = null)
    {
        $rules = array(
            'email'    => 'required|email|unique:user',
            'login'    => 'required|min:5|unique:user',
            'password'    => 'required|min:8|confirmed',
            'country'    => '',
            'city'    => '',
            'f_name'    => '',
            'l_name'    => '',
            'terms'    => 'required'
        );
        if ($user_info == null) {
            $user_info = Input::all();
            $user_info['f_name'] = '';
            $user_info['l_name'] = '';
        }
        else{
            $user_info['terms'] = 'on';
            $user_info['password_confirmation'] =  $user_info['password'];
        }
        // dd($user_info);
        $validator = Validator::make($user_info, $rules);

        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to("sign-up")->withErrors($messages)->withInput(Input::except('password'));;
        }

        $confirmation_code = str_random(30);

        $user = User::create(array('email' => $user_info['email'],
                            'login' => $user_info['login'],
                            'password' => Hash::make($user_info['password']),
                            'f_name' => $user_info['f_name'],
                            'l_name' => $user_info['l_name'],
                            'role_id' => Role::where('name','=','user')->first()->id,
                            'confirmation_code' => $confirmation_code));

        Mail::queue('emails.auth.verify', array("confirmation_code" => $confirmation_code), function($message) use($user_info) {
            $message->to($user_info['email'], $user_info['login'])
                ->subject('Verifiez votre adresse mail ');
        });
        $message = 'Félicitations ! Votre nouveau compte a été créé avec succès ! Merci de verifier votre email.';
        $userdata = array(
            'login' => $user_info['login'],
            'password' => $user_info['password'],
            'role_id' => Role::where('name','=','user')->first()->id
        );
        Auth::login($user, true);
        return View::make("message", compact("message"));
    }

    public function doLogin()
    {
        $rules = array(
            'login'    => 'required',
            'password' => 'required:'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            $messages = $validator->messages();

            return Redirect::to("login")->withInput(Input::except('password'))->withErrors($messages);
        }

        $userdata = array(
            'login' => Input::get('login'),
            'password' => Input::get('password')/*,
            'role_id' => Role::where('name','=','user')->first()->id*/
        );
        if(Auth::attempt($userdata, Input::has("save_cnt")))
        {
            return Redirect::intended(Input::get('next', '/'));
        }
        else
        {
            $errors = array( "Vos identifiants sont incorrects .");
            return Redirect::to('login')->withErrors($errors);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        $gauth=new Hybrid_Auth(app_path().'/config/google_auth.php');
        $gauth->logoutAllProviders();
        $fbauth=new Hybrid_Auth(app_path().'/config/fb_auth.php');
        $fbauth->logoutAllProviders();
        return Redirect::to('login');
    }

    public function login()
    {
        if (Auth::check()) {
            return Redirect::to('/');
        }
        return View::make('frontend.user.login');
    }

    public function show($id)
    {

    }

    public function edit()
    {
        $user = User::find(Auth::id());
        $page_title = "Profil - ".(($user->l_name and $user->f_name) ? $user->l_name.' '.$user->f_name : $user->login);
        $page_keywords = $user->login.', '.$user->l_name.' '.$user->f_name;
        return View::make('frontend.user.profile', compact('user', 'page_title', 'page_keywords'));
    }

    public function update()
    {
        $user = User::find(Auth::id());

        $login = Input::get('login');
        $l_name = Input::get('l_name');
        $f_name = Input::get('f_name');

        $validator = Validator::make(
            array('login' => $login,
                'l_name' => $l_name,
                'f_name' => $f_name),
            array('login' => 'required|min:5|unique:user,login,'.Auth::id(),
                'l_name' => 'min:3',
                'f_name' => 'min:3')
        );
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput(Input::except('password'));
        }

        $user->login = $login;
        $user->l_name = $l_name;
        $user->f_name = $f_name;
        $user->save();

        $messages = array('Les infos ont été bien modifiés.');
        return Redirect::back()->withMessages($messages);
    }
    public function passwordResetLink()
    {

        $token = str_random(30);
        $user = User::find(Auth::id());
        $user->password_reset_token = $token;
        $user->save();

        Mail::queue('emails.auth.reminder', array("token" => $token), function($message) {
            $message->to(Auth::user()->email, Auth::user()->login)
                    ->subject('Réinitialisation de mot de passe Exprime');
        });
        $result = array();
        if(count(Mail::failures()) > 0){
            $result['state'] = 'error';
            $result['msg'] = "Echec d'envoi de lien de réinitialisation de mot de passe à votre courrier électronique.";
        }
        else
        {
            $result['state'] = 'sent';
            $result['msg'] = "Consultez votre courrier électronique, Nous vous avons envoyé un lien de réinitialisation de mot de passe.";
        }
        return $result;
    }

    public function passwordReset()
    {
        return View::make('frontend.user.password_reset');
    }

    public function passwordChange($token)
    {
        $user = User::find(Auth::id());
        if ($user->password_reset_token === $token) {
            $new_password = Input::get('new_password');
            $new_password_confirmation = Input::get('new_password_confirmation');

            $validator = Validator::make(
                array('new_password' => $new_password, 'new_password_confirmation' => $new_password_confirmation),
                array('new_password' => 'required|confirmed|min:8')
            );

            if ($validator->fails())
            {
                $messages = $validator->messages();
                return Redirect::back()->withErrors($messages)->withInput(Input::except('new_password'));
            }
            $user->password = Hash::make(Input::get('new_password'));
            $user->password_reset_token = null;
            $user->save();
            $this->logout();
            $messages = array('Le mot de passe été bien modifié.');
            return Redirect::to("login")->withMessages($messages);
        }
    }
    public function test($request, $response)
    {
        return dd($request);
    }
}
