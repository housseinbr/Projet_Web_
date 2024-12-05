<?php
require_once 'C:/xampp/htdocs/frm4/config.php';  
require_once 'C:/xampp/htdocs/frm4/model/FormationModel.php';  

class FormationController
{
    // Méthode pour récupérer toutes les formations
    public function listFormations()
    {
        $sql = "SELECT * FROM formation"; 
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode pour supprimer une formation
    public function deleteFormation($id_f)
    {
        $sql = "DELETE FROM formation WHERE id_f = :id_f"; 
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_f', $id_f);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode pour ajouter une formation
    public function addFormation($formation)
    {
        $sql = "INSERT INTO formation (titre, disc, duree, nom_f, pre_f, email_f)  
        VALUES (:titre, :disc, :duree, :nom_f, :pre_f, :email_f)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $formation->getTitre(),
                'disc' => $formation->getDisc(),
                'duree' => $formation->getDuree(),
                'nom_f' => $formation->getNomF(),
                'pre_f' => $formation->getPreF(),
                'email_f' => $formation->getEmailF()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Méthode pour mettre à jour une formation
    public function updateFormation($formation, $id_f)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE formation SET 
                    titre = :titre,
                    disc = :disc,
                    duree = :duree,
                    nom_f = :nom_f,
                    pre_f = :pre_f,
                    email_f = :email_f
                WHERE id_f = :id_f'
            );

            $query->execute([
                'id_f' => $id_f,
                'titre' => $formation->getTitre(),
                'disc' => $formation->getDisc(),
                'duree' => $formation->getDuree(),
                'nom_f' => $formation->getNomF(),
                'pre_f' => $formation->getPreF(),
                'email_f' => $formation->getEmailF()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }

    // Méthode pour afficher une formation par son ID
    public function showFormation($id_f)
    {
        $sql = "SELECT * FROM formation WHERE id_f = :id_f"; 
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_f', $id_f);
            $query->execute();

            $formation = $query->fetch();
            return $formation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function recherchertitre($titre) {
        // Assuming you have a database connection defined
        $db = Config::getConnexion();
        $stmt = $db->prepare("SELECT * FROM formation WHERE titre LIKE ?");
        $stmt->execute(['%' . $titre . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>
