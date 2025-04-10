<?php
include '../Include/db_connection.php';

// Vérifier la connexion
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Récupérer les catégories
$sql = "SELECT * FROM categories ORDER BY nom DESC";
$result = mysqli_query($conn, $sql);

// Vérifier si la requête a réussi
if (!$result) {
    die("Erreur SQL : " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/liste_categories.css">
    <link rel="stylesheet" href="../assets/css/barreNav.css">
    <title>Catégories</title>
</head>
<body>
<?php include '../Include/barreNav.php'; ?>
    <h2>Liste des Catégories</h2>
    <a href="ajouter_categories.php"><button>Ajouter une catégorie</button></a>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['nom']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                    <a href="modifier_categories.php?id=<?= $row['id'] ?>">Modifier</a> | 
                    <a href="supprimer_categories.php?id=<?= $row['id'] ?>" onclick="return confirm('Supprimer ce projet ?')">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>
