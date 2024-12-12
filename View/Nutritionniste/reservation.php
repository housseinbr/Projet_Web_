<?php
// app/views/reservation.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Nutritionniste</title>
    <style>
        /* Ajouter ici votre style CSS */
    </style>
</head>
<body>
    <div class="container">
        <h2>Réservation Nutritionniste</h2>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="text" name="telephone" placeholder="Téléphone" required>
            <button type="submit">Enregistrer</button>
        </form>
    </div>
</body>
</html>
