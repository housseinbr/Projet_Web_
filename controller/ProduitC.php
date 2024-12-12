<?php

include_once __DIR__ .'../../config.php';
require_once '../../model/Produit.php';


class ProduitC
{
    public function listProduit()
    {
        $sql = "SELECT * FROM Produit";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    function deleteProduit($ide)
    {
        $sql = "DELETE FROM Produit WHERE idProduit = $ide";
        $db = config::getConnexion();
        $req = $db->prepare($sql);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    function addProduit($Produit)
    {
    $sql = "INSERT INTO Produit (idProduit, nom, description, categorie, prix, dispo, image) 
            VALUES (NULL, :nom, :description, :categorie, :prix, :dispo, :image)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'nom' => $Produit->getNom(),
            'description' => $Produit->getDescription(),
            'categorie' => $Produit->getCategorie(),
            'prix' => $Produit->getPrix(),
            'dispo' => $Produit->getDispo(),
            'image' => $Produit->getImage(),
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
    }

    public function updateProduit($Produit, $id)
    {
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE Produit SET 
                nom = :nom, 
                description = :description, 
                categorie = :categorie, 
                prix = :prix, 
                dispo = :dispo, 
                image = :image 
            WHERE idProduit = :idProduit'
        );

        $query->execute([
            'idProduit' => $id,
            'nom' => $Produit->getNom(),
            'description' => $Produit->getDescription(),
            'categorie' => $Produit->getCategorie(),
            'prix' => $Produit->getPrix(),
            'dispo' => $Produit->getDispo(),
            'image' => $Produit->getImage(),
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    }
    
    function showProduit($id)
    {
        $sql = "SELECT * from Produit where idProduit = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $Produit = $query->fetch();
            if ($Produit) {
                if ($Produit) {
                    // Construct the Product object
                    $product = new Produit(
                        $Produit['idProduit'],
                        $Produit['nom'],
                        $Produit['description'],
                        $Produit['categorie'],
                        $Produit['prix'],
                        $Produit['dispo'],
                        $Produit['image']
                    );
                    return $product;
                } else {
                    echo "No product found for ID: " . $id;
                    return null;
                }
                
                    
                                
            } else {
                echo "No product found for ID: " . $id;
            }
            
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    } 
    

    function recherchernom($nom){
        $sql="SELECT * From produit WHERE nom= '$nom' ";
        $db = config::getConnexion();
        try{
        $liste=$db->query($sql);
        return $liste;
        }
        catch (Exception $e){
          die('Erreur: '.$e->getMessage());
        }	
      }
      
      function rechercherdescription($description){
        $sql="SELECT * From produit WHERE description = '$description' ";
        $db = config::getConnexion();
        try{
        $liste=$db->query($sql);
        return $liste;
        }
        catch (Exception $e){
          die('Erreur: '.$e->getMessage());
        }	
      }

      function trierProduitAsc(){

        $sql="SELECT * FROM produit ORDER BY prix ASC";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function trierProduitDesc(){
              
      $sql="SELECT * FROM produit ORDER BY prix DESC";
      $db = config::getConnexion();
      try{
        $liste = $db->query($sql);
        return $liste;
      }
      catch (Exception $e){
        die('Erreur: '.$e->getMessage());
      }	
    }

}