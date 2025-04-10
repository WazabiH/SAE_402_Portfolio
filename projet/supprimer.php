<?php
include '../Include/db_connection.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Récupérer l'image
    $sql = "SELECT image FROM projet WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row && file_exists("uploads/" . $row["image"])) {
        unlink("uploads/" . $row["image"]);
    }

    // Supprimer le projet
    mysqli_query($conn, "DELETE FROM projet WHERE id=$id");

    header("Location: projet.php");
    exit();
}
?>
