<?php
require_once 'C:/xampp/htdocs/reservation_nutrisionniste/crud_reservation/config.php';
use App\Config\Config;

class Reservation {
    private ?int $id;
    private ?string $nom_client;
    private ?string $email;
    private ?string $date_reservation;
    private ?string $heure_reservation;

    // Constructor
    public function __construct(
        ?int $id = null,
        ?string $nom_client = null,
        ?string $email = null,
        ?string $date_reservation = null,
        ?string $heure_reservation = null
    ) {
        $this->id = $id;
        $this->nom_client = $nom_client;
        $this->email = $email;
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
        return $this->email;
    }

    public function setEmailNutritioniste(?string $email): void {
        $this->email = $email;
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

}
