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
        <?php include "nav.php"; ?>
        </div>
    </header>
 
    <div class="container">
        <main id="agent">
            <h2>Publication du jour</h2>
            <form action="publication.php" method="POST">
                <label for="date_pub">La date du jour</label>
                <input type="date" id="date_pub" name="date_pub" required>
                <label for="article">Article</label>
                <input type="text" id="article" name="article" pattern="[a-zA-Z0-9 ]+" required>
                <button type="submit" name="btnValider">Envoyer</button>
            </form>
        </main>

        <?php 
    
            if(isset($_POST['btnValider'])){
                $Recupdate = $_POST['date_pub'];
                $Recuparticle = $_POST['article'];

                 // Vérifier si une publication avec la même date et le même article existe déjà
                $check_duplicate = $bdd->prepare("SELECT * FROM publication WHERE date_pub = :date_pub AND article = :article");
                $check_duplicate->bindParam(':date_pub', $Recupdate);
                $check_duplicate->bindParam(':article', $Recuparticle);
                $check_duplicate->execute();

                // Si aucun doublon n'est trouvé, insérer les données
                if ($check_duplicate->rowCount() == 0) {
                    $publication_insertion = "INSERT INTO publication (date_pub, article) VALUES ('$Recupdate', '$Recuparticle')";

                    $bdd->exec($publication_insertion );
                    header("location:affichage-pub.php");
                    
                    header("location:affichage-pub.php");
                } else {
                    echo "<p class='register failed'>Cette publication avec cette date et cet article existe déjà dans la base de données.</p>";
                }
            }

        ?>

<?php include "footer.php" ?>

