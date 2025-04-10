<?php
include '../Include/db_connection.php';

// Récupérer les projets
$sql = "SELECT * FROM projet ORDER BY date_realisation DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/liste_projets.css">
    <link rel="stylesheet" href="../assets/css/barreNav.css">
    <title>Gestion des Projets</title>
</head>
<body>
<?php include '../Include/barreNav.php'; ?>
    <h2>Liste des Projets</h2>
    <a href="ajouter_projet.php"><button>Ajouter un projet</button></a>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Image</th>
            <th>Date de réalisation</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['nom']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><img src="uploads/<?= htmlspecialchars($row['image']) ?>" width="100"></td>
                <td><?= $row['date_realisation'] ?></td>
                <td>
                    <a href="modifier_projet.php?id=<?= $row['id'] ?>">Modifier</a> | 
                    <a href="supprimer.php?id=<?= $row['id'] ?>" onclick="return confirm('Supprimer ce projet ?')">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>


</body>
</html>
