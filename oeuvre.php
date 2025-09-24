<?php
    require 'header.php';
    require 'bdd.php';
    require 'functions.php';


    

    // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil


$id = $_GET['id'] ?? header('Location: index.php');

if ($id) {
    // Récupérer les informations de l'oeuvre depuis la base de données
    $oeuvre = OeuvreById($id);
    if (!$oeuvre) {
        header('Location: index.php');
        exit;
    }
}

?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
