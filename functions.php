<?php

################################# Création des tables  ###########################


//Table Oeuvres
/*
nom de l'œuvre ; 
nom de l'artiste ;
lien vers la photo de l'œuvre ;
description de l’œuvre.
*/

function createTableOeuvres()
{
    $cnx = connexion();
    $sql = " CREATE TABLE IF NOT EXISTS Oeuvres (
                    id_oeuvre INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    titre VARCHAR(100) NOT NULL,
                    artiste VARCHAR(100) NOT NULL,
                    image VARCHAR(250) NOT NULL,
                    description TEXT NOT NULL
                    )";
    $request = $cnx->exec($sql);
};
// createTableOeuvres();

############################################### Fonction d'affichage des données de la BDD #############################################################

/**
 * Je crée une fonction qui me permet de récupérer toutes les œuvres enregistrées dans ma base de données.
 * Je retourne le résultat sous forme d'un tableau associatif, facile à parcourir et à afficher.
 */
function AllOeuvres(): mixed
{
    // Je me connecte à ma base de données grâce à la fonction connexion() que j’ai définie ailleurs.
    $cnx = connexion();

    // J’écris ma requête SQL : je demande à récupérer toutes les colonnes et toutes les lignes de la table "oeuvres".
    $sql = "SELECT * FROM oeuvres";

    // J’exécute la requête SQL sur ma connexion à la base de données.
    // La méthode query() envoie directement la requête et me renvoie un objet contenant les résultats.
    $request = $cnx->query($sql);

    // Je transforme l’objet de résultats en tableau associatif.
    // Chaque ligne devient un tableau, avec pour clés les noms des colonnes de la table.
    // fetchAll(PDO::FETCH_ASSOC) me permet de manipuler facilement mes données ensuite dans mon code.
    $result = $request->fetchAll(PDO::FETCH_ASSOC);

    // Je retourne le tableau contenant toutes les œuvres.
    // Ainsi, je pourrai l’utiliser dans d’autres fichiers (par exemple pour les afficher sur ma page d’accueil).
    return $result;
};

/**
 * Je crée une fonction qui me permet de récupérer une œuvre précise dans ma base de données,
 * en fonction de son identifiant unique (id).
 * Je retourne le résultat sous forme de tableau associatif, ce qui me permet d'accéder
 * facilement aux informations de l’œuvre (titre, artiste, image, etc.).
 */
function OeuvreById(int $id): mixed
{
    // Je me connecte à ma base de données grâce à la fonction connexion() déjà existante.
    $cnx = connexion();

    // J’écris ma requête SQL : je veux toutes les colonnes (*) de la table "oeuvres",
    // mais seulement pour l’œuvre qui possède l’id que je vais fournir.
    // J’utilise un paramètre nommé (:id) pour sécuriser la requête et éviter les injections SQL.
    $sql = "SELECT * FROM oeuvres WHERE id = :id";

    // Je prépare ma requête avec prepare(), ce qui me permet de lier ensuite une valeur au paramètre :id.
    $request = $cnx->prepare($sql);

    // J’exécute la requête en remplaçant :id par la valeur de la variable $id passée en argument.
    $request->execute([':id' => $id]);

    // Comme je cherche une seule œuvre, j’utilise fetch() (et non fetchAll),
    // pour récupérer uniquement la première ligne trouvée sous forme de tableau associatif.
    $result = $request->fetch(PDO::FETCH_ASSOC);

    // Je retourne les informations de l’œuvre.
    // Si l’id n’existe pas, la fonction retournera "false".
    return $result;
};

// Ajouter Oeuvre : 
function ajouterOeuvre($titre, $artiste, $image, $description) {
    $cnx = connexion();
    $requete = $cnx->prepare("INSERT INTO oeuvres (titre, artiste, image, description) VALUES (?, ?, ?, ?)");
    return $requete->execute([$titre, $artiste, $image, $description]);
}


