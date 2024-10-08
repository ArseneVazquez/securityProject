<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Contact - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    form {
        display: flex;
        flex-direction: column;
        max-width: 400px; 
        margin: 20px auto; 
    }
    h2 {
        color: green;
    }
    label {
        margin-bottom: 5px; 
        font-weight: bold; 
    }
    input {
        margin-bottom: 15px; 
        padding: 10px; 
        border: 1px solid #ccc; 
        border-radius: 5px; 
    }
    button {
        background-color: #e74c3c; 
        color: white; 
        padding: 10px; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer; 
        transition: background-color 0.3s; 
        margin-left: 70px;
    }
    button:hover {
        background-color: #c0392b; 
    }
</style>

<body>
<?php
include "connexion.php"; 
$modifContact = $bdd->query("SELECT * FROM contact WHERE id_contact=" . $_GET['mod']);
$dataRecup = $modifContact->fetch(); 
?>

<header>
    <div class="tit"><h1>The KEY SECURITY</h1></div>
    <div class="lnk">
        <?php include "nav.php"; ?>
    </div>
</header>

<div class="container">
    <main id="contact">
        <h2>Modifier le Contact</h2>
        <form action="" method="POST">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $dataRecup['nom']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $dataRecup['email']; ?>" required>

            <label for="telephone">Téléphone:</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo $dataRecup['telephone']; ?>" required>

            <button type="submit" name="btnModifier">Modifier</button>
        </form>
    </main>

    <?php 
    if(isset($_POST['btnModifier'])){
        $nom = ucfirst($_POST["nom"]);
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];

        $updateContact = "UPDATE contact SET nom='$nom', email='$email', telephone='$telephone' WHERE id_contact=" . $_GET['mod'];
        $bdd->exec($updateContact); 
        header("Location: affichage-contact.php");
        exit; // Exit to prevent further code execution
    }
    ?>

<?php include "footer.php" ?>
