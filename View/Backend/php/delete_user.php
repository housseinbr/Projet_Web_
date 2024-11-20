<?php


include '../../../config.php';



if (isset($_POST['user_id'])) {
    $userId = intval($_POST['user_id']);
    
    try {
        $pdo = config::getConnexion();
        
        $stmt = $pdo->prepare("DELETE FROM utilisateur WHERE id_u = :id_u");
        $stmt->bindParam(':id_u', $userId, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            header("Location: manage_users.php?message=Utilisateur supprimé avec succès");
            exit();
        } else {
            echo "Erreur lors de la suppression de l'utilisateur.";
        }
        
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
    
} else {
    echo "ID utilisateur non fourni.";
}
?>
