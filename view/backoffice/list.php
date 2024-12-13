<?php
// Inclusion du contrôleur pour la gestion des formations
require_once 'C:/xampp/htdocs/frm5/controller/FormationController.php'; 

// Création d'une instance du contrôleur pour récupérer la liste des formations
$formationController = new FormationController();

// Vérification de la méthode de tri sélectionnée
if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'asc') {
        $formations = $formationController->sortByDureeAsc();
    } else if ($_GET['sort'] == 'desc') {
        $formations = $formationController->sortByDureeDesc();
    }
} else {
    // Afficher toutes les formations si aucun tri n'est demandé
    $formations = $formationController->listFormations();
}
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
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        .table td {
            white-space: nowrap; /* Ne pas couper les mots dans la cellule */
            overflow: hidden; /* Masquer le débordement */
            text-overflow: ellipsis; /* Ajouter les points de suspension (...) pour le débordement */
        }
        .table td.text-truncate {
            max-width: 200px; /* Ajustez cette valeur selon vos besoins */
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="../../index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href="../../index.html"><img class="img-xs" src="assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle " src="assets/images/faces/face28.jpeg" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal"> yassin njeh</h5>
                                <span>Gold Member</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">Formation</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="list.php">List formation</a></li>
                            <li class="nav-item"> <a class="nav-link" href="ajouter.php">Ajouter formation</a></li>
                            <li class="nav-item"> <a class="nav-link" href="listcat.php">Liste categorie</a></li>
                            <li class="nav-item"> <a class="nav-link" href="ajoutercat.php">Ajouter categorie</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-body">
                                <!-- Formulaire pour trier les formations -->
                                <form action="" method="get" class="d-flex justify-content-around mb-3">
                                    <button type="submit" name="sort" value="asc" class="btn btn-secondary">Trier par durée croissante</button>
                                    <button type="submit" name="sort" value="desc" class="btn btn-secondary">Trier par durée décroissante</button>
                                </form>

                                <form method="POST" action="recherchertitre.php" class="d-flex justify-content-around mb-3">
                                    <select name="choix" id="choix" class="form-select mr-1">
                                        <option selected>Open this select menu</option>
                                        <option>titre formation</option>
                                    </select>
                                    <input type="text" name="Search" class="form-control mr-1" placeholder="Search">
                                    <input type="submit" class="btn btn-dark"></i>
                                </form>

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Titre</th>
                                            <th>Description</th>
                                            <th>Durée</th>
                                            <th>Nom du formateur</th>
                                            <th>Prénom du formateur</th>
                                            <th>Email du formateur</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($formations as $Formation) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($Formation['id_f'], ENT_QUOTES) . "</td>";
                                            echo "<td>" . htmlspecialchars($Formation['titre'], ENT_QUOTES) . "</td>";
                                            echo "<td class='text-truncate'>" . htmlspecialchars($Formation['disc'], ENT_QUOTES) . "</td>";
                                            echo "<td>" . htmlspecialchars($Formation['duree'], ENT_QUOTES) . " H </td>";
                                            echo "<td>" . htmlspecialchars($Formation['nom_f'], ENT_QUOTES) . "</td>";
                                            echo "<td>" . htmlspecialchars($Formation['pre_f'], ENT_QUOTES) . "</td>";
                                            echo "<td>" . htmlspecialchars($Formation['email_f'], ENT_QUOTES) . "</td>";
                                            echo "<td>
                                                    <form method='POST' action='modifier.php' style='display:inline;'>
                                                        <input type='submit' name='update' value='Update' class='btn btn-primary'>
                                                        <input type='hidden' value='" . htmlspecialchars($Formation['id_f'], ENT_QUOTES) . "' name='id_f'>
                                                    </form>
                                                    <a href='supprimer.php?id=" . htmlspecialchars($Formation['id_f'], ENT_QUOTES) . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this item?\")'>Delete</a>
                                                  </td>";    
                                            echo '</tr>';   
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
                        </div>
                    </footer>
                    <!-- End Footer -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- inject:js -->
        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/hoverable-collapse.js"></script>
        <script src="assets/js/misc.js"></script>
        <script src="assets/js/settings.js"></script>
        <script src="assets/js/todolist.js"></script>
        <!-- endinject -->
    </body>
</html>