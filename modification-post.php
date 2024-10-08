<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agents - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>



    
    form {
    display: flex;
    flex-direction: column;
    max-width: 400px; /* Largeur maximale du formulaire */
    margin: 20px auto; /* Centre le formulaire */
}
h2{
    color: green;

}

label {
    margin-bottom: 5px; /* Espacement entre le label et le champ */
    font-weight: bold; /* Met le texte en gras */
}

input {
    margin-bottom: 15px; /* Espacement entre les champs */
    padding: 10px; /* Espacement intérieur */
    border: 1px solid #ccc; /* Bordure du champ */
    border-radius: 5px; /* Arrondi des coins */
}

button {
    background-color: #e74c3c; /* Couleur de fond du bouton */
    color: white; /* Couleur du texte */
    padding: 10px; /* Espacement intérieur */
    border: none; /* Supprime la bordure */
    border-radius: 5px; /* Arrondi des coins */
    cursor: pointer; /* Change le curseur au survol */
    transition: background-color 0.3s; /* Animation lors du survol */
    margin-left: 70px;
    font-size: 19px;
    
}

button:hover {
    background-color: #c0392b; /* Couleur de fond au survol */
}

button:hover {
    background-color: #c0392b; /* Couleur de fond au survol */
}

.register {
        color: white;
        font-weight: bold;
        background-color: #e74c3c; /* Rouge vif */
        border: 2px solid #c0392b; /* Bordure légèrement plus foncée */
        padding: 15px 20px;
        border-radius: 8px;
        text-align: center;
        width: 50%;
        margin: 20px auto; /* Centre horizontalement */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ombre pour un effet 3D */
        font-family: 'Arial', sans-serif;
        font-size: 18px;
        transition: transform 0.3s ease-in-out;
    }
        
    /* Ajout d'un léger effet au survol */
.register:hover {
    transform: scale(1.05); /* Agrandit légèrement l'élément au survol */
    background-color: #c0392b; /* Change légèrement la couleur au survol */
}

</style>
<body>
    <header>
        <div class="tit"><h1>The KEY SECURITY</h1></div>
        <div class="lnk">
        <?php include "nav.php"; ?>
        </div>
    </header>
    <?php 
include "connexion.php"; 

    $id_post = $_GET['mod'];
    $modifPost = $bdd->prepare("SELECT * FROM post WHERE id_post = ?");
    $modifPost->execute([$id_post]);
    $dataRecup = $modifPost->fetch();

?>
    <div class="container">
        <main id="agent">
            <h2>Informations sur les Employeés</h2>
            <form action="" method="POST">
                <label for="nom">Nom_employé</label>
                <input type="text" id="nom" name="nom" pattern="[a-zA-Z0-9 ]+" required>
                <label for="numero-matricule">Numero-matricule</label>
                <input type="number" id="numero-matricule" name="numero" required>

                <label for="adresse">Adresse_mission</label>
                <input type="text" id="numero-matricule" name="adresse" pattern="[a-zA-Z0-9 ]+" required><br>

                <button type="submit" name="btnValider">Envoyer</button>
            </form>
        </main>

        <?php 
    
            if (isset($_POST['btnValider'])) {
                $nom_agent = ucfirst($_POST['nom']);
                $numero_matricule = $_POST['numero'];
                $adresse_mission = $_POST['adresse'];
            
                // Mettre à jour le post dans la base de données
                $updatePost = $bdd->prepare("UPDATE post SET nom_agent = ?, numero_matricule = ?, adresse_mission = ? WHERE id_post = ?");
                $updatePost->execute([$nom_agent, $numero_matricule, $adresse_mission, $id_post]);
            
                // Redirection après la mise à jour
                header("Location: affichage-post.php");
                exit;
            }
        
        ?>
 <?php include "footer.php" ?>

