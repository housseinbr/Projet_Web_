<?php

class Cate {
    private ?int $id_cat;      // ID de la catégorie
    private ?string $categorie; // Nom de la catégorie

    // Constructeur
    public function __construct(?int $id_cat = null, ?string $categorie = null) {
        $this->id_cat = $id_cat;
        $this->categorie = $categorie;
    }

    // Getters et Setters

    public function getIdCat(): ?int {
        return $this->id_cat;
    }

    public function setIdCat(?int $id_cat): void {
        $this->id_cat = $id_cat;
    }

    public function getCategorie(): ?string {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): void {
        $this->categorie = $categorie;
    }
}

?>
