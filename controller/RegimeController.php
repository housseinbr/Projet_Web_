<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../model/RegimeModel.php';

class RegimeController
{
    private $db;

    // Constructor with dependency injection for the database connection
    public function __construct()
    {
        $this->db = Config::getConnexion();
    }

    // Méthode pour récupérer toutes les régimes avec recherche, tri et pagination
    public function listRegimes($search = '', $orderBy = 'id_r', $orderDirection = 'ASC', $limit = 10, $offset = 0)
    {
        $allowedOrderBy = ['id_r', 'titre', 'kcl'];
        $allowedOrderDirection = ['ASC', 'DESC'];

        // Validation des paramètres de tri
        $orderBy = in_array($orderBy, $allowedOrderBy) ? $orderBy : 'id_r';
        $orderDirection = in_array($orderDirection, $allowedOrderDirection) ? $orderDirection : 'ASC';

        // Requête SQL avec recherche et tri
        $sql = "SELECT * FROM regime 
                WHERE titre LIKE :search 
                ORDER BY $orderBy $orderDirection 
                LIMIT :limit OFFSET :offset";

        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':search', "%$search%", PDO::PARAM_STR);
            $query->bindValue(':limit', $limit, PDO::PARAM_INT);
            $query->bindValue(':offset', $offset, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erreur dans listRegimes : ' . $e->getMessage());
            return [];
        }
    }

    // Méthode pour supprimer un régime
    public function deleteRegime($id_r)
    {
        if (!is_numeric($id_r) || $id_r <= 0) {
            return false; // Validation simple
        }

        $sql = "DELETE FROM regime WHERE id_r = :id_r";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':id_r', $id_r, PDO::PARAM_INT);
            $query->execute();
            return $query->rowCount() > 0; // Retourne true si une ligne a été supprimée
        } catch (PDOException $e) {
            error_log('Erreur dans deleteRegime : ' . $e->getMessage());
            return false;
        }
    }

    // Méthode pour ajouter un régime
    public function addRegime($regime)
    {
        if (!$this->validateRegime($regime)) {
            return false; // Validation échouée
        }

        $sql = "INSERT INTO regime (id_u, titre, discription, kcl) VALUES (:id_u, :titre, :discription, :kcl)";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
                'id_u' => $regime->getIdU(),
                'titre' => $regime->getTitre(),
                'discription' => $regime->getDiscription(),
                'kcl' => $regime->getKcl(),
            ]);
            return $this->db->lastInsertId(); // Retourne l'ID du régime ajouté
        } catch (PDOException $e) {
            error_log('Erreur dans addRegime : ' . $e->getMessage());
            return false;
        }
    }

    // Méthode pour mettre à jour un régime
    public function updateRegime($regime)
    {
        if (!$this->validateRegime($regime)) {
            return false; // Validation échouée
        }

        $sql = "UPDATE regime SET 
                    id_u = :id_u,
                    titre = :titre,
                    discription = :discription,
                    kcl = :kcl
                WHERE id_r = :id_r";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
                'id_r' => $regime->getIdR(),
                'id_u' => $regime->getIdU(),
                'titre' => $regime->getTitre(),
                'discription' => $regime->getdiscription(),
                'kcl' => $regime->getKcl(),
            ]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Erreur dans updateRegime : ' . $e->getMessage());
            return false;
        }
    }

    // Méthode pour afficher un régime par son ID
    public function showRegime($id_r)
    {
        if (!is_numeric($id_r) || $id_r <= 0) {
            return null;
        }

        $sql = "SELECT * FROM regime WHERE id_r = :id_r";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':id_r', $id_r, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log('Erreur dans showRegime : ' . $e->getMessage());
            return null;
        }
    }
    // Méthode pour afficher les régimes par ID utilisateur
public function listRegimesByUserId($id_u)
{
    if (!is_numeric($id_u) || $id_u <= 0) {
        return [];
    }

    $sql = "SELECT * FROM regime WHERE id_u = :id_u";
    try {
        $query = $this->db->prepare($sql);
        $query->bindValue(':id_u', $id_u, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Erreur dans listRegimesByUserId : ' . $e->getMessage());
        return [];
    }
}


    // Méthode pour récupérer le nombre total de régimes
    public function countRegimes($search = '')
    {
        $sql = "SELECT COUNT(*) as total FROM regime WHERE titre LIKE :search";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':search', "%$search%", PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            error_log('Erreur dans countRegimes : ' . $e->getMessage());
            return 0;
        }
    }

    // Méthode pour obtenir des statistiques sur les régimes
    public function getStatistics()
    {
        $sql = "SELECT 
                    COUNT(*) as total_regimes,
                    AVG(kcl) as average_kcl,
                    MAX(kcl) as max_kcl,
                    MIN(kcl) as min_kcl
                FROM regime";
        try {
            $query = $this->db->query($sql);
            return $query->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif contenant les statistiques
        } catch (PDOException $e) {
            error_log('Erreur dans getStatistics : ' . $e->getMessage());
            return [
                'total_regimes' => 0,
                'average_kcl' => 0,
                'max_kcl' => 0,
                'min_kcl' => 0,
            ];
        }
    }

    // Méthode pour valider un objet Regime
    private function validateRegime($regime)
    {
        return is_numeric($regime->getKcl()) && $regime->getKcl() > 0 &&
               !empty($regime->getTitre()) && strlen($regime->getTitre()) >= 2;
    }
}
