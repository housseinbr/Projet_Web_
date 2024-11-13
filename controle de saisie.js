const poidsInput = document.getElementById("poids");
poidsInput.addEventListener("input", function () {
    const poids = parseFloat(poidsInput.value);
    if (poids < 0 || poids > 300 || isNaN(poids)) {
        poidsInput.setCustomValidity("Veuillez entrer un poids entre 0 et 300 kg.");
    } else {
        poidsInput.setCustomValidity("");
    }
});

const tailleInput = document.getElementById("taille");
tailleInput.addEventListener("focus", function () {
    if (!poidsInput.value) {
        alert("Veuillez remplir votre poids avant de continuer.");
        poidsInput.focus();
    }
});
tailleInput.addEventListener("input", function () {
    const taille = parseFloat(tailleInput.value);
    if (taille < 0 || taille > 300 || isNaN(taille)) {
        tailleInput.setCustomValidity("Veuillez entrer une taille entre 0 et 300 cm.");
    } else {
        tailleInput.setCustomValidity("");
    }
});

const dateNaissanceInput = document.getElementById("date-naissance");
dateNaissanceInput.addEventListener("focus", function () {
    if (!tailleInput.value) {
        alert("Veuillez remplir votre taille avant de continuer.");
        tailleInput.focus();
    }
});
dateNaissanceInput.addEventListener("change", function () {
    const dateValue = new Date(dateNaissanceInput.value);
    const minDate = new Date("1900-01-01");
    const maxDate = new Date("2024-12-31");

    if (dateValue < minDate || dateValue > maxDate || isNaN(dateValue)) {
        dateNaissanceInput.setCustomValidity(
            "Veuillez entrer une date de naissance entre 1900 et 2024."
        );
    } else {
        dateNaissanceInput.setCustomValidity("");
    }
});

const frequenceRepasInput = document.getElementById("frequence-repas");
frequenceRepasInput.addEventListener("focus", function () {
    if (!dateNaissanceInput.value) {
        alert("Veuillez remplir votre date de naissance avant de continuer.");
        dateNaissanceInput.focus();
    }
});
frequenceRepasInput.addEventListener("input", function () {
    const repas = parseInt(frequenceRepasInput.value, 10);
    if (repas < 1 || repas > 10 || isNaN(repas)) {
        frequenceRepasInput.setCustomValidity("Veuillez entrer un nombre de repas entre 1 et 10.");
    } else {
        frequenceRepasInput.setCustomValidity("");
    }
});

const sommeilHeuresInput = document.getElementById("sommeil-heures");
sommeilHeuresInput.addEventListener("focus", function () {
    if (!frequenceRepasInput.value) {
        alert("Veuillez remplir le nombre de repas avant de continuer.");
        frequenceRepasInput.focus();
    }
});
sommeilHeuresInput.addEventListener("input", function () {
    const heures = parseFloat(sommeilHeuresInput.value);
    if (heures < 0 || heures > 24 || isNaN(heures)) {
        sommeilHeuresInput.setCustomValidity("Veuillez entrer un nombre d'heures entre 0 et 24.");
    } else {
        sommeilHeuresInput.setCustomValidity("");
    }
});

const objectifInput = document.getElementById("objectif-principal");
objectifInput.addEventListener("focus", function () {
    if (!sommeilHeuresInput.value) {
        alert("Veuillez remplir le nombre d'heures de sommeil avant de continuer.");
        sommeilHeuresInput.focus();
    }
});

const form = document.querySelector("form");
form.addEventListener("submit", function(event) {
    if (!poidsInput.value || !tailleInput.value || !dateNaissanceInput.value || !frequenceRepasInput.value || !sommeilHeuresInput.value || !objectifInput.value) {
        event.preventDefault(); 
        alert("Veuillez remplir tous les champs avant de soumettre le formulaire.");
    }
});
