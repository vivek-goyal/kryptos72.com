<?php
if (empty($form_options[100])||empty($form_options[101])||empty($form_options[102])) die("MadMimi: You must specify the Username, API Key and List name");
require_once(sprintf("%s/madmimi_api.php", dirname(__FILE__)));
$mailer = new MadMimi($form_options[100], $form_options[101]); 
$user = array('email' => $email, 'add_list' => $form_options[102]);
$user_params = array_merge($user,$mv);
$res = $mailer->AddUser($user_params);
if ($res) $result = true;
else die('MadMimi: Error');
?>