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
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
    .error-message {
        color: red;
        font-size: 0.9em;
        margin-top: 5px;
        display: none;
    }
</style>
    </head>

    <body>
    <form action="process.php" method="POST">

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
                                <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> Mon Profil</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Mes achats</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i> Paramètres du compte</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Se déconnecter</a>
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
                        <a href="index2.html" class="nav-item nav-link">Accueil</a>
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
                        <a href="contact.html" class="nav-item nav-link active">Contact</a>
                    </div>
                    <a href="inscription.html" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">contactez-nous<</a>
                </div>
            </nav>
        </div>

            <!-- Header Start -->
            <div class="container-fluid bg-breadcrumb">
                <div class="container text-center py-5" style="max-width: 900px;">
                    <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">evaluation personnel</h4>
                    <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active text-primary">evaluation</li>
                    </ol>    
                </div>
            </div>
            <!-- Header End -->
        </div>
        <!-- Navbar & Hero End -->

        <!-- Contact Start -->
        <div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-xl-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <div class="bg-light rounded p-5 mb-5">
                                <h4 class="text-primary mb-4">Pour quoi cette evaluation</h4>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="contact-add-item">
                                            <div class="contact-icon text-primary mb-4">
                                            </div>
                                            <div>
                                                <h4>Une bonne formation en nutrition permet de développer une connaissance approfondie des aliments, de leurs bienfaits, et de l'art de les associer pour un équilibre nutritionnel optimal.</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-light p-5 rounded h-100 wow fadeInUp" data-wow-delay="0.2s">
                                <h4 class="text-primary">On commence</h4>
                                <!--<p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a class="text-primary fw-bold" href="https://htmlcodex.com/contact-form">Download Now</a>.</p>-->
                                <form>
                                <form action="process.php" method="POST">
                                    <div class="row g-4">
                                        <!-- Poids -->
                                        <div class="col-lg-12 col-xl-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="poids" name="poids" placeholder="Votre Poids">
                                                <label for="poids">Votre Poids (kg)</label>
                                            </div>
                                        </div>
                                
                                        <!-- Taille -->
                                        <div class="col-lg-12 col-xl-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="taille" name="taille" placeholder="Votre Taille">
                                                <label for="taille">Votre Taille (cm)</label>
                                            </div>
                                        </div>
                                
                                        <!-- Date de naissance -->
                                        <h5 class="text-primary">Donnez votre date de naissance</h5>
                                        <div class="col-lg-12 col-xl-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control border-0" id="date_nais" name="date_nais" placeholder="Date de naissance">
                                                <label for="date_nais">Votre Date de naissance</label>
                                            </div>
                                        </div>
                                
                                    
                                        <!-- Fréquence des repas -->
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="nb_repa" name="nb_repa" placeholder="Fréquence des repas">
                                                <label for="nb_repa">Combien de repas prenez-vous par jour ?</label>
                                            </div>
                                        </div>
                                
                                        <!-- Préférences alimentaires -->
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="kcl" name="kcl" placeholder="Préférences alimentaires">
                                                <label for="kcl">combien de calories tu manges dans un jour dans votre vie quotidienne ?</label>
                                            </div>
                                        </div>
                                
                                        <!-- Niveau de stress -->
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="number" class="form-control border-0" id="niv_phy" name="niv_phy" min="1" max="10" placeholder="Niveau de stress">
                                                <label for="niv_phy">Sur une échelle de 1 à 10, quel est votre niveau physique quotidien ?</label>
                                            </div>
                                        </div>
                                
                                        <!-- Nombre d'heures de sommeil -->
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" id="nb_h_dormir" name="nb_h_dormir" placeholder="Heures de sommeil">
                                                <label for="nb_h_dormir">Combien d'heures dormez-vous en moyenne par nuit ?</label>
                                            </div>
                                        </div>

                                            <!-- Objectif principal -->
                                            <h5 class="text-primary">Quel est votre objectif principal ?</h5>
                                            <div class="col-12">
                                                <select id="cat" name="cat" class="form-select">
                                                    <option value="perdre-poids">Perdre du poids</option>
                                                    <option value="prendre-muscle">Prendre du muscle</option>
                                                    <option value="maintenir-poids">avoir une bonne sante</option>
                                                </select>
                                                <label for="cat">Sélectionnez votre objectif principal</label>
                                            </div>
                                    
                                
                                        <!-- Bouton d'envoi -->
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100 py-3">valider votre repense</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                        <div class="rounded h-100">
                            <img src="C:\xampp\htdocs\Projet Web\Projet Web\img\about-2.jpg" alt="image" width="700" height="500">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Contact End -->

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
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
        <script >function showErrorMessage(inputElement, message) {
    let errorElement = inputElement.nextElementSibling;
    if (!errorElement || !errorElement.classList.contains("error-message")) {
        errorElement = document.createElement("div");
        errorElement.classList.add("error-message");
        inputElement.parentNode.insertBefore(errorElement, inputElement.nextSibling);
    }
    errorElement.textContent = message;
    errorElement.style.display = "block";
}

function hideErrorMessage(inputElement) {
    const errorElement = inputElement.nextElementSibling;
    if (errorElement && errorElement.classList.contains("error-message")) {
        errorElement.style.display = "none";
    }
}

const poidsInput = document.getElementById("poids");
poidsInput.addEventListener("input", function () {
    const poids = parseFloat(poidsInput.value);
    if (poids < 20 || poids > 300 || isNaN(poids)) {
        showErrorMessage(poidsInput, "Veuillez entrer un poids entre 20 et 300 kg.");
    } else {
        hideErrorMessage(poidsInput);
    }
});

const tailleInput = document.getElementById("taille");
tailleInput.addEventListener("input", function () {
    const taille = parseFloat(tailleInput.value);
    if (taille < 0 || taille > 300 || isNaN(taille)) {
        showErrorMessage(tailleInput, "Veuillez entrer une taille entre 0 et 300 cm.");
    } else {
        hideErrorMessage(tailleInput);
    }
});

const dateNaissanceInput = document.getElementById("date-naissance");
dateNaissanceInput.addEventListener("change", function () {
    const dateValue = new Date(dateNaissanceInput.value);
    const minDate = new Date("1900-01-01");
    const maxDate = new Date("2024-12-31");
    if (dateValue < minDate || dateValue > maxDate || isNaN(dateValue)) {
        showErrorMessage(dateNaissanceInput, "Veuillez entrer une date de naissance valide entre 01/01/1900 et 31/12/2024.");
    } else {
        hideErrorMessage(dateNaissanceInput);
    }
});

const frequenceRepasInput = document.getElementById("frequence-repas");
frequenceRepasInput.addEventListener("input", function () {
    const repas = parseInt(frequenceRepasInput.value, 10);
    if (repas < 1 || repas > 10 || isNaN(repas)) {
        showErrorMessage(frequenceRepasInput, "Veuillez entrer un nombre de repas entre 1 et 10.");
    } else {
        hideErrorMessage(frequenceRepasInput);
    }
});

const caloriesInput = document.getElementById("preferences-alimentaires");
caloriesInput.addEventListener("input", function () {
    const calories = parseInt(caloriesInput.value, 10);
    if (calories < 1000 || calories > 10000 || isNaN(calories)) {
        showErrorMessage(caloriesInput, "Veuillez entrer un nombre de calories entre 1000 et 10 000.");
    } else {
        hideErrorMessage(caloriesInput);
    }
});

const niveauPhysiqueInput = document.getElementById("stress-niveau");
niveauPhysiqueInput.addEventListener("input", function () {
    const niveau = parseInt(niveauPhysiqueInput.value, 10);
    if (niveau < 1 || niveau > 10 || isNaN(niveau)) {
        showErrorMessage(niveauPhysiqueInput, "Veuillez entrer un niveau entre 1 et 10.");
    } else {
        hideErrorMessage(niveauPhysiqueInput);
    }
});

const sommeilHeuresInput = document.getElementById("sommeil-heures");
sommeilHeuresInput.addEventListener("input", function () {
    const heures = parseFloat(sommeilHeuresInput.value);
    if (heures < 0 || heures > 24 || isNaN(heures)) {
        showErrorMessage(sommeilHeuresInput, "Veuillez entrer un nombre d'heures entre 0 et 24.");
    } else {
        hideErrorMessage(sommeilHeuresInput);
    }
});

const form = document.querySelector("form");
form.addEventListener("submit", function (event) {
    const inputs = form.querySelectorAll("input");
    let allValid = true;
    inputs.forEach((input) => {
        if (!input.value) {
            showErrorMessage(input, "Ce champ est requis.");
            allValid = false;
        }
    });
    if (!allValid) {
        event.preventDefault();
    }
});</script>
    </body>
</html>