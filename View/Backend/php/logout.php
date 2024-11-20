<?php
session_start();
include_once '../../../Controller/utilisateur_controller.php';

$controller = new utilisateur_controller();
$controller->logout_user();

header("Location: login.php");
exit();
?>
