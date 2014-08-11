<?php
		include 'connexion.php';
		$idPropriete = $_REQUEST["id"];
		
		$tab=array();
  		$id_Propriete = htmlentities(intval($idPropriete));
		$requete = 'SELECT id_valeur, value FROM valeur WHERE id_propriete = ' . $id_Propriete . ' ORDER BY value';
		// exécution de la requête
		$resultat = $connexion -> query($requete) or die(print_r($connexion -> errorInfo()));
		// résultats
		while ($donnees = $resultat -> fetch(PDO::FETCH_ASSOC)) {
			// je remplis un tableau et mettant l'id en index
			$tab[$donnees['id_valeur']] = utf8_encode($donnees['value']);
			
		}
?>