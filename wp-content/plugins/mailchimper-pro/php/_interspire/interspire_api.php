<?php
//searchinfo
// must contain a list id: <List>1</List> or <List>any</List>
// You can also filter the search by Status, Confirmed, CustomFields, Subscriber, Email, Format, Newsletter, Link, etc
// I took the list above from the function GenerateSubscriberSubQuery line 2199 of /api/subscribers.php
$xml = "
<xmlrequest>
	<username>admin</username>
	<usertoken>d467e49b221137215ebdab1ea4e046746de7d0ea</usertoken>
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
</xmlrequest>
";

$ch = curl_init('http://YOUREMAILMARKETER.com/xml.php'); //change to the path to your xml.php file
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
$result = @curl_exec($ch);
if($result != false) {
    $xml_doc = simplexml_load_string($result);
    if($xml_doc != false){
        echo "Result: <br />";
        var_dump($xml_doc);
        echo "<br /><br />";
    }        
} else {
        echo "Error performing request: <br />";
        var_dump($result);
        echo "<br /><br />";
    }    

?>