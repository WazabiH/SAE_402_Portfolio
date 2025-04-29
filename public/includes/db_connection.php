<?php
session_start();

// Connexion à la base de données
$host = "mysql-hamed-wassila.alwaysdata.net";
$dbname = "hamed-wassila_portfolio";
$username = "407654";
$password = "Islam93tkt?";

$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}
?>
