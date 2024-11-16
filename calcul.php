<?php
// Définition des taux de change fixes
$tauxDeChange = [
    'USD' => 1,    // Dollar comme référence
    'EUR' => 1.1,  // 1 EUR = 1.1 USD
];

// Récupération des données du formulaire
$valeur1 = isset($_POST['valeur1']) ? (float) $_POST['valeur1'] : 0;
$valeur2 = isset($_POST['valeur2']) ? (float) $_POST['valeur2'] : 0;
$devise1 = isset($_POST['devise1']) ? $_POST['devise1'] : 'USD';
$devise2 = isset($_POST['devise2']) ? $_POST['devise2'] : 'USD';

// Calcul des montants en USD
$montantUSD = ($valeur1 * $tauxDeChange[$devise1]) + ($valeur2 * $tauxDeChange[$devise2]);

// On choisit une devise finale pour l'affichage
$deviseFinale = $devise2;
$resultat = floor( $montantUSD / $tauxDeChange[$deviseFinale]);

// Stockage dans l’historique
$historique = json_decode(file_get_contents('historique.json'), true) ?? [];
$historique[] = [
    'valeur1' => $valeur1,
    'devise1' => $devise1,
    'valeur2' => $valeur2,
    'devise2' => $devise2,
    'resultat' => $resultat,
    'date' => date('Y-m-d H:i:s'),
];
file_put_contents('historique.json', json_encode($historique));


// Fonction d'envoi d'email avec l'historique
function envoyerHistoriqueParEmail($historique)
{
    // Formater l'historique en texte
    $emailContent = "Historique des calculs de taux de change :\n\n";
    foreach ($historique as $calcul) {
        $emailContent .= "Date: " . $calcul['date'] . "\n";
        $emailContent .= "Montant 1: " . $calcul['valeur1'] . " " . $calcul['devise1'] . "\n";
        $emailContent .= "Montant 2: " . $calcul['valeur2'] . " " . $calcul['devise2'] . "\n";
        $emailContent .= "Résultat: " . $calcul['resultat'] . " " . $calcul['deviseResultat'] . "\n\n";
    }

    // Destinataire de l'email
    $to = "client@example.com";  // Remplacez par l'adresse e-mail du client
    $subject = "Historique des calculs de taux de change";
    $headers = "From: webmaster@example.com\r\n";  // Remplacez par votre adresse e-mail

    // Envoi de l'e-mail
    mail($to, $subject, $emailContent, $headers);
}

// Envoyer l'historique par email
envoyerHistoriqueParEmail($historique);

// Redirection vers index.php avec les résultats dans l'URL
header("Location: index.php?resultat=" . urlencode($resultat) . "&deviseResultat=" . urlencode($deviseFinale));
exit;
