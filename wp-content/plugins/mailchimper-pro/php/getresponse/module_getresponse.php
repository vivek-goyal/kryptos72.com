<?php
if (empty($form_options[84])) die("You must specify the API Key.");
if (empty($form_options[85])) die("You must specify the Campaign ID.");

require_once(sprintf("%s/getresponse_api.php", dirname(__FILE__)));
$params = array (
	'campaign'  => $form_options[85],
	'email'     => $email,
	'cycle_day' => 0
);
if (isset($_SERVER['REMOTE_ADDR'])) $params['ip'] = $_SERVER['REMOTE_ADDR'];
if (isset($mv)) {
	if (is_array($mv)) 
	{
	$c=0;
		foreach($mv as $key=>$mvitem)
		{
		$c++;
			$params['customs'][] = array('name'=>$key,'content'=>$mvitem);
		}
	}
	if (isset($mv['name'])) $params['name'] = $mv['name'];
}
# initialize JSON-RPC client
$client = new jsonRPCClient('http://api2.getresponse.com');
# add contact to the campaign
$result = $client->add_contact(
    $form_options[84],
	$params
);
if ($result == 'Contact already queued for target campaign') $result = true;
else
{
if (!isset($result['queued'])) die('GetResponse: Error Creating Contact');
else $result = true;
}
?>