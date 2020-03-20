<?php
	require_once(sprintf("%s/php/myemma/Emma.php", dirname(__FILE__)));
	$account_id = ACCOUNT_ID;
	$public_key = API_PUBLIC_KEY;
	$private_key = API_PRIVATE_KEY;
	$debug = false;
	$em = new Emma($account_id, $public_key, $private_key, $debug);
	$member = array();
	$member['email'] = 'myemail@sympies.com';
	$member['fields'] = array('first_name' => 'Hola');
	$req = json_decode($em->membersAddSingle($member));
	var_dump($req);
?>