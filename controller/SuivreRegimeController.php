<?php
require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . '/../model/SuivreRegimeModel.php');

class SuiviRegimeController {
    public function listSuivis(string $search = '', string $orderBy = 'id_s', string $orderDirection = 'ASC'): array {
        $allowedOrderBy = ['id_s', 'id_u', 'imc', 'cat', 'motivation', 'poids'];
        $allowedOrderDirection = ['ASC', 'DESC'];

        $orderBy = in_array($orderBy, $allowedOrderBy) ? $orderBy : 'id_s';
        $orderDirection = in_array($orderDirection, $allowedOrderDirection) ? $orderDirection : 'ASC';

        $sql = "SELECT * FROM suivre_regime 
                WHERE cat LIKE :search 
                ORDER BY $orderBy $orderDirection";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erreur lors de la récupération des suivis : ' . $e->getMessage());
            return [];
        }
    }

    public function getStatistics(): array {
        $sql = "SELECT 
                    COUNT(*) as total_suivis,
                    AVG(imc) as average_imc,
                    MAX(poids) as max_poids,
                    MIN(poids) as min_poids
                FROM suivre_regime";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            return $query->fetch(PDO::FETCH_ASSOC) ?: [
                'total_suivis' => 0,
                'average_imc' => 0,
                'max_poids' => 0,
                'min_poids' => 0,
            ];
        } catch (PDOException $e) {
            error_log('Erreur lors de la récupération des statistiques : ' . $e->getMessage());
            return [
                'total_suivis' => 0,
                'average_imc' => 0,
                'max_poids' => 0,
                'min_poids' => 0,
            ];
        }
    }
    

    public function deleteSuivi(int $id): bool {
        $sql = "DELETE FROM suivre_regime WHERE id_s = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Erreur lors de la suppression du suivi : ' . $e->getMessage());
            return false;
        }
    }

    public function addSuivi(SuivreRegime $suivi): bool {
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
                'motivation' => $suivi->getMotivation(),
            ]);
            return true;
        } catch (PDOException $e) {
            error_log('Erreur lors de l\'ajout du suivi : ' . $e->getMessage());
            return false;
        }
    }

    public function updateSuivi(SuivreRegime $suivi): bool {
        $sql = "UPDATE suivre_regime SET 
                    id_u = :id_u, 
                    poids = :poids, 
                    imc = :imc, 
                    cat = :cat, 
                    motivation = :motivation 
                WHERE id_s = :id_s";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_s' => $suivi->getIdS(),
                'id_u' => $suivi->getIdU(),
                'poids' => $suivi->getPoids(),
                'imc' => $suivi->getImc(),
                'cat' => $suivi->getCat(),
                'motivation' => $suivi->getMotivation(),
            ]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Erreur lors de la mise à jour du suivi : ' . $e->getMessage());
            return false;
        }
    }

    public function getSuiviById(int $id): ?array {
        $sql = "SELECT * FROM suivre_regime WHERE id_s = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log('Erreur lors de la récupération du suivi par ID : ' . $e->getMessage());
            return null;
        }
    }

    public function listSuiviByUserId($id_u)
{
    if (!is_numeric($id_u) || $id_u <= 0) {
        return [];
    }

    $sql = "SELECT * FROM suivre_regime WHERE id_u = :id_u";
    try {
        $query = $this->db->prepare($sql);
        $query->bindValue(':id_u', $id_u, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Erreur dans listSuiviByUserId : ' . $e->getMessage());
        return [];
    }
}



}
?>
