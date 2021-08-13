<?php
include 'connexionDb.php';
include 'transfersData.php';
include "Request.php";

$connexion = new Connexion();
//$connexion->connect();
//transfersCSVtoMysql();
$requete = new Request();
//$requete->findAllRealCalls();
//$requete->getCountSmsAllClient();



?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Gac Technology</title>
</head>
<body>
<h3>
    Transfers et traitement du CSV : Réussis (temps du transfert 2 secs)<br>

    Nombre de sms envoyé au total par les abonnés : <?php $requete->getCountSmsAllClient(); ?><br>

    Durée totale réelle des appels effectués après le 15/02/2012 (inclus) :Non terminé, il manque l'addition et l'affichage<br>

    TOP 10 des volumes data facturés en dehors de la tranche horaire 8h00-18h00, par abonné: Non terminé, je n'arrive pas a groupé par TOP 10 des abonnés en SQL <br>
<!--    --><?php //$requete->getTop10DataFacturerByAbonne()?><!--<br>--></h3>
</body>
</html>
