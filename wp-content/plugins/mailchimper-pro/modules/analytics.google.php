<?php
// Manage Google Analytics API functions

class GoogleAnalyticsAPI
{
	var $client = false;
	var $accountId;
	var $baseFeed = 'https://www.googleapis.com/analytics/v3';
	var $token = false;

	/**
	 * Constructor
	 *
	 **/
	function GoogleAnalyticsAPI()
	{
			if ( !class_exists('Google_Client') ) {
			require_once(str_replace("modules/","",sprintf("%s/lib/google-api-php-client/src/Google_Client.php", dirname(__FILE__))));
			}
			if ( !class_exists('Google_AnalyticsService') ) {
			require_once(str_replace("modules/","",sprintf("%s/lib/google-api-php-client/src/contrib/Google_AnalyticsService.php", dirname(__FILE__))));
			}
            $this->client = new Google_Client();
            $this->client->setApprovalPrompt("force");
            $this->client->setAccessType('offline');
            $this->client->setClientId(SSFPRO_GA_CLIENTID);
            $this->client->setClientSecret(SSFPRO_GA_CLIENTSECRET);
            $this->client->setRedirectUri(SSFPRO_GA_REDIRECT);
            $this->client->setScopes(array("https://www.googleapis.com/auth/analytics"));
            $this->client->setUseObjects(true);

            try {
                    $this->analytics = new Google_AnalyticsService($this->client);
                }
            catch (Google_ServiceException $e)
                {
                    print 'Google Analytics API Service Error ' . $e->getCode() . ':' . $e->getMessage();
					return false;
                }
	}

	function checkLogin()
	{

            $ga_google_authtoken  = get_option('ssfpro_setting_ganalytics_auth_token');
            if (!empty($ga_google_authtoken))
            {
				try
                {
                    $this->client->setAccessToken($ga_google_authtoken);
				}
				catch( Google_AuthException $e )
                {
                    print 'MailChimper PRO can\'t authenticate with Google. <a href="/wp-admin/admin.php?page=mailchimper_pro_generalsettings&deauth=1"> Deauthorize (Reset) and try again later.</a>
                            <br><br><strong>Error Code: </strong> ' . $e->getCode() . ':' . $e->getMessage();

                    return false;
                }
            }
            else
            {
                $authCode = get_option('ssfpro_setting_ganalytics');
                if (empty($authCode)) return false;

                try
                {
                    $accessToken = $this->client->authenticate($authCode);
                }
                catch( Exception $e )
                {
                    print 'MailChimper PRO can\'t authenticate with Google. <a href="/wp-admin/admin.php?page=mailchimper_pro_generalsettings&deauth=1"> Deauthorize (Reset) and try again later.</a>
                            <br><br><strong>Error Code: </strong> ' . $e->getCode() . ':' . $e->getMessage();

                    return false;
                }

                if($accessToken)
                {
                    $this->client->setAccessToken($accessToken);
                    if (!empty($accessToken)) update_option('ssfpro_setting_ganalytics_auth_token', $accessToken);
                }
                else
                {
                    return false;
                }
            }

            $this->token =  $this->client->getAccessToken();
            return true;
	}

	function getSingleProfile()
	{
            $webproperty_id = get_option('ssfpro_setting_gprofile');
            list($pre, $account_id, $post) = explode('-',$webproperty_id);

            if (empty($webproperty_id)) return false;

            try {
                $profiles = $this->analytics->management_profiles->listManagementProfiles($account_id, $webproperty_id);
            }
            catch (Google_ServiceException $e)
            {
                print 'Google Analytics API Service Error: ' . $e->getCode() . ': ' . $e->getMessage();
                return false;
            }

            $profile_id = $profiles->items[0]->id;
            if (empty($profile_id)) return false;

            $account_array = array();
            array_push($account_array, array('id'=>$profile_id, 'ga:webPropertyId'=>$webproperty_id));
            return $account_array;
	}

        function getAllProfiles()
        {
            $profile_array = array();
            
            try {
                    $profiles = $this->analytics->management_webproperties->listManagementWebproperties('~all');
                }
                catch (Google_ServiceException $e)
                {
                    print 'Google Analytics API service error ' . $e->getCode() . ': ' . $e->getMessage();
                }


            if( !empty( $profiles->items ) )
            {
                foreach( $profiles->items as $profile )
                {
                    $profile_array[ $profile->id ] = str_replace('http://','',$profile->name );
                }
            }

            return $profile_array;
        }

	function getAnalyticsAccounts()
	{
		$analytics = new Google_AnalyticsService($this->client);
		$accounts = $analytics->management_accounts->listManagementAccounts();
		$account_array = array();

		$items = $accounts->getItems();

		if (count($items) > 0) {
			foreach ($items as $key => $item)
			{
				$account_id = $item->getId();

				$webproperties = $analytics->management_webproperties->listManagementWebproperties($account_id);

				if (!empty($webproperties))
				{
					foreach ($webproperties->getItems() as $webp_key => $webp_item) {
						$profiles = $analytics->management_profiles->listManagementProfiles($account_id, $webp_item->id);

						$profile_id = $profiles->items[0]->id;
						array_push($account_array, array('id'=>$profile_id, 'ga:webPropertyId'=>$webp_item->id));
					}
				}
			}

			return $account_array;
		}
		return false;

	}

	/**
	 * Sets the account id to use for queries
	 *
	 * @param id - the account id
	 **/
	function setAccount($id)
	{
		$this->accountId = $id;
	}


	/**
	 * Get a specific data metrics
	 *
	 * @param metrics - the metrics to get
	 * @param startDate - the start date to get
	 * @param endDate - the end date to get
	 * @param dimensions - the dimensions to grab
	 * @param sort - the properties to sort on
	 * @param filter - the property to filter on
	 * @param limit - the number of items to get
	 * @return the specific metrics in array form
	 **/
	function getMetrics($metric, $startDate, $endDate, $dimensions = false, $sort = false, $filter = false, $limit = false)
	{
		$analytics = new Google_AnalyticsService($this->client);

		$params = array();

		if ($dimensions!='') $params['dimensions'] = $dimensions;
		if ($sort!='') $params['sort'] = $sort;
		if ($filter!='') $params['filters'] = $filter;
		if ($limit!='') $params['max-results'] = $limit;
          $filtered_id = str_replace( 'ga:', '', $this->accountId );           
          if(!$filtered_id){
                echo 'Google Analytics Error: Account ID is empty';
                return false;
           }
 	   return $analytics->data_ga->get(
	       'ga:'.$filtered_id,
	       $startDate,
	       $endDate,
	       $metric,
	       $params
	       );
	}

	/**
	 * Checks the date against Jan. 1 2005
	 * @param date - the date to compare
	 * @return the correct date
	 **/
	function verifyStartDate($date)
	{
		if ( strtotime($date) > strtotime('2005-01-01') )
			return $date;
		else
			return '2005-01-01';
	}

} // END class
?>