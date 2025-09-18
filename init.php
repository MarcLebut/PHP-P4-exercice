<?php
require_once "bdd.php";       // Connexion
require_once "functions.php"; // Fonctions

$pdo = connexion(); // Initialisation de la Variable $pdo

// Appeler ici toutes les créations de tables nécessaires
//createTableOeuvres($pdo);

// Tu peux en rajouter d’autres si besoin, ex : creerTableProduits($pdo);

// Message final
echo "<hr>🚀 Initialisation terminée.";
