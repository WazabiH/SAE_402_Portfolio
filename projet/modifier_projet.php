<?php
include '../Include/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les infos du projet
    $sql = "SELECT * FROM projet WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $projet = mysqli_fetch_assoc($result);
}

// Mettre à jour les données
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $date_realisation = $_POST['date_realisation'];

    $sql = "UPDATE projet SET nom=?, description=?, date_realisation=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nom, $description, $date_realisation, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: projet.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/modifier_projet.css">
    <link rel="stylesheet" href="../assets/css/barreNav.css">
    <title>Modifier le projet</title>
</head>
<body>
<?php include '../Include/barreNav.php'; ?>
    <h2>Modifier le projet</h2>

    <form action="projet.php" method="post">
        <input type="text" name="nom" value="<?= htmlspecialchars($projet['nom']) ?>" required><br>
        <textarea name="description" required><?= htmlspecialchars($projet['description']) ?></textarea><br>
        <input type="date" name="date_realisation" value="<?= $projet['date_realisation'] ?>" required><br>
        <button type="submit">Enregistrer les modifications</button>
    </form>

</body>
</html>
