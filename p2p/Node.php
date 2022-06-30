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
		
	
		
		$this->sock = socket_create(AF_INET,SOCK_STREAM,0); //create socket connection
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
		$random = strval(rand(1, 99999999); 
		$id = $this->host.strval($this->port).$random;
		return $id;
	}

	//start Socket Server
	public function initServer(){
		socket_set_option($this->sock, SOL_SOCKET, SO_REUSEADDR, 1)
		socket_bind($this->host, $this->port);
		socket_listen(1);
	}

	public function printConnections(){
		echo "Node connection Overview\n";
		$inbound_size = sizeof($inbound_nodes);
		$outbound_size = sizeof($outbound_nodes);
		echo "Total Nodes connected with us: $inbound_size\n";
		echo "Total Nodes connected to: $outbound_size\n";
	}

	public function sendToNodes(){
	}

	public function sendToNode(){
		
	}

	//have to manually connect with node by calling connectWithNode() function
	public function connectWithNode($host, $port, $id){
		if($id == $this->id){
			echo "Cannot connect with yourself";
			return false;
		}
		//allNodes is an array
		// inbound + outbound
		$result = $this->allNodes();

		//id in all_nodes id == id in allNodes()
		//if the given id already availble in the nodes
		for($i=0;$i<sizeof($result);$i++){
			if($result[$i]['id'] == $id){
				echo "Already connected with the node";
				return true;
			}
		}
		$ids = function($result){ for($i=0;$i<sizeof($result);$i++){ return $result[$i]['id'];} };
		$result = $this->getAllNodes(); 
		$node_ids = ids($result);
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







	//send data to the connected node . data types: string,json, byte objects
        public function send($data, $enctype= 'utf-8' ){
				socket_sendmsg($this->sock, $data);       
       	
		      //if isJson($data){
                        //try{
                                //decode json and get value

                //                socket_sendmsg($this->sock, $data)
                        //}

                //}
        }



        public function close(){
                socket_close($this->sock);
        }
	
}
