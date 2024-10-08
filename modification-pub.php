<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agents - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
    <style>
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
            font-size: 19px;
        }
        button:hover {
            background-color: #c0392b; /* Couleur de fond au survol */
        }
    </style>
</head>

<?php 
include "connexion.php";

if (isset($_GET['mod'])) {
    $id_post = $_GET['mod'];
    $modifPost = $bdd->prepare("SELECT * FROM publication WHERE id_pub = ?");
    $modifPost->execute([$id_post]);
    $dataRecup = $modifPost->fetch();

    if (!$dataRecup) {
        echo "<p>Publication non trouvée.</p>";
        exit;
    }
} else {
    echo "<p>Aucun identifiant de publication fourni.</p>";
    exit;
}

?>

<body>
    <header>
        <div class="tit"><h1>The KEY SECURITY</h1></div>
        <div class="lnk">
            <?php include "nav.php"; ?>
        </div>
    </header>

    <div class="container">
        <main id="agent">
            <h2>Modifier la Publication</h2>
            <form action="" method="POST">
                <label for="date_pub">La date du jour</label>
                <input type="date" id="date_pub" name="date_pub" value="<?php echo $dataRecup['date_pub']; ?>" required>
                <label for="article">Article</label>
                <input type="text" id="article" name="article" pattern="[a-zA-Z0-9 ]+" value="<?php echo $dataRecup['article']; ?>" required>
                <button type="submit" name="btnValider">Envoyer</button>
            </form>
        </main>
        <?php 
            // Traitement du formulaire de modification
            if (isset($_POST['btnValider'])) {
                $Recupdate = $_POST['date_pub'];
                $Recuparticle = $_POST['article'];

                // Mettre à jour la publication
                $stmtUpdate = $bdd->prepare("UPDATE publication SET date_pub = ?, article = ? WHERE id_pub = ?");
                if ($stmtUpdate->execute([$Recupdate, $Recuparticle, $id_post])) {
                    header("Location: affichage-pub.php"); // Redirige après succès
                    exit();
                } else {
                    echo "<p>Erreur lors de la modification de la publication.</p>";
                }
            }
        ?>
 <?php include "footer.php" ?>

