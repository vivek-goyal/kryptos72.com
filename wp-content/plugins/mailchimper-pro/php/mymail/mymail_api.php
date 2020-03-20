<?php
$user = array(
    'email' => $email,
    'status' => 1,
	'referer' => 'MailChimper PRO'
);
if ( is_array( $mv ) ) {
	$user_params = array_merge( $user, $mv );
}
else {
	$user_params = $user;
}
$subscriber_id = mymail('subscribers')->add($user_params, true );
$success = mymail('subscribers')->assign_lists($subscriber_id, $form_options[119], $remove_old = false);
if ($success) $result = true;
else die('MyMail Error: Couldn\'t add user');
?>