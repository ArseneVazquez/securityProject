<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Agent - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Styles pour le formulaire et les éléments de la page */
        form {
            display: flex;
            flex-direction: column;
            max-width: 400px; /* Largeur maximale du formulaire */
            margin: 20px auto; /* Centre le formulaire */
        }
        h2 {
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
    </style>
</head>

<body>
    <?php 
    include "connexion.php";

    // Vérifiez si 'mod' est présent dans l'URL
    if (isset($_GET['mod'])) {
        $id_agent = intval($_GET['mod']);
        $modifAgent = $bdd->query("SELECT * FROM agent WHERE id_agent = $id_agent");
        $dataRecup = $modifAgent->fetch();
    } else {
        echo "Aucun ID d'agent fourni.";
        exit;
    }
    ?>

    <header>
        <div class="tit"><h1>The KEY SECURITY</h1></div>
        <div class="lnk">
            <?php include "nav.php"; ?>
        </div>
    </header>

    <div class="container">
        <main id="agent">
            <h2>Modifier les Informations de l'Agent</h2>
            <form action="" method="POST">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($dataRecup['nom_agent']); ?>" required>

                <label for="telephone">Téléphone:</label>
                <input type="text" id="telephone" name="tel" value="<?php echo htmlspecialchars($dataRecup['tel']); ?>" required>

                <label for="adresse">Adresse:</label>
                <input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($dataRecup['adr']); ?>" required>

                <button type="submit" name="btnValider">Envoyer</button>
            </form>
        </main>

        <?php 
        // Traitement du formulaire
        if (isset($_POST['btnValider'])) {
            $nom = ucfirst($_POST["nom"]);
            $telephone = $_POST['tel'];
            $adresse = $_POST['adresse'];

            // Préparation de la mise à jour de l'agent
            $updateAgent = $bdd->prepare("UPDATE agent SET nom_agent = ?, tel = ?, adr = ? WHERE id_agent = ?");
            $updateAgent->execute([$nom, $telephone, $adresse, $id_agent]);

            header("Location: affichage-agent.php");
            exit;
        }
        ?>

<?php include "footer.php" ?>
