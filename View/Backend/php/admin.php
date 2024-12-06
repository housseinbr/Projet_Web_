<?php
session_start(); 

include '../../../config.php';


if (!isset($_SESSION['id_u'])) {
    echo "<script>alert('Vous devez être connecté pour ajouter un admin.');</script>";
    exit; 
}

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

        echo "<script>alert('Le nouvel admin a été ajouté avec succès');</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
