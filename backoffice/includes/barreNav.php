<?php
// backoffice/includes/barreNav.php
?>
<nav class="navbar" id="navbar">
  <!-- Optionnel : un logo ou le titre -->
  <a href="../public/index.php" class="brand">Mon Portfolio</a>

  <!-- Bouton hamburger pour mobile -->
  <button class="navbar-toggle" onclick="document.getElementById('navbar').classList.toggle('open')">
    &#9776;
  </button>

  <!-- Le vrai menu -->
  <div class="navbar-menu">
    <ul>
      <li><a href="../projet/projet.php"       class="active">Projets</a></li>
      <li><a href="../categories/categories.php">Catégories</a></li>
      <li><a href="../experience/experience.php">Expériences</a></li>
      <li><a href="../reseaux/reseaux_sociaux.php">Réseaux sociaux</a></li>
      <li><a href="../public/index.php">Retour portfolio</a></li>
      <li><a href="../login/logout.php">Déconnexion</a></li>
    </ul>
  </div>
</nav>

<!-- Petite ligne de JS pour activer le menu mobile -->
<script>
  // on peut extraire ça dans un .js à part
  const nav = document.getElementById('navbar');
  document.querySelector('.navbar-toggle')
    .addEventListener('click', () => nav.classList.toggle('open'));
</script>

