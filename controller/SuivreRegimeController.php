<?php
include_once(__DIR__ . '/../config.php');  // Assurez-vous que c'est 'include_once'
include(__DIR__ . '/../Model/SuiviRegime.php');

class SuiviRegimeController
{
    // Méthode pour lister tous les suivis
    public function listSuivis()
    {
        $sql = "SELECT * FROM suivre_regime";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode pour supprimer un suivi
    function deleteSuivi($id)
    {
        $sql = "DELETE FROM suivre_regime WHERE id_s = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode pour ajouter un suivi
    function addSuivi($suivi)
    {
        $sql = "INSERT INTO suivre_regime (id_u, poids, imc, cat, motivation) 
                VALUES (:id_u, :poids, :imc, :cat, :motivation)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_u' => $suivi->getIdU(),
                'poids' => $suivi->getPoids(),
                'imc' => $suivi->getImc(),
                'cat' => $suivi->getCat(),
                'motivation' => $suivi->getMotivation()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Méthode pour mettre à jour un suivi
    public function updateSuivi($suivi)
    {
        // Connexion à la base de données
        $db = config::getConnexion();
        
        // Afficher les données avant mise à jour pour vérifier
        $sql = "SELECT * FROM suivre_regime WHERE id_s = :id";
        $query = $db->prepare($sql);
        $query->execute(['id' => $suivi->getId()]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Affichage des données récupérées pour débogage
        echo "Données existantes avant mise à jour :<br>";
        print_r($result);
        
        // SQL UPDATE
        $sql = "UPDATE suivre_regime SET 
                    id_u = :id_u, 
                    poids = :poids, 
                    imc = :imc, 
                    cat = :cat, 
                    motivation = :motivation 
                WHERE id_s = :id";
        
        // Préparer la requête d'UPDATE
        $query = $db->prepare($sql);
    
        // Afficher la requête SQL pour déboguer
        echo "SQL: " . $sql . "<br>";

        // Lier les valeurs à la requête
        $query->bindValue(':id', $suivi->getId());
        $query->bindValue(':id_u', $suivi->getIdU());
        $query->bindValue(':poids', $suivi->getPoids());
        $query->bindValue(':imc', $suivi->getImc());
        $query->bindValue(':cat', $suivi->getCat());
        $query->bindValue(':motivation', $suivi->getMotivation());

        // Afficher les valeurs liées pour déboguer
        echo "Binding values:<br>";
        echo "id: " . $suivi->getId() . "<br>";
        echo "id_u: " . $suivi->getIdU() . "<br>";
        echo "poids: " . $suivi->getPoids() . "<br>";
        echo "imc: " . $suivi->getImc() . "<br>";
        echo "cat: " . $suivi->getCat() . "<br>";
        echo "motivation: " . $suivi->getMotivation() . "<br>";

        try {
            // Exécuter la requête
            $result = $query->execute();
    
            // Vérifier si la mise à jour a réussi
            if ($result) {
                echo "Mise à jour réussie !<br>";
            } else {
                echo "La mise à jour a échoué.<br>";
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode pour récupérer un suivi par son ID
    public function getSuiviById($id)
    {
        $sql = "SELECT * FROM suivre_regime WHERE id_s = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);

            $suivi = $query->fetch(PDO::FETCH_ASSOC);
            return $suivi ? $suivi : null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
