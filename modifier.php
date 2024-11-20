<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__ . '/../../../config.php');
include(__DIR__ . '/../../../Controller/RegimeController.php');
include_once(__DIR__ . '/../../../Model/Regime.php');

$regimeController = new RegimeController();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $regime = $regimeController->showRegime($id);

    if (!$regime) {
        die('Régime non trouvé.');
    }
} else {
    die('ID de régime non spécifié.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $regimeToUpdate = new Regime(
        $regime['id_u'], 
        $_POST['titre'],
        $_POST['discription'],
        $_POST['kcl']
    );

    if ($regimeController->updateRegime($regimeToUpdate, $id)) {
        header('Location: affichage_regime.php'); 
        exit;
    } else {
        die('Erreur lors de la mise à jour du régime.');
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Régime</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #1e1e1e; 
            color: #f4f4f4; 
        }
        form {
            background: #2a2a2a; 
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #444; 
            border-radius: 4px;
            background-color: #444; 
            color: #f4f4f4;
        }
        input:focus, textarea:focus {
            border-color: #4CAF50; 
            outline: none;
        }
        button {
            background-color: #4CAF50; 
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049; 
        }
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
            const titre = document.getElementById('titre').value.trim();
            const discription = document.getElementById('discription').value.trim();
            const kcl = document.getElementById('kcl').value;

            
            document.querySelectorAll('.error').forEach(e => e.textContent = '');

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

<h1>Modifier le Régime</h1>

<form method="POST" action="" onsubmit="return validateForm()">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($regime['titre']); ?>" required>
    <div id="titre_error" class="error"></div>

    <label for="discription">Description :</label>
    <textarea id="discription" name="discription" required><?php echo htmlspecialchars($regime['discription']); ?></textarea>
    <div id="discription_error" class="error"></div>

    <label for="kcl">Calories :</label>
    <input type="number" id="kcl" name="kcl" value="<?php echo htmlspecialchars($regime['kcl']); ?>" required>
    <div id="kcl_error" class="error"></div>

    <button type="submit">Modifier</button>
</form>

</body>
</html>