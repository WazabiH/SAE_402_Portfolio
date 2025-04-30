<?php
// backoffice/reseaux/reseaux.php

include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/barreNav.php';
include __DIR__ . '/../includes/functions.php';

// 1) Recherche DRY
$search = getSearchParam('search');
// 2) Clause WHERE automatique
$where = buildSearchWhere(['nom_du_reseau', 'lien'], $conn, 'search');

// 3) Requête
$sql    = 'SELECT * FROM social_media' . $where . ' ORDER BY nom_du_reseau';
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Erreur MySQL : ' . mysqli_error($conn));
}
$count = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réseaux sociaux</title>
  <link rel="stylesheet" href="../../public/assets/css/liste_projets.css">
  <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
  <!-- Bootstrap Icons pour afficher <i class="bi…"> -->
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

  <div class="project-list-header">
    <div class="title-count">
      <h2>Réseaux sociaux</h2>
      <span class="count"><?= $count ?> élément(s)</span>
    </div>
    <div class="controls">
      <?php renderSearchForm('', 'search', 'Rechercher un réseau…'); ?>
      <a href="ajouter_reseaux.php" class="btn-add">Ajouter un réseau</a>
    </div>
  </div>

  <table class="project-table">
    <thead>
      <tr>
        <th>Réseau</th>
        <th>Lien</th>
        <th>Icône</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($count): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= htmlspecialchars($row['nom_du_reseau'], ENT_QUOTES) ?></td>
          <td>
            <a href="<?= htmlspecialchars($row['lien'], ENT_QUOTES) ?>"
               target="_blank">
              <?= htmlspecialchars($row['lien'], ENT_QUOTES) ?>
            </a>
          </td>
          <td><i class="<?= htmlspecialchars($row['icon'], ENT_QUOTES) ?>"></i></td>
          <td class="actions">
            <a href="modifier_reseaux.php?id=<?= $row['id'] ?>" class="edit">Modifier</a>
            <a href="supprimer_reseaux.php?id=<?= $row['id'] ?>"
               class="delete"
               onclick="return confirm('Supprimer ce réseau ?');">
              Supprimer
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="4">Aucun réseau trouvé.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <?php mysqli_close($conn); ?>
</body>
</html>
