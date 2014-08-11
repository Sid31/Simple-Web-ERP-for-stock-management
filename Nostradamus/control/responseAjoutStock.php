

<?php
// Si les parametres post existe

$codeProduit = $_POST['stock'];
$quantite = (int)$_POST['quantite'];
if(empty($quantite)){
	$quantite = 1;
}

if (!empty($codeProduit) && $codeProduit !="") {
	require '../model/Stock.php';
	require '../control/StockManager.php';
	require '../control/ProduitManager.php';
	require '../model/Produit.php';
	include "connexion.php";
	
	$manageProduit = new ProduitManager($connexion);
	$unProduit =  $manageProduit->getProduitAvecCode($codeProduit);
	if($unProduit->getID() !=null){
	$manageStock = new StockManager($connexion);


	$etatStock = $manageStock->getEtatStock($unProduit->getID());	
	$etaStock = (int)$etatStock;
	$etatStock+=$quantite;
	$data = array('etat_stock' => $etatStock, 'code_produit' => $codeProduit, 'id_produit' => $unProduit->getID());
	$unStock = new Stock($data);
	$manageStock -> add($unStock);
	
	
	
	echo "stock ok";
	}
	else {
		echo "stock fail";
	}
	
}

?>