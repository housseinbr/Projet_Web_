<?php
require_once __DIR__ . '/../config.php';

class Reservation {
    private ?int $id;
    private ?string $nom_client;
    private ?string $email_nutritioniste;
    private ?string $date_reservation;
    private ?string $heure_reservation;

    // Constructor
    public function __construct(
        ?int $id = null,
        ?string $nom_client = null,
        ?string $email_nutritioniste = null,
        ?string $date_reservation = null,
        ?string $heure_reservation = null
    ) {
        $this->id = $id;
        $this->nom_client = $nom_client;
        $this->email_nutritioniste = $email_nutritioniste;
        $this->date_reservation = $date_reservation;
        $this->heure_reservation = $heure_reservation;
    }

    // Getters and Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getNomClient(): ?string {
        return $this->nom_client;
    }

    public function setNomClient(?string $nom_client): void {
        $this->nom_client = $nom_client;
    }

    public function getEmailNutritioniste(): ?string {
        return $this->email_nutritioniste;
    }

    public function setEmailNutritioniste(?string $email_nutritioniste): void {
        $this->email_nutritioniste = $email_nutritioniste;
    }

    public function getDateReservation(): ?string {
        return $this->date_reservation;
    }

    public function setDateReservation(?string $date_reservation): void {
        $this->date_reservation = $date_reservation;
    }

    public function getHeureReservation(): ?string {
        return $this->heure_reservation;
    }

    public function setHeureReservation(?string $heure_reservation): void {
        $this->heure_reservation = $heure_reservation;
    }

    // Static Methods for Database Operations
    public static function createReservation(string $nom_client, string $email_nutritioniste, string $date_reservation, string $heure_reservation, string $image_path): bool {
        $pdo = Config::getConnexion(); // Use Config for database connection
        $sql = "INSERT INTO reservation (nom_client, email_nutritioniste, date_reservation, heure_reservation, image_path) 
                VALUES (:nom_client, :email_nutritioniste, :date_reservation, :heure_reservation, :image_path)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':nom_client', $nom_client);
        $stmt->bindParam(':email_nutritioniste', $email_nutritioniste);
        $stmt->bindParam(':date_reservation', $date_reservation);
        $stmt->bindParam(':heure_reservation', $heure_reservation);
        $stmt->bindParam(':image_path', $image_path);

        return $stmt->execute();
    }

    public static function getAllReservations(): array {
        $pdo = Config::getConnexion(); // Use Config for database connection
        $sql = "SELECT * FROM reservation";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getReservationById(int $id): ?array {
        $pdo = Config::getConnexion(); // Use Config for database connection
        $sql = "SELECT * FROM reservation WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public static function updateReservation(int $id, string $nom_client, string $email_nutritioniste, string $date_reservation, string $heure_reservation): bool {
        $pdo = Config::getConnexion(); // Use Config for database connection
        $sql = "UPDATE reservation 
                SET nom_client = :nom_client, email_nutritioniste = :email_nutritioniste, date_reservation = :date_reservation, heure_reservation = :heure_reservation 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom_client', $nom_client);
        $stmt->bindParam(':email_nutritioniste', $email_nutritioniste);
        $stmt->bindParam(':date_reservation', $date_reservation);
        $stmt->bindParam(':heure_reservation', $heure_reservation);

        return $stmt->execute();
    }

    public static function deleteReservation(int $id): bool {
        $pdo = Config::getConnexion(); // Use Config for database connection
        $sql = "DELETE FROM reservation WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
