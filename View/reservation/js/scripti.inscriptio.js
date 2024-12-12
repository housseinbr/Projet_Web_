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


nextBtnFirst.addEventListener("click", function(event) {
    event.preventDefault();
    if (validateBasicInfo()) {
        slidePage.style.marginLeft = "-25%";
        updateProgress();
        current += 1;
    }
});

nextBtnSec.addEventListener("click", function(event) {
    event.preventDefault();
    if (validateContactInfo()) {
        slidePage.style.marginLeft = "-50%";
        updateProgress();
        current += 1;
    }
});

nextBtnThird.addEventListener("click", function(event) {
    event.preventDefault();
    if (validatePersonalInfo()) {
        slidePage.style.marginLeft = "-75%";
        updateProgress();
        current += 1;
    }
});


submitBtn.addEventListener("click", function() {
    updateProgress();
    setTimeout(function() {
        alert("Votre inscription a été réussie !");
        location.reload();
    }, 800);
});

prevBtnSec.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "0%";
    updateProgress(-1);
    current -= 1;
});

prevBtnThird.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "-25%";
    updateProgress(-1);
    current -= 1;
});

prevBtnFourth.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "-50%";
    updateProgress(-1);
    current -= 1;
});

function showError(input, message) {
    let errorLabel = input.parentElement.querySelector('.error');
    if (!errorLabel) {
        errorLabel = document.createElement('label');
        errorLabel.classList.add('error');
        errorLabel.style.color = 'red'; // Appliquer le style rouge
        errorLabel.style.fontSize = '0.9em'; // Taille de police ajustable
        errorLabel.style.marginTop = '5px'; // Espacement au-dessus du message d'erreur
        input.parentElement.appendChild(errorLabel);
    }
    errorLabel.textContent = message;
}

function clearError(input) {
    let errorLabel = input.parentElement.querySelector('.error');
    if (errorLabel) {
        errorLabel.remove();
    }
}

function validateBasicInfo() {
    const nom = document.querySelector('input[name="nom"]');
    const pre = document.querySelector('input[name="pre"]');
    let valid = true;

    if (!nom.value.trim()) {
        showError(nom, "Le champ Nom ne peut pas être vide.");
        valid = false;
    } else {
        clearError(nom);
    }

    if (!pre.value.trim()) {
        showError(pre, "Le champ Prénom ne peut pas être vide.");
        valid = false;
    } else {
        clearError(pre);
    }

    return valid;
}

function validateContactInfo() {
    const email = document.querySelector('input[name="email"]');
    const phone = document.querySelector('input[name="tel"]');
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    const phoneRegex = /^[0-9]{10}$/;
    let valid = true;

    if (!emailRegex.test(email.value.trim())) {
        showError(email, "Adresse email invalide.");
        valid = false;
    } else {
        clearError(email);
    }

    if (!phoneRegex.test(phone.value.trim())) {
        showError(phone, "Numéro de téléphone invalide. Doit contenir 10 chiffres.");
        valid = false;
    } else {
        clearError(phone);
    }

    return valid;
}


function validatePersonalInfo() {
    const age = document.querySelector('input[name="age"]');
    let valid = true;

    if (!age.value.trim() || age.value <= 0) {
        showError(age, "Veuillez entrer un âge valide.");
        valid = false;
    } else {
        clearError(age);
    }

    return valid;
}

function updateProgress(direction = 1) {
    bullet[current - 1].classList.toggle("active", direction > 0);
    progressCheck[current - 1].classList.toggle("active", direction > 0);
    progressText[current - 1].classList.toggle("active", direction > 0);
}

document.querySelectorAll('input').forEach(input => {
    input.addEventListener('keydown', function() {
        clearError(input);
    });
});


function togglePasswordVisibility(id, icon) {
    const passwordField = document.getElementById(id);
    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}