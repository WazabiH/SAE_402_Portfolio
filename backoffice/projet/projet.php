<?php
// backoffice/projet/projet.php

include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/barreNav.php';
include __DIR__ . '/../includes/functions.php';  // <-- assure-toi que c'est bien functions.php

// 1) Récupérer la recherche via la fonction DRY
$search = getSearchParam('search');

// 2) Construire la clause WHERE
$where = buildSearchWhere(
    ['p.nom', 'p.description'], 
    $conn, 
    'search'
);

// 3) Préparer et exécuter la requête
$sql = "
  SELECT
    p.id,
    p.nom,
    p.description,
    p.date_realisation,
    p.image,
    c.nom AS categorie
  FROM projet AS p
  JOIN categories AS c
    ON p.categorie_id = c.id
" 
. $where . "
  ORDER BY p.date_realisation DESC
";

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
  <title>Liste des Projets</title>
  <link rel="stylesheet" href="../../public/assets/css/liste_projets.css">
  <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
</head>
<body>

  <div class="project-list-header">
    <div class="title-count">
      <h2>Mes Projets</h2>
      <span class="count"><?= $count ?> projet(s)</span>
    </div>
    <div class="controls">
      <?php 
        // Affiche la barre de recherche en une ligne
        renderSearchForm(
          '',                    // action = page courante
          'search',              // nom du champ GET
          'Rechercher un projet…'// placeholder
        ); 
      ?>
      <a href="ajouter_projet.php" class="btn-add">Ajouter un projet</a>
    </div>
  </div>

  <table class="project-table">
    <thead>
      <tr>
        <th>Titre</th>
        <th>Chapô</th>
        <th>Date de création</th>
        <th>Image</th>
        <th>Catégorie</th>
        <th>Editer/Supprimer</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= htmlspecialchars($row['nom'], ENT_QUOTES) ?></td>
        <td><?= nl2br(htmlspecialchars($row['description'], ENT_QUOTES)) ?></td>
        <td><?= htmlspecialchars($row['date_realisation'], ENT_QUOTES) ?></td>
        <td>
          <?php if ($row['image']): ?>
            <img 
              src="uploads/<?= rawurlencode($row['image']) ?>" 
              alt="<?= htmlspecialchars($row['nom'], ENT_QUOTES) ?>">
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row['categorie'], ENT_QUOTES) ?></td>
        <td class="actions">
          <a href="modifier_projet.php?id=<?= $row['id'] ?>" class="edit">Éditer</a>
          <a href="supprimer_projet.php?id=<?= $row['id'] ?>" class="delete"
             onclick="return confirm('Supprimer ce projet ?');">
            Supprimer
          </a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <?php mysqli_close($conn); ?>
</body>
</html>
