<html>
	<head>
		<meta charset="utf-8">
		<title>Projet Nostradamus</title>
		<link href="css/fuelux/fuelux.min.css" rel="stylesheet" type="text/css">
		
		<link href="css/foundation.css" rel="stylesheet" type="text/css">
		

		<script src="js/vendor/jquery.js"></script>
		<script src="js/fluex/datagrid.js"></script>
		<script src="js/loader.min.js"></script>
		<script src="js/underscore-min.js"></script>
		
	</head>
	<body>
		<h1> Créer un produit</h1>
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
						<a style="color: lightblue">Produit</a><!-- menu selectioné -->
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
<div class="container-fluid">
   <div class="container-fluid">
    <!-- DATAGRID MARKUP -->
<table id="MyGrid" class="table table-bordered datagrid">
	<thead>
	<tr>
		<th>
			<span class="datagrid-header-title">Geographic Data Sample</span>
 
			<div class="datagrid-header-left">
				<div class="input-append search datagrid-search">
					<input type="text" class="input-medium" placeholder="Search">
					<button type="button" class="btn"><i class="icon-search"></i></button>
				</div>
			</div>
			<div class="datagrid-header-right">
				<div class="select filter" data-resize="auto">
					<button type="button" data-toggle="dropdown" class="btn dropdown-toggle">
						<span class="dropdown-label"></span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li data-value="all" data-selected="true"><a href="#">All</a></li>
						<li data-value="lt5m"><a href="#">Population < 5M</a></li>
						<li data-value="gte5m"><a href="#">Population >= 5M</a></li>
					</ul>
				</div>
			</div>
		</th>
	</tr>
	</thead>
	<tfoot>
	<tr>
		<th>
			<div class="datagrid-footer-left" style="display:none;">
				<div class="grid-controls">
					<span>
						<span class="grid-start"></span> -
						<span class="grid-end"></span> of
						<span class="grid-count"></span>
					</span>
					<div class="select grid-pagesize" data-resize="auto">
						<button type="button" data-toggle="dropdown" class="btn dropdown-toggle">
							<span class="dropdown-label"></span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li data-value="5" data-selected="true"><a href="#">5</a></li>
							<li data-value="10"><a href="#">10</a></li>
							<li data-value="20"><a href="#">20</a></li>
							<li data-value="50"><a href="#">50</a></li>
							<li data-value="100"><a href="#">100</a></li>
						</ul>
					</div>
					<span>Per Page</span>
				</div>
			</div>
			<div class="datagrid-footer-right" style="display:none;">
				<div class="grid-pager">
					<button type="button" class="btn grid-prevpage"><i class="icon-chevron-left"></i></button>
					<span>Page</span>
 
					<div class="input-append dropdown combobox">
						<input class="span1" type="text">
						<button type="button" class="btn" data-toggle="dropdown"><i class="caret"></i></button>
						<ul class="dropdown-menu"></ul>
					</div>
					<span>of <span class="grid-pages"></span></span>
					<button type="button" class="btn grid-nextpage"><i class="icon-chevron-right"></i></button>
				</div>
			</div>
		</th>
	</tr>
	</tfoot>
</table>
	<!-- END DATAGRID MARKUP -->
	
	<script type="text/javascript">
		// DataSource Constructor
var StaticDataSource = function( options ) {
    this._columns = options.columns;
    this._formatter = options.formatter;
    this._data = options.data;
    this._delay = options.delay;
};

StaticDataSource.prototype = {
    columns: function() {
        return this._columns
    },
    data: function( options, callback ) {
        var self = this;
        
        var data = $.extend(true, [], self._data);
        
        // SEARCHING
        if (options.search) {
            data = _.filter(data, function (item) {
                for (var prop in item) {
                    if (!item.hasOwnProperty(prop)) continue;
                    if (~item[prop].toString().toLowerCase().indexOf(options.search.toLowerCase())) return true;
                }
                return false;
            });
        }
        
        var count = data.length;

        // SORTING
        if (options.sortProperty) {
            data = _.sortBy(data, options.sortProperty);
            if (options.sortDirection === 'desc') data.reverse();
        }
        
        // PAGING
        var startIndex = options.pageIndex * options.pageSize;
        var endIndex = startIndex + options.pageSize;
        var end = (endIndex > count) ? count : endIndex;
        var pages = Math.ceil(count / options.pageSize);
        var page = options.pageIndex + 1;
        var start = startIndex + 1;
        
        data = data.slice(startIndex, endIndex);
        
        if (self._formatter) self._formatter(data);

		callback({ data: data, start: 0, end: 0, count: 0, pages: 0, page: 0 });
    }
};

// Using your sample data pour recuperer les datas du stock
var sampleData = [{
        "memberid": 103,
        "name": "Laurens  Natzijl",
        "age": "25"
    }, {
        "memberid": 104,
        "name": "Sandra Snoek",
        "age": "21"
    }, {
        "memberid": 105,
        "name": "Jacob Kort",
        "age": "31"
    }, {
        "memberid": 106,
        "name": "Erik  Blokker",
        "age": "40"
    }, {
        "memberid": 107,
        "name": "Jacco  Ruigewaard",
        "age":"37"
    }];

var dataSource = new StaticDataSource({
            columns: [{property:"memberid",label:"LidId",sortable:true},{property:"name",label:"Naam",sortable:true},{property:"age",label:"Leeftijd",sortable:true}],
            data: sampleData,
            delay: 250
        });

$('#MyGrid').datagrid({
    dataSource: dataSource,
    stretchHeight: true
});
	</script>
	
	<!-- END DATAGRID MARKUP -->
</body>
	
</html>
