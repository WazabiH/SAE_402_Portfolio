<?php
// backoffice/dashboard.php

require_once __DIR__ . '/includes/db_connection.php';  // Démarre session et $conn
require_once __DIR__ . '/includes/auth.php';           // Vérifie la session
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administration</title>
  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../public/assets/css/administration.css">
</head>
<body>
  <header class="dashboard-header">
    <h1>Administration</h1>
    <a href="login/logout.php" class="logout-btn">Déconnexion</a>
  </header>

  <main class="dashboard-main">
    <div class="cards-container">
      <a href="projet/projet.php" class="card">
        <i class="bi bi-folder-fill icon"></i>
        <span>Projets</span>
      </a>
      <a href="categories/categories.php" class="card">
        <i class="bi bi-tags-fill icon"></i>
        <span>Catégories</span>
      </a>
      <a href="reseaux/reseaux.php" class="card">
        <i class="bi bi-share-fill icon"></i>
        <span>Réseaux sociaux</span>
      </a>
    </div>
  </main>
</body>
</html>
