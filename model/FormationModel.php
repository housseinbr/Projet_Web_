<?php

class Formation {
    private ?int $id_f;
    private ?string $titre;
    private ?string $disc;
    private ?string $duree;
    private ?string $nom_f;
    private ?string $pre_f;
    private ?string $email_f;

    // Constructor
    public function __construct(?int $id_f, ?string $titre, ?string $disc, ?string $duree, ?string $nom_f, ?string $pre_f, ?string $email_f) {
        $this->id_f = $id_f;
        $this->titre = $titre;
        $this->disc = $disc;
        $this->duree = $duree;
        $this->nom_f = $nom_f;
        $this->pre_f = $pre_f;
        $this->email_f = $email_f;
    }

    // Getters and Setters
    public function getIdF(): ?int {
        return $this->id_f;
    }

    public function setIdF(?int $id_f): void {
        $this->id_f = $id_f;
    }

    public function getTitre(): ?string {
        return $this->titre;
    }

    public function setTitre(?string $titre): void {
        $this->titre = $titre;
    }

    public function getDisc(): ?string {
        return $this->disc;
    }

    public function setDisc(?string $disc): void {
        $this->disc = $disc;
    }

    public function getDuree(): ?string {
        return $this->duree;
    }

    public function setDuree(?string $duree): void {
        $this->duree = $duree;
    }

    public function getNomF(): ?string {
        return $this->nom_f;
    }

    public function setNomF(?string $nom_f): void {
        $this->nom_f = $nom_f;
    }

    public function getPreF(): ?string {
        return $this->pre_f;
    }

    public function setPreF(?string $pre_f): void {
        $this->pre_f = $pre_f;
    }

    public function getEmailF(): ?string {
        return $this->email_f;
    }

    public function setEmailF(?string $email_f): void {
        $this->email_f = $email_f;
    }
}
