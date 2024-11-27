<?php
// model/ReservationModel.php

class ReservationModel {
    private $pdo;

    public function __construct() {
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "crud_operaions";

        try {
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            die();
        }
    }

    // Méthode pour créer une réservation
    public function createReservation($nom_client, $email_nutritioniste, $date_reservation, $heure_reservation) {
        $sql = "INSERT INTO reservation (nom_client, email_nutritioniste, date_reservation, heure_reservation) 
                VALUES (:nom_client, :email_nutritioniste, :date_reservation, :heure_reservation)";
        $stmt = $this->pdo->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':nom_client', $nom_client);
        $stmt->bindParam(':email_nutritioniste', $email_nutritioniste);
        $stmt->bindParam(':date_reservation', $date_reservation);
        $stmt->bindParam(':heure_reservation', $heure_reservation);

        // Exécution de la requête
        return $stmt->execute();
    }
}
