<?php
// Inclure le contrôleur AccessController
require_once 'C:/xampp/htdocs/frm4/controller/AccederFController.php';

// Créer une instance du contrôleur
$accessController = new AccederFController();

// Vérifier si l'ID de la catégorie est présent dans la requête GET et si c'est un entier
$id_cat = isset($_GET['id_cat']) && is_numeric($_GET['id_cat']) ? (int) $_GET['id_cat'] : null;

if ($id_cat) {
    // Supprimer la catégorie par son ID
    $accessController->deleteCategory($id_cat);

    // Rediriger vers la liste des catégories après la suppression
    header('Location: listcat.php');
    exit();
} else {
    // Si l'ID est manquant ou invalide
    echo "L'ID de la catégorie est manquant ou invalide.";
}
?>
