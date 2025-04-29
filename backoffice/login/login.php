<?php
require_once '../includes/db_connection.php';   // Connexion + session_start() :contentReference[oaicite:2]{index=2}&#8203;:contentReference[oaicite:3]{index=3}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Échappement basique
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // Si tu stockes encore le mot de passe en clair (pas idéal), on reste sur :
    $sql    = "SELECT * FROM login WHERE username = '$user' AND password = '$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // Auth OK → on stocke le nom en session
        $_SESSION['username'] = $user;
        header('Location: ../dashboard.php');
        exit;
    } else {
        $error = 'Nom d’utilisateur ou mot de passe incorrect.';
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../../public/assets/css/login.css">
  <title>Connexion</title>
</head>
<body>
  <div class="login-container">
    <h2>Administration – Connexion</h2>
    <p class="description">
      Veuillez entrer vos identifiants pour accéder à l'administration.
    </p>

    <?php if (!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="../dashboard.php">
      <input type="text"    name="username" placeholder="Nom d'utilisateur" required>
      <input type="password" name="password" placeholder="Mot de passe"  required>
      <button type="submit">Se connecter</button>
    </form>
  </div>
</body>
