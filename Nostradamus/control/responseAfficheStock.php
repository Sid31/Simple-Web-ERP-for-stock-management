<?php
// Si les parametres post existe

$codeProduit = $_REQUEST['c'];



if (!empty($codeProduit) && $codeProduit !="") {
	
	require '../model/Stock.php';
	require 'StockManager.php';
	require 'ProduitManager.php';
	require '../model/Produit.php';
	include "connexion.php";
	$tableauString="";
	$manageProduit = new ProduitManager($connexion);
	$unProduit =  $manageProduit->getProduitAvecCode($codeProduit);
	$idProduit=$unProduit->getID();
	$nomProduit=$unProduit->getNom();
	if($idProduit !=null){
	$manageStock = new StockManager($connexion);
	
// Récupération de l'historique
$req = $connexion->prepare('SELECT id_utilisateur, etat_stock, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_historique FROM stocks WHERE id_produit = ? ORDER BY date DESC LIMIT 10');
$req->execute(array($idProduit));
$tableauString=$tableauString."<h2>Historique des opérations sur ".$nomProduit." (".$codeProduit.")</h2><TABLE BORDER=\"1\"> <TR> <TH> ID de l'utilisateur </TH> <TH> Date</TH> <TH> Etat du stock </TH> </TR>";

while ($donnees = $req->fetch())
{ $tableauString=$tableauString."<TR><TD>".htmlspecialchars($donnees['id_utilisateur'])." </TD><TD>". $donnees['date_historique']."</TD><TD>".nl2br(htmlspecialchars($donnees['etat_stock']))."</TD></TR>";
} // Fin de la boucle des commentaires

$req->closeCursor();
$tableauString=$tableauString."</TABLE>";
	echo $tableauString;
	}
	}

?>
