<?php
require_once '../../../config.php';

$stmt = config::getConnexion()->query("SELECT id_u FROM c_u LIMIT 1");

if ($stmt->rowCount() > 0) {
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    $id_u = $user_data['id_u']; 
} else {
    $message = "Veuillez vous connecter pour modifier votre compte.";
    $checkIcon = "❌";
    $redirectUrl = "../../Frontend/Connecter.html";
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion requise</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .checkmark { font-size: 50px; text-align: center; margin-top: 50px; display: none; }
            .message { text-align: center; font-size: 20px; margin-top: 20px; }
            .redirect-message { text-align: center; font-size: 18px; margin-top: 30px; }
            .redirect-message span { font-weight: bold; }
            .fadeIn { animation: fadeIn 2s forwards; }
            @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="checkmark fadeIn"><?php echo $checkIcon; ?></div>
            <div class="message fadeIn"><?php echo $message; ?></div>
            <div class="redirect-message fadeIn">
                <span id="countdown">5</span> secondes restantes...
            </div>
        </div>
        <script>
            let countdown = document.getElementById("countdown");
            let seconds = 5;

            function updateCountdown() {
                if (seconds > 0) {
                    countdown.textContent = seconds;
                    seconds--;
                } else {
                    window.location.href = "<?php echo $redirectUrl; ?>";
                }
            }

            setInterval(updateCountdown, 1000);

            setTimeout(function() {
                document.querySelector(".checkmark").style.display = "block";
            }, 500);  
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
    exit;
}

$stmt_user = config::getConnexion()->prepare("SELECT nom, pre, email, tel, age, genre, pwd, image FROM utilisateur WHERE id_u = ?");
$stmt_user->execute([$id_u]);

if ($stmt_user->rowCount() > 0) {
    $user = $stmt_user->fetch(PDO::FETCH_ASSOC);
    $nom = $user['nom'];
    $pre = $user['pre'];
    $email = $user['email'];
    $tel = $user['tel'];
    $age = $user['age'];
    $genre = $user['genre'];
    $pwd = $user['pwd'];
    $image = $user['image'];
    $genre_label = ($genre == 1) ? 'Homme' : 'Femme';
} else {
    echo "Utilisateur non trouvé.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $pre = $_POST['pre'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $age = $_POST['age'];
    $genre = $_POST['genre'];
    $pwd = $_POST['pwd'];
    $image_path = $image;  // Garder l'ancienne image si aucune nouvelle n'est téléchargée.

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_dir = './upload/';  
        $image_name = basename($_FILES['image']['name']); 
        $image_path = $image_name;

        if (getimagesize($_FILES['image']['tmp_name']) !== false) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_dir . '/' . $image_name)) {
                echo "L'image a été téléchargée avec succès.";
            } else {
                echo "Erreur lors du téléchargement de l'image.";
                exit;
            }
        } else {
            echo "Ce fichier n'est pas une image valide.";
            exit;
        }
    }

    $stmt_update = config::getConnexion()->prepare("UPDATE utilisateur SET nom = ?, pre = ?, email = ?, tel = ?, age = ?, genre = ?, pwd = ?, image = ? WHERE id_u = ?");
    $stmt_update->execute([$nom, $pre, $email, $tel, $age, $genre, $pwd, $image_path, $id_u]);

    //echo "<script>Les informations ont été mises à jour avec succès.</script>";
    //header("Location: /path/to/redirect"); // Redirigez l'utilisateur vers la page de son choix après la mise à jour.
    exit;
}
?>





<!DOCTYPE html>
<html lang="en">

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
        <link href="../../Frontend/lib/animate/animate.min.css" rel="stylesheet">
        <link href="../../Frontend/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="../../Frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="../../Frontend/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="../../Frontend/css/style.css" rel="stylesheet">
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
                        <a href="../../Frontend/inscription.html"><small class="me-3 text-dark"><i class="fa fa-user text-primary me-2"></i>Création de Compte</small></a>
                        <a href="../../Frontend/Connecter.html"><small class="me-3 text-dark"><i class="fa fa-sign-in-alt text-primary me-2"></i>Se connecter</small></a>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown"><small><i class="fa fa-home text-primary me-2"></i> Mon tableau de bord</small></a>
                            <div class="dropdown-menu rounded">
                                <a href="account.php" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> Mon Profil</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Mes achats</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>
                                <a href="account_modif.php" class="dropdown-item"><i class="fas fa-cog me-2"></i> Paramètres du compte</a>
                                <a href="logout_button.php" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Se déconnecter</a>
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
                    <img src="../../Frontend/img/logo.png">
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="../../Frontend/index2.html" class="nav-item nav-link">Accueil</a>
                        <a href="../../Frontend/about.html" class="nav-item nav-link">À propos</a>
                        <a href="../../Frontend/service.html" class="nav-item nav-link">Nos Services</a>
                        <a href="../../Frontend/blog.html" class="nav-item nav-link">Blogs</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                <span class="dropdown-toggle">Pages</span>
                            </a>
                            <div class="dropdown-menu m-0">
                                <a href="../../Frontend/feature.html" class="dropdown-item">Nos Fonctionnalités</a>
                                <a href="../../Frontend/team.html" class="dropdown-item">Notre Équipe</a>
                                <a href="../../Frontend/testimonial.html" class="dropdown-item">Témoignages</a>
                                <a href="../../Frontend/offer.html" class="dropdown-item">Nos Offres</a>
                                <a href="../../Frontend/FAQ.html" class="dropdown-item">FAQ</a>
                                <!--<a href="404.html" class="dropdown-item">Page 404</a>-->
                            </div>
                        </div>
                        <a href="../../Frontend/contact.html" class="nav-item nav-link">Contactez-nous</a>
                    </div>
                    <a href="../../Frontend/inscription.html" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Commencer</a>
                </div>
            </nav>
        </div>

        <!-- Header Start -->
            <div class="container-fluid bg-breadcrumb">
                <div class="container text-center py-5" style="max-width: 900px;">
                    <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">mettre ajour ton profile</h4>
                    <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active text-primary">profile</li>
                    </ol>    
                </div>
            </div>
        <!-- Header End -->
        </div>
        <!-- Navbar & Hero End -->
        <div class="container">
    <br>
    <br>
    <h2>Mettre à jour ton profil</h2>
    <br>
    <br>
    <form method="POST" action="" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <th>Image de profil</th>
                <!-- Affichage de l'image de profil -->
                <?php if (!empty($user['image'])): ?>
                    <!-- Utiliser le nom de l'image pour construire le chemin correct -->
                    <img src="./upload/<?php echo htmlspecialchars($user['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Image de profil" width="150">
                <?php else: ?>
                    <img src="./upload/default.jpg" alt="Image de profil" width="150">
                <?php endif; ?>
                <td><input class="form-control border-0" type="file" name="image" accept="image/*"></td>
            </tr>
            <tr>
                <th>Nom</th>
                <td><input class="form-control border-0" type="text" name="nom" value="<?php echo htmlspecialchars($nom, ENT_QUOTES, 'UTF-8'); ?>" required></td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td><input class="form-control border-0" type="text" name="pre" value="<?php echo htmlspecialchars($pre, ENT_QUOTES, 'UTF-8'); ?>" required></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input class="form-control border-0" type="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" required></td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td><input class="form-control border-0" type="tel" name="tel" value="<?php echo htmlspecialchars($tel, ENT_QUOTES, 'UTF-8'); ?>" required></td>
            </tr>
            <tr>
                <th>Âge</th>
                <td><input class="form-control border-0" type="number" name="age" value="<?php echo htmlspecialchars($age, ENT_QUOTES, 'UTF-8'); ?>" required></td>
            </tr>
            <tr>
                <th>Genre</th>
                <td>
                    <select class="form-select" name="genre" required>
                        <option value="1" <?php echo ($genre == 1) ? 'selected' : ''; ?>>Homme</option>
                        <option value="2" <?php echo ($genre == 2) ? 'selected' : ''; ?>>Femme</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Mot de passe</th>
                <td><input class="form-control border-0" type="password" name="pwd" value="<?php echo htmlspecialchars($pwd, ENT_QUOTES, 'UTF-8'); ?>" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-primary w-100 py-3" type="submit">Mettre à jour</button>
                </td>
            </tr>
        </table>
    </form>
</div>



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
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-md-0">
                        <span class="text-body"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i>HYGEIA</a>, Tous droits réservés.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end text-body">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Cree par <a class="border-bottom text-white" href="https://htmlcodex.com"> Web Coders</a> Partager par  <a class="border-bottom text-white" href="https://themewagon.com">Web Coders</a>
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
        <script src="../../Frontend/lib/wow/wow.min.js"></script>
        <script src="../../Frontend/lib/easing/easing.min.js"></script>
        <script src="../../Frontend/lib/waypoints/waypoints.min.js"></script>
        <script src="../../Frontend/lib/counterup/counterup.min.js"></script>
        <script src="../../Frontend/lib/lightbox/js/lightbox.min.js"></script>
        <script src="../../Frontend/lib/owlcarousel/owl.carousel.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="../../Frontend/js/main.js"></script>
    </body>

</html>
