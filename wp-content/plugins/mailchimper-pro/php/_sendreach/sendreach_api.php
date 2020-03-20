<?

/**
 * Copyright 2013 SendReach.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */


// set your API details here
// You can find your userid under SendReach.com > Account Settings > Developers
$api_vars['key'] = '';
$api_vars['secret'] = '';
$api_vars['userid'] = ''; // this is the userid that created the API application.

// include the api classes file
   require_once(sprintf("%s/php/sendreach/classes.php", dirname(__FILE__)));
// create a new api instance
$sendreach = new api();

// add subscriber to list
// set new subscriber vars

 $list_id = ''; // list to subscriber new user too
 $first_name = ''; // optional but highly suggested
 $last_name = ''; // option, but highly suggested
 $custom1 = ''; // option, but highly suggested
 $email = ''; // required
 $client_ip = ''; // required

 $subscriber_add = $sendreach->subscriber_add($list_id,$first_name,$last_name,$email,$client_ip,$custom1); // the data is returned in json format
 $subscriber_add = json_decode($subscriber_add); // here we convert the json data into a PHP array
?>