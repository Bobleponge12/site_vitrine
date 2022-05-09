<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// AVEC PHPMAILER
require_once('./includes/Exception.php');
require_once('./includes/PHPMailer.php');
require_once('./includes/SMTP.php');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
if (!empty($_POST['email']) && !empty($_POST['nom'])) {
  try {
    ob_start();
    //DECLARATION DES VARIABLES
    $email = htmlspecialchars($_POST['email']);
    $nom   = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $message = htmlspecialchars($_POST['message']); // . ' ' . $email . ' ' . $nom . ' ' . $prenom;
    $message = wordwrap($message, 70, '\r\n'); // Pour couper le message en ligne de 70 caractères pour éviter les problème sur certain navigateur

    $ficheClient = "
        <h2>Fiche client</h2>
    <table>
      <tr>
        <th>Nom:</th>
        <td>" . $nom . "</td>
      </tr>
      <tr>
        <th>Prénom:</th>
        <td>" . $prenom . "</td>
      </tr>
      <tr>
        <th>Email:</th>
        <td>" . $email . "</td>
      </tr>
      <tr>
        <th>Téléphone: </th>
        <td>" . $telephone . "</td>
      </tr>
      <tr>
        <th>Message: </th>
        <td>" . $message . "</td>
      </tr>
    </table>
        ";


    //Server settings
    $mail->SMTPDebug  = SMTP::DEBUG_SERVER;            //Enable verbose debug output
    $mail->isSMTP();                                   //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';              //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                          //Enable SMTP authentication
    $mail->Username   = 'ktareb80@gmail.com';          //SMTP username
    $mail->Password   = 'JesuisRimkus12!';             //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   //Enable implicit TLS encryption
    // $mail->SMTPDebug = 1;

    $mail->Port       = 465;                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );

    //Recipients
    $mail->setFrom('tareb.karim@orange.fr', 'Expediteur');
    $mail->addAddress('karim.tareb@orange.fr', 'Destinataire');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Test envoi mail PHPMailer';
    //$mail->Body    = $_POST['prenom'] . ' vous à contacté. Voici son adresse mail : <br>'
    //     . $_POST['email'];
    $mail->Body = $ficheClient;

    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      try {
        $mail->send();
        header('location:./messageEnvoye.html');
        exit();
      } catch (Exception $e) {
        echo $e->getMessage();
        echo 'Mail pas envoyé';
      }
    } else header('location:contact.php');
    exit();
    ob_end_flush();
  } catch (Exception) {
    echo "Le message n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
  }
}

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

            <!-- Téléphone -->
            <div class="mb-3">
              <label for="telephone" class="form-label text-white">Téléphone</label>
              <input type="text" class="form-control" name="telephone" placeholder="Veuillez entrer votre téléphone." />
            </div>

            <!-- Text area -->
            <div class="mb-3">
              <label for="message" class="form-label text-white">Vous pouvez ajouter une message(3 lignes max).</label>
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