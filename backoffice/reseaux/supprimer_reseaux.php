<?php
// backoffice/supprimer_reseaux.php
include __DIR__ . '/../includes/db_connection.php';

if (!isset($_GET['id'])) {
    die('ID manquant.');
}
$id = intval($_GET['id']);

// Supprimer l’enregistrement
$sql  = "DELETE FROM social_media WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
if (!mysqli_stmt_execute($stmt)) {
    die('Erreur MySQL : ' . mysqli_error($conn));
}

// Redirection vers la liste
header('Location: reseaux.php');
exit;
