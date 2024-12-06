<?php
require_once('C:/xampp/htdocs/yoo/config/config.php');  // Exemple de chemin absolu
require_once('C:/xampp/htdocs/yoo/model/EvaluationModel.php'); 

class EvaluationController
{
    // Récupérer toutes les évaluations
    public function listEvaluations()
    {
        $sql = "SELECT * FROM evaluation";
        $db = configg::getConnexion();
        try {
            return $db->query($sql)->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Supprimer une évaluation par son ID
    public function deleteEvaluation($id) {
        $db = configg::getConnexion();
        try {
            $sql = "DELETE FROM evaluation WHERE id_eva = :id_eva";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_eva', $id);
            $stmt->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    public function addEvaluation($evaluation) {
        $db = configg::getConnexion();
        $sql = "INSERT INTO evaluation (poids, kcl, taille, date_nais, nb_repa, niv_phy, nb_h_dormir, cat)
                VALUES (:poids, :kcl, :taille, :date_nais, :nb_repa, :niv_phy, :nb_h_dormir, :cat)";
        $stmt = $db->prepare($sql);
        
        $stmt->bindParam(':poids', $evaluation->poids);
        $stmt->bindParam(':kcl', $evaluation->kcl);
        $stmt->bindParam(':taille', $evaluation->taille);
        $stmt->bindParam(':date_nais', $evaluation->date_nais);
        $stmt->bindParam(':nb_repa', $evaluation->nb_repa);
        $stmt->bindParam(':niv_phy', $evaluation->niv_phy);
        $stmt->bindParam(':nb_h_dormir', $evaluation->nb_h_dormir);
        $stmt->bindParam(':cat', $evaluation->cat);

        $stmt->execute();

        // Retourner l'ID de la dernière évaluation insérée
        return $db->lastInsertId(); // Récupérer l'ID de la dernière insertion
    }
    
    // Méthode pour obtenir l'ID de la dernière évaluation insérée
    public function getLastEvaluationId() {
        $db = configg::getConnexion();
        $sql = "SELECT MAX(id_eva) AS max_id FROM evaluation";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['max_id'];  // Retourne le dernier ID d'évaluation
    }

    

public function updateEvaluation($data, $id_evaluation) {
    $db = configg::getConnexion();

    // SQL pour la mise à jour de l'évaluation
    $sql = "UPDATE evaluation SET 
            poids = :poids, 
            kcl = :kcl, 
            taille = :taille, 
            date_nais = :date_nais, 
            nb_repa = :nb_repa, 
            niv_phy = :niv_phy, 
            nb_h_dormir = :nb_h_dormir, 
            cat = :cat 
            WHERE id_eva = :id_eva";

    $stmt = $db->prepare($sql);

    // Lier les paramètres avec les valeurs du tableau $data
    $stmt->bindParam(':poids', $data['poids']);
    $stmt->bindParam(':kcl', $data['kcl']);
    $stmt->bindParam(':taille', $data['taille']);
    $stmt->bindParam(':date_nais', $data['date_nais']);
    $stmt->bindParam(':nb_repa', $data['nb_repa']);
    $stmt->bindParam(':niv_phy', $data['niv_phy']);
    $stmt->bindParam(':nb_h_dormir', $data['nb_h_dormir']);
    $stmt->bindParam(':cat', $data['cat']);
    $stmt->bindParam(':id_eva', $id_evaluation);

    // Exécuter la requête
    $stmt->execute();
}

    

    // Récupérer une évaluation par son ID
    public function showEvaluation($id)
    {
        $sql = "SELECT * FROM evaluation WHERE id_eva = :id";
        $db = configg::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function searchPoids($search)
{
    $db = configg::getConnexion();

    // Construction de la requête SQL
    $sql = "SELECT * FROM evaluation WHERE poids LIKE :search";

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
function getPoids($orderBy, $direction)
{
    $validColumns = ['kcl', 'taille'];
    $validDirections = ['ASC', 'DESC'];

    // Validation des paramètres
    if (!in_array($orderBy, $validColumns) || !in_array($direction, $validDirections)) {
        die('Paramètres de tri invalides.');
    }

    $db = configg::getConnexion();
    $sql = "SELECT * FROM evaluation ORDER BY $orderBy $direction";

    try {
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
}

?>
