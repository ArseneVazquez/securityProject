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
$affichageContact = $bdd->query("Select * from contact");
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
  <h2>Liste des Contacts</h2>
  <table class="agents-table">
    <thead>
      <tr>
        <th> contact num</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Telephone</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
        while ( $dataRecup = $affichageContact->fetch()) {         
    ?>
        <tr>
            <td ><?php echo $dataRecup["id_contact"]; ?></td>
            <td><?php echo $dataRecup["nom"]; ?></td>
            <td><?php echo $dataRecup["email"]; ?></td>
            <td><?php echo $dataRecup["telephone"]; ?></td>
            <td><a href="?delete=<?php echo $dataRecup['id_contact']; ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette contact ?');">supprimer</a></td>
            <td><a href="modification-contact.php?mod=<?php echo $dataRecup['id_contact']; ?>" class="btn btn-edit">Modifier</a></td>
        </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

<?php 
    if (isset($_GET['delete'])) {
      $id = $_GET['delete'];
      try {
          $stmt = $bdd->prepare("DELETE FROM contact WHERE id_contact = ?");
          $stmt->execute([$id]);
          $message = "Contact supprimé avec succès !";
          header("location:affichage-contact.php");

      } catch (PDOException $e) {
          $message = "Erreur lors de la suppression : " . $e->getMessage();
      }
}

?>

<?php include "footer.php" ?>
