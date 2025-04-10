<?php 
include '../Include/db_connection.php';

// On vérifie si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données
    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $date_realisation = mysqli_real_escape_string($conn, $_POST["date_realisation"]);

    // Répertoire pour les uploads
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);  // Créer le répertoire s'il n'existe pas
    }

    // Vérifier si une image a été envoyée
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image = basename($_FILES["image"]["name"]);
        $image = mysqli_real_escape_string($conn, $image);
        $target_file = $target_dir . $image;
        
        // Déplacer l'image téléchargée
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insertion dans la base de données
            $sql = "INSERT INTO projet (nom, description, image, date_realisation) 
                    VALUES ('$nom', '$description', '$image', '$date_realisation')";
            
            // Exécuter la requête SQL
            if (mysqli_query($conn, $sql)) {
                // Rediriger vers projet.php
                header("Location: projet.php");
                exit();  // Assurez-vous d'ajouter exit() après header()
            } else {
                die("Erreur SQL : " . mysqli_error($conn));
            }
        } else {
            die("Erreur lors du téléchargement de l'image.");
        }
    } else {
        die("Aucune image valide fournie.");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/ajouter_projet.css">
    <link rel="stylesheet" href="../assets/css/barreNav.css">
    <title>Ajouter un projet</title>
</head>
<body>
<?php include '../Include/barreNav.php'; ?>
    <h2>Ajouter un projet</h2>
    
    <form action="ajouter_projet.php" method="post" enctype="multipart/form-data">
        <label for="nom">Nom du projet</label>
        <input type="text" id="nom" name="nom" placeholder="Nom du projet..." required><br>

        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Ajoutez une description..." required></textarea><br>

        <label for="image">Image du projet</label>
        <div id="drop-zone">
            <p>Glissez-déposez une image ici ou cliquez pour sélectionner un fichier</p>
            <input type="file" id="image" name="image" required hidden>
        </div>

        <label for="date_realisation">Date de réalisation</label>
        <input type="date" id="date_realisation" name="date_realisation" required><br>

        <button type="submit" aria-label="Ajouter le projet">Ajouter</button>
    </form>

<script src="../assets/js/dropdow.js"></script>

</body>
</html>
