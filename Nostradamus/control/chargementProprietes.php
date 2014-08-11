<?php

$go = $_POST['go'];
$idPropriete = $_POST['idPropriete'];
if ($go == 'go' || !empty($idPropriete)) {
	$json = array();
	// connexion à la base de données
	include 'connexion.php';
	if (isset($go)) {
		// requête qui récupère les régions
		$requete = "SELECT id_propriete, type_propriete, nom_propriete  FROM proprietes ORDER BY nom_propriete ";
		// exécution de la requête
		$resultat = $connexion -> query($requete) or die(print_r($connexion -> errorInfo()));
		// résultats
		while ($donnees = $resultat -> fetch(PDO::FETCH_ASSOC)) {
			// je remplis un tableau et mettant l'id en index 
			$json[$donnees['id_propriete']][] = utf8_encode($donnees['nom_propriete']);
		}
	} else if (isset($idPropriete)){
	$id_Propriete = htmlentities(intval($idPropriete));
	$requete = 'SELECT id_valeur, value FROM valeur WHERE id_propriete = ' . $id_Propriete . ' ORDER BY value';
	// exécution de la requête
	$resultat = $connexion -> query($requete) or die(print_r($connexion -> errorInfo()));
	// résultats
	while ($donnees = $resultat -> fetch(PDO::FETCH_ASSOC)) {
		// je remplis un tableau et mettant l'id en index
		$json[$donnees['id_valeur']][] = utf8_encode($donnees['value']);
	}
}
	// envoi du résultat avec success
	echo json_encode($json);
}
?>