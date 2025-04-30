<?php
// 1) Connexion
include __DIR__ . '/../includes/db_connection.php';

// 2) Vérif ID
if (!isset($_GET['id'])) {
  die('ID de projet manquant.');
}
$id = intval($_GET['id']);

// 3) Traitement du POST (UPDATE + redirection)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer et valider les champs…
  $nom              = $_POST['nom'];
  $description      = $_POST['description'];
  $date_realisation = $_POST['date_realisation'];
  // … gestion de l’upload comme vous l’avez déjà
  // UPDATE en base
  $sql  = "UPDATE projet SET nom=?, description=?, date_realisation=?, image=? WHERE id=?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ssssi", $nom, $description, $date_realisation, $projet['image'], $id);
  if (!mysqli_stmt_execute($stmt)) {
    die('Erreur MySQL : ' . mysqli_error($conn));
  }
  mysqli_stmt_close($stmt);

  // **Redirection AVANT tout affichage HTML**
  header('Location: projet.php');
  exit;
}

// 4) Si pas de POST, on charge les données pour préremplir le form
$sql    = "SELECT * FROM projet WHERE id = ?";
$stmt   = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$projet = mysqli_fetch_assoc($result);

// 5) Ensuite seulement, inclure la barre de nav et afficher le HTML
include __DIR__ . '/../includes/barreNav.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
    <link rel="stylesheet" href="../../public/assets/css/modifier_projet.css">
    <title>Modifier le projet</title>
</head>
<body>
<div class="form-container">
    <h2>Modifier le projet</h2>
    <form action="modifier_projet.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="nom" value="<?= htmlspecialchars($projet['nom']) ?>" required>
        <textarea name="description" required><?= htmlspecialchars($projet['description']) ?></textarea>

        <div class="drop-zone">
            <span class="drop-zone__prompt">Glisser-déposer l'image ou cliquez pour sélectionner</span>
            <img src="uploads/<?= htmlspecialchars($projet['image']) ?>" class="drop-zone__thumb" alt="Aperçu" />
            <input type="file" name="image" accept="image/*">
        </div>

        <input type="date" name="date_realisation" value="<?= $projet['date_realisation'] ?>" required>
        <button type="submit">Enregistrer</button>
    </form>
</div>

<script>
const dropZone = document.querySelector('.drop-zone');
const fileInput = dropZone.querySelector('input[type="file"]');
const thumbnail = dropZone.querySelector('.drop-zone__thumb');

// Ouvre le dialogue fichier
dropZone.addEventListener('click', () => fileInput.click());

// Mise à jour de la miniature
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

// Événements drag & drop
['dragover','dragenter'].forEach(evt => {
    dropZone.addEventListener(evt, e => { e.preventDefault(); dropZone.classList.add('dragover'); });
});
['dragleave','drop','dragend'].forEach(evt => {
    dropZone.addEventListener(evt, () => dropZone.classList.remove('dragover'));
});

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
