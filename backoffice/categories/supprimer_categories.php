<?php
include __DIR__ . '/../includes/db_connection.php';

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
    mysqli_query($conn, "DELETE FROM categories WHERE id = $id");
    header("Location: categories.php");
    exit();
} else {
    die("ID manquant.");
}
?>
