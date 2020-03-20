<?php
	require_once(sprintf("%s/php/sendinblue/mailin.php", dirname(__FILE__)));
    $mailin = new Mailin("https://api.sendinblue.com/v2.0","Your access key");
    $id = 7;
    $users = array('example1@example.net','example2@example.net','example3@example.net');
    var_dump($mailin->add_users_list($id,$users));
?>