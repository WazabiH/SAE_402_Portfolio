<?php
// backoffice/categories/liste_categories.php

include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/barreNav.php';
include __DIR__ . '/../includes/functions.php';

// 1) Recherche DRY
$search = getSearchParam('search');
// 2) Clause WHERE automatique
$where = buildSearchWhere(['nom', 'description'], $conn, 'search');

// 3) Requête
$sql    = 'SELECT * FROM categories' . $where . ' ORDER BY nom';
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Erreur SQL : ' . mysqli_error($conn));
}
$count = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des catégories</title>
  <link rel="stylesheet" href="../../public/assets/css/liste_projets.css">
  <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
</head>
<body>

  <div class="project-list-header">
    <div class="title-count">
      <h2>Mes Catégories</h2>
      <span class="count"><?= $count ?> catégorie(s)</span>
    </div>
    <div class="controls">
      <?php renderSearchForm('', 'search', 'Rechercher une catégorie…'); ?>
      <a href="ajouter_categories.php" class="btn-add">Ajouter une catégorie</a>
    </div>
  </div>

  <table class="project-table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($count): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= htmlspecialchars($row['nom'], ENT_QUOTES) ?></td>
          <td><?= nl2br(htmlspecialchars($row['description'], ENT_QUOTES)) ?></td>
          <td class="actions">
            <a href="modifier_categories.php?id=<?= $row['id'] ?>" class="edit">Modifier</a>
            <a href="supprimer_categories.php?id=<?= $row['id'] ?>"
               class="delete"
               onclick="return confirm('Supprimer cette catégorie ?');">
              Supprimer
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="3">Aucune catégorie trouvée.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <?php mysqli_close($conn); ?>
</body>
</html>
