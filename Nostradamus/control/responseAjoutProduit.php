<?php
// Si les parametres post existe

$nomProduit = $_REQUEST['nomProduit'];
$codeProduit = $_REQUEST['codeProduit'];
$tableauO = $_REQUEST['couleur'];
$dataProp;
$listeProp;
if (!empty($nomProduit) AND !empty($codeProduit)) {
	require '../model/Produit.php';
	require '../model/Prop.php';
	require '../model/Propriete.php';
	require '../control/ProduitManager.php';
	require '../control/ProprieteManager.php';
	require '../control/PropManager.php';
	$data = array('nom_produit' => $nomProduit, 'code_produit' => $codeProduit);

	include "connexion.php";
	$unProduit = new Produit($data);
	$manageProduit = new ProduitManager($connexion);
	$manageProduit -> add($unProduit);

	$managePropriete = new ProprieteManager($connexion);

	echo $tableauO;
	echo 'Produit ajouté à la base.';
	$i = 0;
	$tab;
	$j = 0;
	foreach ($_POST as $key => $value) {
		echo $key;
		echo $value;
		$tab[$i] = $key;
		$tab[$i + 1] = $value;
		$i = $i + 2;
	}

	for ($i = 4; $i < count($tab); $i += 2) {
		$dataProp[$tab[$i]] = $tab[$i + 1];
	}
	foreach ($dataProp as $key => $value) {
		$listeProp[$j] = array('id_produit' => $unProduit -> getID(), 'id_propriete' => $managePropriete -> getIDPropriete($key), 'valeur' => $dataProp[$key]);
		$j++;
	}
	$manageProp = new PropManager($connexion);
	foreach ($listeProp as $key => $value) {
		$uneProp = new Prop($value);
		$manageProp -> add($uneProp);
	}
} else {
	echo 'fail';
/*	echo $tableauO;
	foreach ($_POST as $key => $value) {
		echo $key;
		echo $value;

	}*/
}
?> 