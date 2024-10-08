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
    margin-top: -165px;

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
h1{
    text-align: center;
    margin-top: 35px;
}
.parag{
    word-spacing: 3px;
    margin-top: 60px;
    /*margin-left: 85px;*/
    text-align: center;
}
.tot{

    margin-left: 30px;
    margin-top: 205px;
}
footer{
        margin-top: -0.105px;


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

<?php
    include "connexion.php";
    

?>
<body>
    <header>
        <div class="tit"><h1>The KEY SECURITY</h1></div>
        <div class="lnk">
            <?php include "nav.php"; ?>
        </div>
    </header>
    <h1>The KEY SECURITY</h1>
    
    <div class="parag">
                <p>
                Nous sommes là pour vous aider ! Dans notre entreprise "The  key security ", <br>votre sécurité et votre tranquillité
                 d'esprit sont notre priorité.  Si vous avez des questions,<br> des préoccupations ou si vous souhaitez en savoir plus
                  sur nos services, n'hésitez pas à nous contacter. <br> Notre équipe dédiée se tient prête à répondre à vos besoins.
                   Remplissez le formulaire ci-dessous<br> ou utilisez les informations  de contact fournies, et nous vous répondrons dans les plus brefs délais.


                </p>
            </div>
 <div class="tot"> 


    <div class="container">
        <main id="agent">
            <h2>Contactez-nous </h2>
            <form action="contact.php" method="POST">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" pattern="[a-zA-Z0-9]+" required>
                <label for="numero_tel">Numéro de Telephone</label>
                <input type="number" id="numero_tel" name="numero_tel" required>
                <label for="sugestion">Email:</label>
                <input type="email" id="sugestion" name="email" required>
                    
                <button type="submit" name='btnContacter'>Envoyer</button>
            </form>
        </main>

        <?php 
        if(isset($_POST['btnContacter'])){
            $nom =ucfirst($_POST["nom"]);
            $numero_tel =$_POST['numero_tel'];
            $email =$_POST['email'];

            // Vérifier si un contact avec le même numéro de téléphone ou email existe déjà
            $check_duplicate = $bdd->prepare("SELECT * FROM contact WHERE telephone = :numero_tel OR email = :email");
            $check_duplicate->bindParam(':numero_tel', $numero_tel);
            $check_duplicate->bindParam(':email', $email);
            $check_duplicate->execute();

            // Si aucun doublon n'est trouvé, insérer les données
            if ($check_duplicate->rowCount() == 0) {
                $contact_insertion ="INSERT INTO contact(nom, email, telephone)VALUES ( '$numero_tel', '$email', '$numero_tel')";
            
                //  adresse, email, nom) VALUES ( '$numero_tel', '$adresse', '$email', '$nom')";      
        
                $bdd->exec($contact_insertion ); 
                header("location:affichage-contact.php");
                
                header("location:affichage-contact.php");
            } else {
                echo "<p class='register failed'>Ce contact avec cet email ou ce numéro de téléphone existe déjà dans la base de données.</p>";
            }

            
        }
        
        ?>
 </div>
 <?php include "footer.php" ?>

