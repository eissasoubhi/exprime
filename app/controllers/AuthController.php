<?php

class AuthController extends \BaseController
{

    public function getTwitterLogin($auth=NULL)
    {
        if ($auth == 'auth')
        {
            Hybrid_Endpoint::process();
            return;
        }
        try
        {
            $oauth = new Hybrid_Auth(app_path(). '/config/twitterAuth.php');
            $provider = $oauth->authenticate('Twitter');
            $profile = $provider->getUserProfile();
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }

        return var_dump($profile).'<a href="logout">Log Out</a>';

    }

    //this is the code for facebook Login
    public function getFacebookLogin($auth=NULL)
    {
        // dd($auth);
        if ($auth == 'auth')
        {
            try
            {
                Hybrid_Endpoint::process();
            }
            catch (Exception $e)
            {
                return Redirect::to('fbauth');
            }
            return;
        }

        $oauth = new Hybrid_Auth(app_path(). '/config/fb_auth.php');
        $provider = $oauth->authenticate('Facebook');
        $profile = $provider->getUserProfile();

        if ($user = User::where('email', '=', $profile->email)->first()) {
            Auth::login($user, true);
            return Redirect::intended('/');
        }
        return App::make('frontend\UserController')->doSignUp(array('email' => $profile->email,
                                                                    'login' => $profile->identifier,
                                                                    'password' =>"pass1234",
                                                                    'f_name' => $profile->firstName,
                                                                    'l_name' => $profile->lastName));
    }

    //this is the method that will handle the Google Login

    public function getGoogleLogin($auth=NULL)
    {
        if ($auth == 'auth')
        {
             Hybrid_Endpoint::process();

        }
        try {
            $oauth = new Hybrid_Auth(app_path() . '/config/google_auth.php');
            $provider = $oauth->authenticate('Google');
            $profile = $provider->getUserProfile();
        }
        catch(exception $e)
        {
            return $e->getMessage();
        }
        if ($user = User::where('email', '=', $profile->email)->first()) {
            Auth::login($user, true);
            return Redirect::intended('/');
        }
        return App::make('frontend\UserController')->doSignUp(array('email' => $profile->email,
                                                                    'login' => $profile->identifier,
                                                                    'password' =>"pass1234",
                                                                    'f_name' => $profile->firstName,
                                                                    'l_name' => $profile->lastName));

    }


    public function getLoggedOut()
    {
        // $hauth = new Hybrid_Auth(app_path() . '/config/twitterAuth.php');
        // $hauth = new Hybrid_Auth(app_path() . '/config/fb_auth.php');
        //You can use any of the one provider to get the variable, I am using google
        //this is important to do, as it clears out the cookie
        $hauth=new Hybrid_auth(app_path().'/config/google_auth.php');
        $hauth->logoutAllProviders();
        return View::make('login');

    }




}
