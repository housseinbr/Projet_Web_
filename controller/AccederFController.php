<?php
require_once 'C:/xampp/htdocs/frm4/config.php';  

class AccederFController
{
    // Méthode pour récupérer toutes les catégories
    public function listCategories()
    {
        $sql = "SELECT * FROM cate"; 
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode pour supprimer une catégorie
    public function deleteCategory($id_cat)
    {
        $sql = "DELETE FROM cate WHERE id_cat = :id_cat"; 
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_cat', $id_cat);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode pour ajouter une catégorie
    public function addCategory($categorie)
    {
        $sql = "INSERT INTO cate (categorie) VALUES (:categorie)";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'categorie' => $categorie
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Méthode pour mettre à jour une catégorie
    public function updateCategory($categorie, $id_cat)
    {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE cate SET 
                    categorie = :categorie
                WHERE id_cat = :id_cat'
            );

            $query->execute([
                'id_cat' => $id_cat,
                'categorie' => $categorie
            ]);

            // Vérification du succès de la mise à jour
            if ($query->rowCount() > 0) {
                echo "Category updated successfully.";
            } else {
                echo "No category was updated. Check the data.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }

    // Méthode pour afficher une catégorie par son ID
    public function showCategory($id_cat)
    {
        $sql = "SELECT * FROM cate WHERE id_cat = :id_cat"; 
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_cat', $id_cat);
            $query->execute();

            $category = $query->fetch();
            return $category;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
