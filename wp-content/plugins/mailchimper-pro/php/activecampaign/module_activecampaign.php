<?php
   require_once(sprintf("%s/ActiveCampaign.class.php", dirname(__FILE__)));
	$ac = new ActiveCampaign($form_options[54], $form_options[55]);
	if (!empty($form_options[56])) $list_id = $form_options[56];
	else die("ActiveCampaign Error: List ID not specified.");
	/*
	 * TEST API CREDENTIALS.
	 */
	if (!(int)$ac->credentials_test()) {
		die("ActiveCampaign: Invalid Credentials");
		exit();
	}
	/*
	 * ADD OR EDIT CONTACT (TO THE NEW LIST CREATED ABOVE).
	 */
	$contact = array(
		"email" => $email,
		"p[{$list_id}]" => $list_id,
		"status[{$list_id}]" => 1, // "Active" status
	);
	$contact_datas = $contact;
	if (isset($mv)) {
		if (is_array($mv)) 
		{
			foreach($mv as $key=>$mvitem)
			{
				$nmv['field[%'.$key.'%,0]'] = $mvitem;
			}
			$contact_datas = array_merge($contact, $nmv);
		}
	}
	$contact_sync = $ac->api("contact/sync", $contact_datas);
	if ((int)$contact_sync->success) {
		// successful request
		$contact_id = (int)$contact_sync->subscriber_id;
		$result = true;
	}
	else {
		// request failed
		$result = false;
		die("ActiveCampaign Error: " . $contact_sync->error);
		exit();
	}
?>