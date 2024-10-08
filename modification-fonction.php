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
    include "connexion.php"; // Corrected missing semicolon
    $id_fonction = $_GET['mod'];

    $modifFonction = $bdd->prepare("SELECT * FROM fonction WHERE id_fonction = ?");
    $modifFonction->execute([$id_fonction]);
    $dataRecup = $modifFonction->fetch();
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
            <h2>Informations sur le client</h2>
            <form action="" method="POST">
                <label for="numero-matricule">Numéro Matricule</label>
                <input type="number" id="numero-matricule" name="numero" value="<?php echo htmlspecialchars($dataRecup['numero_matricule']); ?>" required>
                <label for="role">Rôle</label>
                <input type="text" id="role" name="rol" pattern="[a-zA-Z0-9 ]+" value="<?php echo htmlspecialchars($dataRecup['rol']); ?>" required>

                <button type="submit" name="btnValider">Envoyer</button>
            </form>
        </main>
        
        <?php 
        if (isset($_POST['btnValider'])) {
            $numero_matricule = $_POST['numero'];
            $rol = $_POST['rol'];   

            // Mettre à jour la fonction dans la base de données
            $updateFonction = $bdd->prepare("UPDATE fonction SET rol = ?, numero_matricule = ? WHERE id_fonction = ?");
            $updateFonction->execute([$rol, $numero_matricule, $id_fonction]);
            
            // Redirection après la mise à jour
            header("Location: affichage-fonction.php");
            exit;
        }
        ?>
        
        <?php include "footer.php" ?>
