<?php

// node connection manages sockets and creation of nodes

class NodeConnection
{
    public $host, $port, $id;

    public $inbound_nodes = [];
    public $outbound_nodes = [];

    public function __construct($host, $port)
    {
        $this->host = $host;
        $this->port = $port;
        $this->id = $this->generateId();
    }

    public function allNodes(){
        return array_merge($this->inbound_nodes, $this->outbound_nodes);
    }

    //create nodeID for node while creation
    public function generateId(){
        $random = strval(rand(1, 99999999)); 
        $id = hash('sha1', $this->host.$this->port.$random);
        return $id;
    }

    // public function 
}
