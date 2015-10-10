<?php
class RegistrationController extends \BaseController {

    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            $error = 'Adresse URL invalide !';
            return View::make('message', compact("error"));
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            $error = 'Adresse URL invalide !';
            return View::make('message', compact("error"));
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
        $message = 'Vous avez vérifié votre compte avec succès.';
        return View::make('message', compact("message"));
    }
}