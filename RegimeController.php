<?php
include_once(__DIR__ . '/../config.php');

class RegimeController
{
    public function listRegimes()
    {
        $sql = "SELECT * FROM regime";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function deleteRegime($id)
    {
        $sql = "DELETE FROM regime WHERE id_r = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function addRegime($regime)
    {   
        $sql = "INSERT INTO regime (id_u, titre, discription, kcl) 
                VALUES (:id_u, :titre, :discription, :kcl)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_u' => $regime->getUserId(),
                'titre' => $regime->getTitre(),
                'discription' => $regime->getDiscription(),
                'kcl' => $regime->getKcl()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateRegime($regime, $id)
    {
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE regime SET 
                    titre = :titre,
                    discription = :discription,
                    kcl = :kcl
                WHERE id_r = :id'
            );

            $query->execute([
                'id' => $id,
                'titre' => $regime->getTitre(),
                'discription' => $regime->getDiscription(),
                'kcl' => $regime->getKcl()
            ]);

            if ($query->rowCount() > 0) {
                echo $query->rowCount() . " records UPDATED successfully <br>";
                return true;
            } else {
                echo "Aucun enregistrement mis à jour. Vérifiez l'ID fourni.<br>";
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
            return false;
        }
    }

    function showRegime($id)
    {
        $sql = "SELECT * from regime where id_r = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);

            $regime = $query->fetch();
            return $regime;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
