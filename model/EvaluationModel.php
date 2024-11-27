<?php
// Inclure la connexion à la base de données et le modèle
require_once('C:/xampp/htdocs/try4/controller/EvaluationController.php');
require_once('C:/xampp/htdocs/try/login.php');


$database = new Database();
$db = $database->getConnection();  


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $poids = $_POST['poids'];
    $kcl = $_POST['preferences-alimentaires'];
    $taille = $_POST['taille'];
    $date_nais = $_POST['date-naissance'];
    $nb_repa = $_POST['frequence-repas'];
    $niv_phy = $_POST['stress-niveau'];
    $nb_h_dormir = $_POST['sommeil-heures'];
    $cat = $_POST['objectif-principal'];

   
    $controller = new EvaluationController($db);  
    $controller->addEvaluation($poids, $kcl, $taille, $date_nais, $nb_repa, $niv_phy, $nb_h_dormir, $cat);

   
    header('Location: ../view/FrontOffice/success.php');
    exit();
}


class EvaluationModel {
    private $controller;

   
    public function __construct($controller) {
        $this->controller = $controller;
    }

   
    public function showAllEvaluations() {
        return $this->controller->getAllEvaluations();
    }
}
?>
