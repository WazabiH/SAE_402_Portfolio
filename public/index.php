<?php
// public/index.php

// 1) Traitement du formulaire de contact
include __DIR__ . '/includes/sendmail.php';

// 2) Connexion à la BDD
require_once __DIR__ . '/includes/db_connection.php';

// 3) Récupération des réseaux sociaux
$sqlSocial = "SELECT nom_du_reseau, lien, icon FROM social_media";
$socialRes = mysqli_query($conn, $sqlSocial);
if (!$socialRes) {
    die("Erreur réseaux : " . mysqli_error($conn));
}

// 4) Récupération des catégories
$sqlCats = "SELECT id, nom, description FROM categories ORDER BY nom";
$catsRes = mysqli_query($conn, $sqlCats);
if (!$catsRes) {
    die("Erreur catégories : " . mysqli_error($conn));
}

// 5) Récupération des projets avec jointure catégorie
$sqlProj = "
  SELECT p.id, p.nom, p.description, p.date_realisation, p.image, c.nom AS categorie
  FROM projet p
  LEFT JOIN categories c ON p.categorie_id = c.id
  ORDER BY p.date_realisation DESC
";
$projRes = mysqli_query($conn, $sqlProj);
if (!$projRes) {
    die("Erreur projets : " . mysqli_error($conn));
}

?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Portfolio Wassila Hamed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <!-- Bootstrap Icons (pour social et projets) -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

    <!-- Ton CSS principal -->
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="is-preload">

    <!-- Navigation -->
    <nav id="nav">
      <ul>
        <li><a href="#header">Accueil</a></li>
        <li><a href="#categories">Catégories</a></li>
        <li><a href="#projets">Projets</a></li>
        <li><a href="#competences">Compétences</a></li>
        <li><a href="#footer">Contact</a></li>
        <li><a href="../backoffice/login/login.php">Administration</a></li>
      </ul>
    </nav>

    <!-- Header -->
    <section id="header">
      <span class="logo icon fa-paper-plane"></span>
      <h1>Bienvenue sur mon Portfolio</h1>
      <p>Je suis Wassila Hamed, étudiant en développement web.<br>
         Découvrez mes projets et mes compétences à travers ce portfolio.
      </p>
      <ul class="actions special">
        <li>
          <a href="assets/document/CV_Hamed_Wassila.pdf"
             target="_blank"
             class="button">Voir mon CV</a>
        </li>
      </ul>
    </section>
<!-- Catégories -->
<section id="categories" class="box container">
  <header class="major">
    <h2>Mes Catégories</h2>
    <p>Voici les différentes catégories de projets que je propose :</p>
  </header>

  <div class="section-list">
    <?php while ($cat = mysqli_fetch_assoc($catsRes)): ?>
      <div class="card">
        <div class="card-content">
          <h3><?= htmlspecialchars($cat['nom'], ENT_QUOTES) ?></h3>
          <p><?= nl2br(htmlspecialchars($cat['description'], ENT_QUOTES)) ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<!-- Projets -->
<section id="projets" class="box container">
  <header class="major">
    <h2>Mes Projets</h2>
    <p>Quelques-unes de mes réalisations récentes</p>
  </header>

  <div class="section-list">
    <?php while ($proj = mysqli_fetch_assoc($projRes)): ?>
      <div class="card">
        <!-- Vignette -->
        <?php if ($proj['image']): ?>
          <img
            src="../backoffice/projet/uploads/<?= rawurlencode($proj['image']) ?>"
            alt="<?= htmlspecialchars($proj['nom'], ENT_QUOTES) ?>"
          >
        <?php endif; ?>

        <!-- Contenu textuel -->
        <div class="card-content">
          <h3><?= htmlspecialchars($proj['nom'], ENT_QUOTES) ?></h3>
          <p><?= nl2br(htmlspecialchars($proj['description'], ENT_QUOTES)) ?></p>
          <p class="meta">
            Réalisé le <?= htmlspecialchars($proj['date_realisation'], ENT_QUOTES) ?>
            dans « <?= htmlspecialchars($proj['categorie'], ENT_QUOTES) ?> »
          </p>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>




    <!-- Contact & Formulaire -->
    <section  class="box container medium">
      <header class="major last">
        <h2>Des questions ou des commentaires ?</h2>
      </header>
      <p>N'hésitez pas à me contacter si vous avez une question ou un projet à proposer.</p>

      <form method="post" action="">
        <div class="row">
          <div class="col-6 col-12-mobilep">
            <input type="text" name="firstname" placeholder="Prénom" required />
          </div>
          <div class="col-6 col-12-mobilep">
            <input type="text" name="name" placeholder="Nom" required />
          </div>
          <div class="col-6 col-12-mobilep">
            <input type="email" name="email" placeholder="Email" required />
          </div>
          <div class="col-12">
            <textarea name="message" placeholder="Message" rows="6" required></textarea>
          </div>
          <div class="col-12">
            <ul class="actions special">
              <li><input type="submit" name="envoi" value="Envoyer le message" /></li>
            </ul>
          </div>
        </div>
      </form>

      <!-- Réseaux sociaux -->
      <div class="social-links">
        <?php while ($row = mysqli_fetch_assoc($socialRes)): ?>
          <a href="<?= htmlspecialchars($row['lien'], ENT_QUOTES) ?>"
             class="social-icon"
             target="_blank"
             title="<?= htmlspecialchars($row['nom_du_reseau'], ENT_QUOTES) ?>">
            <i class="bi <?= htmlspecialchars($row['icon'], ENT_QUOTES) ?>"></i>
          </a>
        <?php endwhile; ?>
      </div>

      <ul class="copyright">
        <li>&copy; Hamed Wassila. Tous droits réservés.</li>
        <li>Design : <a href="http://html5up.net">HTML5 UP</a></li>
      </ul>
    </section>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
      const p = new URLSearchParams(location.search);
      if (p.get('sent') === '1') {
        toastr.success('Votre message a bien été envoyé.', 'Succès', { closeButton: true });
      } else if (p.get('sent') === '0') {
        toastr.error('Erreur lors de l’envoi.', 'Erreur', { closeButton: true });
      }
      if (p.has('sent')) history.replaceState(null, '', location.pathname);
    });
    </script>
</body>
</html>
