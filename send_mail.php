<?php
require_once 'C:/xampp/htdocs/frm5/controller/FormationController.php'; 
require_once 'C:/xampp/htdocs/frm5/PHPMailer-master/src/Exception.php'; 
require_once 'C:/xampp/htdocs/frm5/PHPMailer-master/src/PHPMailer.php'; 
require_once 'C:/xampp/htdocs/frm5/PHPMailer-master/src/SMTP.php'; 
require_once 'C:/xampp/htdocs/frm5/PHPMailer-master/PHPMailerAutoload.php';

if (isset($_POST["Ajouter"]))
{
$mail = new PHPMailer(true);

    //Server settings                    // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";                 // Set the SMTP server to send through                                 // Enable SMTP authentication
    $mail->Username   = 'yassinnjeh11@gmail.com';                     // SMTP username
    $mail->Password   = 'izgkiqnjlnqbfmae';                               // SMTP password                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('yassinnjeh11@gmail.com');
    $mail->addAddress($_POST["email_f"]);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'formation';
    $mail->Body    = 'Bonjour, une nouvelle formation a été ajoutée et vous êtes le formateur de cette formation. Merci beaucoup! ';

    $mail->send();
    echo 'check your e mail for confirmation';

}

?>