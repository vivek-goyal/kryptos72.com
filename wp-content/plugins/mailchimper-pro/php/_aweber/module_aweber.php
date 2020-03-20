<?php
require_once(sprintf("%s/aweber_api.php", dirname(__FILE__)));

$consumerKey    = $form_options[62];
$consumerSecret = $form_options[59];
$accessKey      = $form_options[60];
$accessSecret   = $form_options[61];
$list_id        = $form_options[63];

try {
	$aweber = new AWeberAPI($consumerKey, $consumerSecret);
	$account = $aweber->getAccount($accessKey, $accessSecret);
	$account_id = $account->data['id'];
} catch (AWeberException $e) {
		print_r($e);
		die();
}
function handle_errors(&$exc) {
    // a simple way to display an API exception
    print "<h3>AWeberAPIException:</h3>";
    print " <li> Type: $exc->type              <br>";
    print " <li> Msg : $exc->message           <br>";
    print " <li> Docs: $exc->documentation_url <br>";
    print "<hr>";
}

try {
    $list = $account->loadFromUrl("/accounts/{$account_id}/lists/{$list_id}");
    # create a subscriber
    $params = array(
        'email' => $email,
        'ip_address' => get_client_ip(),
        'ad_tracking' => 'MailChimper PRO',
        'misc_notes' => 'MailChimper PRO',
        'custom_fields' => $mv
    );
	if (isset($mv['name'])) $params['name'] = $mv['name'];
    $subscribers = $list->subscribers;
    $new_subscriber = $subscribers->create($params);

    # success!
    print "A new subscriber was added to the $list->name list!";

} catch(AWeberAPIException $exc) {
    handle_errors($exc);
    exit(1);
}
// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}