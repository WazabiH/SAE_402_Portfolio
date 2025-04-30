<?php
include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/barreNav.php';

// 0) Charger la liste des catégories
$catsResult = mysqli_query($conn, "SELECT id, nom FROM categories ORDER BY nom");
if (!$catsResult) {
    die('Erreur MySQL (chargement catégories) : ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1) Récupération des champs
    $nom              = $_POST['nom'];
    $description      = $_POST['description'];
    $date_realisation = $_POST['date_realisation'];
    $categorie_id     = intval($_POST['categorie_id']);

    // 2) Préparation du dossier uploads/
    $uploadDirFs = __DIR__ . '/uploads/';
    if (!is_dir($uploadDirFs)) {
        mkdir($uploadDirFs, 0755, true);
    }

    // 3) Traitement de l'image (taille et type)
    $file        = $_FILES['image'];
    $maxSize     = 2 * 1024 * 1024; // 2 Mo
    $allowedMimes = [
      'image/jpeg' => 'jpg',
      'image/png'  => 'png',
      'image/gif'  => 'gif',
    ];

    if ($file['size'] > $maxSize) {
        die("Erreur : le fichier dépasse la taille maximale de 2 Mo.");
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime  = $finfo->file($file['tmp_name']);
    if (!isset($allowedMimes[$mime])) {
        die("Erreur : type de fichier non autorisé. Seuls JPG, PNG et GIF sont acceptés.");
    }

    $ext      = $allowedMimes[$mime];
    $filename = uniqid('img_') . '.' . $ext;
    $uploadFile = $uploadDirFs . $filename;
    if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
        die("Échec de l'upload de l'image.");
    }

    // 4) Insertion en base
    $sql  = "INSERT INTO projet
             (nom, description, date_realisation, image, categorie_id)
             VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssi',
        $nom, $description, $date_realisation, $filename, $categorie_id
    );
    if (!mysqli_stmt_execute($stmt)) {
        die('Erreur MySQL : ' . mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);

    // 5) Redirection
    header('Location: projet.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un projet</title>
  <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
  <link rel="stylesheet" href="../../public/assets/css/ajouter_projet.css">
</head>
<body>

  <div class="form-container">
    <h2>Ajouter un projet</h2>
    <form action="ajouter_projet.php" method="post" enctype="multipart/form-data">
      <input type="text" name="nom" placeholder="Nom du projet" required>
      <textarea name="description" placeholder="Description" required></textarea>

      <!-- Ligne d'information sur la taille et les formats autorisés -->
      <p class="file-info">
        Taille maximale : 2 Mo. Formats autorisés : JPG, JPEG, PNG, GIF.
      </p>

      <!-- Drop-zone image -->
      <div class="drop-zone">
        <span class="drop-zone__prompt">
          Glisser-déposer l’image ou cliquez pour sélectionner
        </span>
        <img class="drop-zone__thumb" alt="Aperçu" />
        <input
          type="file"
          name="image"
          required
          accept=".jpg,.jpeg,.png,.gif"
        />
      </div>
      <select name="categorie_id" id="categorie_id" required>
        <option value="">— Choisissez une catégorie —</option>
        <?php while ($c = mysqli_fetch_assoc($catsResult)): ?>
          <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nom'], ENT_QUOTES) ?></option>
        <?php endwhile; ?>
      </select>

      <input type="date" name="date_realisation" required>
      <button type="submit">Ajouter</button>
    </form>
  </div>

  <script>
    const dropZone = document.querySelector('.drop-zone');
    const fileInput = dropZone.querySelector('input[type="file"]');
    const thumbnail = dropZone.querySelector('.drop-zone__thumb');

    thumbnail.style.display = 'none';

    dropZone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', () => {
      const files = fileInput.files;
      if (!files.length) {
        thumbnail.style.display = 'none';
        dropZone.querySelector('.drop-zone__prompt').style.display = '';
        return;
      }
      const file = files[0];
      const reader = new FileReader();
      reader.onload = () => {
        dropZone.querySelector('.drop-zone__prompt').style.display = 'none';
        thumbnail.src = reader.result;
        thumbnail.style.display = 'block';
      };
      reader.readAsDataURL(file);
    });

    ['dragover','dragenter'].forEach(evt =>
      dropZone.addEventListener(evt, e => {
        e.preventDefault();
        dropZone.classList.add('dragover');
      })
    );
    ['dragleave','dragend','drop'].forEach(evt =>
      dropZone.addEventListener(evt, () => {
        dropZone.classList.remove('dragover');
      })
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
