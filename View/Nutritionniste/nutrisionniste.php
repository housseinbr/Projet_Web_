<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="utf-8">
        <title>HYGEIA</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
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
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
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
                        <a href="inscription.html"><small class="me-3 text-dark"><i class="fa fa-user text-primary me-2"></i>Création de Compte</small></a>
                        <a href="Connecter.html"><small class="me-3 text-dark"><i class="fa fa-sign-in-alt text-primary me-2"></i>Se connecter</small></a>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown"><small><i class="fa fa-home text-primary me-2"></i> Mon tableau de bord</small></a>
                            <div class="dropdown-menu rounded">
                                <a href="../Backend/php/account.php" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> Mon Profil</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Mes achats</a>
                                <a href="admin.html" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> Ajout d'Administration</a>
                                <a href="../Backend/php/account_modif.php" class="dropdown-item"><i class="fas fa-cog me-2"></i> Paramètres du compte</a>
                                <a href="../Backend/php/logout_button.php" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Se déconnecter</a>
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
                    <img src="img/logo.png">
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="#" class="nav-item nav-link active">Accueil</a>
                        <a href="about.html" class="nav-item nav-link">À propos</a>
                        <a href="service.html" class="nav-item nav-link">Nos Services</a>
                        <a href="blog.html" class="nav-item nav-link">Blogs</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                <span class="dropdown-toggle">Pages</span>
                            </a>
                            <div class="dropdown-menu m-0">
                                <a href="feature.html" class="dropdown-item">Nos Fonctionnalités</a>
                                <a href="team.html" class="dropdown-item">Notre Équipe</a>
                                <a href="testimonial.html" class="dropdown-item">Témoignages</a>
                                <a href="offer.html" class="dropdown-item">Nos Offres</a>
                                <a href="FAQ.html" class="dropdown-item">FAQ</a>
                                <!--<a href="404.html" class="dropdown-item">Page 404</a>-->
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contactez-nous</a>
                    </div>
                    <a href="inscription.html" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Commencer</a>
                </div>
            </nav>
        </div>

            <!-- Carousel Start -->
            <div class="header-carousel owl-carousel">
                <div class="header-carousel-item">
                    <img src="img/carousel-1.jpg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row g-5">
                                <div class="col-12 animated fadeInUp">
                                    <div class="text-center">
                                        <h4 class="text-primary text-uppercase fw-bold mb-4">Bienvenu au HYGEIA</h4>
                                        <h1 class="display-4 text-uppercase text-white mb-4">Savoir manger est un art</h1>
                                        <p class="mb-5 fs-5">Savoir manger demande une connaissance des aliments, de leurs bienfaits, et de la manière de les associer pour un équilibre nutritionnel. C’est un art car il englobe la créativité, la culture et le respect du corps.
                                        </p>
                                        <div class="d-flex justify-content-center flex-shrink-0 mb-4">
                                            <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="#"><i class="fas fa-play-circle me-2"></i> Regarder La Video</a>
                                            <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2" href="#">On Commence</a>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <h2 class="text-white me-2">Suivez Nous :</h2>
                                            <div class="d-flex justify-content-end ms-2">
                                                <a class="btn btn-md-square btn-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                                <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-twitter"></i></a>
                                                <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-instagram"></i></a>
                                                <a class="btn btn-md-square btn-light rounded-circle ms-2" href=""><i class="fab fa-linkedin-in"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-carousel-item">
                    <img src="img/carousel-2.jpeg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row gy-0 gx-5">
                                <div class="col-lg-0 col-xl-5"></div>
                                <div class="col-xl-7 animated fadeInLeft">
                                    <div class="text-sm-center text-md-end">
                                        <h4 class="text-primary text-uppercase fw-bold mb-4">Bienvenu au HYGEIA</h4>
                                        <h1 class="display-4 text-uppercase text-white mb-4">Savoir manger est un art</h1>
                                        <p class="mb-5 fs-5">Savoir manger demande une connaissance des aliments, de leurs bienfaits, et de la manière de les associer pour un équilibre nutritionnel. C’est un art car il englobe la créativité, la culture et le respect du corps. 
                                        </p>
                                        <div class="d-flex justify-content-center justify-content-md-end flex-shrink-0 mb-4">
                                            <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="#"><i class="fas fa-play-circle me-2"></i> Regarder La Video</a>
                                            <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2" href="#">On Commence</a>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                                            <h2 class="text-white me-2">Suivez Nous :</h2>
                                            <div class="d-flex justify-content-end ms-2">
                                                <a class="btn btn-md-square btn-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                                <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-twitter"></i></a>
                                                <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-instagram"></i></a>
                                                <a class="btn btn-md-square btn-light rounded-circle ms-2" href=""><i class="fab fa-linkedin-in"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- Carousel End -->
        </div>
        <
<body>
<div class="container">
    <h2>Réservation Nutritionniste</h2>
    <form name="reservationForm" action="" method="POST" onsubmit="return validateForm(event)">
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="text" name="telephone" placeholder="Téléphone" required>
        <button type="submit">Enregistrer</button>
    </form>

    <script>
        // Fonction de validation du formulaire
        function validateForm(event) {
            // Empêcher l'envoi du formulaire par défaut
            event.preventDefault();

            // Récupérer les valeurs des champs
            var email = document.forms["reservationForm"]["email"].value;
            var nom = document.forms["reservationForm"]["nom"].value;
            var prenom = document.forms["reservationForm"]["prenom"].value;
            var telephone = document.forms["reservationForm"]["telephone"].value;

            // Validation de l'email
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailRegex.test(email)) {
                alert("Veuillez entrer un email valide.");
                return false;
            }

            // Validation du nom (lettres uniquement et longueur minimale de 2 caractères)
            var nameRegex = /^[a-zA-Z]+$/;
            if (!nameRegex.test(nom) || nom.length < 2) {
                alert("Le nom doit contenir uniquement des lettres et avoir une longueur minimale de 2 caractères.");
                return false;
            }

            // Validation du prénom (lettres uniquement et longueur minimale de 2 caractères)
            if (!nameRegex.test(prenom) || prenom.length < 2) {
                alert("Le prénom doit contenir uniquement des lettres et avoir une longueur minimale de 2 caractères.");
                return false;
            }

            // Validation du téléphone (doit correspondre à un format spécifique, exemple : 123-456-7890)
            var phoneRegex = /^\d{10}$/; // Ici, le format attendu est un numéro de téléphone à 10 chiffres
            if (!phoneRegex.test(telephone)) {
                alert("Le numéro de téléphone doit comporter 10 chiffres.");
                return false;
            }

            // Si tout est valide, soumettre le formulaire
            document.forms["reservationForm"].submit();
        }
    </script>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud_operaions";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $telephone = $_POST['telephone'];
    
            $sql = "INSERT INTO nutrisonniste (email, nom, prenom, telephone) VALUES (:email, :nom, :prenom, :telephone)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':telephone', $telephone);
    
            if ($stmt->execute()) {
                // Rediriger vers display.php dans le dossier 'view' après un enregistrement réussi
                header("Location: View/display.php");
                exit; // Arrêter le script après la redirection
            } else {
                echo "<p style='color: red;'>Erreur lors de l'enregistrement.</p>";
            }
        }
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";
    }
    ?>
</div>

</body>
</html>


    <!-- Footer Start -->
 <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="footer-item">
                            <a href="index.html" class="p-0">
                                <h4 class="text-white"><i class="fas fa-search-dollar me-3"></i>HYGEIA</h4>
                                <!-- <img src="img/logo.png" alt="Logo"> -->
                            </a>
                            <p class="mb-4">Savoir manger demande une connaissance des aliments, de leurs bienfaits, et de la manière de les associer pour un équilibre nutritionnel. C’est un art car il englobe la créativité, la culture et le respect du corps...</p>
                            <div class="d-flex">
                                <!--<a href="#" class="bg-primary d-flex rounded align-items-center py-2 px-3 me-2">
                                    <i class="fas fa-apple-alt text-white"></i>
                                    <div class="ms-3">
                                        <small class="text-white">Download on the</small>
                                        <h6 class="text-white">App Store</h6>
                                    </div>
                                </a>-->
                                <a href="inscription.html" class="bg-dark d-flex rounded align-items-center py-2 px-3 ms-2">
                                    <i class="fas fa-play text-primary"></i>
                                    <div class="ms-3">
                                        <small class="text-white">On commence</small>
                                        <h6 class="text-white">inscriez vous maintenant</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-2">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">Lien rapide</h4>
                            <a href="#about"><i class="fas fa-angle-right me-2"></i> À propos</a>
                            <a href="#service"><i class="fas fa-angle-right me-2"></i> Nos Services</a>
                            <a href="#att"><i class="fas fa-angle-right me-2"></i> Attractions</a>
                            <a href="#team"><i class="fas fa-angle-right me-2"></i> Team</a>
                            <a href="#blog"><i class="fas fa-angle-right me-2"></i> Blogs</a>
                            <a href="contact.html"><i class="fas fa-angle-right me-2"></i> Contacte Nous</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">Support</h4>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Disclaimer</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Support</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> FAQ</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Help</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">Nos Contact</h4>
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
                                <p class="text-white mb-0">WebCoders@gmail.com.com</p>
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
      <!-- Back to Top -->
      <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   
      


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
