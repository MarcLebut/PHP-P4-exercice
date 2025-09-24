<?php
##################################### Fonction pour la connexion à la BDD #############################

// On vas utiliser l'extension PHP Data Objects (PDO), elle définit une excellente interface pour accéder à une base de données depuis PHP et d'exécuter des requêtes SQL .
// Pour se connecter à la BDD avec PDO il faut créer une instance de cet Objet (PDO) qui représente une connexion à la base,  pour cela il faut se servir du constructeur de la classe
// Ce constructeur demande certains paramètres:
// On déclare des constantes d'environnement qui vont contenir les information à la connexion à la BDD

// constante du serveur => localhost
define("DBHOST", "localhost");

// constante de l'utlisateur de la BDD du serveur en local => root
define("DBUSER", "root");

// contante pour le mot de pase de serveur en local => pas de mot de passe 
define("DBPASS", "");

// constante pour le nom de la BDD
define("DBNAME", "ArtBox");


function connexion()
{

    //DSN (Data Source Name)
    // $dsn = mysql:host=localhost;dbname=cinema;charset=utf8;
    $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

    //Grâce à PDO on peut lever une exception (une erreur) si la connexion à la BDD ne se réalise pas(exp: suite à une faute au niveau du nom de la BDD) et par la suite si  cette erreur est capté on lui demande d'afficher une erreur

    try { // dans le try on vas instancier PDO, c'est créer un objet de la classe PDO (un élément de PDO)
        // avec la variable dsn et les constantes d'environnement

        $pdo = new PDO($dsn, DBUSER, DBPASS);
        // echo "je suis connectée";

        //On définit le mode d'erreur de PDO sur Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {  // PDOException est une classe qui représente une erreur émise par PDO et $e c'est l'objetde la clase en question qui vas stocker cette erreur

        die("Erreur : " . $e->getMessage()); // die permet d'arrêter le PHP et d'afficher une erreur en utilisant la méthode getMessage de l'objet $e
    }

    //le catch sera exécuter dès lors on aura un problème da le try

    return $pdo;  //ici on utilise un return car on récupère l'objet de la fonction que l'on vas appelé  dans plusieurs autre fonctions

}

