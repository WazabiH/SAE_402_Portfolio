<?php
// backoffice/projet/modifier_projet.php

// 1) Connexion BDD
include __DIR__ . '/../includes/db_connection.php';

// 2) Vérif de l’ID en GET
if (!isset($_GET['id'])) {
  die('ID de projet manquant.');
}
$id = intval($_GET['id']);

// 3) Récupérer le projet existant
$sql    = "SELECT * FROM projet WHERE id = ?";
$stmt   = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$res    = mysqli_stmt_get_result($stmt);
$projet = mysqli_fetch_assoc($res);
if (!$projet) {
  die('Projet introuvable.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 4) Récupérer et nettoyer les champs
  $nom              = trim($_POST['nom']);
  $description      = trim($_POST['description']);
  $date_realisation = $_POST['date_realisation'];
  $imageName        = $projet['image']; // par défaut l’ancienne

  // 5) Si une nouvelle image a été uploadée, on la traite
  if (!empty($_FILES['image']['name'])) {
    $file     = $_FILES['image'];
    $maxSize  = 2 * 1024 * 1024; // 2 Mo
    $allowed  = ['image/jpeg'=>'jpg','image/png'=>'png','image/gif'=>'gif'];

    if ($file['size'] > $maxSize) {
      die("Erreur : fichier trop volumineux (max 2 Mo).");
    }
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime  = $finfo->file($file['tmp_name']);
    if (!isset($allowed[$mime])) {
      die("Erreur : format non autorisé (JPG, PNG, GIF seulement).");
    }

    // Générer un nom unique et déplacer
    $ext        = $allowed[$mime];
    $newName    = uniqid('img_') . ".$ext";
    $uploadDir  = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $dest       = $uploadDir . $newName;
    if (!move_uploaded_file($file['tmp_name'], $dest)) {
      die("Erreur lors de l'upload de l'image.");
    }

    // Supprimer l'ancienne image si elle existe
    if ($projet['image'] && file_exists($uploadDir . $projet['image'])) {
      @unlink($uploadDir . $projet['image']);
    }

    $imageName = $newName;
  }

  // 6) Mise à jour en base
  $sql = "UPDATE projet
          SET nom = ?, description = ?, date_realisation = ?, image = ?
          WHERE id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param(
    $stmt, 'ssssi',
    $nom, $description, $date_realisation, $imageName, $id
  );
  if (!mysqli_stmt_execute($stmt)) {
    die('Erreur MySQL : ' . mysqli_error($conn));
  }
  mysqli_stmt_close($stmt);

  // 7) Redirection
  header('Location: projet.php');
  exit;
}

// 8) Afficher le formulaire avec la barre de nav
include __DIR__ . '/../includes/barreNav.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier le projet</title>
  <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
  <link rel="stylesheet" href="../../public/assets/css/modifier_projet.css">
</head>
<body>
  <div class="form-container">
    <h2>Modifier le projet</h2>
    <form action="modifier_projet.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
      <input type="text" name="nom" value="<?= htmlspecialchars($projet['nom'], ENT_QUOTES) ?>" required>
      <textarea name="description" required><?= htmlspecialchars($projet['description'], ENT_QUOTES) ?></textarea>

      <div class="drop-zone">
        <span class="drop-zone__prompt">Glisser-déposer l'image ou cliquez pour sélectionner</span>
        <img
          src="uploads/<?= htmlspecialchars($projet['image'], ENT_QUOTES) ?>"
          class="drop-zone__thumb"
          alt="Aperçu" />
        <input type="file" name="image" accept="image/*">
      </div>

      <input type="date" name="date_realisation"
             value="<?= htmlspecialchars($projet['date_realisation'], ENT_QUOTES) ?>"
             required>
      <button type="submit">Enregistrer</button>
    </form>
  </div>

  <script>
  const dropZone = document.querySelector('.drop-zone');
  const fileInput = dropZone.querySelector('input[type="file"]');
  const thumbnail = dropZone.querySelector('.drop-zone__thumb');

  // Cacher le prompt si miniature présente
  if (thumbnail.src) {
    dropZone.querySelector('.drop-zone__prompt').style.display = 'none';
    thumbnail.style.display = 'block';
  } else {
    thumbnail.style.display = 'none';
  }

  dropZone.addEventListener('click', () => fileInput.click());
  fileInput.addEventListener('change', () => {
    const files = fileInput.files;
    if (!files || !files.length) return;
    const reader = new FileReader();
    reader.onload = () => {
      dropZone.querySelector('.drop-zone__prompt').style.display = 'none';
      thumbnail.src = reader.result;
      thumbnail.style.display = 'block';
    };
    reader.readAsDataURL(files[0]);
  });

  ['dragover','dragenter'].forEach(evt =>
    dropZone.addEventListener(evt, e => {
      e.preventDefault();
      dropZone.classList.add('dragover');
    })
  );
  ['dragleave','drop','dragend'].forEach(evt =>
    dropZone.addEventListener(evt, () => dropZone.classList.remove('dragover'))
  );
  dropZone.addEventListener('drop', e => {
    e.preventDefault();
    if (e.dataTransfer.files.length) {
      fileInput.files = e.dataTransfer.files;
      fileInput.dispatchEvent(new Event('change'));
    }
  });
  </script>
</body>
</html>
