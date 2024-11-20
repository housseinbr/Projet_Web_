<?php
include(__DIR__ . '/../../../config.php');
include(__DIR__ . '/../../../Controller/RegimeController.php');

$regimeController = new RegimeController();
$regimes = $regimeController->listRegimes();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Régimes</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #1e1e1e; /* Arrière-plan sombre */
            color: #f4f4f4; /* Couleur de texte claire */
        }
        h1 {
            text-align: center;
            color: #4CAF50; /* Vert */
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            background-color: #2a2a2a; /* Fond de tableau sombre */
        }
        th, td {
            border: 1px solid #444; /* Bordures sombres */
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
        }
        th {
            background-color: #4CAF50; /* Vert pour les en-têtes */
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #3a3a3a; /* Couleur des lignes paires */
        }
        tr:hover {
            background-color: #333; /* Couleur neutre au survol */
        }
        a {
            color: #4CAF50; /* Liens verts */
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .description {
            display: none; /* Masquer la description par défaut */
            white-space: pre-line;
            max-width: 900px;
            line-height: 1.2;
        }
        .calories {
            color: blue;
            font-weight: bold;
        }
        .titre {
            width: 200px;
        }
        .kcal {
            width: 150px;
        }
        @media (max-width: 600px) {
            body {
                margin: 10px;
            }
            table {
                font-size: 14px;
            }
        }
        .no-records {
            text-align: center;
            font-style: italic;
            color: #999;
        }
    </style>
    <script>
        function toggleDescription(id) {
            var description = document.getElementById('desc-' + id);
            if (description.style.display === 'none' || description.style.display === '') {
                description.style.display = 'block';
            } else {
                description.style.display = 'none';
            }
        }
    </script>
</head>
<body>

<h1>Liste des Régimes</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th class="titre">Titre</th>
            <th>Description</th>
            <th class="kcal">Kcal</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($regimes->rowCount() > 0): ?>
            <?php foreach ($regimes as $regime): ?>
                <tr>
                    <td><?php echo htmlspecialchars($regime['id_r']); ?></td>
                    <td class="titre"><?php echo nl2br(htmlspecialchars($regime['titre'])); ?></td>
                    <td>
                        <div id="desc-<?php echo $regime['id_r']; ?>" class="description">
                            <?php echo nl2br(htmlspecialchars($regime['discription'])); ?>
                        </div>
                        <button onclick="toggleDescription(<?php echo $regime['id_r']; ?>)">Afficher</button>
                    </td>
                    <td class="kcal"><?php echo htmlspecialchars($regime['kcl']); ?> Kcal</td>
                    <td>
                        <a href="modifier.php?id=<?php echo $regime['id_r']; ?>">Modifier</a> |
                        <a href="ajouter.php?id=<?php echo $regime['id_r']; ?>">Ajouter</a> |
                        <a href="delete.php?id=<?php echo $regime['id_r']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce régime ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="no-records">Aucun régime trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>