<?php
	if(!class_exists('MailChimp')) require_once(sprintf("%s/MailChimp.php", dirname(__FILE__)));
	$MailChimp = new MailChimp($form_options[34]);
	$mlid = $mailchimp_listid;
	$result = $MailChimp->call('lists/subscribe', array(
		'id'                => $mlid,
		'email'             => array('email'=>$email),
		'merge_vars'        => $mv,
		'double_optin'      => $double_optin,
		'update_existing'   => $update_existing,
		'replace_interests' => $replace_interests,
		'send_welcome'      => $send_welcome
	));
	if ( isset( $result['code'] ) && $result[ 'code' ] == 214 ) {
		$result = true;
	}
	else {
		if ( isset( $result['leid'] ) ) {
			if ($result['leid']>0) $result = true;
			else {
				$error_msg = $result['error'];
				$result = false;
			}
		}
		else {
				print('<pre>');
				print_r($result);
				print('</pre>');
				$result = false;
		}
	}
?>