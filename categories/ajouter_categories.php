<?php 
include '../Include/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);

    $sql = "INSERT INTO categories (nom, description) VALUES ('$nom', '$description')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: categories.php");
        exit();
    } else {
        echo "Erreur SQL : " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/ajouter_categorie.css">
    <link rel="stylesheet" href="../assets/css/barreNav.css">
    <title>Ajouter une catégorie</title>
</head>
<body>
<?php include '../Include/barreNav.php'; ?>
    <h2>Ajouter une catégorie</h2>
    
    <form action="ajouter_categories.php" method="post">
        <label for="nom">Nom de la catégorie</label>
        <input type="text" id="nom" name="nom" placeholder="Nom de la catégorie..." required><br>

        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Ajoutez une description..." required></textarea><br>

        <button type="submit" aria-label="Ajouter la catégorie">Ajouter</button>
    </form>
</body>
</html>
