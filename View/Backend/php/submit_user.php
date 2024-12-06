<?php

include_once '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $age = $_POST['age'];
    $genre = $_POST['genre'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        $pdo = config::getConnexion();

        $sql = "INSERT INTO utilisateur (nom, prenom, email, tel, age, genre, pwd) 
                VALUES (:nom, :prenom, :email, :tel, :age, :genre, :pwd)";

        $stmt = $pdo->prepare($sql);


        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':pwd', $hashed_password);


        $stmt->execute();

        echo "Utilisateur ajouté avec succès!";
    } catch (PDOException $e) {

        echo "Erreur: " . $e->getMessage();
    }
}
?>
