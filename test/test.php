<?php

function getAllNodes(){
	return [['id'=>'897213'],['id'=>'12414'],['id'=>'127841']];
}

//print_r(getAllNodes());

$idx = [];
for($i = 0; $i< sizeof(getAllNodes()); $i++){
	$nodes = getAllNodes();
	$idx[] = $nodes[$i]['id'];
}

print_r($idx);


$z = null;
$px = getAllNodes();

