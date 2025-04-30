<?php
// backoffice/reseaux/modifier_reseaux.php

include __DIR__ . '/../includes/db_connection.php';

// Vérif. de l’ID
if (!isset($_GET['id'])) {
  die('ID de réseau manquant.');
}
$id = intval($_GET['id']);

// Charger l’entrée existante
$sql    = "SELECT * FROM social_media WHERE id = ?";
$stmt   = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$res    = mysqli_stmt_get_result($stmt);
$reseau = mysqli_fetch_assoc($res);
if (! $reseau) {
  die('Réseau introuvable.');
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom  = trim($_POST['nom_du_reseau'] ?? '');
  $lien = trim($_POST['lien'] ?? '');
  $icon = trim($_POST['icon'] ?? '');

  if ($nom === '' || $lien === '' || $icon === '') {
    die('Tous les champs sont obligatoires.');
  }

  $sql = "UPDATE social_media
          SET nom_du_reseau = ?, lien = ?, icon = ?
          WHERE id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'sssi', $nom, $lien, $icon, $id);
  if (!mysqli_stmt_execute($stmt)) {
    die('Erreur MySQL : '.mysqli_error($conn));
  }
  mysqli_stmt_close($stmt);

  header('Location: reseaux.php');
  exit;
}

// Inclure la barre de nav et afficher le form
include __DIR__ . '/../includes/barreNav.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier un réseau social</title>
  <!-- même style que modifier_projet -->
  <link rel="stylesheet" href="../../public/assets/css/modifier_projet.css">
  <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
</head>
<body>
  <div class="form-container">
    <h2>Modifier un réseau social</h2>
    <form action="modifier_reseaux.php?id=<?= $id ?>" method="post">
      <input
        type="text"
        name="nom_du_reseau"
        value="<?= htmlspecialchars($reseau['nom_du_reseau'], ENT_QUOTES) ?>"
        required
      >
      <input
        type="url"
        name="lien"
        value="<?= htmlspecialchars($reseau['lien'], ENT_QUOTES) ?>"
        required
      >
      <input
        type="text"
        name="icon"
        value="<?= htmlspecialchars($reseau['icon'], ENT_QUOTES) ?>"
        required
      >
      <button type="submit">Enregistrer</button>
    </form>
  </div>
</body>
</html>
