<?php
$config = [
			'api_key' => 'xxx', //your API key is available in Settings
			'installation_url' => 'http://aaa.aaa.com',  //Your Sendy installation
			'list_id' => 'xxx'//Users - vEpmBm892Lq3bp1f8Ebzg0NQ' //Users list
		];
		$sendy = new SendyPHP($config);
		$user =		array(
				        'name'=>'Gayan',
				        'email' => 'gayanhewa@gmail.com'
		          );
		$result = $sendy->subscribe($user);
		var_dump($result);
?>