<?php
// backoffice/includes/auth.php

// Comme db_connection.php démarre déjà session_start(), on peut directement vérifier la session :
if (empty($_SESSION['username'])) {
    // L’utilisateur n’est pas authentifié → on le renvoie vers le login
    header('Location: ../login/index.php');
    exit;
}
