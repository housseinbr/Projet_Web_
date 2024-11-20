<?php
include(__DIR__ . '/../../../config.php');
include(__DIR__ . '/../../../Controller/RegimeController.php');

$regimeController = new RegimeController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $regime = new Regime(
        $_POST['id_u'], 
        $_POST['titre'],
        $_POST['discription'],
        $_POST['kcl']
    );

    $regimeController->addRegime($regime);
    header('Location: affichage_regime.php'); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Régime</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #1e1e1e; 
            color: #f4f4f4; 
        }
        form {
            background-color: #2a2a2a; 
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #444; 
            color: #f4f4f4; 
        }
        input:focus, textarea:focus {
            border-color: #4CAF50; 
            outline: none;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50; 
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049; 
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
    <script>
        function validateForm() {
            let isValid = true;
            const id_u = document.getElementById('id_u').value;
            const titre = document.getElementById('titre').value.trim();
            const discription = document.getElementById('discription').value.trim();
            const kcl = document.getElementById('kcl').value;

            document.querySelectorAll('.error').forEach(e => e.textContent = '');

            if (id_u <= 0) {
                document.getElementById('id_u_error').textContent = "L'ID de l'utilisateur doit être positif.";
                isValid = false;
            }
            if (titre.length < 2) {
                document.getElementById('titre_error').textContent = "Le titre doit contenir au moins 2 caractères.";
                isValid = false;
            }
            if (discription.length < 10) {
                document.getElementById('discription_error').textContent = "La description doit contenir au moins 10 caractères.";
                isValid = false;
            }
            if (kcl <= 0) {
                document.getElementById('kcl_error').textContent = "Les calories doivent être un nombre positif.";
                isValid = false;
            }

            return isValid;
        }
    </script>
</head>
<body>

<h1>Ajouter un Régime</h1>

<form method="post" onsubmit="return validateForm()">
    <label for="id_u">ID de l'Utilisateur</label>
    <input type="number" id="id_u" name="id_u" required>
    <div id="id_u_error" class="error"></div>

    <label for="titre">Titre</label>
    <input type="text" id="titre" name="titre" required>
    <div id="titre_error" class="error"></div>

    <label for="discription">Description</label>
    <textarea id="discription" name="discription" required></textarea>
    <div id="discription_error" class="error"></div>

    <label for="kcl">Calories (kcal)</label>
    <input type="number" id="kcl" name="kcl" required>
    <div id="kcl_error" class="error"></div>

    <button type="submit">Ajouter</button>
</form>

</body>
</html>