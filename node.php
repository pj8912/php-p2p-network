<?php


require_once 'p2p/NodeConnection.php';


$node1 = new NodeConnection('127.0.0.1', 9000);

$node2 = new NodeConnection('127.0.0.1', 9002);

$node1->connect_with_node('127.0.0.1', 9002);

$node2->connect_with_node('127.0.0.1', 9000);

