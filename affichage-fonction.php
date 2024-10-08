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
$affichageFonction = $bdd->query("Select * from fonction");
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
        <th>numero fonction</th>
        <th>numero matricule</th>
        <th>role</th>
        <th colspan="2" >Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        while ( $dataRecup = $affichageFonction->fetch()) {         
    ?>
        <tr>
            <td ><?php echo $dataRecup["id_fonction"]; ?></td>
            <td><?php echo $dataRecup["numero_matricule"]; ?></td>
            <td><?php echo $dataRecup["rol"]; ?></td>
            <td><a href="?delete=<?php echo $dataRecup['id_fonction']; ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette Fonction ?');">supprimer</a></td>
            <td><a href="modification-fonction.php?mod=<?php echo $dataRecup['id_fonction']; ?>" class="btn btn-edit">Modifier</a></td>


            
        </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

<?php 
    if (isset($_GET['delete'])) {
      $id = $_GET['delete'];
      try {
          $stmt = $bdd->prepare("DELETE FROM fonction WHERE id_fonction = ?");
          $stmt->execute([$id]);
          $message = "Fonction supprimé avec succès !";
          header("location:affichage-fonction.php");
      } catch (PDOException $e) {
          $message = "Erreur lors de la suppression : " . $e->getMessage();
      }
}

?>

<?php include "footer.php" ?>
