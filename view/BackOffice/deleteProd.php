<?php
include '../../controller/ProduitC.php';
$ProduitC = new ProduitC();
$ProduitC->deleteProduit(ide: $_GET["id"]); 
header('Location:listProd.php');