<?php
include_once(__DIR__ . '/../config.php');
include_once(__DIR__ . '/../Model/utilisateur_model.php');

class utilisateur_controller {

    public function checkEmailOrPhone($email, $tel) {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT * FROM utilisateur WHERE email = :email OR tel = :tel');
        $query->execute([
            'email' => $email,
            'tel' => $tel
        ]);
        return $query->fetch() !== false; 
    }

    public function add_user($utilisateur) {
        try {
            $db = config::getConnexion();
    
            if ($this->checkEmailOrPhone($utilisateur->getEmail(), $utilisateur->getTel())) {
                return false;
            }
    
            $query = $db->prepare('INSERT INTO utilisateur (nom, pre, email, tel, age, genre, pwd) VALUES (:nom, :prenom, :email, :tel, :age, :genre, :pwd)');
            $query->execute([
                'nom' => $utilisateur->getNom(),
                'prenom' => $utilisateur->getPrenom(),
                'email' => $utilisateur->getEmail(),
                'tel' => $utilisateur->getTel(),
                'age' => $utilisateur->getAge(),
                'genre' => $utilisateur->getGenre(),
                'pwd' => $utilisateur->getPwd(),
            ]);
    
            $userId = $db->lastInsertId();  
            $this->clear_and_add_user_to_cu($userId);  
            return true; 
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    private function clear_and_add_user_to_cu($userId) {
        $db = config::getConnexion();

        $query = $db->prepare('DELETE FROM c_u');
        $query->execute();

        $query = $db->prepare('INSERT INTO c_u (id_u) VALUES (:id_u)');
        $query->execute([
            'id_u' => $userId
        ]);
    }

    public function login_user($email, $pwd) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM utilisateur WHERE email = :email');
            $query->execute(['email' => $email]);
            $user = $query->fetch();
    
            if ($user) {
                $storedPassword = $user['pwd']; 
                if ($pwd === $storedPassword) {
                    $this->clear_and_add_user_to_cu($user['id_u']);
                    $_SESSION['user_id'] = $user['id_u'];  
                    $_SESSION['user_name'] = $user['nom'];
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function is_logged_in() {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT * FROM c_u LIMIT 1');
        $query->execute();
        return $query->fetch() !== false; 
    }

    public function logout_user() {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('DELETE FROM c_u');
            $query->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function logout_user_button() {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('DELETE FROM c_u');
            $query->execute();

            session_unset(); 
            session_destroy(); 
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function affichier_user_dashbored() {
        try {
            $db = config::getConnexion();  
            $query = $db->prepare('SELECT * FROM utilisateur');
            $query->execute();
            $users = $query->fetchAll();
            return $users;  
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function displayDashboard() {
        $users = $this->affichier_user_dashbored();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Corona Admin</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="assets/images/favicon.png" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    </head>
    <body>
        <div class="container-scroller">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
                </div>
                <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                    <div class="profile-pic">
                        <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="assets/images/faces/face15.jpg" alt="">
                        <span class="count bg-success"></span>
                        </div>
                        <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">Houssein Barbirou</h5>
                        <span>Admin General</span>
                        </div>
                    </div>
                    <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                        <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                            <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    
                    </div>
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="user_view.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-contacts"></i>
                    </span>
                    <span class="menu-title">Users</span>
                    </a>
                </li>
                
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_navbar.html -->
                <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav navbar-nav-right">
                    </ul>
                        
                </div>
                </nav>
                <br>
                <br>
                <!-- Conteneur principal de la page -->
                <div class="content-wrapper">
                <!-- Table for managing users -->
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <br>
                                    <br>Liste des utilisateurs</h4>
                                    <div class="d-flex justify-content-between">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                                        <select id="sortSelect" class="form-control">
                                            <option value="id_u">ID</option>
                                            <option value="nom">Nom</option>
                                            <option value="pre">Prénom</option>
                                            <option value="email">Email</option>
                                            <option value="age">Âge</option>
                                            <option value="genre">Genre</option>
                                        </select>
                                        <button class="btn btn-primary" onclick="sortTable()">Trier</button>
                                    </div>
                                <br>
                                <div class="table-responsive">
                                    <table class="table" id="userTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Email</th>
                                                <th>Téléphone</th>
                                                <th>Âge</th>
                                                <th>Genre</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($users) && is_array($users)): ?>
                                                <?php foreach ($users as $user): ?>
                                                    <tr id="user-<?php echo $user['id_u']; ?>">
                                                    <td data-sort="id_u"><?php echo htmlspecialchars($user['id_u']); ?></td>
                                                    <td data-sort="nom"><?php echo htmlspecialchars($user['nom']); ?></td>
                                                    <td data-sort="pre"><?php echo htmlspecialchars($user['pre']); ?></td>
                                                    <td data-sort="email"><?php echo htmlspecialchars($user['email']); ?></td>
                                                    <td data-sort="tel"><?php echo htmlspecialchars($user['tel']); ?></td>
                                                    <td data-sort="age"><?php echo htmlspecialchars($user['age']); ?></td>
                                                    <td data-sort="genre" class="badge <?php echo ($user['genre'] == 1) ? 'badge-outline-success' : 'badge-outline-danger'; ?>">
                                                        <?php echo htmlspecialchars(($user['genre'] == 1) ? "Homme" : "Femme"); ?>
                                                    </td>
    
                                                        <td>
                                                            <button onclick="deleteUser(<?php echo $user['id_u']; ?>)" class="btn btn-danger btn-sm">Supprimer</button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr><td colspan="8">Aucun utilisateur trouvé.</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
        function deleteUser(userId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "../../php/delete_user.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const response = xhr.responseText.trim();
                        if (response === 'success') {
                            document.getElementById('user-' + userId).remove();
                            alert('Utilisateur supprimé avec succès');
                        } else {
                            alert('Erreur lors de la suppression de l\'utilisateur : ' + response);
                        }
                    }
                };
                xhr.send("user_id=" + userId);
            }
        }
    </script>

    <br>
    <div class="row">




    <?php
// Include the config.php file to get the database connection
//include_once '../config.php'; // Adjust the path to where config.php is located

// Initialize gender counts
$maleCount = 0;
$femaleCount = 0;

try {
    // Get the database connection
    $pdo = config::getConnexion();

    // Query to count the number of males and females
    $sql = "SELECT genre, COUNT(*) as count FROM utilisateur GROUP BY genre";
    $stmt = $pdo->query($sql);
    
    // Fetch the results and assign to variables
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['genre'] == 1) {
            $maleCount = $row['count']; // Male count (genre 1)
        } elseif ($row['genre'] == 2) {
            $femaleCount = $row['count']; // Female count (genre 2)
        }
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

<!-- Pie chart for gender distribution -->
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Répartition des genres</h4>
            <canvas id="pieChart" style="height:250px; width:100%;"></canvas>
        </div>
    </div>
</div>

<script>
    const maleCount = <?php echo $maleCount; ?>;
    const femaleCount = <?php echo $femaleCount; ?>;

    const genderData = {
        labels: ['Homme', 'Femme'],
        datasets: [{
            data: [maleCount, femaleCount],
            backgroundColor: ['#36A2EB', '#FF6384']
        }]
    };

    const ctx = document.getElementById('pieChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: genderData
    });
</script>

</div>
    
                <script>
                    // Search function
                    document.getElementById('searchInput').addEventListener('input', function () {
                        const searchValue = this.value.toLowerCase();
                        const rows = document.querySelectorAll('#userTable tbody tr');
                        rows.forEach(row => {
                            const cells = row.querySelectorAll('td');
                            let found = false;
                            cells.forEach(cell => {
                                if (cell.textContent.toLowerCase().includes(searchValue)) {
                                    found = true;
                                }
                            });
                            row.style.display = found ? '' : 'none';
                        });
                    });
    
                    // Fonction de tri
                    function sortTable() {
    const table = document.getElementById('userTable');
    const rows = Array.from(table.rows).slice(1); // Exclure l'en-tête
    const sortBy = document.getElementById('sortSelect').value;

    // Réinitialiser la visibilité des lignes avant de trier
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let found = false;
        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(searchValue)) {
                found = true;
            }
        });
        row.style.display = found ? '' : 'none';
    });

    // Tri des lignes
    rows.sort((rowA, rowB) => {
        const cellA = rowA.querySelector(`td[data-sort="${sortBy}"]`).textContent.trim();
        const cellB = rowB.querySelector(`td[data-sort="${sortBy}"]`).textContent.trim();

        if (sortBy === 'age') { // Si on trie par âge, on le traite comme un nombre
            return parseInt(cellA) - parseInt(cellB);
        }
        return cellA.localeCompare(cellB); // Par défaut, on compare en texte
    });

    rows.forEach(row => table.appendChild(row)); // Réordonner les lignes
}


    
                    function deleteUser(userId) {
                        if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                            const xhr = new XMLHttpRequest();
                            xhr.open("POST", "../../php/delete_user.php", true);
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    const response = xhr.responseText.trim();
                                    if (response === 'success') {
                                        alert('Utilisateur supprimé avec succès');
                                        document.getElementById('user-' + userId).remove();
                                    } else {
                                        alert('Erreur lors de la suppression de l\'utilisateur');
                                    }
                                }
                            };
                            xhr.send("id_u=" + userId);
                        }
                    }
                </script>
            </div>
        </div>
    </body>
    </html>
    <?php
    }

}
?>
