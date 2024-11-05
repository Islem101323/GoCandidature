<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $statut_etudiant = $_POST['statut_etudiant'];
    $filiere = $_POST['filiere'];
    $niveau = $_POST['niveau'];
    $cin = $_POST['cin'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $lieu_naissance = $_POST['lieu_naissance'];
    $sexe = $_POST['sexe'];
    $nationalite = $_POST['nationalite'];
    $nationalite_autre = isset($_POST['nationalite_autre']) ? $_POST['nationalite_autre'] : '';

    // Traitement des fichiers uploadés
    $uploads_dir = 'uploads';
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }

    $file_paths = [];
    foreach (['photo_identite', 'photo_releve', 'photo_cin', 'photo_bac', 'photo_paiement'] as $file_field) {
        if (isset($_FILES[$file_field]) && $_FILES[$file_field]['error'] == 0) {
            $file_name = basename($_FILES[$file_field]['name']);
            $target_path = "$uploads_dir/$file_name";
            move_uploaded_file($_FILES[$file_field]['tmp_name'], $target_path);
            $file_paths[$file_field] = $target_path;
        }
    }

    // Affichage d'une confirmation
    echo "<p>Formulaire soumis avec succès.</p>";
    echo "<p>Statut de l'étudiant : $statut_etudiant</p>";
    echo "<p>Filière : $filiere</p>";
    echo "<p>Niveau : $niveau</p>";
    echo "<p>Nom : $nom</p>";
    echo "<p>Prénom : $prenom</p>";
    echo "<p>Date de naissance : $date_naissance</p>";
    echo "<p>Lieu de naissance : $lieu_naissance</p>";
    echo "<p>Sexe : $sexe</p>";
    echo "<p>Nationalité : $nationalite $nationalite_autre</p>";

    foreach ($file_paths as $field => $path) {
        echo "<p>Fichier $field : $path</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche de renseignements et d'inscription en ligne</title>
</head>
<body>

<h1>Fiche de renseignements et d'inscription en ligne</h1>

<form action="" method="POST" enctype="multipart/form-data">
    <p>Vous êtes :
        <select name="statut_etudiant">
            <option value="">Sélectionnez</option>
            <option value="nouveau_bac_2022">Nouvel étudiant - baccalauréat 2022</option>
            <option value="nouveau_bac_reoriente">Nouvel étudiant - baccalauréat 2022 (réorienté août)</option>
            <option value="ancien_etudiant">Ancien étudiant</option>
            <option value="ancien_reoriente_mars">Ancien étudiant (réorienté mars)</option>
            <option value="ancien_retour">Ancien étudiant (retour aux études après une rupture)</option>
            <option value="nouveau_mastere">Nouvel étudiant (mastère)</option>
            <option value="etudiant_derogatoire">Étudiant dérogatoire</option>
            <option value="etudiant_etranger">Étudiant étranger</option>
        </select>
    </p>

    <hr>
    <h3>Informations générales de l'étudiant :</h3>
    <p>Filière :
        <select name="filiere">
            <option value="">Sélectionnez</option>
            <option value="licence_informatique_gestion">Licence en informatique de gestion</option>
            <option value="licence_sciences_gestion">Licence en sciences de gestion</option>
            <option value="licence_sciences_economiques">Licence en sciences économiques</option>
            <option value="licence_sciences_informatique">Licence en sciences de l'informatique</option>
            <option value="licence_ingenierie_systemes">Licence en ingénierie des systèmes informatiques</option>
        </select>
    </p>

    <p>Niveau :
        <select name="niveau">
            <option value="">Sélectionnez</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
    </p>

    <p>
        <label for="cin">CIN :</label>
        <input type="text" name="cin" id="cin" size="10">
    </p>

    <p>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" size="10">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" size="10">
    </p>

    <p>
        <label for="date_naissance">Date de naissance :</label>
        <input type="date" name="date_naissance" id="date_naissance">
        <label for="lieu_naissance">Lieu de naissance :</label>
        <input type="text" name="lieu_naissance" id="lieu_naissance" size="10">
    </p>

    <p>Sexe :
        <input type="radio" name="sexe" value="masculin"> Masculin
        <input type="radio" name="sexe" value="feminin"> Féminin
    </p>

    <p>Nationalité :
        <input type="radio" name="nationalite" value="tunisienne"> Tunisienne
        <input type="radio" name="nationalite" value="autre"> Autre
        <input type="text" name="nationalite_autre" size="10">
    </p>

    <hr>
    <h3>Dossier numérique :</h3>
    <p>Photos d'identité :
        <input type="file" name="photo_identite">
    </p>
    <p>Photos de relevé de note :
        <input type="file" name="photo_releve">
    </p>
    <p>Photo de la carte d'identité :
        <input type="file" name="photo_cin">
    </p>
    <p>Photo de baccalauréat :
        <input type="file" name="photo_bac">
    </p>
    <p>Photo de paiement :
        <input type="file" name="photo_paiement">
    </p>

    <p><input type="submit" value="Envoyer"></p>
</form>

</body>
</html>
