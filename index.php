<?php
// Vérification si un résultat est passé via la méthode GET
$resultat = isset($_GET['resultat']) ? $_GET['resultat'] : null;
$deviseResultat = isset($_GET['deviseResultat']) ? $_GET['deviseResultat'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcul de taux de change</title>
</head>

<body>
    <form action="calcul.php" method="POST">
        <input type="number" name="valeur1" placeholder="Montant 1" required>
        <select name="devise1">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
        </select>
        <input type="number" name="valeur2" placeholder="Montant 2" required>
        <select name="devise2">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
        </select>
        <button type="submit">Calculer</button>
    </form>

    <?php if ($resultat && $deviseResultat): ?>
        <h2>Résultat : <?php echo htmlspecialchars($resultat); ?> <?php echo htmlspecialchars($deviseResultat); ?></h2>
    <?php endif; ?>
</body>

</html>