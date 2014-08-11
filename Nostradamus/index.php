<?php
	$code = $_REQUEST["c"];

	require 'control/ProduitManager.php';
	require 'model/Produit.php';
	include "control/connexion.php";
	
	$manageProduit = new ProduitManager($connexion);
	$unProduit =  $manageProduit->getProduitAvecCode($code);
	$idProduit=$unProduit->getID();
	$nomProduit=$unProduit->getNom();	
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Projet Nostradamus</title>
		<link href="css/foundation.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/token-input.css" type="text/css" />
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
		<script src="js/vendor/jquery.js"></script>
		<script type="text/JavaScript">
function Afficher(id) {
$( "#result" ).load( "ActionClavier.php?id1="+id);
} 
function clavier (valeur) {
document.forms["stock"].elements["<?="quantite";?>"].value=document.forms["stock"].elements["<?="quantite";?>"].value+valeur;
}
function effacer () {
document.forms["stock"].elements["<?="quantite";?>"].value="";
}
function plulpus () {
document.forms["stock"].elements["<?="quantite";?>"].value=parseInt(document.forms["stock"].elements["<?="quantite";?>"].value) +1;
}
</script>
	</head>
	<body>
		<h1> Nostradamus</h1>
		<nav class="top-bar" data-topbar>
			<ul class="title-area">
				<li class="name">
					<h1><a style="color: lightblue" href="index.php">Accueil</a></h1>
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
					<li class="has-dropdown not-click">
						<a >Graphe</a><!-- menu selectioné -->
						<ul class="dropdown">
							<li>
								<a href="graphe.php">Graphe du stock</a>
							</li>							
						</ul>
					</li>
				</ul>
			</section>
		</nav>
<?if ((isset ($code)) && ($idProduit !=null)){?>
		<div class="panel clearfix ">
			<form method="post" id="stock" name="stock" action="recapitulatif.php?c=<?php echo ($code);?>">
				<div class="row">
					<h2> Ajouter d'un produit au stock</h2>

					<h3><?php echo "Produit: ".$nomProduit ?></h3> 
						<h3><?php echo "Code du produit: ".$code ?></h3> 											
					<br/>
					<div class="row">
						<div class="small-10 large-3 columns">				
<input type="button" value="0" id="c0" onClick="clavier(0);" style="width:50px; height:50px; font-size:18px">							
<input type="button" value="1" id="c1" onClick="clavier(1);" style="width:50px; height:50px; font-size:18px">
<input type="button" value="2" id="c2" onClick="clavier(2);" style="width:50px; height:50px; font-size:18px">
<input type="button" value="3" id="c3" onClick="clavier(3);" style="width:50px; height:50px; font-size:18px">
<input type="button" value="4" id="c4" onClick="clavier(4);" style="width:50px; height:50px; font-size:18px">
<input type="button" value="5" id="c5" onClick="clavier(5);" style="width:50px; height:50px; font-size:18px">
<input type="button" value="6" id="c6" onClick="clavier(6);" style="width:50px; height:50px; font-size:18px">
<input type="button" value="7" id="c7" onClick="clavier(7);" style="width:50px; height:50px; font-size:18px">
<input type="button" value="8" id="c8" onClick="clavier(8);" style="width:50px; height:50px; font-size:18px">
<input type="button" value="9" id="c9" onClick="clavier(9);" style="width:50px; height:50px; font-size:18px">
<input type="button" value="+1" id="P1" onClick="plulpus();" style="width:50px; height:50px; font-size:18px">
<input type="button" value="EFF" id="EFF" onClick="effacer();" style="width:50px; height:50px; font-size:18px">
							</div>					
					<div class="columns">
								<br />
						<input type="number" id="quantite" value="1" name="quantite" style=" width: 200px"/>
						<button type="submit" id="submit" name="submit" value="valider"  class="button  radius success round">							
							Ajouter
						</button>
						<button type="submit" id="enlever" name="enlever" value="enlever"  class="button  radius alert round">
							Enlever
							</button>
						</div>
				</div>
					<br />
					</form>			
				<div id="alertebi" name="alertebi"></div>
		</div>
		</div>
		
<? }?>

		<script src="js/vendor/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
		<script src="js/vendor/fastclick.js"></script>
		<script src="js/foundation/foundation.js"></script>
		<script src="js/foundation/foundation.topbar.js"></script>
		<script src="js/foundation/foundation.alert.js"></script>
		<!-- <script type="text/javascript">
			$(document).ready(function() {
				$("#demo-input-facebook-theme").tokenInput("control/rechercheProduit.php", {
					searchDelay : 1000,
					minChars : 2,
					tokenLimit : 1
				});
			});
			$(function() {
				$("#submit").click(function() {

					var stock = "<?php echo $code ?>";
					var quantite = $("#quantite").val();
					console.log("pakapkakpska"+quantite)
					/* Variables */
					var dataString = 'stock=' + stock + '&quantite='+quantite;
					/* requette Ajax*/

					$.ajax({
						type : "POST",
						url : "control/responseAjoutStock.php",
						data : dataString,
						success : function(data) {
							//var resultat = '<div data-alert="" class="alert-box success radius">  Le stock a été mise à jour.  <a  class="close">×</a>	</div>';
							//document.getElementById('alertebi').innerHTML = resultat;
							//$(document).foundation('alert');
							confirm("Le stock a été mise à jour");
							console.log(data)
							console.log("AJAX DONE");
						}
					});

					return false;
				});
				//EOF

			});

		</script> -->
		<script>
			$(document).foundation();

		</script>

	</body>

</html>

