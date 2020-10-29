<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link href="style.css" rel="stylesheet" />
    </head>
    <body>
        <h1>Mon super blog !</h1>
        <form action="3.php" method="post">
            <p>Aimeriez-vous enregistrer un <strong>Billet</strong> ? 
            Voici à quoi cela va ressembler !</p>
            <p>
            <label for="billet">Titre</label><br>
            <input placeholder='Le titre ici' type="text" name="titre" id="titre"><br><br>
            <label for="billet">Contenu</label><br>
            <input placeholder='Le contenu ici' type="text" name="contenu" id="contenu"><br><br>
            <input type="submit" value="Enregistrer">
            </p>
        </form>
        <p>Derniers billets du blog :</p>
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
        // On récupère les 5 derniers billets
        $req = $bdd->query('SELECT id, titre, contenu,
        DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS
        date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0,
        5');
        while ($donnees = $req->fetch())
        {
        ?>
        <div class="news">
        <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
        </h3>
        <p>
        <?php
        // On affiche le contenu du billet
        echo nl2br(htmlspecialchars($donnees['contenu']));
        ?>
        <br />
        <em><a href="2.php?billet=<?php echo $donnees['id'];
        ?>">Commentaires</a></em>
        </p>
        </div>
        <?php
        } // Fin de la boucle des billets
        $req->closeCursor();
        ?>
    </body>
</html>