<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'crud_operaions';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification si le paramètre 'nom' est passé dans l'URL
if (isset($_GET['nom']) && !empty($_GET['nom'])) {
    $nom = $_GET['nom'];

    // Récupérer les informations du nutritionniste en fonction du nom
    $sql = "SELECT * FROM nutrisonniste WHERE nom = :nom LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->execute();
    
    // Si un nutritionniste est trouvé
    if ($stmt->rowCount() > 0) {
        $nutritionniste = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Nutritionniste non trouvé.";
        exit();
    }
} else {
    echo "Le paramètre 'nom' est requis.";
    exit();
}

// Traitement de la mise à jour des informations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles données du formulaire
    $email = $_POST['email'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];

    // Requête SQL pour mettre à jour les informations
    $sqlUpdate = "UPDATE nutrisonniste SET email = :email, prenom = :prenom, telephone = :telephone WHERE nom = :nom";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    
    // Lier les paramètres et exécuter la requête
    $stmtUpdate->bindParam(':email', $email);
    $stmtUpdate->bindParam(':prenom', $prenom);
    $stmtUpdate->bindParam(':telephone', $telephone);
    $stmtUpdate->bindParam(':nom', $nom);
    
    if ($stmtUpdate->execute()) {
        echo "Nutritionniste mis à jour avec succès!";
    } else {
        echo "Erreur lors de la mise à jour du nutritionniste : " . implode(", ", $stmtUpdate->errorInfo());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Nutritionniste</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1 class="my-5 text-center">Modifier Nutritionniste</h1>
    <form action="update.php?nom=<?php echo htmlspecialchars($nom); ?>" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($nutritionniste['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" id="nom" value="<?php echo htmlspecialchars($nutritionniste['nom']); ?>" readonly required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" id="prenom" value="<?php echo htmlspecialchars($nutritionniste['prenom']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" id="telephone" value="<?php echo htmlspecialchars($nutritionniste['telephone']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

</body>
</html>

