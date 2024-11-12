<?php

function connection_a_la_base() {
    $connect = new mysqli('127.0.0.1', 'root', '', 'fitness_db');
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
    return $connect;
}

function enregistre_les_information() {
    $nom = trim($_POST['nom']);
    $pre = trim($_POST['pre']);
    $email = trim($_POST['email']);
    $tel = trim($_POST['tel']);
    $age = trim($_POST['age']);
    $gender = trim($_POST['genre']); 
    $pwd = trim($_POST['pwd']);
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

    $connect = connection_a_la_base();

    $stmt = $connect->prepare("SELECT * FROM user WHERE email = ? OR tel = ?");
    if (!$stmt) {
        die("Preparation failed: " . $connect->error);
    }
    
    $stmt->bind_param("ss", $email, $tel);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email ou téléphone existe déjà.";
        $stmt->close();
    } else {
        $stmt->close();

        $stmt = $connect->prepare("INSERT INTO user (nom, pre, pwd, age, gender, email, tel) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Preparation failed for `user` table: " . $connect->error);
        }
        
        $stmt->bind_param("sssssss", $nom, $pre, $hashed_password, $age, $gender, $email, $tel);  
        
        if ($stmt->execute()) {
            echo "Informations enregistrées avec succès.";
        } else {
            echo "Erreur lors de l'insertion dans la table `user`: " . $stmt->error;
        }
        $stmt->close(); 
    }

    $connect->close();
}

function connection_de_utilisateur() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = trim($_POST['email']);
        $pwd = trim($_POST['pwd']);

        $connect = connection_a_la_base();

        $stmt = $connect->prepare("SELECT pwd FROM user WHERE email = ?");
        if (!$stmt) {
            die("Preparation failed: " . $connect->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();
            if (password_verify($pwd, $hashed_password)) {
                $_SESSION['user_email'] = $email; 
                echo "Connexion réussie."; 
                // Redirect or take further action here
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Aucun utilisateur trouvé avec cet email."; 
        }

        $stmt->close();
        $connect->close();
    } else {
        echo "Méthode de requête non valide."; 
    }
}

?>
