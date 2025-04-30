<?php
include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/barreNav.php';

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];

    $result = mysqli_query($conn, "SELECT * FROM categories WHERE id = $id");

    if (!$result) {
        die("Erreur SQL : " . mysqli_error($conn));
    }

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
        
        $update = mysqli_query($conn, "UPDATE categories SET nom = '$nom', description = '$description' WHERE id = $id");

        if ($update) {
            header("Location: categories.php?success=1");
            exit();
        } else {
            echo "Erreur lors de la mise à jour : " . mysqli_error($conn);
        }
    } else {
        echo "<p style='color:red;'>Tous les champs sont obligatoires.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/barreNav.css">
    <link rel="stylesheet" href="../../public/assets/css/modifier_categories.css">
    <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
    <title>Modifier une Catégorie</title>
</head>
<body>


<main>
    <h2>Modifier une Catégorie</h2>

    <form method="POST" class="form-container">
        <label for="nom">Nom de la catégorie</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($categorie['nom']) ?>" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($categorie['description']) ?></textarea>

        <button type="submit" class="btn-update">Mettre à jour</button>
    </form>

    <a href="categories.php" class="btn-back">🔙 Retour</a>
</main>

</body>
</html>
