<?php
// backoffice/reseaux/ajouter_reseaux.php

include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/barreNav.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1) Récupération et nettoyage
    $nom   = trim($_POST['nom_du_reseau'] ?? '');
    $lien  = trim($_POST['lien'] ?? '');
    $icon  = trim($_POST['icon'] ?? '');

    // 2) Validation
    if ($nom === '' || $lien === '' || $icon === '') {
        die('Tous les champs sont obligatoires.');
    }

    // 3) Insertion en base
    $sql  = "INSERT INTO social_media (nom_du_reseau, lien, icon) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $nom, $lien, $icon);
    if (!mysqli_stmt_execute($stmt)) {
        die('Erreur MySQL : '.mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);

    // 4) Redirection vers la liste
    header('Location: reseaux.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un réseau social</title>
  <!-- même style que le formulaire projet -->
  <link rel="stylesheet" href="../../public/assets/css/ajouter_projet.css">
  <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
</head>
<body>
  <div class="form-container">
    <h2>Ajouter un réseau social</h2>
    <form action="ajouter_reseaux.php" method="post">
      <input
        type="text"
        name="nom_du_reseau"
        placeholder="Nom du réseau (ex. Twitter)"
        required
      >
      <input
        type="url"
        name="lien"
        placeholder="URL du profil (ex. https://twitter.com/…)"
        required
      >
      <input
        type="text"
        name="icon"
        placeholder="Classe Bootstrap Icon (ex. bi-twitter)"
        required
      >
      <button type="submit">Ajouter</button>
    </form>
  </div>
</body>
</html>
