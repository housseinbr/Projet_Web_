<?php
  
  require_once 'C:/xampp/htdocs/frm5/controller/FormationController.php'; 
  class mailc{
    function recupererformation($id_f){
        $sql="SELECT * from formation where id_f=:id_f ";
        $db = config::getConnexion();
        try{
        $liste=$db->query($sql);
        return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }


  }
}
$mail=new mailc();
$liste=$mail->recupererformation($_POST['id_user']);
foreach($liste as $row){

    $email=$row['email_f'];


}
$mailto = $email;
$mailSub = 'formation';
$mailMsg = 'Bonjour, une nouvelle formation a été ajoutée et vous êtes le formateur de cette formation. Merci beaucoup!';
require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail->IsSmtp();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 465
$mail->IsHTML(true);
$mail->addAttachment('images/img_1.jpg');
$mail->Username = "yassinnjeh11@gmail.com";
$mail->Password = "izgkiqnjlnqbfmae";
$mail->SetFrom("yassinnjeh11@gmail.com");
$mail->Subject = $mailSub;
$mail->Body = $mailMsg;
$mail->AddAddress($mailto);

if (!$mail->Send()) {
    echo "Mail Not Sent to ";
} else {
    header('Location: list.php');
}
?>