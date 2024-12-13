<?php
require_once 'C:/xampp/htdocs/frm5/controller/AccederFController.php'; 

$error = "";
$category = ['id_cat' => '', 'categorie' => ''];

// Create an instance of the access controller
$accessController = new AccederFController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["id_cat"], $_POST["categorie"]) &&
        !empty($_POST["id_cat"]) && !empty($_POST["categorie"])
    ) {
        $id_cat = htmlspecialchars($_POST['id_cat']); 
        $categorie = htmlspecialchars($_POST['categorie']);

        // Update the category in the database
        $accessController->updateCategory($categorie, $id_cat); 

        header('Location: listcat.php'); 
        exit(); 
    } else {
        $error = "Please fill all the fields correctly.";
    }
}

if (isset($_GET['id_cat'])) {
    $id_cat = htmlspecialchars($_GET['id_cat']);
    $category = $accessController->showCategory($id_cat);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion des Catégories</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
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
                                <img class="img-xs rounded-circle" src="assets/images/faces/face28.jpeg" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal">yassn njeh</h5>
                                <span>Gold Member</span>
                            </div>
                        </div>
                        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list">
                            <!-- Dropdown contents -->
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">categorie</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="listcat.php">List categorie</a></li>
                            <li class="nav-item"><a class="nav-link" href="ajoutercat.php">Ajouter categorie</a></li>
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
                                <h4 class="card-title">Modifier une Catégorie</h4>
                                <?php if ($error): ?>
                                    <div class="alert alert-danger"><?php echo $error; ?></div>
                                <?php endif; ?>

                                <form action="" method="POST" onsubmit="return validateForm()">
                                    <input type="hidden" name="id_cat" value="<?php echo htmlspecialchars($category['id_cat']); ?>" />
                                    
                                    <div class="form-group">
                                        <label for="categorie">Nouvelle catégorie</label>
                                        <input type="text" class="form-control" id="categorie" name="categorie" value="<?php echo htmlspecialchars($category['categorie']); ?>" placeholder="Entrez une nouvelle catégorie" required />
                                        <span id="erreurCategorie" class="text-danger"></span>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
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

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script>
        function validateForm() {
            var isValid = true;
            document.querySelectorAll('.text-danger').forEach(span => span.innerText = '');
            
            var categorie = document.getElementById('categorie').value.trim();
            if (!categorie || categorie.length < 2) {
                document.getElementById('erreurCategorie').innerText = "Catégorie invalide (au moins 2 caractères).";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>