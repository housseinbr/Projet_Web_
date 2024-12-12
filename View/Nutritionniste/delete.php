<?php
include '../config.php';


try {
    // Connexion à la base de données
    $pdo = config::getConnexion();

    if (isset($_GET['nom']) && !empty($_GET['nom'])) {
        $nom = $_GET['nom'];

        // Requête pour supprimer le nutritionniste par son nom
        $sql = "DELETE FROM nutrisonniste WHERE nom = :nom";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Le nutritionniste '$nom' a été supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du nutritionniste.";
        }
    } else {
        echo "Le paramètre 'nom' est requis.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
