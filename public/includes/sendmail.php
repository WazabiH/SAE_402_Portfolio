<?php
// sendmail.php

$msg_erreur = "<p class='banner_error'>Votre message possède une erreur.</p>";
$msg_good = "<p class='banner_success'>Votre message a bien été envoyé.</p>";

if (isset($_POST['envoi'])) {
    $_firstname = $_POST['firstname'];
    $_name = $_POST['name'];
    $_message = $_POST['message'];
    $_email = $_POST['email'];

    if (empty($_firstname) || empty($_name) || empty($_message) || empty($_email)) {
        echo $msg_erreur;
    } else {
        // ---------- Email de confirmation à l'utilisateur ----------
        $to_user = $_email;
        $subject_user = "Confirmation d'envoi de votre message";

        $body_user = "<html>
            <body>
                <div>
                    <p>Cher(e) $_firstname $_name,</p>
                    <p>Merci pour votre message. Nous avons bien reçu votre demande.</p>
                    <p><strong>Votre message :</strong><br>$_message</p>
                    <p>Cordialement,<br>L'équipe de l'IUT de Cergy-Pontoise, site de Sarcelles.</p>
                </div>
                <div style='font-size: 12px; color: #999; margin-top: 20px;'>
                    <p>Cet e-mail a été envoyé automatiquement. Merci de ne pas répondre.</p>
                    <p>Si vous n'avez pas effectué cette action, veuillez ignorer cet e-mail.</p>
                </div>
            </body>
        </html>";

        $headers_user = "MIME-Version: 1.0\r\n";
        $headers_user .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers_user .= "From: <hamed-wassila@alwaysdata.net>\r\n";

        // ---------- Envoi et suite ----------
        if (mail($to_user, $subject_user, $body_user, $headers_user)) {
            require_once 'admin_notification.php';
            echo $msg_good;
        } else {
            echo "<p class='banner_error'>Une erreur est survenue lors de l'envoi de l'e-mail. Veuillez réessayer plus tard.</p>";
        }
    }
}
?>
