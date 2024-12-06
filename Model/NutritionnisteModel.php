<?php
// models/Nutritionniste.php

require_once __DIR__ . DIRECTORY_SEPARATOR . "../config.php";

class Nutritionniste {
    private ?int $id;
    private ?string $email;
    private ?string $nom;
    private ?string $prenom;
    private ?string $telephone;

    // Constructor
    public function __construct(?int $id = null, ?string $email = null, ?string $nom = null, ?string $prenom = null, ?string $telephone = null) {
        $this->id = $id;
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
    }

    // Getters and setters
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
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

    public function getTelephone(): ?string {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): void {
        $this->telephone = $telephone;
    }

    // Static methods
    public static function createReservation(string $email, string $nom, string $prenom, string $telephone): bool {
        global $conn;
        $sql = "INSERT INTO nutrisonniste (email, nom, prenom, telephone) VALUES (:email, :nom, :prenom, :telephone)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':telephone', $telephone);

        return $stmt->execute();
    }

    public static function getAllReservations(): array {
        global $conn;
        $sql = "SELECT * FROM nutrisonniste";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

