<?

#
# Example PHP server-side script for generating
# responses suitable for use with jquery-tokeninput
#

# Connect to the database
//mysql_pconnect("192.168.1.110", "sid", "sidveloorangetrombone") or die("Could not connect");
//mysql_select_db("nostradamus") or die("Could not select database");
include 'connexion.php';
# Perform the query
	$terme= $_GET["q"];
    $query = $connexion->prepare("SELECT code_produit, nom_produit from produits WHERE code_produit LIKE :queryString ORDER BY code_produit ASC LIMIT 10");
	$query->execute(array(':queryString' => '%%%'.$terme.'%%'));
	$arr = array();

# Collect the results
while($obj = $query->fetch(PDO::FETCH_ASSOC)) {
    $arr[] = $obj;
}

# JSON-encode the response
$json_response = json_encode($arr);

# Optionally: Wrap the response in a callback function for JSONP cross-domain support
if($_GET["callback"]) {
    $json_response = $_GET["callback"] . "(" . $json_response . ")";
}

# Return the response
echo $json_response;

?>
