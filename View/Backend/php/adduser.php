<?php
include_once '../../../Controller/utilisateur_controller.php';
include_once '../../../Model/utilisateur_model.php';

$utilisateur_controller = new utilisateur_controller();
$message = "";
$checkIcon = "";
$redirectUrl = "../../../index.html"; 

if (isset($_POST["nom"], $_POST["pre"], $_POST["email"], $_POST["tel"], $_POST["age"], $_POST["genre"], $_POST["pwd"])) {
    if (!empty($_POST["nom"]) && !empty($_POST["pre"]) && !empty($_POST["email"]) && !empty($_POST["tel"]) && !empty($_POST["age"]) && !empty($_POST["genre"]) && !empty($_POST["pwd"])) {
        
        $hashedPwd = $_POST["pwd"];
        
        $utilisateur = new Utilisateur(
            null, 
            $_POST["nom"],
            $_POST["pre"],
            $_POST["email"],
            $_POST["tel"],
            (int)$_POST["age"],
            $_POST["genre"],
            $hashedPwd
        );
        
        $registrationResult = $utilisateur_controller->add_user($utilisateur);

        if ($registrationResult === true) {
            $message = "Inscription réussie ! Vous allez être redirigé.";
            $checkIcon = "✔️"; 
        } else {
            $message = "Erreur : L'email ou le numéro de téléphone existe déjà.";
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
    <title>Inscription</title>
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
