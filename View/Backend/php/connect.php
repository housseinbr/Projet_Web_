<?php
session_start(); // Démarrer la session

include_once '../../../Controller/utilisateur_controller.php';
include_once '../../../Model/utilisateur_model.php';

$utilisateur_controller = new utilisateur_controller();
$message = "";
$checkIcon = "";
$redirectUrl = "../../../index.html";

if (isset($_POST["email"], $_POST["pwd"])) {
    if (!empty($_POST["email"]) && !empty($_POST["pwd"])) {
        $loginResult = $utilisateur_controller->login_user($_POST["email"], $_POST["pwd"]);
        
        if ($loginResult === true) {
            // Si connexion réussie, initialiser la session de l'utilisateur
            $_SESSION['user_email'] = $_POST["email"];
            $message = "Connexion réussie ! Vous allez être redirigé.";
            $checkIcon = "✔️";  
        } else {
            $message = "Erreur : Les informations sont incorrectes.";
            $checkIcon = "❌";  
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
        $checkIcon = "❌";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .checkmark {
            font-size: 50px;
            text-align: center;
            margin-top: 50px;
            display: none;
        }

        .message {
            text-align: center;
            font-size: 20px;
            margin-top: 20px;
        }

        .redirect-message {
            text-align: center;
            font-size: 18px;
            margin-top: 30px;
        }

        .redirect-message span {
            font-weight: bold;
        }
        .fadeIn {
            animation: fadeIn 2s forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="checkmark fadeIn">
            <?php echo $checkIcon; ?>
        </div>
        <div class="message fadeIn">
            <?php echo $message; ?>
        </div>
        <div class="redirect-message fadeIn">
            <span id="countdown">5</span> secondes restantes...
        </div>
    </div>

    <script>
        let countdown = document.getElementById("countdown");
        let seconds = 5;

        function updateCountdown() {
            if (seconds > 0) {
                countdown.textContent = seconds;
                seconds--;
            } else {
                window.location.href = "<?php echo $redirectUrl; ?>";
            }
        }

        setInterval(updateCountdown, 1000);

        setTimeout(function() {
            document.querySelector(".checkmark").style.display = "block";
        }, 500);  
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
