<?php
include 'fonction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    connection_a_la_base();
    connection_de_utilisateur();
} else {
    echo "Aucune donnée soumise.";
}
?>
