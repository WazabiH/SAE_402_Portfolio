<?php
session_start();

// Connexion à la base de données
$host = "mysql-hamed-wassila.alwaysdata.net";
$dbname = "hamed-wassila_portfolio"; // Nom de la base de données
$username = "hamed-wassila";
$password = "Islam93tkt?."; 

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}  