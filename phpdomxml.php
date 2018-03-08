<?php

require("phpsqlajax_dbinfo.php");
/*$username="";
$password="";
$database="omarket";*/
// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Select all the rows in the markers table

$query = $pdo->prepare('SELECT * FROM markers');
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

for ($i=0; $i < count($result) ; $i++) { 
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$result[$i]['name']);
  $newnode->setAttribute("address", $result[$i]['address']);
  $newnode->setAttribute("lat", $result[$i]['lat']);
  $newnode->setAttribute("lng", $result[$i]['lng']);
  $newnode->setAttribute("type", $result[$i]['type']);
}

echo $dom->saveXML();

?>