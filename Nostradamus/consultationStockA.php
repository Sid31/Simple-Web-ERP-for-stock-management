<html>
	<head>
		<title>Projet Nostradamus</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="css/foundation.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/token-input.css" type="text/css" />
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />

	</head>
	<body>
		<h1> Tableau  croisé dynamique du stock</h1>
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
			
			<div class="row">
  <div class="medium-3 columns "><select id="propriete" name="propriete">
								<option value="">-- Propriete ligne  --</option>
							</select>
							</div>
							<div class="medium-3 columns "><select id="typeFiltre" name="typeFiltre">
								<option value="">-- Type de filtre  --</option>
							</select>
							</div>
  
</div>
<div class="row">
  <div class="medium-3 columns"><select id="propriete2" name="propriete">
								<option value="">-- Propriete colonne --</option>
							</select></div>
  <div class="medium-2 columns "><input type="button"  name="afficher" id="afficher" value="Afficher" class=" button"></div>
  <div class="medium-3 columns "><select id="filtre" name="filtre">
								<option value="">--  Filtre  --</option>
							</select>
							</div>

</div>
<div class="row">
		</div><table>
						<tbody id="dyna" name="dyna">
						</tbody>
				</table>
</div>
		<script src="js/vendor/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
		<script src="js/vendor/fastclick.js"></script>
		<script src="js/foundation/foundation.js"></script>
		<script src="js/foundation/foundation.topbar.js"></script>
		<script src="js/foundation/foundation.alert.js"></script>
		<script type="text/javascript">
			$("document").ready(function() {
				var $propriete = $('#propriete');
				var $proprieteColonne = $('#propriete2');
				var $typeFiltre=$('#typeFiltre');
				var $filtre=$('#filtre');
				var filtre='';
				var valeurFiltre='';
				var $divTableau= $('#dyna');
				var propriete = $('filtre');

 
				/* Variables */
				var go = "go";
				//var execution = false;

				/* DATASTRING */
				var dataGo = 'go=' + go;

				var $propriete1 = $('#propriete1');
				var propriete;
				var $propL = $('.ligne');
				var $propC = $('.colonne');
				// chargement des régions
				$.ajax({
					type : "POST",
					url : 'control/chargementProprietes.php',
					data : dataGo,
					dataType : 'json', // on veut un retour JSON
					success : function(json) {
						$.each(json, function(index, value) {// pour chaque noeud JSON
							// on ajoute l option dans la liste
							
							$propriete.append('<option name="proprieteBase" id="proprieteBase" value="' + index + '">' + value + '</option>');
							$proprieteColonne.append('<option name="proprieteBase" id="proprieteBase" value="' + index + '">' + value + '</option>');
							$typeFiltre.append('<option name="proprieteBase" id="proprieteBase" value="' + index + '">' + value + '</option>');							
							$(document).foundation('alert');
							//execution=false;							
							// rafraichi le code derrière l'alerte permetant ainsi de la fermer
						});
					}
				});
				// à la sélection d une propriete dans la liste 
				$("#afficher").click(function() {
					var val = $("#propriete").val();
					var valC = $("#propriete2").val();
					var filtre = $("#filtre").val();
					var valeurFiltre = $("#filtre").children(":selected").text();
					
					if ((val != '' || valC!='')) {					
						var dataPropriete = 'idProprieteL=' + val +'&idProprieteC=' + valC +'&idFiltre=' + filtre+'&valeurFiltre=' + valeurFiltre;	
						$.ajax({
							url : 'control/proprieteDynamique.php',
							type : 'POST',
							data : dataPropriete,
							success : function(tab) {
										$divTableau.empty();
										$divTableau.append(tab);
							}
						});						
					}
				});
				$("#typeFiltre").change(function() {					
					filtre = $("#typeFiltre").val();
					var dataPropriete = 'idPropriete=' + filtre;
					$.ajax({
					type : "POST",
					url : 'control/chargementProprietes.php',
					data : dataPropriete,
					dataType : 'json', // on veut un retour JSON
					success : function(json) {
						$filtre.empty();
						$filtre.append('<option name="filtre" value=""> Aucun filtre </option>');
						$.each(json, function(index, value) {														
							$filtre.append('<option name="filtre" value="' + index + '">' + value + '</option>');																	
						});
					}
				});
				});
			});
			

		</script>
		<script>
			$(document).foundation();
		</script>

	</body>
</html>

