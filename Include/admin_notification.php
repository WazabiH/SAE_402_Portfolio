<?php
// admin_notification.php

$to_admin = "hamedwassila2004@gmail.com"; // adresse de réception
$subject_admin = "Nouveau message depuis le formulaire de contact";

$body_admin = "<html>
    <body>
        <p><strong>Message reçu via le formulaire :</strong></p>
        <p><strong>Nom :</strong> $_firstname $_name</p>
        <p><strong>Email :</strong> $_email</p>
        <p><strong>Message :</strong><br>$_message</p>
    </body>
</html>";

$headers_admin = "MIME-Version: 1.0\r\n";
$headers_admin .= "Content-type:text/html;charset=UTF-8\r\n";
$headers_admin .= "From: <no-reply@votresite.fr>\r\n";

mail($to_admin, $subject_admin, $body_admin, $headers_admin);
?>
