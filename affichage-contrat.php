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
</head>

<?php 

include "connexion.php" ;
$affichageContrat = $bdd->query("Select * from contrat");
?>

<body>
  <header>
    <div class="tit">
      <h1>The KEY SECURITY</h1>
    </div>
    <div class="lnk">
      <?php include "nav.php"; ?>
    </div>
  </header>

<div>
  <h2>Liste des Clients</h2>
  <table class="agents-table">
    <thead>
      <tr>
        <th>numero contat</th>
        <th>date de signature</th>
        <th>contenu</th>
        <th>date d'expiration</th>
        <th colspan="2" >Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        while ( $dataRecup = $affichageContrat->fetch()) {         
    ?>
        <tr>
            <td ><?php echo $dataRecup["id_contrat"]; ?></td>
            <td><?php echo $dataRecup["date_signature"]; ?></td>
            <td><?php echo $dataRecup["contenu"]; ?></td>
            <td><?php echo $dataRecup["date_expiration"]; ?></td>
            <td><a href="?delete=<?php echo $dataRecup['id_contrat']; ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette Client ?');">supprimer</a></td>
            <td><a href="modification-contrat.php?id=<?php echo $dataRecup['id_contrat']; ?>" class="btn btn-edit">Modifier</a></td>

            
        </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

<?php 
    if (isset($_GET['delete'])) {
      $id = $_GET['delete'];
      try {
          $stmt = $bdd->prepare("DELETE FROM contrat WHERE id_contrat = ?");
          $stmt->execute([$id]);
          $message = "contrat supprimé avec succès !";
          header("location:affichage-contrat.php");
      } catch (PDOException $e) {
          $message = "Erreur lors de la suppression : " . $e->getMessage();
      }
}

?>

<?php include "footer.php" ?>
