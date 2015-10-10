<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Réinitialisation de votre mot de passe</h2>

		<div>
			Vous avez demandé de réinitialiser votre mot de passe .<br/>
			Pour réinitialiser votre mot de passe, veuillez remplir ce formulaire : {{ URL::to('password/reset', array($token)) }}.
		</div>
	</body>
</html>
