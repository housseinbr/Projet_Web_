<?php 
require_once 'C:/xampp/htdocs/frm5/controller/FormationController.php'; 
$formationController = new FormationController();
$list = $formationController->listFormations(); // Récupérer la liste des formations

// Fonction de traduction
function translate($text, $langFrom, $langTo) {
    $cacheDir = 'cache/'; // Dossier de cache
    if (!file_exists($cacheDir)) {
        mkdir($cacheDir, 0777, true); // Créer le dossier s'il n'existe pas
    }

    $cacheFile = $cacheDir . md5($text . $langFrom . $langTo) . '.txt'; // Nom du fichier basé sur le texte et les langues
    if (file_exists($cacheFile)) {
        return file_get_contents($cacheFile); // Lire la traduction depuis le cache
    }

    $url = "https://api.mymemory.translated.net/get?q=" . urlencode($text) . "&langpair=$langFrom|$langTo";
    $response = @file_get_contents($url); // Utiliser @ pour supprimer les warnings
    if ($response === FALSE) {
        return $text; // En cas d'erreur, retourner le texte original
    }
    
    $data = json_decode($response, true);
    $translatedText = $data['responseData']['translatedText'] ?? $text; // Retourner le texte original en cas d'erreur

    // Sauvegarder la traduction dans le cache
    file_put_contents($cacheFile, $translatedText);
    return $translatedText;
}

// Détection de la langue sélectionnée
$selectedLang = isset($_POST['lang']) ? $_POST['lang'] : 'fr';
$translations = [];

// Traduction pour l'anglais
if ($selectedLang === 'en') {
    $translations['title'] = translate("Your Formation", "fr", "en");
    $translations['description'] = translate("Discover our training courses to ensure a balanced and sustainable life", "fr", "en");
    $translations['details'] = translate("Our training courses cover sustainable agriculture, healthy eating and nutrition. They offer practical and current knowledge to adopt environmentally friendly practices and improve health. Accessible to everyone, they allow you to learn at your own pace.", "fr", "en");
    $translations['formationTitle'] = "Your Training";
    $translations['programs'] = "Our Training Programs"; 
    $translations['noFormations'] = "No training available.";
    $translations['createAccount'] = "Create Account";
    $translations['login'] = "Log In";
    $translations['dashboard'] = "My Dashboard";
    $translations['myProfile'] = "My Profile";
    $translations['myPurchases'] = "My Purchases";
    $translations['notifications'] = "Notifications";
    $translations['settings'] = "Account Settings";
    $translations['logout'] = "Log Out";
    $translations['home'] = "Home";
    $translations['about'] = "About";
    $translations['services'] = "Our Services";
    $translations['blogs'] = "Blogs";
    $translations['pages'] = "Pages";
    $translations['contact'] = "Contact Us";
    $translations['start'] = "Get Started";
    $translations['titre'] = "Title of Formation"; // Titre de formation
    $translations['descFormation'] = "Description"; // Description
    $translations['dureeFormation'] = "Duration of Training"; // Durée de la formation
    $translations['nomFormateur'] = "Trainer's Name"; // Nom du formateur
    $translations['prenomFormateur'] = "Trainer's First Name"; // Prénom du formateur
    $translations['emailFormateur'] = "Trainer's Email"; // Email du formateur
    $translations['heures'] = "hours"; // Traduction pour heures
    
} else {
    // Texte par défaut en français
    $translations['title'] = "Votre Formations";
    $translations['description'] = "Découvrez nos formations pour assurer une vie équilibrée et durable";
    $translations['details'] = "Nos formations couvrent l'agriculture durable, l'alimentation saine et la nutrition. Elles offrent des connaissances pratiques et actuelles pour adopter des pratiques respectueuses de l'environnement et améliorer la santé. Accessible à tous, elles permettent d'apprendre à son rythme.";
    $translations['formationTitle'] = "Votre Formation";
    $translations['programs'] = "Nos Formations";  
    $translations['noFormations'] = "Aucune formation disponible.";
    $translations['createAccount'] = "Création de Compte";
    $translations['login'] = "Se connecter";
    $translations['dashboard'] = "Mon tableau de bord";
    $translations['myProfile'] = "Mon Profil";
    $translations['myPurchases'] = "Mes achats";
    $translations['notifications'] = "Notifications";
    $translations['settings'] = "Paramètres du compte";
    $translations['logout'] = "Se déconnecter";
    $translations['home'] = "Accueil";
    $translations['about'] = "À propos";
    $translations['services'] = "Nos Services";
    $translations['blogs'] = "Blogs";
    $translations['pages'] = "Pages";
    $translations['contact'] = "Contactez-nous";
    $translations['start'] = "Commencer";
    $translations['titre'] = "Titre de formation"; // Titre de formation
    $translations['descFormation'] = "Description"; // Description en français
    $translations['dureeFormation'] = "Durée de la formation"; // Durée de la formation en français
    $translations['nomFormateur'] = "Nom du formateur"; // Nom du formateur en français
    $translations['prenomFormateur'] = "Prénom du formateur"; // Prénom du formateur en français
    $translations['emailFormateur'] = "Email du formateur"; // Email du formateur en français
    $translations['heures'] = "heures"; // Traduction pour heures en français
}
?>

<!DOCTYPE html>
<html lang="<?php echo $selectedLang; ?>">

<head>
    <meta charset="utf-8">
    <title>HYGEIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Chargement...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid topbar bg-light px-5 d-none d-lg-block">
        <div class="row gx-0 align-items-center">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-flex flex-wrap">
                    <a href="#" class="text-muted small me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Esprit Areana So8ra</a>
                    <a href="tel:+01234567890" class="text-muted small me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+216 27 31 91 64</a>
                    <a href="mailto:example@gmail.com" class="text-muted small me-0"><i class="fas fa-envelope text-primary me-2"></i>HYGEIA@gmail.com</a>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <form method="POST">
                        <select name="lang" onchange="this.form.submit()" class="form-select" style="width: auto; display: inline-block;">
                            <option value="fr" <?php if ($selectedLang === 'fr') echo 'selected'; ?>>Français</option>
                            <option value="en" <?php if ($selectedLang === 'en') echo 'selected'; ?>>Anglais</option>
                        </select>
                    </form>
                    <a href="inscription.html"><small class="me-3 text-dark"><i class="fa fa-user text-primary me-2"></i><?php echo $translations['createAccount']; ?></small></a>
                    <a href="Connecter.html"><small class="me-3 text-dark"><i class="fa fa-sign-in-alt text-primary me-2"></i><?php echo $translations['login']; ?></small></a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown"><small><i class="fa fa-home text-primary me-2"></i><?php echo $translations['dashboard']; ?></small></a>
                        <div class="dropdown-menu rounded">
                            <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i><?php echo $translations['myProfile']; ?></a>
                            <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i><?php echo $translations['myPurchases']; ?></a>
                            <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i><?php echo $translations['notifications']; ?></a>
                            <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i><?php echo $translations['settings']; ?></a>
                            <a href="#" class="dropdown-item"><i class="fas fa-power-off me-2"></i><?php echo $translations['logout']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <img src="img/logo.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index2.html" class="nav-item nav-link"><?php echo $translations['home']; ?></a>
                    <a href="about.html" class="nav-item nav-link"><?php echo $translations['about']; ?></a>
                    <a href="service.html" class="nav-item nav-link"><?php echo $translations['services']; ?></a>
                    <a href="blog.html" class="nav-item nav-link"><?php echo $translations['blogs']; ?></a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <span class="dropdown-toggle"><?php echo $translations['pages']; ?></span>
                        </a>
                        <div class="dropdown-menu m-0">
                            <a href="feature.html" class="dropdown-item">Nos Fonctionnalités</a>
                            <a href="team.html" class="dropdown-item">Notre Équipe</a>
                            <a href="testimonial.html" class="dropdown-item">Témoignages</a>
                            <a href="offer.html" class="dropdown-item">Nos Offres</a>
                            <a href="FAQ.html" class="dropdown-item">FAQ</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link"><?php echo $translations['contact']; ?></a>
                </div>
                <a href="inscription.html" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0"><?php echo $translations['start']; ?></a>
            </div>
        </nav>
    </div>

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s"><?php echo $translations['title']; ?></h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html"><?php echo $translations['home']; ?></a></li>
                <li class="breadcrumb-item active text-primary"><?php echo $translations['programs']; ?></li>
            </ol>    
        </div>
    </div>
    <!-- Header End -->

    <!-- Formations Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary"><?php echo $translations['formationTitle']; ?></h4>
                <h1 class="display-5 mb-4"><?php echo $translations['description']; ?></h1>
                <p class="mb-0"><?php echo $translations['details']; ?></p>
            </div>

            <?php if (!empty($list)): ?>
                <div class="row">
                    <?php foreach ($list as $formation): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h4 class="breadcrumb-item active text-primary"><?php echo $translations['titre']; ?> : <?php echo htmlspecialchars($formation['titre']); ?></h4>
                                <h6 class="card-text"><?php echo $translations['descFormation']; ?> : <?php echo htmlspecialchars($formation['disc']); ?></h6>
                                <h6 class="card-text"><?php echo $translations['dureeFormation']; ?> : <?php echo htmlspecialchars($formation['duree']) . ' ' . $translations['heures']; ?></h6>
                                <h6 class="card-text"><?php echo $translations['nomFormateur']; ?> : <?php echo htmlspecialchars($formation['nom_f']); ?></h6>
                                <h6 class="card-text"><?php echo $translations['prenomFormateur']; ?> : <?php echo htmlspecialchars($formation['pre_f']); ?></h6>
                                <h6 class="card-text"><?php echo $translations['emailFormateur']; ?> : <?php echo htmlspecialchars($formation['email_f']); ?></h6>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p><?php echo $translations['noFormations']; ?></p>
            <?php endif; ?>
        </div>
    </div>
    <!-- Formations End -->

    <!-- Footer Start -->
    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgba(255, 255, 255, 0.08);">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="footer-item">
                        <a href="index.html" class="p-0">
                            <h4 class="text-white"><i class="fas fa-search-dollar me-3"></i>HYGEIA</h4>
                        </a>
                        <p class="mb-4"><?php echo $translations['details']; ?></p>
                        <div class="d-flex">
                            <a href="inscription.html" class="bg-dark d-flex rounded align-items-center py-2 px-3 ms-2">
                                <i class="fas fa-play text-primary"></i>
                                <div class="ms-3">
                                    <small class="text-white"><?php echo $translations['start']; ?></small>
                                    <h6 class="text-white">Inscrivez-vous maintenant</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-2">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Lien rapide</h4>
                        <a href="#about"><i class="fas fa-angle-right me-2"></i> <?php echo $translations['about']; ?></a>
                        <a href="#service"><i class="fas fa-angle-right me-2"></i> <?php echo $translations['services']; ?></a>
                        <a href="#att"><i class="fas fa-angle-right me-2"></i> Attractions</a>
                        <a href="#team"><i class="fas fa-angle-right me-2"></i> Team</a>
                        <a href="#blog"><i class="fas fa-angle-right me-2"></i> <?php echo $translations['blogs']; ?></a>
                        <a href="contact.html"><i class="fas fa-angle-right me-2"></i> <?php echo $translations['contact']; ?></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Support</h4>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Disclaimer</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> <?php echo $translations['settings']; ?></a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> FAQ</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Help</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Nos Contacts</h4>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt text-primary me-3"></i>
                            <p class="text-white mb-0">Esprit Areana So8ra</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope text-primary me-3"></i>
                            <p class="text-white mb-0">HYGEIA@gmail.com</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa fa-phone-alt text-primary me-3"></i>
                            <p class="text-white mb-0">+216 27 31 91 64</p>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="fab fa-firefox-browser text-primary me-3"></i>
                            <p class="text-white mb-0">WebCoders@gmail.com</p>
                        </div>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f text-white"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-twitter text-white"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-instagram text-white"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="#"><i class="fab fa-linkedin-in text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    
    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-body"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i>HYGEIA</a>, Tous droits réservés.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-body">
                    Créé par <a class="border-bottom text-white" href="https://htmlcodex.com">Web Coders</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html> 