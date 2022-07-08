<?php

//require 'NodeConnection.php';

class Node{

	public $host, $port, $id;

	public $inbound_nodes = [] ;
	public $outbound_nodes = [] ;

	

	public function __construct($host , $port, $id){

		$this->host = $host;
		$this->port = $port;
		$this->id = $id;
		
	
		//socket create TCP socket
		$this->sock = socket_create(AF_INET,SOCK_STREAM,TCP_SOL);
		$this->initServer(); //start server
	}


	//get All Nodes
	public function allNodes(){

		return array_merge($this->inbound_nodes, $this->outbound_nodes);
	}	
	
	// generate random node id
	public function generateId(){
		//make sure host and port are strings
		//convert port to string
		$random = strval(rand(1, 99999999)); 
		$id = $this->host.strval($this->port).$random;
		return $id;
	}

	//start Socket Server
	public function initServer(){
		socket_set_option($this->sock, SOL_SOCKET, SO_REUSEADDR, 1);
		socket_bind($this->host, $this->port);
		socket_listen(1);
	}

	public function printConnections(){
		echo "Node connection Overview\n";
		$inbound_size = sizeof($this->inbound_nodes);
		$outbound_size = sizeof($this->outbound_nodes);
		echo "Total Nodes connected with us: $inbound_size\n";
		echo "Total Nodes connected to: $outbound_size\n";
	}

	public function sendToNodes(){
	}

	public function sendToNode(){
	
		//sendtonode uses send() of NodeConnection of connected nodes

	}

	//have to manually connect with node by calling connectWithNode() function
	public function connectWithNode($host, $port, $id){
		
		if($id == $this->id){
			echo "Cannot connect with yourself";
			return false;
		}
		//allNodes is an array
		// inbound + outbound
		$result[] = $this->allNodes();

		//id in all_nodes id == id in allNodes()
		//if the given id already availble in the nodes
		for($i=0;$i<sizeof($result);$i++){
			if($result[$i]['id'] == $id){
				echo "Already connected with the node";
				return true;
			}
		}
	
		$node_ids  = [];
		for($i=0; $i<sizeof(allNodes()); $i++){
			$nodes = allNodes();
			$node_ids[] = $nodes[$i]['id'];
		}
	
		try{
		
			$sock = socket_create(AF_INET, SOCK_STREAM, TCP_SOL);
			socket_connect($sock, $host, $port);
			// Basic information exchange (not secure) of the id's of the nodes!
			// send my id and port to the connected node!
			$send_my_info = json_encode( [
			  $this->id => strval($this->port)
			]);
			
			socket_send($sock, $send_my_info, strlen($send_my_info));

			//when a node is connected , it sends it id!
			$connected_node_id = socket_recv($sock, 4096, strlen(4096));
			
		
		}		

		
		$sock = socket_create(AF_INET, SOCK_STREAM);
		socket_connect($sock, $host, $port);
		socket_send($sock, strval($this->id), strlen(strval($this->id)));
		$connected_node_id = socket_recv($sock, strval($this->id), strlen(strval($this->id)));
		if($this->id == $connected_node_id){
			socket_send($sock, "already having a connection");
			socket_close($sock);
			return true;
		}

		#$client  = $this->createNewConnection($sock, $connected_node, $host, $port);
		$this->outbound_nodes[]  = $client;
	

		 
	}



	
}
