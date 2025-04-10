<?php
// Définition des messages d'erreur et de succès
$msg_erreur = "<p class='banner_error'>Votre message possède une erreur.</p>";
$msg_good = "<p class='banner_success'>Votre message a bien été envoyé.</p>";

// Vérification si le formulaire a été soumis
if (isset($_POST['envoi'])) {

    // Récupération des données du formulaire
    $_firstname = htmlspecialchars($_POST['firstname']);
    $_name = htmlspecialchars($_POST['name']);
    $_message = htmlspecialchars($_POST['message']);
    $_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Vérification si des champs obligatoires sont vides
    if (empty($_firstname) || empty($_name) || empty($_message) || empty($_email)) {
        echo $msg_erreur;
    } else {
        // Vérification du format de l'email
        if (!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
            echo "<p class='banner_error'>Format d'email invalide.</p>";
            exit;
        }

        // Adresse e-mail de l'administrateur
        $to_admin = "hamed-wassila2004@gmail.com";

        // Sujet de l'e-mail pour l'administrateur
        $subject_admin = "Nouveau message reçu via le formulaire de contact";

        // Corps de l'e-mail pour l'administrateur
        $body_admin = "<html>
                        <body>
                            <div>
                                <p>Un nouveau message a été reçu via le formulaire de contact.</p>
                                <p><strong>Nom :</strong> $_firstname $_name</p>
                                <p><strong>Email :</strong> $_email</p>
                                <p><strong>Message :</strong> $_message</p>
                            </div>
                        </body>
                    </html>";

        // En-têtes de l'e-mail pour l'administrateur
        $headers_admin = "MIME-Version: 1.0" . "\r\n";
        $headers_admin .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers_admin .= 'From: Portfolio <no-reply@portfolio.com>' . "\r\n";
        $headers_admin .= 'X-Mailer: PHP/' . phpversion();

        // Envoi de l'e-mail à l'administrateur
        if (mail($to_admin, $subject_admin, $body_admin, $headers_admin)) {
            echo $msg_good;
        } else {
            echo "<p class='banner_error'>Une erreur est survenue lors de l'envoi de l'e-mail. Veuillez réessayer plus tard.</p>";
        }
    }
}
?>