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
// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO commentaire (auteur, commentaire)
VALUES(?, ?)');
$req->execute(array($_POST['auteur'], $_POST['commentaire']));
// Redirection du visiteur vers la page du minichat
header('Location: 2.php');