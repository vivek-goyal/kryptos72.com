<?php
$xml = '<xmlrequest>
	<username>admin</username>
	<usertoken>abc123abc123abc123abc123abc123abc123abc123abc123</usertoken>
	<requesttype>subscribers</requesttype>
	<requestmethod>AddSubscriberToList</requestmethod>
		<details>
			<emailaddress>email@domain.com</emailaddress>
			<mailinglist>1</mailinglist>
			<format>html</format>
			<confirmed>yes</confirmed>
			<customfields>
				<item>
					<fieldid>1</fieldid>
					<value>John Smith</value>
				</item>
			</customfields>
		</details>
</xmlrequest>';

$ch = curl_init('http://www.yourdomain.com/xml2.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
$result = @curl_exec($ch);
if($result === false) {
	echo "Error performing request";
}
else {
	$xml_doc = simplexml_load_string($result);
	echo 'Status is ', $xml_doc->status, '<br/>';
	if ($xml_doc->status == 'SUCCESS') {
		echo 'Data is ', $xml_doc->data, '<br/>';
	} else {
		echo 'Error is ', $xml_doc->errormessage, '<br/>';
	}
}
?>