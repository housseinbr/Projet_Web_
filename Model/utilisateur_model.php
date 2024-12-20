<?php

class Utilisateur {
    private ?int $id;
    private ?string $nom;
    private ?string $prenom;
    private ?string $email;
    private ?string $tel;
    private ?int $age;
    private ?string $genre;
    private ?string $pwd;


    public function __construct(?int $id = null, ?string $nom = null, ?string $prenom = null, ?string $email = null, ?string $tel = null, ?int $age = null, ?string $genre = null, ?string $pwd = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->tel = $tel;
        $this->age = $age;
        $this->genre = $genre;
        $this->pwd = $pwd;
    }


    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(?string $nom): void {
        $this->nom = $nom;
    }

    public function getPrenom(): ?string {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): void {
        $this->prenom = $prenom;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function getTel(): ?string {
        return $this->tel;
    }

    public function setTel(?string $tel): void {
        $this->tel = $tel;
    }

    public function getAge(): ?int {
        return $this->age;
    }

    public function setAge(?int $age): void {
        $this->age = $age;
    }

    public function getGenre(): ?string {
        return $this->genre;
    }

    public function setGenre(?string $genre): void {
        $this->genre = $genre;
    }

    public function getPwd(): ?string {
        return $this->pwd;
    }

    public function setPwd(?string $pwd): void {
        $this->pwd = $pwd;
    }

    
}

?>
