<?php
// Test de Envío de Correo
require_once dirname(__FILE__) . '/../app/config/config.php';
require_once dirname(__FILE__) . '/../vendor/autoload.php'; // Cargar PHPMailer si es composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

echo "--- PRUEBA DE SMTP ---\n";
echo "Host: " . getenv('SMTP_HOST') . "\n";
echo "User: " . getenv('SMTP_USER') . "\n";

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = getenv('SMTP_HOST');
    $mail->SMTPAuth   = true;
    $mail->Username   = getenv('SMTP_USER');
    $mail->Password   = getenv('SMTP_PASS');
    $mail->SMTPSecure = getenv('SMTP_SECURE');
    $mail->Port       = getenv('SMTP_PORT');
    
    // Bypass SSL verify for local testing
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Recipients
    $mail->setFrom(getenv('SMTP_USER'), 'SIGP Tester');
    $mail->addAddress(getenv('SMTP_USER')); // Auto-envío

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Prueba de Configuracion SMTP - SIGP';
    $mail->Body    = 'Este es un correo de prueba para verificar las credenciales <b>App Password</b>.';

    $mail->send();
    echo "✅ ÉXITO: El correo se ha enviado correctamente.\n";
} catch (Exception $e) {
    echo "❌ ERROR: No se pudo enviar el correo.\n";
    echo "Mailer Error: {$mail->ErrorInfo}\n";
}
