<?php
/**
This Example shows how to listSubscribe using the MGAPI.php class and do some basic error checking.
**/
require_once(sprintf("%s/inc/MGAPI.class.php", dirname(__FILE__)));
//API Key - see http://admin.mailigen.com/settings/api
$apikey = 'YOUR MAILIGEN APIKEY';

// A List Id to run examples against. use lists() to view all
$listId = 'YOUR MAILIGEN LIST ID - see lists() method';

// A Campaign Id to run examples against. use campaigns() to view all
$campaignId = 'YOUR MAILIGEN CAMPAIGN ID - see campaigns() method';

// A Campaign Id to run examples against. use campaigns() to view all
$smsCampaignId = 'YOUR MAILIGEN SMS CAMPAIGN ID - see smsCampaigns() method';

//some email addresses used in the examples:
$my_email = 'INVALID@example.org';
$boss_man_email = 'INVALID2@example.com';

$my_phone = '00000000';
$smsSenderID = 'Test';
$smsMergeField = 'SMS';

//just used in xml-rpc examples
$apiUrl = 'http://api.mailigen.com/1.5/';
$api = new MGAPI($apikey);

$id = $listId;
$email_address = $my_email;
$merge_vars = array('EMAIL'=>$my_email, 'FNAME'=>'Joe'); // or $merge_vars = array();
$email_type = 'html';
$double_optin = true;
$update_existing = false;
$send_welcome = false;

$retval = $api->listSubscribe($id, $email_address, $merge_vars, $email_type, $double_optin, $update_existing, $send_welcome);

header("Content-Type: text/plain");
if ($api->errorCode){
	echo "Unable to load listSubscribe()!\n";
	echo "\tCode=".$api->errorCode."\n";
	echo "\tMsg=".$api->errorMessage."\n";
} else {
	echo "Returned: ".$retval."\n";
}