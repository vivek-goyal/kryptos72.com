<?php
	require_once(sprintf("%s/php/mailjet/mailjet.php", dirname(__FILE__)));
	$apiKey = "";
	$secretKey = "";
	$listID = "";
	$mj = new Mailjet( $apiKey, $secretKey );
    $params = array(
        "method" => "POST",
        "Email" => $Cemail
    );

    $result = $mj->contact($params);

    if ($mj->_response_code == 201)
       echo "success - created contact ".$Cname;
    else
       echo "error - ".$mj->_response_code;

    echo $result;
	// add contact to list
	$params = array(
        "method" => "POST",
        "ContactID" => $result->contactid, // ???
        "ListID" => $listID,
        "IsActive" => "True"
    );

    $result = $mj->listrecipient($params);
if ($mj->_response_code == 201)
       echo "success - contact ".$contactID." added to the list ".$listID;
    else
       echo "error - ".$mj->_response_code;

    echo $result;
?>