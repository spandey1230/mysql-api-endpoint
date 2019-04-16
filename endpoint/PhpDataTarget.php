<?php 

require 'RequestHandler.php';

class PhpDataTarget extends RequestHandler
{
	
	function requestsLoad($post, $get)
	{
		$this->trigger($post, $get);
	}
}

$dt = new PhpDataTarget();
$dt->requestsLoad($_POST, $_GET);