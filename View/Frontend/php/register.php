<?php
include 'fonction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    connection_a_la_base();
    enregistre_les_information();
} else {
    echo "Aucune donnée soumise.";
}
?>
