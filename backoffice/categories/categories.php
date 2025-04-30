<?php
include __DIR__ . '/../includes/db_connection.php';
include __DIR__ . '/../includes/barreNav.php';

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
    <link rel="stylesheet" href="../../public/assets/css/liste_categories.css">
    <link rel="stylesheet" href="../../public/assets/css/barreNav.css">
    <title>Liste des Catégories</title>
</head>
<body>


<main>
    <h2>Liste des Catégories</h2>

    <a href="ajouter_categories.php" class="btn-add">Ajouter une catégorie</a>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['nom']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td>
                        <a class="action-link" href="modifier_categories.php?id=<?= $row['id'] ?>">Modifier</a> |
                        <a class="action-link" href="supprimer_categories.php?id=<?= $row['id'] ?>" onclick="return confirm('Supprimer cette catégorie ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
            <tr>
                <td colspan="3">Aucune catégorie trouvée.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</main>

</body>
</html>
