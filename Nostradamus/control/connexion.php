<?php
    $PARAM_hote="192.168.1.110";
	$PARAM_nom_bd="nostradamus";
	$PARAM_utilisateur="sid";
	$PARAM_mot_passe="sidveloorangetrombone";

	$connexion = new PDO("mysql:host=$PARAM_hote;dbname=$PARAM_nom_bd", $PARAM_utilisateur, $PARAM_mot_passe); // connexion à la BDD
	$connexion->query("set names utf8")
		
?>