<?php

class EvaluationController {
    private $db;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($db) {
        $this->db = $db;
    }

    // Méthode pour récupérer toutes les évaluations
    public function getAllEvaluations() {
        try {
            // Préparer la requête
            $query = "SELECT * FROM evaluation";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            // Récupère toutes les lignes sous forme d'un tableau associatif
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Enregistrer l'erreur dans un fichier log (ou afficher si besoin)
            error_log("Erreur lors de la récupération des évaluations : " . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    // Méthode pour ajouter une évaluation
    public function addEvaluation($poids, $kcl, $taille, $date_nais, $nb_repa, $niv_phy, $nb_h_dormir, $cat) {
        try {
            // Validation de données d'entrée (simplifiée, peut être étendue selon les besoins)
            $poids = htmlspecialchars(trim($poids));
            $kcl = htmlspecialchars(trim($kcl));
            $taille = htmlspecialchars(trim($taille));
            $date_nais = htmlspecialchars(trim($date_nais));
            $nb_repa = htmlspecialchars(trim($nb_repa));
            $niv_phy = htmlspecialchars(trim($niv_phy));
            $nb_h_dormir = htmlspecialchars(trim($nb_h_dormir));
            $cat = htmlspecialchars(trim($cat));

            // Préparer la requête d'insertion
            $query = "INSERT INTO evaluation (poids, kcl, taille, date_nais, nb_repa, niv_phy, nb_h_dormir, cat)
                      VALUES (:poids, :kcl, :taille, :date_nais, :nb_repa, :niv_phy, :nb_h_dormir, :cat)";

            // Préparer l'exécution de la requête
            $stmt = $this->db->prepare($query);

            // Lier les paramètres aux variables
            $stmt->bindParam(':poids', $poids, PDO::PARAM_STR);
            $stmt->bindParam(':kcl', $kcl, PDO::PARAM_STR);
            $stmt->bindParam(':taille', $taille, PDO::PARAM_STR);
            $stmt->bindParam(':date_nais', $date_nais, PDO::PARAM_STR);
            $stmt->bindParam(':nb_repa', $nb_repa, PDO::PARAM_INT);
            $stmt->bindParam(':niv_phy', $niv_phy, PDO::PARAM_INT);
            $stmt->bindParam(':nb_h_dormir', $nb_h_dormir, PDO::PARAM_INT);
            $stmt->bindParam(':cat', $cat, PDO::PARAM_STR);

            // Exécuter la requête et retourner le résultat
            return $stmt->execute();
        } catch (PDOException $e) {
            // Enregistrer l'erreur dans un fichier log (ou afficher si besoin)
            error_log("Erreur lors de l'ajout de l'évaluation : " . $e->getMessage());
            return false; // Retourne false en cas d'échec
        }
    }
    public function deleteEvaluation($id) {
        try {
            $query = "DELETE FROM evaluation WHERE id_eva = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression : " . $e->getMessage();
            return false;
        }
    }
    
    public function getEvaluationById($id) {
        try {
            $query = "SELECT * FROM evaluation WHERE id_eva = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération : " . $e->getMessage();
            return false;
        }
    }
    
    public function updateEvaluation($id, $data) {
        try {
            $query = "UPDATE evaluation SET 
                poids = :poids, 
                kcl = :kcl, 
                taille = :taille, 
                date_nais = :date_nais, 
                nb_repa = :nb_repa, 
                niv_phy = :niv_phy, 
                nb_h_dormir = :nb_h_dormir, 
                cat = :cat 
                WHERE id_eva = :id";
            $stmt = $this->db->prepare($query);
    
            $stmt->bindParam(':poids', $data['poids']);
            $stmt->bindParam(':kcl', $data['kcl']);
            $stmt->bindParam(':taille', $data['taille']);
            $stmt->bindParam(':date_nais', $data['date_nais']);
            $stmt->bindParam(':nb_repa', $data['nb_repa']);
            $stmt->bindParam(':niv_phy', $data['niv_phy']);
            $stmt->bindParam(':nb_h_dormir', $data['nb_h_dormir']);
            $stmt->bindParam(':cat', $data['cat']);
            $stmt->bindParam(':id', $id);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }
    
}
?>
