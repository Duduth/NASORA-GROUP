<?php
// Inclure la bibliothèque PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Créer une instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Paramètres de connexion SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'thioubdou@gmail.com';
    $mail->Password = 'Nasora2024';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Utilisez STARTTLS
    $mail->Port = 587;

    // Destinataire, expéditeur, sujet et corps de l'e-mail
    $mail->setFrom('thioubdou@gmail.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name');
    $mail->Subject = 'Test Email';
    $mail->Body = 'This is a test email.';

    // Envoyer l'e-mail
    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo 'Failed to send email. Error: ' . $mail->ErrorInfo;
}
?>
