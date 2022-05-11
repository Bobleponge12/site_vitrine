<?php

if (isset($_COOKIE['auth']) && isset($_SESSION['connect'])) { // 2e condition pour eviter les 2 requetes à chaque fois(allège le serveur)

    // VARIABLE
    $secret = htmlspecialchars($_COOKIE['auth']);

    // VERIFICATION QUE UTILISATEUR EXISTE
    require('./src/connect.php');

    $req = $bdd->prepare('SELECT COUNT(*)
                          AS account
                          FROM user
                          WHERE secret=?');
    $req->execute(array($secret));

    // RECUPERATION INFORMATIONS UTILISATEUR
    while ($userSecret = $req->fetch()) {
        if ($userSecret['account'] == 1) {
        }
    }
}

// VERIFICATION SI UTILISATEUR EST BLOQUE
if (isset($_SESSION['connect'])) {
    require('./src/connect.php');

    $reqUser = $bdd->prepare('SELECT *
                              FROM user
                              WHERE email = ?');
    $reqUser->execute(array($_SESSION['email']));

    while ($userAccount = $reqUser->fetch()) {

        if ($userAccount['blocked'] == 1) {
            header('location:../logout.php');
            exit();
        }

        $_SESSION['connect'] = 1;
        $_SESSION['email']   = $userAccount['email'];
    }
}

// UPDATE LAST CONNEXION
if (isset($_SESSION['connect'])) {

    $reqUser = $bdd->prepare('UPDATE user
                              SET last_connexion = CURRENT_TIMESTAMP
                              WHERE email = ?');
    $reqUser->execute(array($_SESSION['email']));
}
