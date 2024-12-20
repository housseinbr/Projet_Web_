<?php 

class Regime {
    private ?int $id_r;        // ID du régime
    private ?int $id_u;        // ID de l'utilisateur
    private ?string $titre;    // Titre du régime
    private ?string $discription; // Description du régime
    private ?int $kcl;         // Nombre de calories (en entier)

    // Constructor
    public function __construct(?int $id_r, ?int $id_u, ?string $titre, ?string $discription, ?int $kcl) {
        $this->id_r = $id_r;
        $this->id_u = $id_u;
        $this->titre = $titre;
        $this->discription = $discription;
        $this->kcl = $kcl;
    }

    // Getters and Setters
    public function getIdR(): ?int {
        return $this->id_r;
    }

    public function setIdR(?int $id_r): void {
        $this->id_r = $id_r;
    }

    public function getIdU(): ?int {
        return $this->id_u;
    }

    public function setIdU(?int $id_u): void {
        $this->id_u = $id_u;
    }

    public function getTitre(): ?string {
        return $this->titre;
    }

    public function setTitre(?string $titre): void {
        $this->titre = $titre;
    }

    public function getDiscription(): ?string {
        return $this->discription;
    }

    public function setDiscription(?string $discription): void {
        $this->discription = $discription;
    }

    public function getKcl(): ?int {
        return $this->kcl;
    }

    public function setKcl(?int $kcl): void {
        $this->kcl = $kcl;
    }
}
?>
