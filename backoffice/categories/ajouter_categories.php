<?php
// backoffice/categories/ajouter_categories.php

include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/barreNav.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1) Récupération et nettoyage
    $nom         = trim($_POST['nom'] ?? '');
    $description = trim($_POST['description'] ?? '');

    // 2) Validation
    if ($nom === '' || $description === '') {
        die('Tous les champs sont obligatoires.');
    }

    // 3) Insertion en base
    $sql  = "INSERT INTO categories (nom, description) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $nom, $description);
    if (!mysqli_stmt_execute($stmt)) {
        die('Erreur MySQL : ' . mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);

    // 4) Redirection vers la liste
    header('Location: categories.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter une catégorie</title>
  <!-- On réutilise exactement le même CSS que pour le formulaire Projet -->
  <link rel="stylesheet" href="../../public/assets/css/ajouter_projet.css">
  <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
</head>
<body>

  <div class="form-container">
    <h2>Ajouter une catégorie</h2>
    <form action="ajouter_categories.php" method="post">
      <input
        type="text"
        name="nom"
        placeholder="Nom de la catégorie"
        required
      >
      <textarea
        name="description"
        placeholder="Description de la catégorie"
        required
      ></textarea>
      <button type="submit">Ajouter</button>
    </form>
  </div>

</body>
</html>
