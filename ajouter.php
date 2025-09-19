<?php require 'header.php'; ?>
<?php require 'bdd.php'; ?>
<?php require 'functions.php'; ?>




<form action="traitement.php" method="POST">
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
