<?php
require_once 'login.php';

$db = (new Database())->getConnection();

if ($db) {
    echo "Connexion réussie à la base de données 'login'.";
} else {
    echo "Erreur de connexion.";
}
