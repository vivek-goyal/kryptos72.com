<?php
require_once(sprintf("%s/aweber_api.php", dirname(__FILE__)));
 
try {
	if (isset($field1))
	{
     if (!empty($field1)) $authorization_code = $field1;
	 else die("AWeber: Invalid Authorization Code");
	} else die("AWeber: Invalid Authorization Code");

    $auth = AWeberAPI::getDataFromAweberID($authorization_code);
    list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = $auth;

    # Store the Consumer key/secret, as well as the AccessToken key/secret
    # in your app, these are the credentials you need to access the API.
}
catch(AWeberAPIException $exc) {
    die("Error: $exc->message");
}
die($consumerKey.'-'.$consumerSecret.'-'.$accessKey.'-'.$accessSecret);
?>