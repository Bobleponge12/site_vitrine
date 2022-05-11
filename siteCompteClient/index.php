<?php

use function PHPSTORM_META\exitPoint;

session_start();

require('./src/log.php'); // ON VA VERIFIER SI UTILISATEUR LOGER->IL FAUT LE METTRE A CHAQUE PAGE

// VERIFICATION EMAIL ET PASSWORD REMPLI
if (!empty($_POST['email']) && !empty($_POST['password'])) {

	// VARIABLES
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);

	// VERIFICATION EMAIL VALIDE
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location:index.php?error=1&message=Cette adresse mail n\'est pas au bon format.');
		exit();
	}

	// CHIFFRAGE PASSWORD
	$password = "kt12" . sha1($password . "1205") . "23";


	// CONNEXION A LA BDD
	require('./src/connect.php');

	// VERIFICATION EMAIL
	$req = $bdd->prepare('SELECT COUNT(*)
					   AS emailValid
					   FROM user
					   WHERE email=?');

	$req->execute(array($email));

	while ($result = $req->fetch()) {
		if ($result['emailValid'] != 1) {
			header('location:index.php?error=1&message=Identifiants incorrects.');
			exit();
		}
	}

	$req = $bdd->prepare('SELECT *
					      FROM user
					      WHERE email=?');

	$req->execute(array($email));

	while ($user = $req->fetch()) {
		if ($password == $user['password'] && $user['blocked'] == 0) {

			//ACTIVATION DE SESSION
			$_SESSION['connect'] = 1;
			$_SESSION['email']   = $user['email'];

			//CREATION DU COOKIE SI CHEKBOX COCHEE
			if (isset($_POST['auto'])) {
				setcookie('auth', $user['secret'], time() + 365 * 24 * 3600, '/', null, false, true);
			}

			header('location:index.php?success=1');
			exit();
		} else header('location:index.php?error=1&message=Identifiants incorrects.');
		exit();
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Netflix</title>
	<link rel="stylesheet" type="text/css" href="design/default.css">
	<link rel="icon" type="image/pngn" href="../img/favicon.ico">
</head>

<body>

	<?php include('src/header.php'); ?>

	<section>
		<div id="login-body">

			<!-- DETECTER SESSION ACTIVE -->

			<?php if (isset($_SESSION['connect'])) { ?>
				<div class="center">
					<h1>Bonjour</h1>
					<?php
					// SUCCESS
					if (isset($_GET['success'])) {
						echo '<div class="alert success">Vous êtes à présent connecté.</div>';
					}
					?>

					<p>A vous de choisir !</p>
					<small><a href="logout.php">Déconnexion</a></small>
				</div>

			<?php } else { ?>

				<h1>S'identifier</h1>

				<!-- MESSAGES -->
				<?php

				// ERROR
				if (isset($_GET['error'])) {
					if (isset($_GET['message'])) {
						echo '<div class="alert error">' . htmlspecialchars($_GET['message']) . '</div>';
					}
				}

				?>

				<form method="post" action="index.php">
					<input type="email" name="email" placeholder="Votre adresse email" required />
					<input type="password" name="password" placeholder="Mot de passe" required />
					<button type="submit">S'identifier</button>
					<label id="option"><input type="checkbox" name="auto" checked />Se souvenir de moi</label>
				</form>


				<p class="grey">Première visite sur <span>DWD</span> ? <a href="inscription.php">Inscrivez-vous</a>.</p>
			<?php } ?>
		</div>
	</section>

	<?php include('src/footer.php'); ?>
</body>

</html>