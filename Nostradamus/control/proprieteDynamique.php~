<?php


$dateMin = $_POST['dateMin'];

// code javascript  
$StringRetour="<script>";

if (!empty($dateMin)) {
	// connexion à la base de données	
	if (isset($dateMin)) {
		include 'connexion.php';
		$requete = 'SELECT ***** FROM produits GROUP BY id_propriete ORDER date';
		// exécution de la requête
		$resultat = $connexion -> query($requete) or die(print_r($connexion -> errorInfo()));
		// résultats
		while ($donnees = $resultat -> fetch(PDO::FETCH_ASSOC)) {
			// je remplis un tableau et mettant l'id en index
			$headerLigne[$ligne] = utf8_encode($donnees['value']);
			$ligne++;
		}
		$requete = 'SELECT id_valeur, value FROM valeur WHERE id_propriete = ' . $idProprieteC . ' ORDER BY id_valeur';
		
		// exécution de la requête
		$resultat = $connexion -> query($requete) or die(print_r($connexion -> errorInfo()));
		// résultats
		while ($donnees = $resultat -> fetch(PDO::FETCH_ASSOC)) {
			// je remplis un tableau et mettant l'id en index
			$headerColonne[$colonne] = utf8_encode($donnees['value']);

			$colonne++;
		}
	
		$requete = 'INSERT INTO dernier_stock (id_produit, stock)  select id_produit, etat_stock
					from nostradamus.stocks  where (id_produit, date) in (
					    select id_produit, max(date) as date
					    from nostradamus.stocks
					group by id_produit
					) order by id_produit asc;';

		$StringRetour = $StringRetour . "<TH>X</TH>";
		for ($colonne = 1; $colonne <= sizeof($headerColonne); $colonne++) {
			$StringRetour = $StringRetour . "<TH>" . $headerColonne[$colonne - 1] . "</TH>";
		}
		$StringRetour = $StringRetour . "</TR>";
		if( empty($filtre)|| empty($idFiltre)){
		$requeteStockValue = 'SELECT  SUM(v.stock)
 										FROM nostradamus.dernier_stock v,nostradamus.prop p1, nostradamus.prop p2
 										WHERE v.id_produit = p1.id_produit
                                        and v.id_produit = p2.id_produit
                                        and p1.id_propriete = :idProprieteL
                                        and p2.id_propriete = :idProprieteC
                                        and  p1.valeur =:valL
                                        and  p2.valeur = :valC';
		$demandeStock = $connexion -> prepare($requeteStockValue);

		for ($ligne = 1; $ligne <= sizeof($headerLigne); $ligne++) {
			$StringRetour = $StringRetour . "<TR><TH>" . $headerLigne[$ligne - 1] . "</TH>";
			for ($colonne = 1; $colonne <= sizeof($headerColonne); $colonne++) {
				$demandeStock -> execute(array(
											":valL"=>$headerLigne[$ligne - 1],
											":valC"=> $headerColonne[$colonne - 1],
											":idProprieteL"=>$idProprieteL,
											":idProprieteC"=>$idProprieteC,));
				
				$case = $demandeStock -> fetch();
if ($case[0] == null) { $StringRetour = $StringRetour . "<TD> nbs </TD>";
				}
				else{
				$StringRetour = $StringRetour . '<TD bgcolor="#65B4F1">' . $case[0] . '</TD>';
				}
			}
		}
		$StringRetour = $StringRetour . "</TR>";
		}
		else {
			
$requete = 'SELECT id_propriete FROM valeur WHERE id_valeur = ' . $idFiltre ;
		
		// exécution de la requête
		$resultat = $connexion -> query($requete) or die(print_r($connexion -> errorInfo()));
		$idProprieteF = $resultat->fetch();		
				$requeteStockValue = 'SELECT  SUM(v.stock)
 										FROM nostradamus.dernier_stock v,nostradamus.prop p1, nostradamus.prop p2, nostradamus.prop p3
 										WHERE v.id_produit = p1.id_produit
                                        and v.id_produit = p2.id_produit
                                        and v.id_produit = p3.id_produit                                        
                                        and p1.id_propriete = :idProprieteL
                                        and p2.id_propriete = :idProprieteC
                                        
                                        and  p1.valeur =:valL
                                        and  p2.valeur = :valC
                                        and p3.valeur = :valF'
										;
		$demandeStock = $connexion -> prepare($requeteStockValue);

		for ($ligne = 1; $ligne <= sizeof($headerLigne); $ligne++) {
			$StringRetour = $StringRetour . "<TR><TH>" . $headerLigne[$ligne - 1] . "</TH>";
			for ($colonne = 1; $colonne <= sizeof($headerColonne); $colonne++) {
				$demandeStock -> execute(array(
											":valL"=>$headerLigne[$ligne - 1],
											":valF"=>$filtre,
											":valC"=> $headerColonne[$colonne - 1],
											":idProprieteL"=>$idProprieteL,
											":idProprieteC"=>$idProprieteC));
				
				$case = $demandeStock -> fetch();
				if ($case[0] == null) { $StringRetour = $StringRetour . "<TD> nbs </TD>";
				}
				else{
				$StringRetour = $StringRetour . '<TD bgcolor="#65B4F1">' . $case[0] . '</TD>';
				}
			}
		}
		$StringRetour = $StringRetour . "</TR>";
			
		}
	}
	// envoi du résultat avec success
	echo($StringRetour);
}
?>