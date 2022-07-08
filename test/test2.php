<?php

$nodes_inbound = [

	[
		'id'=>'f33oho8ho4298g080824',
		
		'msg'=> 'ade4'
	],
	
	[
                'id'=>'oinroi3n249un028nn90',
                'msg'=> 'adew'
        ],
	
	[
                'id'=>'pmp34ino3i4no5no3in4',
                'msg'=> 'adeq'
        ],


];

$nodes_outbound = [

	 [
                'id'=>'r2300f9402909j24j02j0',
                'msg'=> 'adea'
        ],

        [
                'id'=>'gf9e7gnwe98ybew98yf9w',
                'msg'=> 'adez'
        ],

        [
                'id'=>'08webw0e0we09ybgwewi3',
                'msg'=> 'adex'
        ],


];

$all_nodes = array_merge($nodes_inbound, $nodes_outbound);

function allNodes($nodes){
	return $nodes;
}

function get_all_ids($n){

	$nodes = allNodes($n);
	$node_ids = [];

	for($i=0;$i<sizeof($nodes); $i++){
		$node_ids[] = $nodes[$i]['id'];	
	}
	
	print_r($node_ids);
}	


get_all_ids($all_nodes);
