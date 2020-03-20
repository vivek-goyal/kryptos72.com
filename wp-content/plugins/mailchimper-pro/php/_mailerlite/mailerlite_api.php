<?php
require_once(sprintf("%s/php/mailerlite/base/ML_Rest.php", dirname(__FILE__)));
$ML_Subscribers = new ML_Subscribers( API_KEY );

$subscriber = array(
    'email' => 'first@example.com',
    'name' => 'First name',
    'fields' => array( 
       array( 'name' => 'custom_field_1', 'value' => "field value 1" ),
       array( 'name' => 'custom_field_2', 'value' => "field value 2" )
    )
);
$subscriber = $ML_Subscribers->setId( LIST_ID )->add( $subscriber, 1 );
?>