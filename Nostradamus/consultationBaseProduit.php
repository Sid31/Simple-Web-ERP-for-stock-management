<html>
	<head>
		<title>Projet Nostradamus</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="css/foundation.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/token-input.css" type="text/css" />
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />

	</head>
	<body>
		<h1> Ajouter un produit</h1>
		<nav class="top-bar" data-topbar>
			<ul class="title-area">
				<li class="name">
					<h1><a href="index.php">Accueil</a></h1>
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
						<a style="color: lightblue">Stock</a><!-- menu selectioné -->
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

		<div class="panel clearfix ">
			<form method="post" id="stock" name="stock" >
				<div class="row">
					<h2> Afficher le stock d'un produit</h2>
					<div class="row">

						<div class="small-2 large-2 columns">
							<label for="nomProduit" class="right">Code du produit</label>
						</div>
						<input type="text" id="demo-input-facebook-theme" name="recherche" />
					</div>
					<br />
					<br />
					<div class="row">

						<div class="columns">
							<br />
							<button  id="afficher" name="afficher" value="valider"  class="button  radius success round">
								Afficher
							</button>				
						</div>
						<div class=" columns" id="tableauStock">
							
						</div>
					</div>
					<br />
			</form>
			<div id="alertebi" name="alertebi"></div>
		</div>
		</div>
		<script src="js/vendor/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
		<script src="js/vendor/fastclick.js"></script>
		<script src="js/foundation/foundation.js"></script>
		<script src="js/foundation/foundation.topbar.js"></script>
		<script src="js/foundation/foundation.alert.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				
				$("#demo-input-facebook-theme").tokenInput("control/rechercheProduit.php", {
					searchDelay : 1000,
					minChars : 2,
					tokenLimit : 1
				});

			});

			$(function() {
				$("#afficher").click(function() {					
					var stock = $("#recherche").text();
					var $tableauStock = $('#tableauStock');
					/* Variables */
					var dataString = 'c=' + stock;
					/* requette Ajax*/
					$.ajax({
						type : "POST",
						url : "control/responseAfficheStock.php",
						data : dataString,
						success : function(data) {
							$tableauStock.empty();
							$tableauStock.append(data);	
						}
					});
					return false;
				});				
			});
		</script>
		<script>
			$(document).foundation();
		</script>

	</body>
</html>

