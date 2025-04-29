<?php
include __DIR__ . '/../includes/db_connection.php';

$sql    = "SELECT * FROM projet ORDER BY date_realisation DESC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Erreur MySQL : ' . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/assets/css/liste_projets.css">
  <title>Mes Projets</title>
</head>
<body>
  <h1>Portfolio</h1>

  <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="projet">
      <h2><?= htmlspecialchars($row['nom']) ?></h2>
      <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
      <p><small>Réalisé le <?= htmlspecialchars($row['date_realisation']) ?></small></p>

      <!-- CHEMIN CLIENT :
           Si tu appelles ce fichier via http(s)://tondomaine/projet/projet.php,
           alors uploads/ est bien le sous-dossier projet/uploads/ -->
      <img
        src="uploads/<?= rawurlencode($row['image']) ?>"
        alt="<?= htmlspecialchars($row['nom']) ?>"
      >
    </div>
  <?php endwhile; ?>
</body>
</html>
