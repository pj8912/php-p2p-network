<?php

// class not necessary
// made to represent the actual node connection overriding the node class
class NodeConnection{

	public $socket, $main_node, $id, $host, $port;
	//socket -websocket connections
	//id - Node id (in str)
	//host - host
	//port - port (in str)
	public function __construct($main_node, $socket, $id, $host, $port){
		$this->host = $host;
		$this->port = $port;
		$this->main_node = $main_node;

		//socket
		$this->socket = $socket;

		$this->id = (string)$id;

		$this->info = [];
	}

	public function isJson($string){
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}

	//send data to the connected node . data types: string,json, byte objects
	public function send($data, $enctype= 'utf-8' ){
		if isJson($data){
			try{	
				//decode json and get value
				
				socket_sendmsg($this->socket, $data)
			}

		}
	}



	public function close(){
		socket_close($this->socket);
	}

