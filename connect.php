<?php
require 'config.php';
$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
$user = DB_USERNAME;
$password = DB_PASSWORD;

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

$req = $dbh->prepare('SELECT * FROM utilisateur WHERE valide = 1');
$req->execute();