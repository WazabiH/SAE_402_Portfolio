<?php
// backoffice/categories/modifier_categories.php

// 1) Connexion BDD
include __DIR__ . '/../includes/db_connection.php';

// 2) Vérification de l’ID
if (!isset($_GET['id'])) {
    die('ID de catégorie manquant.');
}
$id = intval($_GET['id']);

// 3) Traitement du POST (UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom         = trim($_POST['nom'] ?? '');
    $description = trim($_POST['description'] ?? '');
    if ($nom === '' || $description === '') {
        die('Tous les champs sont obligatoires.');
    }

    $sql  = "UPDATE categories SET nom = ?, description = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssi', $nom, $description, $id);
    if (! mysqli_stmt_execute($stmt)) {
        die('Erreur MySQL : ' . mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);

    header('Location: categories.php');
    exit;
}

// 4) Si pas de POST, on charge la catégorie pour préremplir le formulaire
$sql    = "SELECT * FROM categories WHERE id = ?";
$stmt   = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$res    = mysqli_stmt_get_result($stmt);
$category = mysqli_fetch_assoc($res);
if (! $category) {
    die('Catégorie introuvable.');
}

// 5) Inclusion de la barre de navigation
include __DIR__ . '/../includes/barreNav.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier une catégorie</title>
  <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
  <link rel="stylesheet" href="../../public/assets/css/modifier_projet.css">
</head>
<body>
  <div class="form-container">
    <h2>Modifier une catégorie</h2>
    <form action="modifier_categories.php?id=<?= $id ?>" method="post">
      <input
        type="text"
        name="nom"
        value="<?= htmlspecialchars($category['nom'], ENT_QUOTES) ?>"
        placeholder="Nom de la catégorie"
        required
      >
      <textarea
        name="description"
        placeholder="Description de la catégorie"
        required
      ><?= htmlspecialchars($category['description'], ENT_QUOTES) ?></textarea>
      <button type="submit">Enregistrer</button>
    </form>
  </div>
</body>
</html>
