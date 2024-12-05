<?php
require_once 'C:/xampp/htdocs/frm4/controller/AccederFController.php'; 

$error = "";

// Create an instance of the controller
$accederFController = new AccederFController();

// Verifying if the form is submitted and checking if all fields are filled
if (isset($_POST["categorie"])) {
    if (!empty($_POST["categorie"])) {
        // Call the controller's method to add the category
        $accederFController->addCategory($_POST['categorie']);

        // Redirect to the category list page after successful insertion
        header('Location:listcat.php');
        exit;
    } else {
        // Set error message if any field is empty
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Add Category</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body>
    
    <div class="container-scroller">
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
                                <img class="img-xs rounded-circle" src="assets/images/faces/face28.jpeg" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal">Yassin Njeh</h5>
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
                        <span class="menu-icon"><i class="mdi mdi-laptop"></i></span>
                        <span class="menu-title">Categorie</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="listcat.php">Liste categorie</a></li>
                            <li class="nav-item"> <a class="nav-link" href="ajoutercat.php">Ajouter categorie</a></li>
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
                                <h4 class="card-title">Ajouter une catégorie</h4>
                                <form class="forms-sample" action="" method="POST" onsubmit="return validateForm()">
                                    <div class="form-group">
                                        <label for="categorie">Nom de la catégorie</label>
                                        <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Enter Nom de la catégorie">
                                        <span id="erreurCategorie" class="text-danger"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </form>
                                <?php if ($error) echo '<p class="text-danger mt-3">' . $error . '</p>'; ?>
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

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script>
    function validateForm() {
        var isValid = true;
        document.getElementById('erreurCategorie').innerText = '';

        var categorie = document.getElementById('categorie').value.trim();

        if (!categorie || categorie.length < 2) {
            document.getElementById('erreurCategorie').innerText = "Nom de la catégorie invalide (au moins 2 caractères).";
            isValid = false;
        }

        return isValid; // Si isValid est false, le formulaire ne sera pas soumis
    }
    </script>
</body>
</html>