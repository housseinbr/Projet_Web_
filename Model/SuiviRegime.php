<?php

class SuiviRegime {
    private ?int $id_s;
    private ?int $id_u;
    private ?float $poids;
    private ?float $imc;
    private ?string $cat;
    private ?string $motivation;

    // Constructor
    public function __construct(?int $id_s, ?int $id_u, ?float $poids, ?float $imc, ?string $cat, ?string $motivation) {
        $this->id_s = $id_s;
        $this->id_u = $id_u;
        $this->poids = $poids;
        $this->imc = $imc;
        $this->cat = $cat;
        $this->motivation = $motivation;
    }

    // Getters and Setters

    // Renamed to match controller's expectations
    public function getId(): ?int {
        return $this->id_s;  // Return the id_s as the ID
    }

    public function setIdS(?int $id_s): void {
        $this->id_s = $id_s;
    }

    public function getIdU(): ?int {
        return $this->id_u;
    }

    public function setIdU(?int $id_u): void {
        $this->id_u = $id_u;
    }

    public function getPoids(): ?float {
        return $this->poids;
    }

    public function setPoids(?float $poids): void {
        $this->poids = $poids;
    }

    public function getImc(): ?float {
        return $this->imc;
    }

    public function setImc(?float $imc): void {
        $this->imc = $imc;
    }

    public function getCat(): ?string {
        return $this->cat;
    }

    public function setCat(?string $cat): void {
        $this->cat = $cat;
    }

    public function getMotivation(): ?string {
        return $this->motivation;
    }

    public function setMotivation(?string $motivation): void {
        $this->motivation = $motivation;
    }
}

?>
