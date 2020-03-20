<?php
require_once(sprintf("%s/YMLP_API.class.php", dirname(__FILE__)));
// create API class
$api = new YMLP_API($form_options[147],$form_options[146]);

// run command
$OverruleUnsubscribedBounced = "0";
$output=$api->ContactsAdd($email,$mv,$form_options[148],$OverruleUnsubscribedBounced);

// output results
if ($api->ErrorMessage){
	die("YMLP connection problem: " . $api->ErrorMessage);
} else {
	$result = true;
}
?>