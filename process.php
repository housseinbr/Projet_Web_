<?php
require_once('C:/xampp/htdocs/yoor/config/config.php');  // Chemin vers le fichier de config
require_once('C:/xampp/htdocs/yoor/controller/controller.php');  // Inclure le contrôleur
require_once('C:/xampp/htdocs/yoor/controller/accederController.php');  // Inclure le contrôleur

// Démarrer la session pour les messages de succès/erreur
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Créer un objet pour l'évaluation
        $evaluation = new stdClass();
        $evaluation->poids = $_POST['poids'];
        $evaluation->kcl = $_POST['kcl'];
        $evaluation->taille = $_POST['taille'];
        $evaluation->date_nais = $_POST['date_nais'];
        $evaluation->nb_repa = $_POST['nb_repa'];
        $evaluation->niv_phy = $_POST['niv_phy'];
        $evaluation->nb_h_dormir = $_POST['nb_h_dormir'];
        $evaluation->cat = $_POST['cat'];

        // Ajouter l'évaluation
        $controller = new EvaluationController();
        $evaluationId = $controller->addEvaluation($evaluation);  // Retourne l'ID de l'évaluation insérée

        // Récupérer l'ID de la dernière évaluation insérée
        // Assurez-vous que getLastEvaluationId retourne l'ID correct
        // $evaluationId = $controller->getLastEvaluationId();  // Facultatif, déjà récupéré via addEvaluation

        // Créer l'objet pour l'insertion dans acceder_eva
        $account = new stdClass();
        $account->id_u = getNextIdForUser();  // Récupérer le prochain ID utilisateur
        $account->id_eva = $evaluationId;    // Utiliser l'ID de l'évaluation insérée
        $account->id_acc = getNextIdForAccount();  // Récupérer le prochain ID pour acceder_eva

        // Ajouter l'enregistrement dans la table acceder_eva
        $accederController = new AccederController();
        $accederController->addAccount($account);  // Ajouter dans acceder_eva

        // Ajouter un message de succès dans la session
        $_SESSION['success_message'] = "Évaluation et compte ajoutés avec succès.";

        // Rediriger vers une page de confirmation ou une autre page
        header('Location: success.php');
        exit;

    } catch (Exception $e) {
        // En cas d'erreur, ajouter un message d'erreur dans la session
        $_SESSION['error_message'] = $e->getMessage();
        header('Location: success.php');
        exit;
    }
} else {
    // Méthode non supportée
    die('Méthode HTTP non supportée.');
}

// Fonction pour obtenir le prochain ID utilisateur
function getNextIdForUser() {
    $db = configg::getConnexion();
    $sql = "SELECT MAX(id_u) AS max_id FROM acceder_eva";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['max_id'] + 1;  // Incrémenter de 1
}

// Fonction pour obtenir le prochain ID pour acceder_eva
function getNextIdForAccount() {
    $db = configg::getConnexion();
    $sql = "SELECT MAX(id_acc) AS max_id FROM acceder_eva";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['max_id'] + 1;  // Incrémenter de 1
}
?>
