<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Contrat - The KEY SECURITY</title>
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

<?php 
include "connexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $bdd->prepare("SELECT * FROM contrat WHERE id_contrat = ?");
    $stmt->execute([$id]);
    $contrat = $stmt->fetch();
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
            <h2>Modifier le Contrat</h2>
            <form action="" method="POST">
                <input type="hidden" name="id_contrat" value="<?php echo $contrat['id_contrat']; ?>">
                <label for="date_signature">Date de Signature</label>
                <input type="date" id="date_signature" name="date_signature" value="<?php echo $contrat['date_signature']; ?>" required>
                <label for="contenu">Contenu</label>
                <input type="text" id="contenu" name="contenu" value="<?php echo $contrat['contenu']; ?>" pattern="[a-zA-Z ]+" required>
                <label for="date_expiration">Date d'Expiration</label>
                <input type="date" id="date_expiration" name="date_expiration" value="<?php echo $contrat['date_expiration']; ?>" required>

                <button type="submit" name="btnModifier">Modifier</button>
            </form>
        </main>

        <?php 
        if(isset($_POST['btnModifier'])){
            $id_contrat = $_POST['id_contrat'];
            $date_signature = $_POST['date_signature'];
            $contenu = $_POST['contenu'];
            $date_expiration = $_POST['date_expiration'];

            try {
                $stmt = $bdd->prepare("UPDATE contrat SET date_signature = ?, contenu = ?, date_expiration = ? WHERE id_contrat = ?");
                $stmt->execute([$date_signature, $contenu, $date_expiration, $id_contrat]);
                $message = "Contrat modifié avec succès !";
                header("location:affichage-contrat.php");
            } catch (PDOException $e) {
                $message = "Erreur lors de la modification : " . $e->getMessage();
            }
        }
        ?>

<?php include "footer.php" ?>
