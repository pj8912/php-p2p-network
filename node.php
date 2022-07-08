<?php


require_once 'p2p/NodeConnection.php';

$myNode = new NodeConnection('localhost','9001');

//$otherNode = new NodeConnection('10.244.55.194', '9001');

$myNode->connect_with_node('localhost', '9000');

