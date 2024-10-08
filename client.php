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
            <?php include "nav.php"; ?>
        </div>
    </header>

    <div class="container">
        <main id="agent">
            <h2>Informations sur le client</h2>
            <form action="client.php" method="POST">
                <label for="nom">Nom du client&entreprise:</label>
                <input type="text" id="nom" name="nom" pattern="[a-zA-Z0-9]+" required>

                <label for="adresse">Adresse</label>
                <input type="text" id="adresse" name="adresse" pattern="[a-zA-Z0-9]+" required>

                <label for="numero-employe">Nombre d'Employeés:</label>
                <input type="number" id="numero-employe" name="num-employe" required>

                <button type="submit" name="btnValider">Envoyer</button>
            </form>
        </main>
        <?php 
    
            if(isset($_POST['btnValider'])){
                $nom = ucfirst($_POST["nom"]);
                $adresse = $_POST['adresse'];
                $employe = $_POST['num-employe'];

                // Vérifier si le client existe déjà dans la base de données avec nom, adresse et num-employe
                $check_duplicate = $bdd->prepare("SELECT * FROM client WHERE nom_client = :nom AND adresse = :adresse AND nombre_agent = :employe");
                $check_duplicate->bindParam(':nom', $nom);
                $check_duplicate->bindParam(':adresse', $adresse);
                $check_duplicate->bindParam(':employe', $employe);
                $check_duplicate->execute();

                // Si le client n'existe pas, on procède à l'insertion
                if ($check_duplicate->rowCount() == 0) {
                    $client_insertion = "INSERT INTO client (nom_client, nombre_agent, adresse) VALUES ('$nom', '$employe', '$adresse')";      
                    $bdd->exec($client_insertion );
                    header("location:affichage-client.php");
                } else {
                    echo "<p class='register'>Cet Client existe déjà dans la base de données.</p>";
                }

               
            }
        
        ?>

<?php include "footer.php" ?>

