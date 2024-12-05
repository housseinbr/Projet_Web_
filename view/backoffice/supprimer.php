<?php
// Inclure le contrôleur Formation
require_once 'C:/xampp/htdocs/frm4/controller/FormationController.php';  // Utiliser un chemin relatif

// Créer une instance du contrôleur
$formationController = new FormationController();

// Vérifier si l'ID de la formation est présent dans la requête GET
$formationId = isset($_GET['id']) ? $_GET['id'] : null;

if ($formationId) {
    // Supprimer la formation par son ID
    $formationController->deleteFormation($formationId);

    // Rediriger vers la liste des formations après la suppression
    header('Location: list.php');  // Assurez-vous que la page existe
    exit(); // Assurez-vous qu'aucun autre code ne soit exécuté après la redirection
} else {
    // Si l'ID est manquant
    echo "L'ID de la formation est manquant.";
}
?>