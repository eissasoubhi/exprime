<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Vérifier votre adresse e-mail</h2>

        <div>
        	Merci d'avoir créé un compte exprime.<br>
            S'il vous plaît suivez le lien ci-dessous pour vérifier votre adresse e-mail
            {{ URL::to('register/verify/' . $confirmation_code) }}.<br/>
        </div>

    </body>
</html>