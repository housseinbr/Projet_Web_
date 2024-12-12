<?php
require_once '../../Controller/ReservationController.php';

// Get reservation ID from GET parameter
$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID de réservation non spécifié.";
    exit();
}

$controller = new ReservationController();
$reservation = $controller->getReservationDetails($id);

if (!$reservation) {
    echo "Réservation introuvable.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleUpdateReservation($id);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Réservation</title>
    <script>
        function validateForm() {
            const email = document.getElementById("email_nutritioniste").value;
            const date = document.getElementById("date_reservation").value;

            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert("Veuillez entrer un email valide.");
                return false;
            }

            if (new Date(date) < new Date()) {
                alert("La date de réservation doit être une date future.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h1>Modifier Réservation</h1>
    <form method="POST" onsubmit="return validateForm()">
        <label for="nom_client">Nom du Client :</label>
        <input type="text" id="nom_client" name="nom_client" value="<?= htmlspecialchars($reservation['nom_client']); ?>" required><br>

        <label for="email_nutritioniste">Email Nutritionniste :</label>
        <input type="email" id="email_nutritioniste" name="email_nutritioniste" value="<?= htmlspecialchars($reservation['email_nutritioniste']); ?>" required><br>

        <label for="date_reservation">Date de Réservation :</label>
        <input type="date" id="date_reservation" name="date_reservation" value="<?= htmlspecialchars($reservation['date_reservation']); ?>" required><br>

        <label for="heure_reservation">Heure de Réservation :</label>
        <input type="time" id="heure_reservation" name="heure_reservation" value="<?= htmlspecialchars($reservation['heure_reservation']); ?>" required><br>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
