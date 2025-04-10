<?php
require_once '../Include/db_connection.php';

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = mysqli_real_escape_string($conn, $_POST["username"]);
    $pass = mysqli_real_escape_string($conn, $_POST["password"]);

    $query = "SELECT * FROM login WHERE username = '$user' AND password = '$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION["username"] = $user;
        header("Location: ../administration.php");
        exit();
    } else {
        echo "<p style='color: red;'>Nom d'utilisateur ou mot de passe incorrect</p>";
    }
}
?>
