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

<?php include "connexion.php" ?>
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

    <div class="container">
        <main id="agent">
            <h2>Informations sur le client</h2>
            <form action="contrat.php" method="POST">
                <label for="date_signature">La date de signature</label>
                <input type="date" id="date_signature" name="date_signature" required>
                <label for="contenu">Article</label>
                <input type="text" id="contenu" name="contenu" pattern="[a-zA-Z ]+" required>
                <label for="date_expiration">La date de expiration</label>
                <input type="date" id="date_expiration" name="date_expiration" required>

                <button type="submit" name="btnValider">Envoyer</button>
            </form>
        </main>

<?php 
    
    if(isset($_POST['btnValider'])){
        $Recupdate = $_POST['date_signature'];
        $Recucontenu = $_POST['contenu'];
        $Recupdate2 = $_POST['date_expiration'];

        // Vérifier si un contrat avec les mêmes données existe déjà
        $check_duplicate = $bdd->prepare("SELECT * FROM contrat WHERE date_signature = :date_signature AND contenu = :contenu AND date_expiration = :date_expiration");
        $check_duplicate->bindParam(':date_signature', $Recupdate);
        $check_duplicate->bindParam(':contenu', $Recucontenu);
        $check_duplicate->bindParam(':date_expiration', $Recupdate2);
        $check_duplicate->execute();

            // Si aucun doublon n'est trouvé, insérer les données
    if ($check_duplicate->rowCount() == 0) {
        $contrat_insertion = "INSERT INTO contrat (date_signature, contenu , date_expiration) VALUES ('$Recupdate', '$Recucontenu', '$Recupdate2')";      

        $bdd->exec($contrat_insertion );
        header("location:affichage-contrat.php");
    } else {
        echo "<p class='register'>Un contrat avec les mêmes informations existe déjà dans la base de données.</p>";
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
