<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h2>Test d'upload FINAL</h2>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    $target_dir = __DIR__ . "/uploads/";
    echo "Dossier cible : " . $target_dir . "<br>";

    if (!is_dir($target_dir)) {
        echo "Le dossier uploads n'existe pas. Création...<br>";
        mkdir($target_dir, 0777, true);
    }

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        echo "On essaie de déplacer le fichier vers : $target_file <br>";

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "<span style='color:green'>✅ Fichier déplacé avec succès !</span>";
        } else {
            echo "<span style='color:red'>❌ Echec du déplacement du fichier !</span>";
        }
    } else {
        echo "<span style='color:red'>❌ Aucun fichier envoyé ou erreur au niveau du fichier.</span>";
    }
}
?>

<form action="test_upload_final.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image" required><br><br>
    <button type="submit">Tester l'Upload</button>
</form>
