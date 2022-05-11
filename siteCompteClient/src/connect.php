<?php

try {
	$bdd = new PDO('mysql:host=localhost;dbname=mon_projet_1;charset=utf8', 'root', '');
} catch (Exception $e) {
	die('Erreur connexion : ' . $e->getMessage());
}
