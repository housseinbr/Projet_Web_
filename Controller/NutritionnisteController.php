<?php
require_once __DIR__ . "/../Model/NutritionnisteModel.php";

class NutritionnisteController {
    // Create a reservation
    public function createReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $telephone = $_POST['telephone'];

            return Nutritionniste::createReservation($email, $nom, $prenom, $telephone);
        }
        return false;
    }

    // Retrieve all reservations
    public function showReservations() {
        return Nutritionniste::getAllReservations();
    }
}

