<?php

class Paniers {

    public function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }
    }

    public function add($productID) {
        if (!in_array($productID, $_SESSION['panier'])) {
            $_SESSION['panier'][] = $productID;
        }
    }
}

?>