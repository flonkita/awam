# Calculateur de Taux de Change

## Description
Ce projet est une application simple en PHP qui permet de calculer la somme de deux montants exprimés dans des devises différentes. Les taux de change sont fixes, et le résultat final est arrondi à l'entier inférieur.

L'interface web permet à l'utilisateur de :
- Saisir deux montants et leurs devises respectives.
- Obtenir le résultat de la somme dans une devise choisie (ou par défaut).
- Visualiser l'historique des calculs.

## Fonctionnalités
1. **Calcul des montants avec taux de change fixes** :
   - `1 USD` est la devise de référence.
   - `1 EUR = 1.1 USD`.

2. **Résultats spécifiques imposés** :
   - ( 100 USD + 100 USD = 200 USD )
   - ( 10 EUR + 5 EUR = 15 EUR )
   - ( 100 USD + 5 EUR = 95 EUR )

3. **Arrondi à l'entier inférieur** pour tous les autres calculs.

4. **Historique des calculs** :
   - Chaque calcul est sauvegardé dans un fichier JSON (`historique.json`) pour consultation ultérieure.

5. **Redirection vers une interface utilisateur** avec le résultat affiché.

---

## Installation

1. Clonez ce projet sur votre machine :
   ```bash
   git clone https://github.com/votre-utilisateur/calculateur-taux-change.git
   ```

---

## Utilisation
Lancez votre serveur local et ouvrez index.php dans un navigateur avec : 
```
php -S localhost:8000
```
Exemple : http://localhost:8000/index.php

Remplissez le formulaire avec les montants et les devises.

Cliquez sur "Calculer" pour obtenir le résultat.

Le résultat est affiché sur la page, accompagné de la devise.

### Évolutions possibles

**Court terme** :
- *Ajout de nouvelles devises* :

Ajouter des taux dans le tableau $tauxDeChange de calcul.php.

- *Affichage de l'historique* :

Créer une page dédiée pour lire le fichier historique.json.

**Long terme** :

- *Taux de change dynamique* :

Connecter l'application à une API de taux de change en temps réel, comme Open Exchange Rates.

- *Interface utilisateur améliorée* :

Utiliser un framework comme Bootstrap ou TailwindCSS.

- *Architecture MVC* : 

Séparer les couches (modèle, vue, contrôleur) pour une meilleure lisibilité.

- *Base de données* : 

Utiliser MySQL ou SQLite pour stocker les taux de change et l’historique.

- *Envoi automatique d'e-mails* :

Implémenter une tâche cron pour envoyer l'historique des calculs du jour par e-mail.

---
### Problèmes Rencontrés

**Arrondi**: 

Durant cet exo, pendant la conversion de dollars/euros ( 100 USD + 5 EUR ), j'avais d'abord 95,909 EUR où j'ai utilisé la fonction round (qui arrondit) mais à 96 donc pour contrer ça j'ai utilisé la fonction floor pour arrondir le résultat à l'entier inférieur soit 95 EUR

**Email**

Pour le mail j'avais pensé à faire envoyer les résultats d'historiques à X par le biais d'un champ de formulaire email où ça enverra tout les calculs de manière ordonnée de la façon suivante :
```
// Optionnel : envoyer un email
if (isset($_GET['sendEmail'])) {
    $to = "client@example.com";
    $subject = "Historique des calculs";
    $message = print_r($historique, true);
    mail($to, $subject, $message);
    echo "Email envoyé avec succès !";
}
```