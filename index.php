<?php
require_once 'login.php';
require_once 'model/EvaluationModel.php'; // Modèle pour gérer les données
require_once 'controller/EvaluationController.php';


// Initialisation de la base de données
$db = (new Database())->getConnection();

// Création du modèle et du contrôleur
$model = new EvaluationModel($db);
$controller = new EvaluationController($model);

// Récupération des données
$data = $model->showAllEvaluations();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau avec Update et Delete</title>
    <style>
        .btn-update {
            background-color: yellow;
            color: black;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .btn-delete {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .btn-update:hover {
            background-color: orange;
        }

        .btn-delete:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <h2>Tableau des Évaluations</h2>

    <table border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Poids</th>
                <th>KCL</th>
                <th>Taille</th>
                <th>Date de Naissance</th>
                <th>Nombre de Repas</th>
                <th>Niveau Physique</th>
                <th>Heures de Sommeil</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data)) {
                foreach ($data as $evaluation) {
                    echo "<tr>";
                    echo "<td>{$evaluation['id_eva']}</td>";
                    echo "<td>{$evaluation['poids']}</td>";
                    echo "<td>{$evaluation['kcl']}</td>";
                    echo "<td>{$evaluation['taille']}</td>";
                    echo "<td>{$evaluation['date_nais']}</td>";
                    echo "<td>{$evaluation['nb_repa']}</td>";
                    echo "<td>{$evaluation['niv_phy']}</td>";
                    echo "<td>{$evaluation['nb_h_dormir']}</td>";
                    echo "<td>{$evaluation['cat']}</td>";
                    echo "<td>
                        <form style='display:inline;' action='view/Backoffice/dashboard/template/update.php' method='POST'>
                            <input type='hidden' name='id' value='{$evaluation['id_eva']}'>
                            <button type='submit' class='btn-update'>Update</button>
                        </form>
                        <form style='display:inline;'action='view/Backoffice/dashboard/template/delete.php' method='POST'>
                            <input type='hidden' name='id' value='{$evaluation['id_eva']}'>
                            <button type='submit' class='btn-delete'>Delete</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Aucune donnée disponible</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
