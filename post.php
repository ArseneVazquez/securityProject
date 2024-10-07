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
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="propos.php">À propos de</a></li>
                    <li><a href="service.php">Nos services</a></li>
                    <li><a href="publication.php">Publications</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php include "connexion.php" ?>
    <div class="container">
        <main id="agent">
            <h2>Informations sur les Employeés</h2>
            <form action="post.php" method="POST">
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
    
            if(isset($_POST['btnValider'])){
                $nom_agent = ucfirst($_POST['nom']);
                $numero_matricule = $_POST['numero'];
                $adresse_mission = $_POST['adresse'];

                // Vérifier si un post avec le même numéro matricule et adresse de mission existe déjà
                $check_duplicate = $bdd->prepare("SELECT * FROM post WHERE nom_agent= :nom_agent AND numero_matricule = :numero_matricule AND adresse_mission = :adresse_mission");
                $check_duplicate->bindParam(':numero_matricule', $nom_agent);
                $check_duplicate->bindParam(':numero_matricule', $numero_matricule);
                $check_duplicate->bindParam(':adresse_mission', $adresse_mission);
                $check_duplicate->execute();

                // Si aucun doublon n'est trouvé, insérer les données
                if ($check_duplicate->rowCount() == 0) {
                    $post_insertion = "INSERT INTO post (nom_agent, numero_matricule, adresse_mission) VALUES ('$nom_agent', '$numero_matricule', '$adresse_mission')";      

                    $bdd->exec($post_insertion );
                    header("location:affichage-post.php");
                } else {
                    echo "<p class='register failed'>Ce post avec ce numéro matricule et cette adresse existe déjà dans la base de données.</p>";
                }

                
            }
        
        ?>

        <footer>
            <p>The KEY SECURITY<br>
                Bujumbura, Commune Mukaza, Avenue du progrès<br>
                Téléphone: 22224501/72002005<br>
                email: <a href="mailto:keysec2024@gmail.com">keysec2024@gmail.com</a>
            </p>
        </footer>
    </div>
</body>
</html>
