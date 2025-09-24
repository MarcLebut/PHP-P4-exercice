<?php require 'header.php'; ?>
<?php require 'bdd.php'; ?>
<?php require 'functions.php'; ?>


<?php
// Traitement du formulaire d'ajout des oeuvres — version simplifiée
$success = $error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Anti-XSS basique : on retire les balises, on trim, et on borne la longueur
    $titre = mb_substr(trim(strip_tags($_POST['titre'] ?? '')), 0, 100, 'UTF-8');    
    $artiste = mb_substr(trim(strip_tags($_POST['artiste'] ?? '')), 0, 100, 'utf-8');
    $image = mb_substr(trim(strip_tags($_POST['image'] ?? '')), 0, 3000, 'utf-8');
    $description = mb_substr(trim(strip_tags($_POST['description'] ?? '')), 0, 3000, 'utf-8');

    // Vérifs essentielles (non vide)
    // Vérifications essentielles (non vide et longueur minimale)
    // Vérifications essentielles (non vide et longueur minimale)
    if ($titre === '' || $artiste === '' || $description === '' || mb_strlen($description, 'UTF-8') < 3) {
        $error = "Veuillez remplir tous les champs et saisir une description d'au moins 3 caractères.";
        
    } else {
        // Image : URL http(s) OU chemin local commençant par '/'
        $isHttp = filter_var($image, FILTER_VALIDATE_URL) && preg_match('~^https?://~i', $image);
        $isLocal = preg_match('~^/[^<>"\']+$~', $image);

        if (!$isHttp && !$isLocal) {
            $error = "L\'image doit être une URL http(s) valide ou un chemin local commençant par '/'.";
        } else {
            // Insertion si tout est OK
            $ok = ajouterOeuvre($titre, $artiste, $image, $description);
            if ($ok) {
                $success = "Oeuvre ajoutée avec succès.";
            } else {
                $error = "Erreur lors de l'ajout de l'œuvre.";
            }
        }
    }

    

    if ($success !== null) {
        echo "<div class=\"alert alert-success\">" . htmlspecialchars($success) . "</div>";
    } elseif ($error !== null) {
    echo 
    "<div class=\"alert alert-danger\">" . htmlspecialchars($error) . "</br>
        <div>
            <a href='ajouter.php'>
                <button class='alert alert-success'><strong>Retour au formulaire</strong></button>
            </a>
        </div>
    </div>";
}

}