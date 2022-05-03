<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once './includes/Exception.php';
require_once './includes/PHPMailer.php';
require_once './includes/SMTP.php';

if (!empty($_POST['email']) && !empty($_POST['nom'])) {



  // ENVOIE MAIL AVEC PHPMAILER
  $mail = new PHPMailer(true); // true pour gérer le Exeception

  try {
    // Configuration
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Pour avoir des informations de debug

    //On configure le SMTP
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;

    //Charset
    $mail->CharSet = "utf-8";

    //Destinataire
    $mail->addAddress("rimkus12@outlook.com");

    // $mail->addBCC("rimkus12@outlook.com"); // Copie cachée

    //Expediteur
    $expediteur = $_POST['email'];
    $mail->Username = 'ktareb80@gmail.com';
    $mail->Password = 'JesuisRimkus12!';
    $mail->setFrom($expediteur);

    // Contenu
    $mail->Subject = "Mail client.";
    $message = $_POST['message'];
    $mail->Body = $message;

    // On envoi
    $mail->send();
    echo "Message envoyé !";
  } catch (Exception) {
    echo "Message non envoyé. Erreur: {$mail->ErrorInfo}";
  }
}


// ENVOIE MAIL SANS PHPMAILER
// if (!empty($_POST['email']) && !empty($_POST['nom'])) {
//   $email = htmlspecialchars($_POST['email']);
//   $nom   = htmlspecialchars($_POST['nom']);
//   $prenom = htmlspecialchars($_POST['prenom']);
//   $message = htmlspecialchars($_POST['message']); // . ' ' . $email . ' ' . $nom . ' ' . $prenom;
//   $message = wordwrap($message, 70, '\r\n'); // Pour couper le message en ligne de 70 caractères pour éviter les problème sur certain navigateur
//   $to = htmlspecialchars('ktareb80@gmail.com');
//   $subject = htmlspecialchars('Demande de contact');
//$headers = [
// "From" => $email,
//  "Content-Type" => "text/html; charset=utf8" // Pour mettre du html dans le message
// "Nom"  => $nom,
// "Prénom" => $prenom
// ];

//   if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     mail($to, $subject, $message);
//   } else header('location:contact.php');
//   exit();
// }

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./design/bootstrap.min.css" />
  <link rel="stylesheet" href="./design/bootstrap.min.css.map" />
  <link rel="stylesheet" href="./design/style.css" />
  <link rel="stylesheet" href="./design/styleAnimReseau.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <title>Contact</title>
</head>

<body>
  <!-- HEADER -->

  <header class="p-5 text-center" style="
        background: center/cover url('img/sommet_nuage_aurore_1920x1280.jpg');
      ">
    <div id="presentation" class="container">
      <p class="dwd">DWD</p>
    </div>
  </header>

  <!-- Barre de navigation -->

  <nav class="navbar sticky-top bg-dark navbar-dark navbar-expand-md">
    <!-- Le breakpoint se précise dans ce cas-->
    <div class="container">
      <div class="navbar-brand">Portail</div>

      <div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#monMenuDeroulant">
        <span class="navbar-toggler-icon"></span>
      </div>

      <div class="collapse navbar-collapse" id="monMenuDeroulant">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.html" class="nav-link">Accueil</a>
          </li>
          <li class="nav-item">
            <a href="./vitrine.html" class="nav-link">Vitrine</a>
          </li>
          <li class="nav-item">
            <a href="./contact.php" class="nav-link">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- INSCRIPTION     -->
  <section style="
        background: center/cover
          url('img/mur_brique_rouge_marron_1920x1280.jpg');
      ">
    <div class="container">
      <div class="text-white text-center p-5">
        <h3>
          Inscriptions Espace Membre<span class="d-block fw-light">Année 2022-2023</span>
        </h3>

        <div class="btn-group m-3">
          <button id="mesOptions" type="button" class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
            Document
          </button>

          <!-- <button type="button" class="btn btn-light ">
                    <span class="visually-hidden">Options</span>
                </button> -->
          <ul class="dropdown-menu" aria-labelledby="mesOptions">
            <li><a class="dropdown-item" href="#">Newsletter</a></li>
            <li><a class="dropdown-item" href="#">Parrainage</a></li>
            <li><a class="dropdown-item" href="#">Partenariat</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <section class="fondDePage">
    <div class="container text-center p-5">
      <h1>CONTACT</h1>
    </div>

    <div id="messageContact" class="container text-center">
      <p>Vous pouvez nous contacter avec ce formulaire ou par tel au :</p>
      <a id="tel" href="tel:0682254811"> 06 82 25 48 11</a>
    </div>

    <!-- FORMULAIRE -->

    <div class="container">
      <div class="row p-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <!-- Début -->
          <form method="post" action="contact.php">
            <!-- E-mail -->
            <div class="mb-3">
              <label for="emailForm" class="form-label">Adresse e-mail *</label>
              <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Votre mail est indispensable." required />
              <div id="emailInfo" class="form-text">
                Nous ne partagons pas votre e-mail
              </div>
            </div>
            <!-- Nom -->
            <div class="mb-3">
              <label for="nom" class="form-label text-white">Nom *</label>
              <input type="text" class="form-control" name="nom" placeholder="Votre nom est indispensable." required />
            </div>

            <!-- Prénom -->
            <div class="mb-3">
              <label for="prenom" class="form-label text-white">Prénom</label>
              <input type="text" class="form-control" name="prenom" placeholder="Veuillez entrer votre prénom." />
            </div>

            <!-- Text area -->
            <div class="mb-3">
              <label for="message" class="form-label text-white">Vous pouvez ajouter une message(5 lignes max).</label>
              <textarea class="form-control" name="message" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-secondary">Soumettre</button>
          </form>
        </div>

        <div class="col-md-2"></div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="fondNoir text-white p-3">
    <div class="row text-center">
      <!-- <div class="col-2"></div> -->
      <div id="reseauSociau" class="col-md-4 mt-4">
        <!-- Liens Réseaux Sociaux Animés -->
        <div class="box">
          <!-- CHECKBOX -->
          <input type="checkbox" name="checkbox" id="checkbox" />

          <!-- MENU -->

          <div class="menu">
            <a href="#">
              <div class="menuItems">
                <i class="fa-brands fa-whatsapp"></i>
              </div>
            </a>
          </div>

          <div class="menu">
            <a href="#">
              <div class="menuItems">
                <i class="fa-brands fa-instagram"></i>
              </div>
            </a>
          </div>
          <div class="menu">
            <a href="#">
              <div class="menuItems">
                <i class="fa-brands fa-facebook"></i>
              </div>
            </a>
          </div>
          <div class="menu">
            <a href="#">
              <div class="menuItems">
                <i class="fa-brands fa-twitter"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-4 dwd">DWD</div>
      <div class="col-md-2"></div>
      <!-- Nom  et Année -->
      <div class="col-md-2 mt-5 fs-5">2022 © Karim Tareb</div>
    </div>
  </footer>
</body>

</html>