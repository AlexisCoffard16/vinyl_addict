<?php
try 
{
    // Connexion à la base de données locale XAMPP
    $pdo = new PDO('mysql:host=localhost;dbname=db_site;charset=utf8', 'root', '');
    // Activation de l'affichage des erreurs SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (Exception $e) 
{
    die('Erreur de connexion : ' . $e->getMessage());
}
?>