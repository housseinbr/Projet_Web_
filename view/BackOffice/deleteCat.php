<?php
include '../../controller/categorieC.php';
$CategorieC = new CategorieC();
$CategorieC->deleteCategorie( $_GET["id"]); 
header('Location:listCat.php');