<?php

require_once 'C:/xampp/htdocs/frm5/controller/FormationController.php'; 

$error = "";

// create an instance of the controller
$formationController = new FormationController(); // Use a meaningful variable name

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required POST fields are set and not empty
    if (
        isset($_POST["titre"], $_POST["disc"], $_POST["duree"], $_POST["nom_f"], $_POST["pre_f"], $_POST["email_f"]) &&
        !empty($_POST["titre"]) && !empty($_POST["disc"]) && !empty($_POST["duree"]) && 
        !empty($_POST["nom_f"]) && !empty($_POST["pre_f"]) && !empty($_POST["email_f"])
    ) {
        // Sanitize inputs to prevent XSS
        $titre = htmlspecialchars($_POST['titre']);
        $disc = htmlspecialchars($_POST['disc']);
        $duree = htmlspecialchars($_POST['duree']);
        $nom_f = htmlspecialchars($_POST['nom_f']);
        $pre_f = htmlspecialchars($_POST['pre_f']);
        $email_f = filter_var($_POST['email_f'], FILTER_SANITIZE_EMAIL);

        // Create a new offer model instance
        $offer = new Formation(
            null, // Assuming ID is set in the POST data
            $titre,
            $disc,
            $duree,
            $nom_f,
            $pre_f,
            $email_f
        );
        
        // Update the offer in the database
        $formationController->updateFormation($offer, $_POST['id_f']);

        // Redirect after successful update
        header('Location: list.php');
        exit(); // Make sure no further code is executed after the redirect
    } else {
        $error = "Please fill all the fields correctly.";
    }
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
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
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
                                <h5 class="mb-0 font-weight-normal">yassn njeh</h5>
                                <span>Gold Member</span>
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
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-onepassword text-info"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-calendar-today text-success"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                                </div>
                            </a>
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
                        <span class="menu-title">formation</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="list.php">List formation</a></li>
                            <li class="nav-item"> <a class="nav-link" href="ajoute.php">Ajouter formation</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-format-line-spacing"></span>
                </button>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="container mt-5">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                if (isset($_POST['id_f'])) {
                                    $Formation = $formationController->showFormation($_POST['id_f']); // Use the correct variable
                                    ?>
                                    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="id_f">ID formation</label>
                                                <input type="text" class="form-control" id="id_f" name="id_f" value="<?php echo $_POST['id_f'] ?>" readonly />
                                            </div>

                                            <div class="form-group">
                                                <label for="titre">Titre de formation</label>
                                                <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $Formation['titre'] ?>" placeholder="Enter le titre" />
                                                <span id="erreurTitre" class="text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="disc">Description</label>
                                                <input type="text" class="form-control" id="disc" name="disc" value="<?php echo $Formation['disc'] ?>" placeholder="Enter Description" />
                                                <span id="erreurDescription" class="text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="duree">Durée de la formation</label>
                                                <input type="text" class="form-control" id="duree" name="duree" value="<?php echo $Formation['duree'] ?>" placeholder="Enter le durée" />
                                                <span id="erreurDuree" class="text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="nom_f">Nom du formateur</label>
                                                <input type="text" class="form-control" id="nom_f" name="nom_f" value="<?php echo $Formation['nom_f'] ?>" placeholder="Enter le nom du formateur" />
                                                <span id="erreurNomF" class="text-danger"></span>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="pre_f">Prénom du formateur</label>
                                                <input type="text" class="form-control" id="pre_f" name="pre_f" value="<?php echo $Formation['pre_f'] ?>" placeholder="Enter le prénom du formateur" />
                                                <span id="erreurPreF" class="text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="email_f">Email du formateur</label>
                                                <input type="text" class="form-control" id="email_f" name="email_f" value="<?php echo $Formation['email_f'] ?>" placeholder="Enter le email du formateur" />
                                                <span id="erreurEmailF" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                    <?php
                                }
                                ?>
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
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script>
        function validateForm() {
            var isValid = true;
            document.querySelectorAll('.text-danger').forEach(span => span.innerText = '');
            var titre = document.getElementById('titre').value.trim();
            var description = document.getElementById('disc').value.trim();
            var duree = document.getElementById('duree').value.trim();
            var nom_f = document.getElementById('nom_f').value.trim();
            var pre_f = document.getElementById('pre_f').value.trim();
            var email_f = document.getElementById('email_f').value.trim();

            if (!titre || titre.length < 2) {
                document.getElementById('erreurTitre').innerText = "Titre invalide (au moins 2 caractères).";
                isValid = false;
            }

            if (!description) {
                document.getElementById('erreurDescription').innerText = "Description invalide.";
                isValid = false;
            }

            if (!duree) {
                document.getElementById('erreurDuree').innerText = "Durée invalide.";
                isValid = false;
            }

            if (!nom_f || nom_f.length < 2) {
                document.getElementById('erreurNomF').innerText = "Nom invalide (au moins 2 caractères).";
                isValid = false;
            }

            if (!pre_f || pre_f.length < 2) {
                document.getElementById('erreurPreF').innerText = "Prénom invalide (au moins 2 caractères).";
                isValid = false;
            }

            if (!email_f || !/^\S+@\S+\.\S+$/.test(email_f)) {
                document.getElementById('erreurEmailF').innerText = "Email invalide.";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>

</html>