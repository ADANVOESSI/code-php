<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat</title>
    </head>
    <style>
        form
        {
        text-align:center;
        }
    </style>
    <body>
    <a href="1.php">Liste des billets</a>
        <form action="3.php" method="post">
            <p>
            <h1>Mon super blog !</h1>
        <input placeholder='Votre Pseudo' type="text" name="auteur" id=""><br><br>
        <input placeholder='Votre commantaire' type="text" name="commentaire" id=""><br><br>
        <input type="submit" value="Enregistrer">
            </p>
        </form>
        <?php
            // Connexion à la base de données
            try
            {
            $bdd = new PDO('mysql:host=localhost;dbname=TP3', 'eric', 'eric');
            }
            catch(Exception $e)
            {
            die('Erreur : '.$e->getMessage());
            }
            // Récupération des 10 derniers messages
            $reponse = $bdd->query('SELECT auteur, commentaire FROM commentaire ORDER
            BY id DESC');
            // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
            while ($donnees = $reponse->fetch())
            {
            echo '<p><strong>' . htmlspecialchars($donnees['auteur']) .
            '</strong> : ' . htmlspecialchars($donnees['commentaire']) . '</p>';
            }
            return $reponse;
        ?>
    </body>
</html>