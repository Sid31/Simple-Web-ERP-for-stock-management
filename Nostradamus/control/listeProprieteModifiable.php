  <?php
  
include 'connexion.php';
$tabPropriete = array();
	// connexion à la base de données
	include 'connexion.php';
		// requête qui récupère les régions
		$requete = "SELECT id_propriete, type_propriete, nom_propriete  FROM proprietes ORDER BY nom_propriete ";
		// exécution de la requête
		$resultat = $connexion -> query($requete) or die(print_r($connexion -> errorInfo()));		
		// résultats
		while ($donnees = $resultat -> fetch(PDO::FETCH_ASSOC)) {			
			// je remplis un tableau et mettant l'id en index 
			$tabPropriete[$donnees['id_propriete']] = utf8_encode($donnees['nom_propriete']);
		}

?> 	