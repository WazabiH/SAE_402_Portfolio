<?php
include '../Include/db_connection.php';

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
    $result = mysqli_query($conn, "SELECT * FROM categories WHERE id = $id");
    $categorie = mysqli_fetch_assoc($result);

    if (!$categorie) {
        die("Catégorie introuvable.");
    }
} else {
    die("ID manquant.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["nom"]);
    $description = trim($_POST["description"]);
    
    if (!empty($nom) && !empty($description)) {
        $nom = mysqli_real_escape_string($conn, $nom);
        $description = mysqli_real_escape_string($conn, $description);
        
        mysqli_query($conn, "UPDATE categories SET nom = '$nom', description = '$description' WHERE id = $id");
        header("Location: categories.php");
        exit();
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/barreNav.css">
    <title>Modifier une Catégorie</title>
</head>
<body>
<?php include '../Include/barreNav.php'; ?>
    <h2>Modifier une Catégorie</h2>
    <form method="POST">
        <input type="text" name="nom" value="<?= htmlspecialchars($categorie['nom']) ?>" required>
        <textarea name="description" required><?= htmlspecialchars($categorie['description']) ?></textarea>
        <button type="submit">Mettre à jour</button>
    </form>
    <a href="categories.php">🔙 Retour</a>
</body>
</html>
