<?php
// Démarre la session seulement si elle n’est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host     = "mysql-hamed-wassila.alwaysdata.net";
$dbname   = "hamed-wassila_portfolio";
$username = "407654";
$password = "Islam93tkt?";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}
