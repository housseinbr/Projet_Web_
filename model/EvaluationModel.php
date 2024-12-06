<?php
/*
class Evaluation
{
    private ?int $id_eva;
    private ?float $poids;
    private ?float $kcl;
    private ?float $taille;
    private ?string $date_nais;
    private ?int $nb_repa;
    private ?int $niv_phy;
    private ?int $nb_h_dormir;
    private ?string $cat;

    public function __construct(
        ?int $id_eva, 
        ?float $poids, 
        ?float $kcl, 
        ?float $taille, 
        ?string $date_nais, 
        ?int $nb_repa, 
        ?int $niv_phy, 
        ?int $nb_h_dormir, 
        ?string $cat
    ) {
        $this->id_eva = $id_eva;
        $this->poids = $poids;
        $this->kcl = $kcl;
        $this->taille = $taille;
        $this->date_nais = $date_nais;
        $this->nb_repa = $nb_repa;
        $this->niv_phy = $niv_phy;
        $this->nb_h_dormir = $nb_h_dormir;
        $this->cat = $cat;
    }

    public function getIdEva(): ?int
    {
        return $this->id_eva;
    }

    public function setIdEva(?int $id_eva): void
    {
        $this->id_eva = $id_eva;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(?float $poids): void
    {
        $this->poids = $poids;
    }

    public function getKcl(): ?float
    {
        return $this->kcl;
    }

    public function setKcl(?float $kcl): void
    {
        $this->kcl = $kcl;
    }

    public function getTaille(): ?float
    {
        return $this->taille;
    }

    public function setTaille(?float $taille): void
    {
        $this->taille = $taille;
    }

    public function getDateNais(): ?string
    {
        return $this->date_nais;
    }

    public function setDateNais(?string $date_nais): void
    {
        $this->date_nais = $date_nais;
    }

    public function getNbRepa(): ?int
    {
        return $this->nb_repa;
    }

    public function setNbRepa(?int $nb_repa): void
    {
        $this->nb_repa = $nb_repa;
    }

    public function getNivPhy(): ?int
    {
        return $this->niv_phy;
    }

    public function setNivPhy(?int $niv_phy): void
    {
        $this->niv_phy = $niv_phy;
    }

    public function getNbHDormir(): ?int
    {
        return $this->nb_h_dormir;
    }

    public function setNbHDormir(?int $nb_h_dormir): void
    {
        $this->nb_h_dormir = $nb_h_dormir;
    }

    public function getCat(): ?string
    {
        return $this->cat;
    }

    public function setCat(?string $cat): void
    {
        $this->cat = $cat;
    }
}*/// Evaluation.php

class Evaluation
{
    private $poids;
    private $kcl;
    private $taille;
    private $date_nais;
    private $nb_repa;
    private $niv_phy;
    private $nb_h_dormir;
    private $cat;

    // Getters et setters pour chaque attribut
    public function getPoids() {
        return $this->poids;
    }

    public function setPoids($poids) {
        $this->poids = $poids;
    }

    public function getKcl() {
        return $this->kcl;
    }

    public function setKcl($kcl) {
        $this->kcl = $kcl;
    }

    public function getTaille() {
        return $this->taille;
    }

    public function setTaille($taille) {
        $this->taille = $taille;
    }

    public function getDateNais() {
        return $this->date_nais;
    }

    public function setDateNais($date_nais) {
        $this->date_nais = $date_nais;
    }

    public function getNbRepa() {
        return $this->nb_repa;
    }

    public function setNbRepa($nb_repa) {
        $this->nb_repa = $nb_repa;
    }

    public function getNivPhy() {
        return $this->niv_phy;
    }

    public function setNivPhy($niv_phy) {
        $this->niv_phy = $niv_phy;
    }

    public function getNbHDormir() {
        return $this->nb_h_dormir;
    }

    public function setNbHDormir($nb_h_dormir) {
        $this->nb_h_dormir = $nb_h_dormir;
    }

    public function getCat() {
        return $this->cat;
    }

    public function setCat($cat) {
        $this->cat = $cat;
    }
}


