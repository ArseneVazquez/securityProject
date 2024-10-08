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
            <h2>Informations sur le client</h2>
            <form action="fonction.php" method="POST">
                <label for="numero-matricule">Numéro Matricule</label>
                <input type="number" id="numero-matricule" name="numero" required>
                <label for="role">Role</label>
                <input type="text" id="role" name="rol" pattern="[a-zA-Z0-9 ]+" required>

                <button type="submit" name="btnValider">Envoyer</button>
            </form>
        </main>
        <?php 
    
            if(isset($_POST['btnValider'])){
                $numero_matricule = $_POST['numero'];
                $rol = $_POST['rol'];   
                
                // Vérifier si une fonction avec le même numéro matricule et rôle existe déjà
                $check_duplicate = $bdd->prepare("SELECT * FROM fonction WHERE numero_matricule = :numero_matricule AND rol = :rol");
                $check_duplicate->bindParam(':numero_matricule', $numero_matricule);
                $check_duplicate->bindParam(':rol', $rol);
                $check_duplicate->execute();

                // Si aucun doublon n'est trouvé, insérer les données
                if ($check_duplicate->rowCount() == 0) {
                    $fonction_insertion = "INSERT INTO fonction (rol, numero_matricule) VALUES ('$rol', '$numero_matricule')";     
                 

                    $bdd->exec($fonction_insertion );
                    header("location:affichage-fonction.php");
                } else {
                    echo "<p class='register failed'>Cette fonction avec ce rôle et ce numéro matricule existe déjà dans la base de données.</p>";
                }

            }
        
        ?>
 <?php include "footer.php" ?>

