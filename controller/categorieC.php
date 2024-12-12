<?php

include_once __DIR__ .'../../config.php';

class CategorieC
{
    public function listCategorie()
    {
        $sql = "SELECT * FROM Categorie";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteCategorie($id)
    {
        $sql = "DELETE FROM Categorie WHERE id = $id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    function addCategorie($categorie)
    {
        $sql = "INSERT INTO categorie (id, categorie, description) 
                VALUES (NULL, :categorie, :description)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'categorie' => $categorie->getNom(),
                'description' => $categorie->getDescription(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function updateCategorie($categorie, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE Categorie SET 
                    categorie = :categorie, 
                    description = :description
                WHERE id = :id'
            );

            $query->execute([
                'id' => $id,
                'categorie' => $categorie->getNom(),
                'description' => $categorie->getDescription(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function showCategorie($id)
    {
        $sql = "SELECT * from Categorie where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $categorie = $query->fetch();
            return $categorie;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>