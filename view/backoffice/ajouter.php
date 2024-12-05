<?php

require_once 'C:/xampp/htdocs/frm4/controller/FormationController.php'; 
require_once 'C:/xampp/htdocs/frm4/controller/AccederFController.php'; 
require_once 'C:/xampp/htdocs/frm4/model/FormationModel.php';  

$error = "";

// create an instance of the controller
$formationController = new FormationController();

// Verifying if the form is submitted and checking if all fields are filled
if (
    isset($_POST["titre"], $_POST["disc"], $_POST["duree"], $_POST["nom_f"], $_POST["pre_f"], $_POST["email_f"])
) {
    if (
        !empty($_POST["titre"]) && !empty($_POST["disc"]) && !empty($_POST["duree"]) && !empty($_POST["nom_f"]) && !empty($_POST["pre_f"]) && !empty($_POST["email_f"])
    ) {
        // Create a new Formation instance (not FormationModel)
        $formation = new Formation(
            null, // Assuming ID will be auto-generated
            $_POST['titre'],
            $_POST['disc'],
            $_POST['duree'],
            $_POST['nom_f'],
            $_POST['pre_f'],
            $_POST['email_f']
        );

        // Call the controller's method to add the formation
        $formationController->addFormation($formation);

        // Redirect to the formation list page after successful insertion
        header('Location:list.php');
        exit;
    } else {
        // Set error message if any field is empty
        $error = "All fields are required.";
    }
}

$accederFController = new AccederFController();
$titers = $accederFController->listCategories();

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
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="../../index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href="../../index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
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
                                <h5 class="mb-0 font-weight-normal">yassin njeh</h5>
                                <span>Gold Member</span>
                            </div>
                        </div>
                        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
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
                            <li class="nav-item"> <a class="nav-link" href="list.php">Liste de formation </a></li>
                            <li class="nav-item"> <a class="nav-link" href="ajouter.php">Ajouter formation </a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <nav class="navbar p-0 fixed-top d-flex flex-row">
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
                                <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="titre">Titre de formation</label>
                                            <select class="form-control" id="titre" name="titre">
                                                <?php foreach ($titers as $categorie): ?>
                                                    <option value="<?= $categorie['categorie'] ?>" 
                                                        <?php if (isset($_POST['categorie']) && $_POST['categorie'] == $categorie['categorie']) echo 'selected'; ?>>
                                                        <?= htmlspecialchars($categorie['categorie']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span id="erreurTitre" class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="disc">Description</label>
                                            <textarea class="form-control" id="disc" name="disc" placeholder="Enter Description"><?= isset($_POST['disc']) ? htmlspecialchars($_POST['disc']) : '' ?></textarea>
                                            <span id="erreurDisc" class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="duree">Durée (heures)</label>
                                            <input type="number" class="form-control" id="duree" name="duree" placeholder="Enter Durée" value="<?= isset($_POST['duree']) ? htmlspecialchars($_POST['duree']) : '' ?>">
                                            <span id="erreurDuree" class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="nom_f">Nom du formateur</label>
                                            <input type="text" class="form-control" id="nom_f" name="nom_f" placeholder="Enter Nom du formateur" value="<?= isset($_POST['nom_f']) ? htmlspecialchars($_POST['nom_f']) : '' ?>">
                                            <span id="erreurNomF" class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="pre_f">Prénom du formateur</label>
                                            <input type="text" class="form-control" id="pre_f" name="pre_f" placeholder="Enter Prénom du formateur" value="<?= isset($_POST['pre_f']) ? htmlspecialchars($_POST['pre_f']) : '' ?>">
                                            <span id="erreurPreF" class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="email_f">Email du formateur</label>
                                            <input type="text" class="form-control" id="email_f" name="email_f" placeholder="Enter Email du formateur" value="<?= isset($_POST['email_f']) ? htmlspecialchars($_POST['email_f']) : '' ?>">
                                            <span id="erreurEmailF" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script>
    function validateForm() {
        var isValid = true;
        document.querySelectorAll('.text-danger').forEach(span => span.innerText = '');

        var titre = document.getElementById('titre').value.trim();
        var disc = document.getElementById('disc').value.trim();
        var duree = document.getElementById('duree').value.trim();
        var nom_f = document.getElementById('nom_f').value.trim();
        var pre_f = document.getElementById('pre_f').value.trim();
        var email_f = document.getElementById('email_f').value.trim();

        if (titre === '') {
            document.getElementById('erreurTitre').innerText = 'Titre is required.';
            isValid = false;
        }
        if (disc === '') {
            document.getElementById('erreurDisc').innerText = 'Description is required.';
            isValid = false;
        }
        if (duree === '') {
            document.getElementById('erreurDuree').innerText = 'Durée is required.';
            isValid = false;
        }
        if (nom_f === '') {
            document.getElementById('erreurNomF').innerText = 'Nom is required.';
            isValid = false;
        }
        if (pre_f === '') {
            document.getElementById('erreurPreF').innerText = 'Prénom is required.';
            isValid = false;
        }
        if (email_f === '') {
            document.getElementById('erreurEmailF').innerText = 'Email is required.';
            isValid = false;
        }
        return isValid;
    }
    </script>
</body>
</html>
