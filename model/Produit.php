<?php
class Produit
{
    private $idProduit = null;
    private $nom = null;
    private $description = null;
    private $categorie = null;
    private $prix = null;
    private $dispo = null;
    private $image = null;

    public function __construct($id = null, $nom, $description, $categorie, $prix, $dispo, $image)
    {
        $this->idProduit = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->categorie = $categorie;
        $this->prix = $prix;
        $this->dispo = $dispo;
        $this->image = $image;
    }

    public function getIdProduit()
    {
        return $this->idProduit;
    }

    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    public function getDispo()
    {
        return $this->dispo;
    }

    public function setDispo($dispo)
    {
        $this->dispo = $dispo;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function display() {
        echo "ID Produit: " . $this->idProduit . "<br>";
        echo "Nom: " . $this->nom . "<br>";
        echo "Description: " . $this->description . "<br>";
        echo "Categorie: " . $this->categorie . "<br>";
        echo "Prix: " . $this->prix . "<br>";
        echo "Disponibilite: " . ($this->dispo ? 'Yes' : 'No') . "<br>";
        echo "Image: " . $this->image . "<br>";
    }
}
?>