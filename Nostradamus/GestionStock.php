<html>
	<head>
		<meta charset="utf-8">
		<title>Projet Nostradamus</title>
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
					<h2> Ajouter d'un produit au stock</h2>
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
							<input type="number" id="quantite" value="1" name="quantite" style=" width: 200px"/>
							<button type="submit" id="ajouter" name="ajouter" value="valider"  class="button  radius success round">
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
				$("#ajouter").click(function() {

					var stock = $("#recherche").text();
					var quantite = $("#quantite").val();
					/* Variables */
					var dataString = 'stock=' + stock + '&quantite=' + quantite;
					/* requette Ajax*/

					$.ajax({
						type : "POST",
						url : "control/responseAjoutStock.php",
						data : dataString,
						success : function(data) {
							console.log(data)
							console.log("AJAX DONE");
							document.location.href = 'recapitulatifWeb.php?c=' + stock;
						}
					});

					return false;
				});
				$("#enlever").click(function() {

					var stock = $("#recherche").text();
					var quantite = -1 * $("#quantite").val();
					/* Variables */
					var dataString = 'stock=' + stock + '&quantite=' + quantite;
					/* requette Ajax*/

					$.ajax({
						type : "POST",
						url : "control/responseAjoutStock.php",
						data : dataString,
						success : function(data) {

							console.log(data);
							console.log("AJAX DONE");
							document.location.href = 'recapitulatifWeb.php?c=' + stock;
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

