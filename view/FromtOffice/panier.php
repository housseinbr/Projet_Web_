<?php
session_start();
include '../../model/paniers.php';
include '../../model/Produit.php';
include '../../controller/ProduitC.php';

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $panier = new paniers();
    $produitC = new ProduitC();
    
    $panier->add($id);
    $q = array();

    foreach ($_SESSION['panier'] as $id){
        $produits[] = $produitC->showProduit($id);
        $q[$id] = 1;
    }
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
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
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
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                    <a href="#" class="text-muted small me-4"><i
                            class="fas fa-map-marker-alt text-primary me-2"></i>Esprit Areana So8ra</a>
                    <a href="tel:+01234567890" class="text-muted small me-4"><i
                            class="fas fa-phone-alt text-primary me-2"></i>+216 27 31 91 64</a>
                    <a href="mailto:example@gmail.com" class="text-muted small me-0"><i
                            class="fas fa-envelope text-primary me-2"></i>HYGEIA@gmail.com</a>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a href="inscription.html"><small class="me-3 text-dark"><i
                                class="fa fa-user text-primary me-2"></i>Création de Compte</small></a>
                    <a href="Connecter.html"><small class="me-3 text-dark"><i
                                class="fa fa-sign-in-alt text-primary me-2"></i>Se connecter</small></a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown"><small><i
                                    class="fa fa-home text-primary me-2"></i> Mon tableau de bord</small></a>
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
                        <a href="index.html" class="nav-item nav-link">Accueil</a>
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
                    <a href="inscription.html"
                        class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Commencer</a>
                </div>
            </nav>
        </div>

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Panier</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">Panier</li>
                </ol>
            </div>
        </div>
        <!-- Header End -->
    </div>
    <!-- Navbar & Hero End -->


    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="row g-4">
            <table class=" table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Prix Total</th>

        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($produits as $item) {
            $idProduit = htmlspecialchars($item->getIdProduit());
            $nom = htmlspecialchars($item->getNom());
            $prix = htmlspecialchars($item->getPrix());
            $quantite = isset($q[$idProduit]) ? $q[$idProduit] : 1; 

            $totalAll = 0;
            $total = $prix * $quantite;
            $totalAll += $total;


            echo "<tr id='product-$idProduit'>";
            echo '<td><img src="../../images/' . htmlspecialchars($item->getImage(), ENT_QUOTES) . '" alt="Product Image" class="card-img-top" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;"></td>';

            echo "<td>$nom</td>";
            echo "<td>$prix</td>";
            echo "<td>";
            echo "<button type='button' class='btn btn-warning' onclick='updateQuantity($idProduit, -1)'>-</button> ";
            echo "<span id='quantity-$idProduit'>$quantite</span> ";
            echo "<button type='button' class='btn btn-success' onclick='updateQuantity($idProduit, 1)'>+</button>";
            echo "</td>";
            echo "<td id='total-$idProduit'>" . ($prix * $quantite) . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<!-- Total Price Card -->
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Total à payer</h5>
        <p class="card-text">Le prix total de tous les produits dans votre panier est: <strong id="totalAll"><?= $totalAll ?></strong> <Strong>TND</Strong></p>
        <a href="addPanier.php" class="btn btn-primary">Passer à la caisse</a>
    </div>
</div>

            </div>
        </div>
    </div>
    <!-- Blog End -->



    <!-- Footer Start -->
    <div class=" container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5 border-start-0 border-end-0"
            style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="footer-item">
                        <a href="index.html" class="p-0">
                            <h4 class="text-white"><i class="fas fa-search-dollar me-3"></i>HYGEIA</h4>
                            <!-- <img src="img/logo.png" alt="Logo"> -->
                        </a>
                        <p class="mb-4">Bienvenue chez Terre & Forme, Notre boutique en ligne spécialisée
                            dans les
                            produits agricoles et de sports. Nous réunissons deux passions : le respect de
                            la terre et
                            le bien-être physique, en proposant des produits de qualité pour cultiver,
                            nourrir et se
                            dépasser.</p>
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
                            <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i
                                    class="fab fa-facebook-f text-white"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i
                                    class="fab fa-twitter text-white"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i
                                    class="fab fa-instagram text-white"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="#"><i
                                    class="fab fa-linkedin-in text-white"></i></a>
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
                    <span class="text-body"><a href="#" class="border-bottom text-white"><i
                                class="fas fa-copyright text-light me-2"></i>HYGEIA</a>, Tous droits
                        réservés.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-body">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Cree par <a class="border-bottom text-white" href="https://htmlcodex.com"> Web Coders</a>
                    Partager
                    par <a class="border-bottom text-white" href="https://themewagon.com">Web Coders</a>
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
    <script>
    // Update the total when quantity is changed
    function updateQuantity(productId, change) {
        let quantityElement = document.getElementById('quantity-' + productId);
        let totalElement = document.getElementById('total-' + productId);
        
        let currentQuantity = parseInt(quantityElement.textContent);
        let price = parseFloat(totalElement.textContent) / currentQuantity;

        let newQuantity = currentQuantity + change;
        if (newQuantity < 1) newQuantity = 1;

        quantityElement.textContent = newQuantity;

        let newTotal = price * newQuantity;
        totalElement.textContent = newTotal.toFixed(0);

        updateTotalPrice();  // Update the total price for all items
    }

    // Update total price for all products
    function updateTotalPrice() {
        let totalAll = 0;
        let totalElements = document.querySelectorAll('[id^="total-"]');
        totalElements.forEach(function (totalElement) {
            totalAll += parseFloat(totalElement.textContent);
        });

        document.getElementById('totalAll').textContent = totalAll.toFixed(0);
    }
</script>



    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>