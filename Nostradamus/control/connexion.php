


<?php

// Modify this parameters with your own information
    $PARAM_hote="hote.xxx";
	$PARAM_nom_bd="dataBaseName";
	$PARAM_utilisateur="user";
	$PARAM_mot_passe="Password";

	$connexion = new PDO("mysql:host=$PARAM_hote;dbname=$PARAM_nom_bd", $PARAM_utilisateur, $PARAM_mot_passe); // connexion à la BDD
	$connexion->query("set names utf8")
		
?>
