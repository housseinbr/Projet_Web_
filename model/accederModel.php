<?php
class Account { // Correction du nom de la classe de "Assignement" à "Assignment"
    private ?int $id_acc;
    private ?int $id_u;
    private ?int $id_eva;
   

    // Constructeur
    public function __construct(?int $id_acc, ?int $id_eva, ?int $id_u) {
        $this->id = $id_acc;
        $this->id_eva = $id_eva;
        $this->id_u = $id_u;
    }

    // Getters et Setters

    public function getIdAcc(): ?int { return $this->id_acc; }
    public function setIdAcc(?int $id_acc): void { $this->id_acc = $id_acc; }

    public function getIdEva(): ?int { return $this->id_eva; }
    public function setIdEva(?int $id_eva): void { $this->id_eva = $id_eva; }

    // Renommage de "getUserId" à "getStudentId" pour plus de clarté
    public function getIdU(): ?int { return $this->id_u; }
    public function setIdU(?int $id_u): void { $this->id_u = $id_u; }
}
?>