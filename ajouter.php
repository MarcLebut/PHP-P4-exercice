<?php require 'header.php'; ?>
<?php require 'bdd.php'; ?>
<?php require 'functions.php'; ?>
<?php
// Traitement du formulaire d'ajout des oeuvres
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $artiste = $_POST['artiste'];
    $image = $_POST['image'];
    $description = $_POST['description'];
   

    // Ajouter le produit
    $result = ajouterOeuvre($titre, $artiste, $image, $description);

    if ($result) {
        $success = "Oeuvre ajouté avec succès.";
    } else {
        $error = "Erreur lors de l'ajout du Oeuvre.";
    }
}




?>

<!-- Affichage des messages -->
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

<form action="" method="POST">
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste" id="artiste">
    </div>

    <div class=" champ-formulaire mb-3">
        <label for="image" class="form-label">image</label>
        <input type="text" class="form-control" id="image" name="image" required>
    </div>
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require 'footer.php'; ?>
