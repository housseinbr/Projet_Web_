// Sélection des éléments HTML et vérification s'ils existent
const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");
let current = 1;

// Fonction pour ajouter la classe active à l'étape courante
function activateStep() {
    bullet[current - 1].classList.add("active");
    progressCheck[current - 1].classList.add("active");
    progressText[current - 1].classList.add("active");
}

// Fonction pour retirer la classe active de l'étape courante
function deactivateStep() {
    bullet[current - 2].classList.remove("active");
    progressCheck[current - 2].classList.remove("active");
    progressText[current - 2].classList.remove("active");
}

// Vérifie que chaque bouton existe avant d'ajouter un écouteur d'événement
if (nextBtnFirst && slidePage) {
    nextBtnFirst.addEventListener("click", function(event) {
        event.preventDefault();
        slidePage.style.marginLeft = "-25%";
        activateStep();
        current += 1;
    });
}

if (nextBtnSec && slidePage) {
    nextBtnSec.addEventListener("click", function(event) {
        event.preventDefault();
        slidePage.style.marginLeft = "-50%";
        activateStep();
        current += 1;
    });
}

if (nextBtnThird && slidePage) {
    nextBtnThird.addEventListener("click", function(event) {
        event.preventDefault();
        slidePage.style.marginLeft = "-75%";
        activateStep();
        current += 1;
    });
}

if (submitBtn) {
    submitBtn.addEventListener("click", function() {
        activateStep();
        current += 1;
        setTimeout(function() {
            // Recharge la page après un court délai pour simuler une soumission
            location.reload();
        }, 800);
    });
}

if (prevBtnSec && slidePage) {
    prevBtnSec.addEventListener("click", function(event) {
        event.preventDefault();
        slidePage.style.marginLeft = "0%";
        deactivateStep();
        current -= 1;
    });
}

if (prevBtnThird && slidePage) {
    prevBtnThird.addEventListener("click", function(event) {
        event.preventDefault();
        slidePage.style.marginLeft = "-25%";
        deactivateStep();
        current -= 1;
    });
}

if (prevBtnFourth && slidePage) {
    prevBtnFourth.addEventListener("click", function(event) {
        event.preventDefault();
        slidePage.style.marginLeft = "-50%";
        deactivateStep();
        current -= 1;
    });
}

// Fonction pour basculer la visibilité du mot de passe
function togglePasswordVisibility(id, icon) {
    const passwordField = document.getElementById(id);
    if (passwordField && icon) {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    } else {
        console.error("L'élément passwordField ou l'icône est introuvable.");
    }
}
