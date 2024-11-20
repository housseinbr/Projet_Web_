<?php
include '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $pwd = $_POST['pwd']; 
    $nom = $_POST['nom'];
    $pre = $_POST['pre'];
    $email = $_POST['email'];


    $sql = "INSERT INTO admin (id, pwd, nom, pre, email) VALUES (:id, :pwd, :nom, :pre, :email)";
    
    try {
        $stmt = config::getConnexion()->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':pre', $pre);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        echo "<script>alert('on a ajouter le nouveau admin');</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
