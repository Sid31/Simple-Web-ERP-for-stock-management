<html>
 <head>
  <meta charset="utf-8">
  <title>Projet Nostradamus</title>
      <link href="css/foundation.css" rel="stylesheet" type="text/css">
 </head>
 <body>
<h1> Nostradamus</h1>
<nav class="top-bar" data-topbar>
			<ul class="title-area">			
				<li class="name">
					<h1><a href="index.php" style="color: lightblue">Accueil</a></h1>
				</li>				
				<li class="toggle-topbar menu-icon">
					<a href="#">Menu</a>
				</li>
			</ul>
			<section class="top-bar-section">
				<!-- Right Nav Section -->					
					<ul class="right">
				</ul>
				<!-- Left Nav Section -->
						<ul class="left">
					<li class="has-dropdown not-click">
						<a>Produit</a><!-- menu selectioné -->
						<ul class="dropdown">
							<li>
								<a href="AjoutProduit.html">Créer un Produit</a>
							</li>
							<li>
								<a href="proprietecreator.html">Créer une propriété</a>
							</li>
						</ul>
					</li>
				
				<li class="has-dropdown not-click">
						<a>Stock</a><!-- menu selectioné -->
						<ul class="dropdown">
							<li>
								<a href="GestionStock.php">Ajouter un produit</a>
							</li>
							<li>
								<a href="consultationBaseProduit.php">Consulter le stock</a>
							</li>
							
							<li>
								<a href="consultationStockA.php">Tableau croisé</a>
							</li>
						</ul>
					</li>
					</ul>	
			</section>
		</nav>
		<div class="panel clearfix ">
			<div class="row">
		<?php
  
// Si les parametres post existe

$codeProduit = $_REQUEST['c'];
$idProduit;
$nomProduit;
$quantite = (int)$_REQUEST['quantite'];
if(empty($quantite)){
	$quantite = 1;
}
if(!empty($_POST["enlever"])){
	$quantite *=-1;
}

if (!empty($codeProduit) && $codeProduit !="") {
	
	require 'model/Stock.php';
	require 'control/StockManager.php';
	require 'control/ProduitManager.php';
	require 'model/Produit.php';
	include "control/connexion.php";
	
	$manageProduit = new ProduitManager($connexion);
	$unProduit =  $manageProduit->getProduitAvecCode($codeProduit);
	$idProduit=$unProduit->getID();
	$nomProduit=$unProduit->getNom();
	if($idProduit !=null){
	$manageStock = new StockManager($connexion);
	
	$etatStock = $manageStock->getEtatStock($unProduit->getID());	
	
	$etaStock = (int)$etatStock;
	$etatStock+=$quantite;
	$data = array('etat_stock' => $etatStock, 'code_produit' => $codeProduit, 'id_produit' => $unProduit->getID());
	$unStock = new Stock($data);
	
	$manageStock -> add($unStock);			
	echo '<script type="text/javascript"> confirm("Le stock a été mis à jour");</script>';
	}
	else {
	}
	

// Récupération de l'historique
$req = $connexion->prepare('SELECT id_utilisateur, etat_stock, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_historique FROM stocks WHERE id_produit = ? ORDER BY date desc LIMIT 10');
$req->execute(array($idProduit));
echo "<h2>Historique des opérations sur ".$nomProduit." (".$codeProduit.")</h2>";
?>
<TABLE BORDER="1"> 

 <TR> 
 <TH> ID de l'utilisateur </TH> 
 <TH> Date</TH> 
 <TH> Etat du stock </TH>  
  </TR> 

<?
while ($donnees = $req->fetch())
{
?>

<TR><TD><?php echo htmlspecialchars($donnees['id_utilisateur']); ?></TD><TD> <?php echo $donnees['date_historique']; ?></TD>
<TD><?php echo nl2br(htmlspecialchars($donnees['etat_stock'])); ?></TD></TR>
<?php
} // Fin de la boucle des commentaires

$req->closeCursor();
}
?>
		
</TABLE>		
		</div>
		</div>
<script src="js/vendor/jquery.js"></script> 
 <script src="js/vendor/fastclick.js"></script>
   <script src="js/foundation/foundation.js"></script>
  <script src="js/foundation/foundation.topbar.js"></script>
  		<script>
  $(document).foundation();
</script>
 </body>
</html>
