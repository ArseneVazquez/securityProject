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
    /* button:hover {
      background-color: #c0392b;
    } */


  </style>
</head>

<?php 

include "connexion.php" ;
$affichageAgent = $bdd->query("Select * from agent");
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
  <h2>Liste des Agents</h2>
  <table class="agents-table">
    <thead>
      <tr>
        <th>num</th>
        <th>Nom</th>
        <th>Telephone</th>
        <th>adresse</th>
        <th colspan="2" >Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        while ( $dataRecup = $affichageAgent->fetch()) {         
    ?>
        <tr>
            <td ><?php echo $dataRecup["id_agent"]; ?></td>
            <td><?php echo $dataRecup["nom_agent"]; ?></td>
            <td><?php echo $dataRecup["tel"]; ?></td>
            <td><?php echo $dataRecup["adr"]; ?></td>
            <td><a href="?delete=<?php echo $dataRecup['id_agent']; ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agent ?');">supprimer</a></td>
            <td><a href="modification_agent.php?mod=<?php echo $dataRecup['id_agent']; ?>" class="btn btn-edit">Modifier</a></td>
            
        </tr>
    <?php } ?>
    </tbody>
  </table>
<?php 
    if (isset($_GET['delete'])) {
      $id = $_GET['delete'];
      try {
          $stmt = $bdd->prepare("DELETE FROM agent WHERE id_agent = ?");
          $stmt->execute([$id]);
          $message = "Agent supprimé avec succès !";
          // header("location:affichage-agent.php");
          header("location:affichage-agent.php");

      } catch (PDOException $e) {
          $message = "Erreur lors de la suppression : " . $e->getMessage();
      }
}

?>
</div>

 <?php include "footer.php" ?>