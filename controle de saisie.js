function showErrorMessage(inputElement, message) {
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
});