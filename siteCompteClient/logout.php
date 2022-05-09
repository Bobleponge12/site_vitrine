<?php
session_start();   // INITIALISATION
session_unset();   // DESACTIVATION
session_destroy(); //DESTRUCTION
setcookie('auth', '', time() - 1, '/', null, false, true); //DESTRUCTION DU COOKIE

header('location:index.php');
exit(); // FACULTATIF CAR PAS DE CODE APRES
