<?php


class Node{


	public $host; //node's host
	public $port; //node's port
	public $nodes_inbound = [];
	public $nodes_outbound = [];


	public function __construct($host, $port, $id){
		
		//generate id
		if(!$id) $this->id = $this->generate_id();
		else $this->id = $id;

		$this->host = $host;
		$this->port = $port;

		//create socket 
		$this->sock = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
		if(!is_resource(this->sock)) $this->onSocketFailure("Failed to create socket");
		

		//set socket  nonblock
		socket_set_nonblock($this->sock);		
	}

	//create nodeId for this node
	
	public function generate_id(){
		$val = 
	}



	//all nodes connected both inbound and outbound
	public function all_nodes(){
		return array_merge($this->nodes_inbound, $this->nodes_outbound);
	}


	//make a connection with another node
	//when connection is made an events is triggered outbound_node_connected
	//
	//when the connection is made with another node, it exchanges the ID of the node
	
	//First we send OUR ID and then we receive the ID of the node we are connected to
	//
	//When the connection is made the 'outbound_node_connected' method is invoked
	//
	//
	
	public function connect_with_node(string $host, string $port, bool $reconnect){

		if ($host == $this->host and $port == $this->port){
			echo "Cannot connect with yourself\n";
			return false;
		}

		//check if node is already connected
		$node = [];
		for($i=0; $i< sizeof($this.all_nodes); $i++){
			$node[] = $this->all_nodes;
			
		}

		$node_ids = [];
		

		
	}
	
	//socket error handling

	public function onSocketFailure(string $message, $socket = null){
		if(is_resource($socket)){
			$message.=": ".socket_strerror(socket_last_error($socket));
		}
		die($message);
	}


	
	public function inbound_node_connected(){
	 	return false;
	}
		

	public function inbound_node_connection_error(){
		return false;
	}
		
	public function outbound_node_connected(){
		return false;
	}
		
	public function outbound_node_connection_error(){
		return false;
	}



}
