<?php
include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/barreNav.php';

// Récupération du paramètre de recherche
$search = '';
$where_clauses = [];
if (!empty($_GET['search'])) {
    $search = trim($_GET['search']);
    $esc = mysqli_real_escape_string($conn, $search);
    $where_clauses[] = "(p.nom LIKE '%$esc%' OR p.description LIKE '%$esc%')";
}

// Requête SQL AVEC JOINTURE
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
. (!empty($where_clauses)
    ? ' WHERE ' . implode(' AND ', $where_clauses)
    : ''
  )
. " ORDER BY p.date_realisation DESC
";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Erreur MySQL : ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../public/assets/css/liste_projets.css">
  <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
  <title>Liste des Projets</title>
</head>
<body>

  <div class="project-list-header">
    <div class="title-count">
      <h2>Mes Projets</h2>
      <span class="count"><?= mysqli_num_rows($result) ?> projet(s)</span>
    </div>
    <div class="controls">
      <form method="GET" action="" class="search-container">
        <input type="search" name="search" placeholder="Rechercher un projet..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">🔍</button>
      </form>
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
        <td><?= htmlspecialchars($row['nom']) ?></td>
        <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>
        <td><?= htmlspecialchars($row['date_realisation']) ?></td>
        <td>
          <?php if ($row['image']): ?>
            <img src="uploads/<?= rawurlencode($row['image']) ?>" alt="<?= htmlspecialchars($row['nom']) ?>">
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row['categorie'] ?? '') ?></td>
        <td class="actions">
          <a href="modifier_projet.php?id=<?= $row['id'] ?>" class="edit">Éditer</a>
          <a href="supprimer_projet.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Supprimer ce projet ?');">Supprimer</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</body>
</html>
