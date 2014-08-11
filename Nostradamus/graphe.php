<html>
	<head>

<meta charset="utf-8">
		<title>Projet Nostradamus</title>
		<link href="css/foundation.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/token-input.css" type="text/css" />
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
		<script src="js/vendor/jquery.js"></script>
		<script src="js/raphael.js"></script>
		<script src="js/raphael-min.js"></script>
		<script src="js/line.js"></script>
        
	</head>
	<div id="codeGraphe"> <script>
            window.onload = function (){
            	hauteur= 500+200;
                var r = Raphael("holder"),
                    txtattr = { font: "12px sans-serif" };              
                r.text(190,70 , "Test graphe javascript").attr(txtattr);
                // graphe 1
                var lines = r.linechart(50, 100, 500, 220, [[1, 2, 3, 4, 5, 6, 7],[3.5, 4.5, 5.5, 6.5, 7, 8]], [[12, 32, 23, 15, 17, 27, 22], [10, 20, 30, 25, 15, 28]], { 
                	nostroke: false, axis: "0 0 1 1", symbol: "circle", smooth: true }).hoverColumn(function () { // false=> batton non arrondi                		
                    this.tags = r.set();
	
                    for (var i = 0, ii = this.y.length; i < ii; i++) {
                        this.tags.push(r.tag(this.x, this.y[i], this.values[i], 160, 10).insertBefore(this).attr([{ fill: "#fff" }, { fill: this.symbols[i].attr("fill") }]));
                    }
                }, function () {
                    this.tags && this.tags.remove();
                });
                // graphe 2
                var lines = r.linechart(600, 100, 500, 220, [[1, 2, 3, 4, 5, 6, 7],[3.5, 4.5, 5.5, 6.5, 7, 8]], [[12, 32, 23, 15, 17, 27, 22], [10, 20, 30, 25, 15, 28]], { 
                	nostroke: false, axis: "0 0 1 1", symbol: "circle", smooth: false }).hoverColumn(function () { // false=> batton non arrondi                		
                    this.tags = r.set();
	
                    for (var i = 0, ii = this.y.length; i < ii; i++) {
                        this.tags.push(r.tag(this.x, this.y[i], this.values[i], 160, 10).insertBefore(this).attr([{ fill: "#fff" }, { fill: this.symbols[i].attr("fill") }]));
                    }
                }, function () {
                    this.tags && this.tags.remove();
                });
                // graphe 2
                var lines = r.linechart(50, 400, 500, 220, [[1, 2, 3, 4, 5, 6, 7],[3.5, 4.5, 5.5, 6.5, 7, 8]], [[12, 32, 23, 15, 17, 27, 22], [10, 20, 30, 25, 15, 28]], { 
                	nostroke: false, axis: "0 0 1 1", symbol: "circle", smooth: true }).hoverColumn(function () { // false=> batton non arrondi                		
                    this.tags = r.set();
	
                    for (var i = 0, ii = this.y.length; i < ii; i++) {
                        this.tags.push(r.tag(this.x, this.y[i], this.values[i], 160, 10).insertBefore(this).attr([{ fill: "#fff" }, { fill: this.symbols[i].attr("fill") }]));
                    }
                }, function () {
                    this.tags && this.tags.remove();
                });
    
                lines.symbols.attr({ r: 4 });
                                                
                 //lines.lines[0].animate({"stroke-width": 6}, 1000);
                 //lines.lines[1].animate({"stroke-width": 6}, 1000);
                // lines.symbols[0].attr({stroke: "#fff"});
                // lines.symbols[0][1].animate({fill: "#f00"}, 1000);
            };
        </script></div>
	<body>
		<h1> Graphiques du stock</h1> <h1 style="color: red"> En travaux</h1>
		<nav class="top-bar" data-topbar>
			<ul class="title-area">
				<li class="name">
					<h1><a  href="index.php">Accueil</a></h1>
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
						<a style="color: lightblue" >Graphe</a><!-- menu selectioné -->
						<ul class="dropdown">
							<li>
								<a href="graphe.php">Graphe du stock</a>
							</li>							
						</ul>
					</li>
				</ul>
			</section>
		</nav>
		
    </head>
    <body >
        <div id="holder"></div>

    </body>
</html>