<?php
  require_once(sprintf("%s/class.rest.php", dirname(__FILE__)));

$rest = new FmRestAPI();
$rest->setApiKey( $form_options[80] );
$rest->setApiSecret( $form_options[81] );

$data = array(
    'email' => $email,
    'list'  => $form_options[82],
    'custom_fields' => $mv
);

//testing transactional mail request
try {
    $response = $rest->doRequest('subscriber/add', $data);
	$result = true;
} catch (Exception $e) {
    die("FreshMail Error: ".$e->getMessage());
}
?>