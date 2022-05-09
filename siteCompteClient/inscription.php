<?php
session_start();

require('./src/log.php');

// REDIRECTION SI SESSION OUVERTE
if (isset($_SESSION['connect'])) {
	header('location:index.php');
	exit();
}

// DETECTION ET VERIFICATION DE L'ENVOI DU FORMULAIRE
if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_two'])) {

	// CONNEXION A LA BDD
	require('./src/connect.php');

	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$password_two = htmlspecialchars($_POST['password_two']);
	// $_SESSION['secret'] = rand() * 3.14;
	// $secret = $_SESSION['secret'];

	// VERIFICATION DU MOT DE PASSE

	if ($password != $password_two) {
		header('location:inscription.php?error=1&message=Les mots de passe doivent être identique.');
		exit();
	}

	// VERIFICATION DU BON FORMAT DU MAIL
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location:inscription.php?error=1&message=Adresse email invalide.');
		exit();
	}
	// VERIFICATION EMAIL PAS DEJA DANS LA BDD

	$req = $bdd->prepare('SELECT COUNT(*)
					   	  AS emailEnregistre
					      FROM user
					      WHERE email = ?');

	$req->execute(array($email));

	while ($result = $req->fetch()) {
		if ($result['emailEnregistre'] != 0) {
			header('location:inscription.php?error=1&message=Adresse mail déjà enregistrée.');
			exit();
		}
	}

	// CHIFFRER LES PASSWORDS
	$password = "kt12" . sha1($password . "1205") . "23";

	// HASH $secret
	$secret = sha1($email) . time();
	$secret = sha1($secret) . time(); // DOUBLE SECURITE

	// REQUETE AJOUT UTILISATEUR
	$req = $bdd->prepare('INSERT INTO user (email, password, secret)
							  VALUE (?, ?, ?)');
	$req->execute(array($email, $password, $secret));

	header('location:inscription.php?success=1&message=Votre inscription a été validée.');
	exit();
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Netflix</title>
	<link rel="stylesheet" type="text/css" href="design/default.css">
	<link rel="icon" type="image/pngn" href="img/favicon.png">
</head>

<body>

	<?php include('src/header.php'); ?>

	<section>
		<div id="login-body">
			<h1>S'inscrire</h1>

			<!-- AFFICHAGE DE L EVENTUELLE ERREUR -->
			<?php
			if (isset($_GET['error'])) {
				if (isset($_GET['message'])) {

					echo '<div class="alert error">' . htmlspecialchars($_GET['message']) . '</div>';
				}
			} else if (isset($_GET['success'])) {
				echo '<div class="alert success">' . htmlspecialchars($_GET['message']) . '<a href="index.php">&nbsp&nbsp&nbsp&nbspConnexion</a></div>';
			}
			?>

			<form method="post" action="inscription.php">
				<input type="email" name="email" placeholder="Votre adresse email" required />
				<input type="password" name="password" placeholder="Mot de passe" required />
				<input type="password" name="password_two" placeholder="Retapez votre mot de passe" required />
				<button type="submit">S'inscrire</button>
			</form>

			<p class="grey">Déjà sur Netflix ? <a href="index.php">Connectez-vous</a>.</p>
		</div>

	</section>

	<?php include('src/footer.php'); ?>
</body>

</html>