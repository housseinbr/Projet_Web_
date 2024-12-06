<?php
require_once('C:/xampp/htdocs/yoor/config/config.php');
require_once('C:/xampp/htdocs/yoor/controller/controller.php');
require_once('C:/xampp/htdocs/yoor/controller/accederController.php');

// Création du contrôleur
$controller = new EvaluationController();
$accederController = new accederController();


// Initialiser la variable
$evaluation = null;

// Vérifier si on a des données de mise à jour
if (isset($_POST['id']) && isset($_POST['poids'])) {
    $id = $_POST['id'];
    $data = [
        'poids' => $_POST['poids'],
        'kcl' => $_POST['kcl'],
        'taille' => $_POST['taille'],
        'date_nais' => $_POST['date_nais'],
        'nb_repa' => $_POST['nb_repa'],
        'niv_phy' => $_POST['niv_phy'],
        'nb_h_dormir' => $_POST['nb_h_dormir'],
        'cat' => $_POST['cat']
    ];
    $controller->updateEvaluation($data, $id);

    // Redirection après mise à jour
    header("Location: http://localhost/yoor/view/Backoffice/dashboard/template/pages/forms/basic_elements.php");
    exit;
} elseif (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $controller->deleteEvaluation($id);

    // Redirection après suppression
    header("Location: http://localhost/yoor/view/Backoffice/dashboard/template/pages/forms/basic_elements.php");
    exit;
} elseif (isset($_POST['id'])) {
    // Charger l'évaluation
    $id = $_POST['id'];
    $evaluation = $controller->showEvaluation($id);
}



// Supprimer un compte
if (isset($_GET['delete_account'])) {
  $id = filter_input(INPUT_GET, 'delete_account', FILTER_VALIDATE_INT);

  if ($id) {
      $accederController->deleteAccount($id);
      $_SESSION['message'] = "Account deleted successfully!";
  } else {
      $_SESSION['error'] = "Invalid account ID.";
  }
  header("Location: http://localhost/yoor/view/Backoffice/dashboard/template/pages/forms/basic_elements.php");
  exit();
}

// Vérifier si les données de mise à jour ont été envoyées via POST
if (isset($_POST['account_id']) && isset($_POST['user_id']) && isset($_POST['evaluation_id'])) {
    // Récupérer les données envoyées via POST
    $accountId = $_POST['account_id'];
    $data = [
        'id_u' => $_POST['user_id'],          // ID de l'utilisateur
        'id_eva' => $_POST['evaluation_id'],  // ID de l'évaluation
    ];

    // Appeler le contrôleur pour mettre à jour l'entrée
    $accederController->updateAccount($data, $accountId);

    // Redirection après la mise à jour
    header("Location: http://localhost/yoor/view/Backoffice/dashboard/template/pages/forms/basic_elements.php");
    exit;
} elseif (isset($_POST['id'])) {
    // Charger le compte à modifier
    $id = $_POST['id'];
    $account = $accederController->showAccount($id); // Correction de l'appel à la méthode pour charger le compte
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
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
    <link rel="stylesheet" href="stylec.css">

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="../../index.html"><img src="../../assets/images/logo.svg" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="../../assets/images/faces/face15.jpg" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
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
                      <i class="mdi mdi-onepassword  text-info"></i>
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
            <a class="nav-link" href="../../index.html">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Basic UI Elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/dropdowns.html">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/typography.html">Typography</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../../pages/forms/basic_elements.php">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">evaluation</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../../pages/tables/basic-table.html">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
              <span class="menu-title">Tables</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../../pages/charts/chartjs.html">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
              <span class="menu-title">Charts</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="../../pages/icons/mdi.html">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Icons</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-security"></i>
              </span>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../pages/samples/blank-page.html"> Blank Page </a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-404.html"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-500.html"> 500 </a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/samples/register.html"> Register </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search products">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-block">
                <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown" aria-expanded="false" href="#">+ Create New Project</a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                  <h6 class="p-3 mb-0">Projects</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-file-outline text-primary"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Software Development</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-web text-info"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">UI Development</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-layers text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Software Testing</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all projects</p>
                </div>
              </li>
              <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                  <i class="mdi mdi-view-grid"></i>
                </a>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <span class="count bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../../assets/images/faces/face4.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                      <p class="text-muted mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../../assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                      <p class="text-muted mb-0"> 15 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../../assets/images/faces/face3.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                      <p class="text-muted mb-0"> 18 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">4 new messages</p>
                </div>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-calendar text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Event today</p>
                      <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                      <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-link-variant text-warning"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Launch Admin</p>
                      <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="../../assets/images/faces/face15.jpg" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">Henry Klein</p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Log out</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">Advanced settings</p>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Evaluation </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Evaluation</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Delete/Update</li>
                </ol>
              </nav>
            </div>
            <div class="clock-container">
    <div id="clock">00:00:00</div>
  </div>
  <script src="script.js"></script>
  <!--recherche-->
  <form method="GET" action="basic_elements.php">
    <div class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Rechercher évaluation par poids" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button class="btn btn-primary" type="submit">Rechercher</button>
    </div>
</form>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #1a1a1a; /* Fond noir pour la page */
        color: white; /* Texte en blanc */
        margin: 0;
        padding: 20px;
    }

    form {
        background-color: #333333; /* Fond gris foncé pour le formulaire */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        max-width: 600px;
        margin: 20px auto;
    }

    .input-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .form-control {
        width: 80%;
        padding: 10px;
        font-size: 1rem;
        border-radius: 5px;
        border: 1px solid #f44336; /* Bordure rouge */
        outline: none;
        background-color: #1a1a1a; /* Fond noir pour le champ de saisie */
        color: white; /* Texte en blanc */
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #f44336; /* Rouge au focus */
        background-color: #333333; /* Légèrement plus clair au focus */
    }

    .btn {
        padding: 10px 20px;
        font-size: 1rem;
        background-color: #f44336; /* Rouge */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #d32f2f; /* Rouge foncé au survol */
    }

    .btn:focus {
        outline: none;
        box-shadow: 0 0 5px #f44336; /* Lueur rouge autour du bouton */
    }

    /* Pour les petits écrans (mobiles) */
    @media (max-width: 600px) {
        .input-group {
            flex-direction: column;
            align-items: stretch;
        }

        .form-control {
            width: 100%;
            margin-bottom: 10px;
        }

        .btn {
            width: 100%;
        }
    }
</style>

 <?php
  if ($evaluation) {
    ?>
    <h2>Modifier l'Évaluation</h2>
    <form action="basic_elements.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $evaluation['id_eva']; ?>">
        <label>Poids: <input type="text" name="poids" value="<?php echo $evaluation['poids']; ?>"></label><br>
        <label>KCL: <input type="text" name="kcl" value="<?php echo $evaluation['kcl']; ?>"></label><br>
        <label>Taille: <input type="text" name="taille" value="<?php echo $evaluation['taille']; ?>"></label><br>
        <label>Date de Naissance: <input type="date" name="date_nais" value="<?php echo $evaluation['date_nais']; ?>"></label><br>
        <label>Nombre de Repas: <input type="text" name="nb_repa" value="<?php echo $evaluation['nb_repa']; ?>"></label><br>
        <label>Niveau Physique: <input type="text" name="niv_phy" value="<?php echo $evaluation['niv_phy']; ?>"></label><br>
        <label>Heures de Sommeil: <input type="text" name="nb_h_dormir" value="<?php echo $evaluation['nb_h_dormir']; ?>"></label><br>
        <label>Catégorie: <input type="text" name="cat" value="<?php echo $evaluation['cat']; ?>"></label><br>
        <button type="submit">Mettre à Jour</button>
    </form>
    <?php
}
else {
  // Récupération des données depuis le contrôleur pour afficher le tableau
  $data = $controller->listEvaluations();  // Utilisation de la méthode listEvaluations pour récupérer toutes les évaluations
  $search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Récupérer les données pour affichage
if ($search) {
    $data= $controller->searchPoids($search);  // Recherche basée sur le texte
}   // Récupérer tous les stages si aucune recherche
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau avec Update et Delete</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: #121212;
            color: #ffffff;
            text-align: center;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #ff0000;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #444;
            background-color: #1e1e1e;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        thead {
            background-color: #ff0000;
            color: #ffffff;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #444;
        }

        tbody tr:nth-child(odd) {
            background-color: #2a2a2a;
        }

        tbody tr:nth-child(even) {
            background-color: #1e1e1e;
        }

        tbody tr:hover {
            background-color: #ff4d4d;
            cursor: pointer;
            color: #121212;
            transition: 0.3s ease;
        }

        th {
            font-size: 1.1rem;
        }

        td {
            font-size: 1rem;
        }

        .btn-update {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-update:hover {
            background-color: #ff1a1a;
        }

        .btn-delete {
            background-color: #000000;
            color: white;
            border: 2px solid #ff0000;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-delete:hover {
            background-color: #ff0000;
            color: #121212;
        }

        td form {
            display: inline-block;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <h2>Tableau des Évaluations</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Poids</th>
                <th>KCL</th>
                <th>Taille</th>
                <th>Date de Naissance</th>
                <th>Nombre de Repas</th>
                <th>Niveau Physique</th>
                <th>Heures de Sommeil</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data)) {
                foreach ($data as $evaluation) {
                    echo "<tr>";
                    echo "<td>{$evaluation['id_eva']}</td>";
                    echo "<td>{$evaluation['poids']}</td>";
                    echo "<td>{$evaluation['kcl']}</td>";
                    echo "<td>{$evaluation['taille']}</td>";
                    echo "<td>{$evaluation['date_nais']}</td>";
                    echo "<td>{$evaluation['nb_repa']}</td>";
                    echo "<td>{$evaluation['niv_phy']}</td>";
                    echo "<td>{$evaluation['nb_h_dormir']}</td>";
                    echo "<td>{$evaluation['cat']}</td>";
                    echo "<td>
                        <form action='basic_elements.php' method='POST'>
                            <input type='hidden' name='id' value='{$evaluation['id_eva']}' />
                            <button type='submit' class='btn-update'>Update</button>
                        </form>
                        <form action='basic_elements.php' method='GET'>
                            <input type='hidden' name='delete_id' value='{$evaluation['id_eva']}' />
                            <button type='submit' class='btn-delete'>Delete</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Aucune donnée disponible</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>




    <h3>Liste des évaluations</h3>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=hygiea', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "
    SELECT 
        ut.nom, 
        ut.pre, 
        ut.email,
        e.poids,
        e.kcl,
        e.taille,
        e.date_nais,
        e.nb_repa,
        e.niv_phy,
        e.nb_h_dormir,
        e.cat,
        ac.id_acc,
        ac.id_u,
        ac.id_eva
    FROM 
        acceder_eva ac
    JOIN 
        utilisateur ut ON ut.id_u = ac.id_u
    JOIN 
        evaluation e ON e.id_eva = ac.id_eva
";
    // Exécuter la requête
    $utilisateurs = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

    if (empty($utilisateurs)) {
        echo "Aucune évaluation trouvée.";
    } 
} catch (PDOException $e) {
    echo "Erreur de base de données : " . $e->getMessage();
}
?>

<div class="table-responsive mb-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom de l'Étudiant</th>
                <th>Prénom de l'Étudiant</th>
                <th>Email</th>
                <th>Poids</th>
                <th>KCL</th>
                <th>Taille</th>
                <th>Date de Naissance</th>
                <th>Nombre de Repas</th>
                <th>Niveau Physique</th>
                <th>Nombre d'Heures de Sommeil</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?php echo htmlspecialchars($utilisateur['nom'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['pre'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['email'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['poids'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['kcl'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['taille'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['date_nais'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['nb_repa'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['niv_phy'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['nb_h_dormir'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['cat'] ?? 'N/A'); ?></td>
                    <td>
                        <!-- Bouton de suppression -->
                        <a href="basic_elements.php?delete_account=<?php echo $utilisateur['id_acc']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                            <i class="bi bi-trash"></i> Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
// Vérifier si une évaluation (ou un compte) existe à modifier
if (isset($account) && $account) {
  ?>
  <h2>Modifier le Compte</h2>
  <form action="basic_elements.php" method="POST">
      <input type="hidden" name="account_id" value="<?php echo $account['id_acc']; ?>">

      <label>ID Utilisateur: <input type="number" name="user_id" value="<?php echo $account['id_u']; ?>"></label><br>
      <label>ID Évaluation: <input type="number" name="evaluation_id" value="<?php echo $account['id_eva']; ?>"></label><br>
      
      <button type="submit" name="update_account">Mettre à Jour</button>
  </form>
  <?php
} else {
  // Récupérer la liste des comptes pour afficher le tableau
  $data = $accederController->listAccounts();  // Utilisation de la méthode listAccounts pour récupérer toutes les affectations de comptes
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tableau avec Update et Delete</title>
      <style>
          .btn-update {
              background-color: yellow;
              color: black;
              border: none;
              padding: 5px 10px;
              cursor: pointer;
          }

          .btn-delete {
              background-color: red;
              color: white;
              border: none;
              padding: 5px 10px;
              cursor: pointer;
          }

          .btn-update:hover {
              background-color: orange;
          }

          .btn-delete:hover {
              background-color: darkred;
          }
      </style>
  </head>
  <body>
      <h2>Tableau des Comptes</h2>

      <table border="1" cellspacing="0" cellpadding="10">
          <thead>
              <tr>
                  <th>ID Utilisateur</th>
                  <th>ID Évaluation</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
              <?php
              if (!empty($data)) {
                  foreach ($data as $account) {
                      echo "<tr>";
                      echo "<td>{$account['id_u']}</td>";
                      echo "<td>{$account['id_eva']}</td>";
                      echo "<td>
                          <form style='display:inline;' action='basic_elements.php' method='POST'>
                              <input type='hidden' name='id' value='{$account['id_acc']}' />
                              <button type='submit' class='btn-update'>Modifier</button>
                          </form>

                      </td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='3'>Aucune donnée disponible</td></tr>";
              }
              ?>
          </tbody>
      </table>
  </body>
  </html>
<?php
}
?>



<script>
// Validation et gestion de la soumission du formulaire d'ajout de stage
document.getElementById('stageForm').addEventListener('submit', function(event) {
let isValid = true;

// Clear previous errors
document.getElementById('titreError').style.display = 'none';
document.getElementById('descriptionError').style.display = 'none';
document.getElementById('scoreMinError').style.display = 'none';
document.getElementById('scoreMaxError').style.display = 'none';

// Get values
const titre = document.getElementById('titre').value.trim();
const description = document.getElementById('description').value.trim();
const scoreMin = parseFloat(document.getElementById('score_min').value.trim());
const scoreMax = parseFloat(document.getElementById('score_max').value.trim());

// Validate Title
if (titre === '') {
    document.getElementById('titreError').style.display = 'block';
    isValid = false;
}

// Validate Description
if (description === '') {
    document.getElementById('descriptionError').style.display = 'block';
    isValid = false;
}

// Validate Minimum Score
if (isNaN(scoreMin)) {
    document.getElementById('scoreMinError').style.display = 'block';
    isValid = false;
}

// Validate Maximum Score
if (isNaN(scoreMax) || scoreMax <= scoreMin) {
    document.getElementById('scoreMaxError').style.display = 'block';
    isValid = false;
}

// Prevent form submission if invalid
if (!isValid) {
    event.preventDefault();
}
});
// Sélectionner tous les formulaires de modification
document.querySelectorAll('form[id^="updateStageForm"]').forEach(form => {
form.addEventListener('submit', function(event) {
    let isValid = true;

    // Identifier les champs spécifiques au formulaire
    const id = this.querySelector('input[name="id"]').value;
    const titre = this.querySelector(#titre${id});
    const description = this.querySelector(#description${id});
    const scoreMin = this.querySelector(#score_min${id});
    const scoreMax = this.querySelector(#score_max${id});

    // Identifier les conteneurs d'erreur
    const titreError = this.querySelector(#titreError${id});
    const descriptionError = this.querySelector(#descriptionError${id});
    const scoreMinError = this.querySelector(#scoreMinError${id});
    const scoreMaxError = this.querySelector(#scoreMaxError${id});

    // Réinitialiser les erreurs
    titreError.style.display = 'none';
    descriptionError.style.display = 'none';
    scoreMinError.style.display = 'none';
    scoreMaxError.style.display = 'none';

    // Validation du titre
    if (titre.value.trim() === '') {
        titreError.style.display = 'block';
        isValid = false;
    }

    // Validation de la description
    if (description.value.trim() === '') {
        descriptionError.style.display = 'block';
        isValid = false;
    }

    // Validation du score minimum
    if (scoreMin.value.trim() === '' || isNaN(scoreMin.value)) {
        scoreMinError.style.display = 'block';
        isValid = false;
    }

    // Validation du score maximum
    if (
        scoreMax.value.trim() === '' ||
        isNaN(scoreMax.value) ||
        parseFloat(scoreMax.value) <= parseFloat(scoreMin.value)
    ) {
        scoreMaxError.style.display = 'block';
        isValid = false;
    }

    // Empêcher la soumission si le formulaire n'est pas valide
    if (!isValid) {
        event.preventDefault();
    }
});
});

</script>
    <?php
}
?>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../../assets/vendors/select2/select2.min.js"></script>
    <script src="../../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../../assets/js/file-upload.js"></script>
    <script src="../../assets/js/typeahead.js"></script>
    <script src="../../assets/js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>