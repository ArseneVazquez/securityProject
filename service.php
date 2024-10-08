<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos services - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
.button-container {
    display: flex;
    flex-wrap: wrap; /* Permet aux boutons de se répartir sur plusieurs lignes si nécessaire */
    justify-content: center; /* Centre les boutons horizontalement */
    gap: 15px; /* Espace entre les boutons */
    padding: 20px; /* Espace intérieur de la container */
}

.button {
    display: inline-block;
    padding: 10px 20px; /* Espacement intérieur du bouton */
    margin-top: 2px; /* Espace au-dessus du bouton */
    margin-bottom: 9px; /* Espace en dessous du bouton */
    background-color: #4CAF50; /* Couleur de fond */
    color: white; /* Couleur du texte */
    text-align: center; /* Centre le texte */
    text-decoration: none; /* Supprime le soulignement du lien */
    border-radius: 15px; /* Coins arrondis */
    font-size: 28px; /* Augmentation de la taille de la police */
    transition: background-color 0.3s, transform 0.2s; /* Animations pour les interactions */
}

.button:hover {
    background-color: #45a049; /* Couleur au survol */
    transform: scale(1.05); /* Légère augmentation de la taille au survol */
}

.button:active {
    transform: scale(0.95); /* Légère réduction de la taille lors du clic */
}
p{
    font-size: 18px;
    margin-top: 55px;
}
h2{
    font-size: 28px;
}




</style>
<body>
    <header>
        <div class="tit"><h1>The KEY SECURITY</h1></div>
        <div class="lnk">
        <?php include "nav.php"; ?>
        </div>
    </header>

    <div class="container">
        <main>
            <h2>Nos services</h2>
            <p>Notre plateforme en ligne permet un suivi en temps réel de vos besoins en sécurité ou besoins<br>
                 que ce soit pour la surveillance d'événements Nous nous engageons à créer des environnements<br>
                  sûrs grâce à une approche proactive et des technologies de pointe. Faites confiance à notre expertise<br>
                   pour garantir votre sécurité et celle de votre entourage.</p><br><br><br><br>

            <div class="button-container">
                <a href="client.php" class="button">Demande de Service</a>
                <a href="agent.php" class="button">Portail des Agents</a><br>
                <a href="post.php" class="button">Suivi des Postes</a>
                <a href="contrat.php" class="button">Contrats et Accords</a>
                <a href="fonction.php" class="button">Fonction occuper</a>

            </div>
        </main>

        <?php include "footer.php" ?>
