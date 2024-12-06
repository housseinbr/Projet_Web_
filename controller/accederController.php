<?php
require_once('C:/xampp/htdocs/yoor/config/config.php');
require_once('C:/xampp/htdocs/yoor/model/accederModel.php');

class accederController {

    public function listAccounts()
    {
        // Requête SQL pour récupérer toutes les lignes de la table stage_assignment
        $sql = "SELECT * FROM acceder_eva";
        
        // Connexion à la base de données
        $db = Configg::getConnexion();
        
        try {
            // Exécution de la requête et récupération de tous les résultats
            return $db->query($sql)->fetchAll();
        } catch (Exception $e) {
            // Si une erreur survient lors de l'exécution de la requête, afficher l'erreur
            die('Error: ' . $e->getMessage());
        }
    }
    public function addAccount($account) {
        $db = Configg::getConnexion();
        $sql = "INSERT INTO acceder_eva (id_acc, id_u, id_eva)
                VALUES (:id_acc, :id_u, :id_eva)";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id_acc', $account->id_acc);
        $stmt->bindParam(':id_u', $account->id_u);
        $stmt->bindParam(':id_eva', $account->id_eva);

        $stmt->execute();
    }

    // READ
    public function getAllAccounts() {
        $sql = "SELECT * FROM acceder_eva";
        $db = Configg::getConnexion();
        try {
            return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateAccount($data, $accountId) {
        // Requête SQL pour mettre à jour l'entrée
        $sql = "UPDATE acceder_eva 
                SET id_u = :id_u, id_eva = :id_eva 
                WHERE id_acc = :id_acc";
    
        // Connexion à la base de données
        $db = Configg::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            // Exécution de la requête avec les paramètres
            $query->execute([
                ':id_u' => $data['id_u'],
                ':id_eva' => $data['id_eva'],
                ':id_acc' => $accountId
            ]);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    

    // DELETE
    public function deleteAccount($id_acc) {
        $sql = "DELETE FROM acceder_eva WHERE id_acc = :id_acc";
        $db = Configg::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_acc' => $id_acc]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
// Récupérer une évaluation par son ID
// Récupérer une évaluation (ou un compte) par son ID
public function showAccount($id_acc) {
    $sql = "SELECT * FROM acceder_eva WHERE id_acc = :id_acc";
    $db = Configg::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute(['id_acc' => $id_acc]);
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

}
?>
