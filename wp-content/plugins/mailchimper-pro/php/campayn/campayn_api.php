<?php
define("CAMPAYN_API",$form_options[74]);
define("CAMPAYN_DOMAIN",$form_options[73]);

require_once(sprintf("%s/httpful-0.2.0.phar", dirname(__FILE__)));
require_once(sprintf("%s/Campayn.php", dirname(__FILE__)));
require_once(sprintf("%s/CampaynList.php", dirname(__FILE__)));
require_once(sprintf("%s/CampaynContact.php", dirname(__FILE__)));
require_once(sprintf("%s/CampaynException.php", dirname(__FILE__)));
$campayn = new Campayn(CAMPAYN_API, array(
    'domain' => CAMPAYN_DOMAIN,    
));
$data = new CampaynContact;
$data->email = $email;
	if (isset($mv)) {
		if (is_array($mv)) 
		{
			foreach($mv as $key=>$mvitem)
			{
				$data->{$key} = $mvitem;
			}
		}
	}
$res = $campayn->addContact($form_options[70], $data);
if (isset($res->success)) $result = true;
else $result = $res->error;
?>
