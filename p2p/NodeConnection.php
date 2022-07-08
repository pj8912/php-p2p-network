<?php

class NodeConnection{
	

	public $nodes_inbound = [];
	public $nodes_outbound = [];
	
	public $id;


	public function __construct($host, $port){
		$this->host = $host;
		$this->port = $port;


		$this->id = $this->generate_id();

		$this->sock = socket_create(AF_INET, SOCK_STREAM , SOL_TCP);
	
		//start
		$this->start();
	
	
		$this->message_send_count = 0;
	
	
	}


	public $new_sock;
	

	public function generate_id(){
		$id = $this->host.strval($this->port).rand(1,9999999);
		$id = hash('sha1', $id);
		return strval($id);
	}

	public function start(){
		socket_set_option($this->sock, SOL_SOCKET, SO_REUSEADDR, 1);
		socket_bind($this->sock , $this->host, $this->port);
		socket_listen($this->sock);
		socket_set_nonblock($this->sock);
		set_time_limit(0);

	}

	public function connections(){
		echo "Node connections: \n";
		echo "Nodes connected with us: ". sizeof($this->nodes_inbound);
		echo "Nodes connected to: ".sizeof($this->nodes_outbound);
	}
	

	public function allNodes(){
		return array_merge($this->nodes_inbound, $this->nodes_outbound);
	}	


	// socket and data for send nodes
	public function sendToNodes($data){
		
                $this->message_send_count += 1;
		
		$all_nodes = $this->allNodes();

		for($i=0; $i < sizeof($nodes); $i++){
			
			$this->send($this->new_sock, $data);
		}
	}

	public function connect_with_node($host, $port){

		if($this->host == $host && $this->port == $port){
			echo "Cannot connect with yourself\n";
			return false;
		}

		//if($this->id == $id){
		//	echo "Cannot connect with yourself\n";
                  //    return false;

		//}

		else{ 
			
			$node_ids = [];

			//check if node in all_nodes()
			$all_nodes = $this-> allNodes();
			for($i=0; $i<sizeof($all_nodes); $i++){
				$node = $all_nodes[$i];
				if($node['host'] == $host && $node['port']== $port){
					echo "Already connected with this node!!\n";
					return true;
				}
			
				$new_nodes = $all_nodes;
				$node_ids[] = $all_nodes[$i]['id'];

			}


			$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		
			socket_connect($sock, $host, $port);
		
			socket_send($sock, strval($this->id) , strlen($this->id), MSG_EOF);

			$buf = strval($this->id);
			$connected_node_id = socket_recv($sock, $buf, 4096, MSG_WAITALL);	

			if( $this->id == $connected_node_id ){
				socket_send($sock, "already connected ");
				socket_close($sock);
				return true;
			}		
			
			$this->nodes_outbound[] =[
				'id'=> $connected_node_id,
				'host' => $host,
				'port' => $port
			];

			$this->new_sock = $sock;

			print_r($this->allNodes());
		}
	}
	
	public function send($socket, $data){
		socket_send($socket , $data, strlen($data), MSG_EOF);
	}

	public function close_socket($sock_conn){
		return socket_close($sock_conn);
	}

	
}	


