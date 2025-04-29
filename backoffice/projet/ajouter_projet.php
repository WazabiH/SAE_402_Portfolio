<?php
include __DIR__ . '/../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1) Récupération des champs
    $nom              = $_POST['nom'];
    $description      = $_POST['description'];
    $date_realisation = $_POST['date_realisation'];

    // 2) Création + permission du dossier uploads/ (une seule fois)
    $uploadDirFs = __DIR__ . '/uploads/';
    if (!is_dir($uploadDirFs)) {
        mkdir($uploadDirFs, 0755, true);
        chmod($uploadDirFs, 0755);
    }

    // 3) Traitement de l'image
    $filename   = basename($_FILES['image']['name']);
    $uploadFile = $uploadDirFs . $filename;

    if (! move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        die("Échec de l'upload de l'image.");
    }

    // 4) Insertion en base (procédural)
    $sql  = "INSERT INTO projet (nom, description, date_realisation, image) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die('Erreur préparation : ' . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, 'ssss', $nom, $description, $date_realisation, $filename);
    if (! mysqli_stmt_execute($stmt)) {
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
</head>
<body>

    <h2>Ajouter un projet</h2>
    <form action="ajouter_projet.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nom" placeholder="Nom du projet" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <input type="file" name="image" required><br>
        <input type="date" name="date_realisation" required><br>
        <button type="submit">Ajouter</button>
    </form>

</body>
</html>
