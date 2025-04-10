<?php
// sendmail.php

// Définition des messages d'erreur et de succès
$msg_erreur = "<p class='banner_error'>Votre message possède une erreur.</p>";
$msg_good = "<p class='banner_success'>Votre message a bien été envoyé.</p>";

// Vérification si le formulaire a été soumis
if (isset($_POST['envoi'])) {

    // Récupération des données du formulaire
    $_firstname = $_POST['firstname'];
    $_name = $_POST['name'];
    $_message = $_POST['message'];
    $_email = $_POST['email'];

    // Vérification si des champs obligatoires sont vides
    if (empty($_firstname) || empty($_name) || empty($_message) || empty($_email)) {
        echo $msg_erreur;
    } else {
        // Adresse e-mail de destination saisie par l'utilisateur
        $to = $_email;

        // Sujet de l'e-mail
        $sujet = "Confirmation d'envoi de votre message";

        // Corps de l'e-mail au format HTML
        $txt = "<html>
                    <body>
                        <div>
                            <p>Cher(e) $_firstname $_name,</p>
                            <p>Merci pour votre message. Nous avons bien reçu votre demande et nous allons la traiter dans les plus brefs délais.</p>
                            <p>Votre message : $_message</p>
                            <p>Cordialement,<br>L'équipe de l'IUT de Cergy-Pontoise, site de Sarcelles.</p>
                        </div>
                        <div style='font-size: 12px; color: #999; margin-top: 20px;'>
                             <p>Cet e-mail a été envoyé automatiquement. Merci de ne pas répondre.</p>
                            <p>Si vous n'avez pas effectué cette action, veuillez ignorer cet e-mail.</p>
                        </div>    
                    </body>
                </html>";

        // En-têtes de l'e-mail
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";

        // Plus d'en-tête
        $headers .= "From: <hamed-wassila@alwaysdata.net>\r\n";

                // Envoi de l'email à l'utilisateur
        if (mail($to_user, $subject_user, $body_user, $headers_user)) {
            // Si l'e-mail est envoyé avec succès, inclure la notification admin
            require_once 'admin_notification.php';
            echo $msg_good;
        } else {
            echo "<p class='banner_error'>Une erreur est survenue lors de l'envoi de l'e-mail. Veuillez réessayer plus tard.</p>";
        }
    }
}
