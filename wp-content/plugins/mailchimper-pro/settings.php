<?php
if ( ! class_exists( 'simple_signup_pro_settings' ) ) {
	class simple_signup_pro_settings extends simple_signup_pro {
	/**
	* Construct the plugin object
	**/
		public function __construct() {
		global $wpdb;
		$this->wpdb =& $wpdb;
		/**
		* register actions, hook into WP's admin_init action hook
		**/
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		add_action( 'admin_menu', array( &$this, 'add_menu' ) );
		add_action( 'admin_head', array( &$this, 'pantherius_add_shortcode_button' ) );
		add_action( 'wp_ajax_ajax_ssp', array( &$this, 'ajax_ssp' ) );
		add_action( 'wp_ajax_nopriv_ajax_ssp', array( &$this, 'ajax_ssp' ) );
		if ( ! class_exists( 'GoogleAnalyticsAPI' ) ) {
			require_once( str_replace( "templates/", "", sprintf( "%s/modules/analytics.google.php", dirname( __FILE__ ) ) ) );
		}
		}
		/**
		* include custom scripts and style to the posts & pages page
		**/
		function enqueue_adminpost_custom_scripts_and_styles() {
			wp_enqueue_style( 'mailchimper_pro_shortcode_button_style', plugins_url( '/templates/assets/css/shortcode-button.css', __FILE__ ) );
		}
		
		public function secondsToTime($seconds) {
			$dtF = new DateTime("@0");
			$dtT = new DateTime("@$seconds");
			return $dtF->diff($dtT)->format('%i:%s');
		}
		/**
		* include custom scripts and style to the admin page
		**/
		function enqueue_admin_custom_scripts_and_styles() {
			if ( isset( $_REQUEST[ 'page' ] ) ) {
				$settings_page = $_REQUEST[ 'page' ];
			}
			wp_enqueue_style( 'mailchimper_pro_admin_style', plugins_url( '/templates/assets/css/plugin_settings.css' , __FILE__ ));
			wp_enqueue_style( 'mailchimper_pro_style', plugins_url( '/templates/assets/css/plugin.css' , __FILE__ ));
			wp_enqueue_style( 'mailchimper_pro_ui_style', plugins_url( '/templates/assets/css/jquery-ui.css' , __FILE__ ));
			//wp_enqueue_style( 'pantherius_ui_theme', plugins_url( '/templates/assets/css/pantherius-jquery-ui.css', __FILE__ ), array(), MODAL_SURVEY_VERSION );
			wp_enqueue_style( 'mailchimper_pro_datatable_style', plugins_url( '/templates/assets/css/datatables.min.css' , __FILE__ ));
			wp_enqueue_style( 'mailchimper_pro_cmu_style', plugins_url( '/templates/assets/css/custom-media-uploader.css' , __FILE__ ));
			wp_enqueue_script( 'jquery');
			wp_enqueue_script( 'jquery-ui-core',array( 'jquery' ) );
			wp_enqueue_script( 'jquery-ui-tabs',array( 'jquery-ui-core' ) );
			wp_enqueue_script( 'jquery-ui-slider',array( 'jquery-ui-core' ) );
			wp_enqueue_script( 'jquery-ui-tooltip',array( 'jquery-ui-core' ) );
			wp_enqueue_script( 'jquery-ui-accordion',array( 'jquery-ui-core' ) );
			wp_enqueue_script( 'jquery-ui-dialog',array( 'jquery-ui-core' ) );
			wp_enqueue_script( 'jquery-effects-core',array( 'jquery' ) );
			wp_enqueue_script( 'jquery-effects-fade',array( 'jquery-effects-core' ) );
			wp_enqueue_media();			
			wp_enqueue_script( 'mailchimper_pro_cmu_script', plugins_url('/templates/assets/js/custom-media-uploader.js' , __FILE__ ), array('jquery'));
			wp_enqueue_script('mailchimper_pro', plugins_url( '/templates/assets/js/plugin.js' , __FILE__ ) , array('jquery'),'100018');
			wp_enqueue_script( "mailchimper_pro_chart", plugins_url('/templates/assets/js/Chart.min.js' , __FILE__ ));
			if (get_option('ssfpro_setting_gprofile')!=''&&$_REQUEST['page']=='mailchimper_pro_stats'&&$_REQUEST['page']=='mailchimper_pro_stats'&&get_option('ssfpro_setting_stats')=='on') 
			{
				if (isset($_REQUEST['stat'])) $ganalytics = $_REQUEST['stat'];
				else $ganalytics = 'link';
			}
			else $ganalytics = '';
			if ( strpos( $settings_page, 'mailchimper_pro_savedforms' ) !== false && isset( $_REQUEST[ 'ssfpro_id' ] )) {
				wp_register_script('mailchimper_pro_admin', plugins_url( '/templates/assets/js/plugin_admin.js' , __FILE__ ) , array('jquery-ui-core'),'100018', true);	
				wp_localize_script( 'mailchimper_pro_admin', 'sspa_params', array( 'plugin_url'=>plugins_url( '' , __FILE__ ), 'admin_url'=>admin_url( 'admin-ajax.php'), 'madmin_url'=>admin_url(), 'adminpage_url'=>admin_url( 'admin.php?page=mailchimper_pro_savedforms' ), 'ganalytics'=>$ganalytics, 'dtables'=> "false"));
			}
			else {
				wp_enqueue_script('mailchimper_pro_datatable', plugins_url( '/templates/assets/js/datatables.min.js' , __FILE__ ) , array('jquery'),'100002', true);
				wp_register_script('mailchimper_pro_admin', plugins_url( '/templates/assets/js/plugin_admin.js' , __FILE__ ) , array('jquery-ui-core','mailchimper_pro_datatable'),'100018', true);
				wp_localize_script( 'mailchimper_pro_admin', 'sspa_params', array( 'plugin_url'=>plugins_url( '' , __FILE__ ), 'admin_url'=>admin_url( 'admin-ajax.php'), 'madmin_url'=>admin_url(), 'adminpage_url'=>admin_url( 'admin.php?page=mailchimper_pro_savedforms' ), 'ganalytics'=>$ganalytics, 'dtables'=> "true"));
			}
			wp_enqueue_script( 'mailchimper_pro_admin' );
			wp_enqueue_script( "mailchimper_pro_colorpicker_script", plugins_url('/templates/assets/js/colorpicker.js' , __FILE__ ) );
			wp_enqueue_style( 'mailchimper_pro_colorpicker_style', plugins_url( '/templates/assets/css/colorpicker.css' , __FILE__ ) );
		}
		/**
		* Extend editor with shortcode button
		**/
		function pantherius_add_shortcode_button() {
			global $typenow, $wpdb;
			// check user permissions
			if ( !current_user_can('edit_posts')&&!current_user_can('edit_pages') ) {
			return;
			}
			// verify the post type
			if( ! in_array( $typenow, array( 'post', 'page' ) ) )
				return;
			// check if WYSIWYG is enabled
			if ( get_user_option('rich_editing') == 'true') {
				add_filter("mce_external_plugins", array(&$this, "pantherius_add_tinymce_plugin"));
				add_filter('mce_buttons', array(&$this, 'pantherius_register_extra_button'));
				$assql = "SELECT id,name FROM ".$wpdb->base_prefix."simple_subscription_popup ORDER BY id ASC";
				$res_sql = $wpdb->get_results($assql);
				if (empty($res_sql)) $res_sql='';
			?>
				<script type='text/javascript'>
				var ssfp_shortcode_button = {
					'datas': <?php echo json_encode($res_sql); ?>
				};
				</script>
				<?php
			}
		}
		
		function pantherius_add_tinymce_plugin($plugin_array) {
			$plugin_array['ssfp_shortcode_button'] = plugins_url( '/templates/assets/js/shortcode-button.js', __FILE__ );
			return $plugin_array;
		}
		
		function pantherius_register_extra_button($buttons) {
		   array_push($buttons, "ssfp_shortcode_button");
		   return $buttons;
		}
		/**
		* initialize datas on wp admin
		**/
		public function admin_init()
		{
		$gares = '';$gaurl = '';
		if (! function_exists('curl_init')) {
		$gares = 'Google Analytics Error: CURL PHP extension is disabled on your server.';
		}

		if (! function_exists('json_decode')) {
		$gares = 'Google Analytics Error: JSON PHP extension is disabled on your server.';
		}

		if (! function_exists('http_build_query')) {
		$gares = 'Google Analytics Error: http_build_query() is disabled on your server.';
		}
		if ($gares=='')
		{
		$gaurl = http_build_query( array(
								'next' =>admin_url("admin.php?page=mailchimper_pro"),
                                'scope' => SSFPRO_GA_SCOPE,
                                'response_type'=>'code',
                                'redirect_uri'=>SSFPRO_GA_REDIRECT,
                                'client_id'=>SSFPRO_GA_CLIENTID
								)
						);
		$gares = '<a onclick="window.open(\'https://accounts.google.com/o/oauth2/auth?'.$gaurl.'\',\'activate\',\'width=700, height=600, menubar=0, status=0, location=0, toolbar=0\')" target="_blank" href="javascript:void(0);">Click here</a> to connect the plugin to your Google Analytics Account. You can open the authorization page in a <a target="_blank" href="https://accounts.google.com/o/oauth2/auth?'.$gaurl.'">new window here.</a>';
		}
		$settings_page = '';
		if ( isset( $_REQUEST[ 'deauth' ] ) && ! isset( $_REQUEST[ 'settings-updated' ] ) ) {
			update_option( 'ssfpro_setting_ganalytics', '' );
            update_option( 'ssfpro_setting_ganalytics_auth_token', '' );
            update_option( 'ssfpro_setting_gprofile', '' );
		}
			if ( isset( $_REQUEST[ 'page' ] ) ) {
				$settings_page = $_REQUEST[ 'page' ];
			}
			if ( strpos( $settings_page, 'mailchimper_pro' ) !== false ) {
				add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_admin_custom_scripts_and_styles' ) );
			}
			else {
				add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_adminpost_custom_scripts_and_styles' ) );
			}
			// Possibly do additional admin_init tasks
			register_setting('ssf_form-group', 'ssfpro_setting_keep_settings');
			register_setting('ssf_form-group', 'ssfpro_setting_stats');
			register_setting('ssf_form-group', 'ssfpro_setting_minify');
			register_setting('ssf_form-group', 'ssfpro_setting_plugininit');
			if (get_option('ssfpro_setting_ganalytics')=='') register_setting('ssf_form-group', 'ssfpro_setting_ganalytics');
			if (get_option('ssfpro_setting_ganalytics_auth_token')=='') register_setting('ssf_form-group', 'ssfpro_setting_ganalytics_auth_token');
			if (get_option('ssfpro_setting_gprofile')=='') register_setting('ssf_form-group', 'ssfpro_setting_gprofile');

			// add your settings section
			add_settings_section('ssf_form-section', '', array(&$this, 'settings_section_ssf_form'), 'ssf_form');
			// add your setting's fields
			add_settings_field('ssf_form-ssfpro_setting_keep_settings', 'Keep Settings', array(&$this, 'settings_field_input_radio'), 'ssf_form', 'ssf_form-section', array('field' => 'ssfpro_setting_keep_settings', 'field_value' => '', 'options' => array("On"=>"on","Off"=>"off"), 'other' => '', 'extrahtml' => '<div class="arrow_box"><p>Keeps your settings during uninstall. Helps to protect your saved datas when updating to a new version.</p></div>'));
			add_settings_field('ssf_form-ssfpro_setting_stats', 'Enable Stats', array(&$this, 'settings_field_input_radio'), 'ssf_form', 'ssf_form-section', array('field' => 'ssfpro_setting_stats', 'field_value' => '', 'options' => array("On"=>"on","Off"=>"off"), 'other' => '', 'extrahtml' => '<div class="arrow_box"><p>Track the effectiveness of your Signup Forms.</p></div>'));
			add_settings_field('ssf_form-ssfpro_setting_minify', 'Minify Scripts', array(&$this, 'settings_field_input_radio'), 'ssf_form', 'ssf_form-section', array('field' => 'ssfpro_setting_minify', 'field_value' => '', 'options' => array("On"=>"on","Off"=>"off"), 'other' => '', 'extrahtml' => '<div class="arrow_box"><p>Use minified and obfuscated JavaScript files on frontend.</p></div>'));
			if (get_option('ssfpro_setting_ganalytics')=='') add_settings_field('ssf_form-ssfpro_setting_ganalytics', 'Google Analytics Key', array(&$this, 'settings_field_input_text'), 'ssf_form', 'ssf_form-section', array('field' => 'ssfpro_setting_ganalytics', 'field_value' => '', 'other' => '', 'extrahtml' => '<div class="arrow_box"><p>'.$gares.'</p></div>'));
			if (get_option('ssfpro_setting_gprofile')!='') $profile_tooltip = '<div class="arrow_box"><p>Successfully connected to Google Analytics. <a href="'.admin_url('admin.php?page=mailchimper_pro_generalsettings&deauth=1').'">Deauthorize Google Analytics</a></p></div>';
			else $profile_tooltip = '<div class="arrow_box"><p>Select your Google Analytics Profile and click on the Save Changes button.</p></div>';
			if (get_option('ssfpro_setting_ganalytics')!='') add_settings_field('ssf_form-ssfpro_setting_gprofile', __( 'Google Analytics Profile', SSPRO_TEXT_DOMAIN ), array(&$this, 'settings_field_input_select'), 'ssf_form', 'ssf_form-section', array('field' => 'ssfpro_setting_gprofile', 'field_value' => '', 'other' => 'gprofile', 'extrahtml' => $profile_tooltip));
			add_settings_field('ssf_form-ssfpro_setting_plugininit', 'Initialize plugin', array(&$this, 'settings_field_input_select'), 'ssf_form', 'ssf_form-section', array('field' => 'ssfpro_setting_plugininit', 'field_value' => '', 'other' => 'plugininit', 'extrahtml' => '<div class="arrow_box"><p>Change the initialization hook if you have troubles with the signup form display.</p></div>'));

			// register your custom settings - custom CSS settings
			register_setting('ssf_form_customcss-group', 'ssfpro_setting_customcss');
			// add your settings section
			add_settings_section('ssf_form_customcss-section', '', array(&$this, 'settings_section_ssf_form'), 'ssf_form_customcss');
			add_settings_field('ssf_form-ssfpro_setting_customcss', __( 'Enter you custom CSS code', SSPRO_TEXT_DOMAIN ), array(&$this, 'settings_field_input_textarea'), 'ssf_form_customcss', 'ssf_form_customcss-section', array('field' => 'ssfpro_setting_customcss', 'field_value' => '', 'other' => 'rows="20" cols="100" placeholder=".class {
	color: #000000;
}"'));
		}
		function get_ganalytics_profile()
		{
			$accounts = array();
			# Create a new Gdata call
			if ( isset($_POST['token']) && $_POST['token'] != '' )
				$ga_res = new GoogleAnalyticsAPI($_POST['token']);
			elseif ( trim(get_option('ssfpro_setting_stats')) != '' )
				$ga_res = new GoogleAnalyticsAPI();
			else
				return false;
			if ( ! $ga_res->checkLogin() )
				return false;
			$accounts = $ga_res->getAllProfiles();
			natcasesort ($accounts);
			if ( count($accounts) > 0 )	return $accounts;
			else return false;
		}
		/**
		* This function provides select inputs for settings fields
		**/
		public function settings_field_input_select($args)
		{
			// Get the field name from the $args array or get the value of this setting
			$field = $args['field'];
			if ($args['field_value']) $value = $args['field_value'];
			else $value = get_option($field);
			if ($args['other']=='gprofile')
			{
				if (get_option('ssfpro_setting_gprofile')=='')
				{
					$profile = $this->get_ganalytics_profile();
					echo sprintf('<select name="%s" id="%s" style="width: 150px;">', $field, $field);
					foreach($profile as $key=>$sites) echo('<option value="'.$key.'" '.selected($value,$key,false).'>'.$sites.'</option>');
					echo('</select>');
				}
				else print('<div style="width:150px;">Connected</div>');
			}
			elseif ( $args['other'] == 'plugininit' ) {
					echo sprintf('<select name="%s" id="%s" style="width: 220px;">', $field, $field);
					echo('<option value="getfooter" ' . selected( $value, 'getfooter', false ) . '>when calling get_footer() hook</option>' );
					echo('<option value="wpfooter" ' . selected( $value, 'wpfooter', false ) . '>when calling wp_footer() hook</option>' );
					echo('<option value="aftercontent" ' . selected( $value, 'aftercontent', false ) . '>when print the content</option>' );
					echo('</select>');				
			}
			else
			{
			if (isset($args['min'])) $field_min = $args['min'];
			if (isset($args['max'])) $field_max = $args['max'];
			if (isset($args['default'])) $field_default = $args['default'];
				if (!isset($field_min)) $field_min = 1;
				if (!isset($field_max)) $field_max = 10;
				if (!isset($field_default)) $field_default = 5;
			// echo a proper select element
				echo sprintf('<select name="%s" id="%s">', $field, $field);
				for($i=$field_min;$i<=$field_max;$i++) {
					$selected = '';
					if ($value==$i) $selected = 'selected = "true"';
					if (!$value AND $i==$field_default) $selected = 'selected = "true"';
					echo('<option value="'.$i.'" '.$selected.'>'.$i.'</option>');
				}
				echo('</select>');
			}
			if (isset($args['extrahtml'])) echo($args['extrahtml']);
		}
		/**
		* This function provides textarea inputs for settings fields
		**/
		public function settings_field_input_textarea( $args ) {
			$other = $args['other'];
			// Get the field name from the $args array or get the value of this setting
			$field = $args['field'];
			if ($args['field_value']) $value = $args['field_value'];
			else $value = get_option($field);
			// echo a proper input type="textarea"
			if (!empty($other)) echo sprintf('<textarea name="%s" id="%s" %s />%s</textarea>', $field, $field, $other, $value);
			else echo sprintf('<textarea name="%s" id="%s" />%s</textarea>', $field, $field, $value);
		}
		/**
		* This function provides radio inputs for settings fields
		**/
        public function settings_field_input_radio( $args ) {
			$key = '';
             $other = $args['other'];
            $options = $args['options'];
 			// Get the field name from the $args array or get the value of this setting
			$field = $args['field'];
			if ($args['field_value']) $value = $args['field_value'];
			else $value = get_option($field);
            // echo a proper input type="radio"
			foreach($options as $key=>$opt) 
			{
				if ($value==$opt OR (!$value AND $opt=="off")) $selected = 'checked="true"';
				else $selected = "";
				echo sprintf('<input type="radio" name="%s" id="%s%s" '.$selected.' value="%s" /> <label for="%s%s"> '.$key.'</label> ', $field, $field, $opt, $opt, $field, $opt);
			}
			if (isset($args['extrahtml'])) echo($args['extrahtml']);
		}
		/**
		* This function provides text inputs for settings fields
		**/
		public function settings_field_input_text($args)
		{
			$other = $args['other'];
			// Get the field name from the $args array or get the value of this setting
			$field = $args['field'];
			if ($args['field_value']) $value = $args['field_value'];
			else $value = get_option($field);
			// echo a proper input type="text"
			if (!empty($other)) echo sprintf('<input type="text" name="%s" id="%s" value="%s" %s />', $field, $field, $value, $other);
			else echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
			if (isset($args['extrahtml'])) echo($args['extrahtml']);
		}
		/**
		* add a menu
		**/		
		public function add_menu()
		{
			add_menu_page('MailChimper PRO', 'MailChimper PRO', 'manage_options', 'mailchimper_pro', array(&$this, 'plugin_settings_page'),'dashicons-email-alt','65.013');
			add_submenu_page('mailchimper_pro', 'MailChimper PRO', 'New Form', 'manage_options', 'mailchimper_pro', array(&$this, 'plugin_settings_page'));
			add_submenu_page('mailchimper_pro', 'MailChimper PRO', 'Saved Forms', 'manage_options', 'mailchimper_pro_savedforms', array(&$this, 'plugin_settings_page_savedforms'));
			add_submenu_page('mailchimper_pro', 'MailChimper PRO', 'Subscribers', 'manage_options', 'mailchimper_pro_subscribers', array(&$this, 'general_settings_page_subscribers'));
			add_submenu_page('mailchimper_pro', 'MailChimper PRO', 'Stats', 'manage_options', 'mailchimper_pro_stats', array(&$this, 'general_settings_page_stats'));
			add_submenu_page('mailchimper_pro', 'MailChimper PRO', 'General Settings', 'manage_options', 'mailchimper_pro_generalsettings', array(&$this, 'general_settings_page_generalsettings'));
			add_submenu_page('mailchimper_pro', 'MailChimper PRO', 'Custom CSS', 'manage_options', 'mailchimper_pro_customcss', array(&$this, 'plugin_settings_page_customcss'));
			add_submenu_page('mailchimper_pro', 'MailChimper PRO', 'Update', 'manage_options', 'mailchimper_pro_update', array(&$this, 'plugin_settings_page_update'));
			add_submenu_page('mailchimper_pro', 'MailChimper PRO', 'Help', 'manage_options', 'mailchimper_pro_help', array(&$this, 'general_settings_page_help'));
		}
		public function settings_section_ssf_form()
		{
		
		}
		/**
		* Menu Callback
		**/		
		public function plugin_settings_page() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.', SSPRO_TEXT_DOMAIN ) );
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_newform.php", dirname(__FILE__)));
		}
		public function plugin_settings_page_savedforms() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.', SSPRO_TEXT_DOMAIN ) );
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_savedforms.php", dirname(__FILE__)));
		}
		public function plugin_settings_page_update() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.', SSPRO_TEXT_DOMAIN ) );
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_update.php", dirname(__FILE__)));
		}
		public function general_settings_page_subscribers() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.', SSPRO_TEXT_DOMAIN ) );
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_subscribers.php", dirname(__FILE__)));
		}
		public function general_settings_page_stats() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.', SSPRO_TEXT_DOMAIN ) );
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_stats.php", dirname(__FILE__)));
		}
		public function general_settings_page_generalsettings() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.', SSPRO_TEXT_DOMAIN ) );
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_general.php", dirname(__FILE__)));
		}
		public function general_settings_page_help() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.', SSPRO_TEXT_DOMAIN ) );
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_help.php", dirname(__FILE__)));
		}
		public function plugin_settings_page_customcss() {
			if( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.', SSPRO_TEXT_DOMAIN ) );
			}
			// Render the settings template
			include(sprintf("%s/templates/settings_customcss.php", dirname(__FILE__)));
		}
		public function settings_section_mailchimper_pro() {
		
		}
		
		function get_stats( $stat ) {
		global $wpdb;
		$data_exists = 0; $chart_datas = array(); $charttype = "";
				$ga_res = new GoogleAnalyticsAPI();
				if ( ! $ga_res->checkLogin() ) print('Error with Logging in to Google Analytics.');
				$accs = $ga_res->getAnalyticsAccounts();
				foreach($accs as $ac) {if ($ac['ga:webPropertyId']==get_option('ssfpro_setting_gprofile')) $ga_res->setAccount($ac['id']);}	
				
				if ($stat=="date")
				{
				$rsql = "SELECT ssps.*, ssps.sdate,ssp.name, COUNT(ssps.autoid) as subscribers, DATE_FORMAT(ssps.sdate,'%d-%m-%Y') as fsdate, DATE_FORMAT(ssps.sdate,'%Y-%m-%d') as fcsdate FROM ".$wpdb->base_prefix."simple_subscription_popup_stats ssps 
				LEFT JOIN ".$wpdb->base_prefix."simple_subscription_popup ssp on ssps.formid = ssp.id GROUP BY DATE_FORMAT(sdate,'%m-%d-%Y') ORDER BY ssps.sdate DESC";
				$ssp_rsql = $wpdb->get_results($rsql);
				$garesult = '<table class="ssfp-table ssfp-table-date display">
						<thead>
							<tr>
								<th class="first">Date</th>
								<th class="third">FormViews</th>
								<th class="third">Entrances</th>
								<th class="second">Subscribers</th>
							</tr>
						</thead>
						<tbody>';
					$before = date('Y-m-d', strtotime('-30 days'));
					$yesterday = date('Y-m-d', strtotime('+1 day'));
					$res = $ga_res->getMetrics('ga:totalEvents,ga:uniqueEvents', $before, $yesterday,'ga:eventCategory, ga:date','-ga:date','ga:eventCategory==MailChimper PRO','100');
					if (!empty($res->rows))
					{
						foreach($res->rows as $rkey => $rvalue)
						{
						$subscr = '0';$data_exists = 1;
						$gadate = (string)$rvalue[1];
						$gadate_formatted = substr($gadate,-2,2).'-'.substr($gadate,-4,2).'-'.substr($gadate,0,4);
							if (!empty($ssp_rsql)) {foreach($ssp_rsql as $ikey => $ivalue) {if ($gadate_formatted==$ivalue->fsdate) $subscr = $ivalue->subscribers;}}
							$chart_datas[] = array($gadate_formatted, $subscr); 
							$garesult .= '<tr><td>'.$gadate_formatted.'</td><td>'.$rvalue[2].'</td><td>'.$rvalue[3].'</td><td>'.$subscr.'</td></tr>';
						}
						$garesult .= '</tbody></table>';
						$charttype = "bar";
					}
				}
				elseif ($stat=="form")
				{
				$rsql = "SELECT ssps.*,ssp.name, COUNT(ssps.autoid) as subscribers FROM ".$wpdb->base_prefix."simple_subscription_popup_stats ssps 
				LEFT JOIN ".$wpdb->base_prefix."simple_subscription_popup ssp on ssps.formid = ssp.id GROUP BY ssps.formid ORDER BY ssps.formid ASC";
				$ssp_rsql = $wpdb->get_results($rsql);
				$garesult = '<table class="ssfp-table ssfp-table-form display">
						<thead>
							<tr>
								<th class="first">Form ID</th>
								<th class="second">Form Name</th>
								<th class="third">FormViews</th>
								<th class="third">Entrances</th>
								<th class="fourth">Subscribers</th>
							</tr>
						</thead>
						<tbody>';
					$before = date('Y-m-d', strtotime('-30 days'));
					$yesterday = date('Y-m-d', strtotime('+1 day'));
					$res = $ga_res->getMetrics('ga:totalEvents, ga:uniqueEvents', $before, $yesterday,'ga:eventAction','-ga:eventAction','ga:eventCategory==MailChimper PRO','100');
					if (!empty($res->rows))
					{
						foreach($res->rows as $rkey => $rvalue)
						{
						$subscr = '0';$sname = 'Unknown';$data_exists = 1;
							if (!empty($ssp_rsql)) {foreach($ssp_rsql as $ikey => $ivalue) {if ($rvalue[0]==$ivalue->formid) {$subscr = $ivalue->subscribers;$sname = $ivalue->name;}}}
							else {
								$sname = $wpdb->get_var($wpdb->prepare("SELECT name FROM ".$wpdb->base_prefix."simple_subscription_popup ORDER BY ssps.formid ASC",$rvalue[0]));
								if (!$sname) $sname = "Unknown";
							}
						$chart_datas[] = array($sname, $subscr); 
						$garesult .= '<tr><td>'.$rvalue[0].'</td><td>'.$sname.'</td><td>'.$rvalue[1].'</td><td>'.$rvalue[2].'</td><td>'.$subscr.'</td></tr>';
						}
					}
					$garesult .= '</tbody></table>';
					$charttype = "polar";
				}
				elseif ($stat=="link")
				{
				$rsql = "SELECT ssps.*,ssp.name, COUNT(ssps.autoid) as subscribers FROM ".$wpdb->base_prefix."simple_subscription_popup_stats ssps 
				LEFT JOIN ".$wpdb->base_prefix."simple_subscription_popup ssp on ssps.formid = ssp.id GROUP BY ssps.link ORDER BY ssps.link ASC";
				$ssp_rsql = $wpdb->get_results($rsql);
				$garesult = '<table class="ssfp-table ssfp-table-link display">
						<thead>
							<tr>
								<th class="third">Link</th>
								<th class="third">PageViews</th>
								<th class="third">Entrances</th>
								<th class="fourth">Subscribers</th>
							</tr>
						</thead>
						<tbody>';
					$before = date('Y-m-d', strtotime('-30 days'));
					$yesterday = date('Y-m-d', strtotime('+1 day'));
					$res = $ga_res->getMetrics('ga:totalEvents, ga:uniqueEvents', $before, $yesterday,'ga:eventLabel','-ga:eventLabel','ga:eventCategory==MailChimper PRO','100');
					if (!empty($res->rows))
					{
						foreach($res->rows as $rkey => $rvalue)
						{
						$subscr = '0';$data_exists = 1;
							if (!empty($ssp_rsql)) {foreach($ssp_rsql as $ikey => $ivalue) {if ($rvalue[0]==$ivalue->link) {$subscr = $ivalue->subscribers;}}}
						$chart_datas[] = array($rvalue[0], $subscr); 
						$garesult .= '<tr><td><a target="_blank" href="'.$rvalue[0].'">'.$rvalue[0].'</a></td><td>'.$rvalue[1].'</td><td>'.$rvalue[2].'</td><td>'.$subscr.'</td></tr>';
						}
						$garesult .= '</tbody></table>';
						$charttype = "pie";
					}
				}
				if ($data_exists == 0) $garesult = '<p>Stats are currently empty.</p>';
				else $garesult .= '<div class="ssfp-graph" data-chart="'.$charttype.'"><canvas style="width: 100%; height: 100%;"></canvas><div class="graph_params">'.json_encode($chart_datas).'</div></div>';
				return die($garesult);
		}

		public function ajax_ssp()
		{
		global $wpdb;
		if (isset($_REQUEST['sspcmd'])) $sspcmd = $_REQUEST['sspcmd'];
			if ($sspcmd=="analytics")
			{
				if (isset($_REQUEST['type'])) $this->get_stats($_REQUEST['type']);
			}
			else
			{
				if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
				{
					if ($sspcmd=="getapiinfo")
					{
						if (isset($_REQUEST['field1']))	$field1 = sanitize_text_field($_REQUEST['field1']);
						else $field1 = '';
						if (isset($_REQUEST['field2']))	$field2 = sanitize_text_field($_REQUEST['field2']);
						else $field2 = '';
						if (isset($_REQUEST['field3']))	$field3 = sanitize_text_field($_REQUEST['field3']);
						else $field3 = '';
						if ($_REQUEST['id']=='awebercredentials')
						{
							require_once(sprintf("%s/php/aweber/getapiinfo_aweber.php", dirname(__FILE__)));
						}
						if ($_REQUEST['id']=='benchmarklists')
						{
							require_once(sprintf("%s/php/benchmark/getapiinfo_benchmark.php", dirname(__FILE__)));
						}
						if ($_REQUEST['id']=='campaynlists')
						{
							require_once(sprintf("%s/php/campayn/getapiinfo_campayn.php", dirname(__FILE__)));
						}
						if ($_REQUEST['id']=='constantcontactlists')
						{
							require_once(sprintf("%s/php/constantcontact/getapiinfo_constantcontact.php", dirname(__FILE__)));
						}
						if ($_REQUEST['id']=='getresponselists')
						{
							require_once(sprintf("%s/php/getresponse/getapiinfo_getresponse.php", dirname(__FILE__)));
						}
						if ($_REQUEST['id']=='mymaillists')
						{
							require_once(sprintf("%s/php/mymail/getapiinfo_mymail.php", dirname(__FILE__)));
						}
						if ($_REQUEST['id']=='mailpoetlists')
						{
							require_once(sprintf("%s/php/mailpoet/getapiinfo_mailpoet.php", dirname(__FILE__)));
						}
						if ($_REQUEST['id']=='ymlplists')
						{
							require_once(sprintf("%s/php/ymlp/getapiinfo_ymlp.php", dirname(__FILE__)));
						}
					
					}
					$signup_form_id = "";
					$form_name = "";
					$form_options = "";
					$form_global = "";
					$error_msg = "";
					if (isset($_REQUEST['signup_form_id'])) $signup_form_id = sanitize_text_field($_REQUEST['signup_form_id']);
					else $signup_form_id = "";
					if (isset($_REQUEST['form_name'])) $form_name = sanitize_text_field($_REQUEST['form_name']);
					else $form_name = "";
					if (isset($_REQUEST['global_use'])) $form_global = sanitize_text_field($_REQUEST['global_use']);
					else $form_global = "";
					if (isset($_REQUEST['options'])) $form_options = $_REQUEST['options'];
					else $form_options = "";
					$form_check = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM ".$wpdb->base_prefix."simple_subscription_popup WHERE `id` = %d",$signup_form_id));
					if ( $sspcmd == "save" ) {
						if(!current_user_can('manage_options')) die();
						if ($form_check>0) {
						//update signup form
							$wpdb->update( $wpdb->base_prefix."simple_subscription_popup", array( "options" => $form_options, 'global' => $form_global),array('id' => $signup_form_id));
							die("updated");
						}
						else {
						//insert signup form
							$res = $wpdb->insert( $wpdb->base_prefix."simple_subscription_popup", array( 
								'id' => $signup_form_id, 
								'name' => $form_name, 
								'options' => $form_options, 
								'global'=> $form_global
								) );
							die('success');
						}
					}
					elseif ( $sspcmd == "add" ) {
						if ( $form_check > 0 ) {
							die( 'Form already exists' );
						}
						else {
							$wpdb->insert( $wpdb->base_prefix . "simple_subscription_popup", array( 
								'id' => $signup_form_id, 
								'name' => $form_name, 
								'options' => json_encode(array("0.8",true,"mixed","rgb(255, 255, 255)","rgb(199, 18, 47)","rgb(255, 255, 255)","rgb(0, 0, 0)","14px","rgb(0, 0, 0)","rgb(0, 0, 0)","Source Sans Pro","Source Sans Pro","13px","normal","Subscribe to our Updates","We will only send notification when we releasing <strong>FREE</strong> and Premium <strong>Plugins, Themes</strong> or Updates for any of our existing products.","60px","10px",2,"centercenter","INVALID ADDRESS","SIGNUP SUCCESS!","4px",false,"20px","normal",false,true,false,false,"",false,"999","3px","","","SUBSCRIBE","Enter your email address",true,false,"perspectivein","999","3px","","","","",false,false,false,array(),"rgb(0, 0, 0)","default","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","1","1","","","1","","",false,"","","","",null,"1","","","1","","",false,false)), 
								'global'=> '1'
								) );
								die( admin_url( 'admin.php?page=mailchimper_pro_savedforms&ssfpro_id=' . $signup_form_id ) . 'success');
						}			
					}
					elseif ( $sspcmd == "duplicate" ) {
						if ( isset( $_REQUEST[ 'form_nid' ] )) {
							$form_nid = $_REQUEST[ 'form_nid' ];
						}
						else {
							$form_nid = "";
						}
						$sql_ch = "SELECT id FROM " . $wpdb->base_prefix . "simple_subscription_popup WHERE id = '" . $form_nid . "'";
						$ch_srvy = $wpdb->get_var( $sql_ch );
						if ( $ch_srvy ) {
							die( "exists" );
						}
						$dforms = $this->wpdb->get_row( $wpdb->prepare( "SELECT * FROM " . $this->wpdb->base_prefix . "simple_subscription_popup ssp WHERE ssp.id = %d", $signup_form_id ) );
						if ( empty( $dforms ) ) {
							die( 'duplication failed' );
						}
						$wpdb->insert( $wpdb->base_prefix . "simple_subscription_popup", array( 
							'id' => $form_nid, 
							'name' => $form_name, 
							'options' => $dforms->options, 
							'global'=> $dforms->global
							) );
					die('duplicated');
				}
				elseif( $sspcmd == "delete" ) {
						if(!current_user_can('manage_options')) die();
						if ($form_check>0) {
							$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix."simple_subscription_popup WHERE `id` = %d",$signup_form_id));
							die("deleted");
						}
					}
					elseif ($sspcmd=="subscription_signup")
					{
						$form_options = "";
						if (isset($_REQUEST['email'])) $email = $_REQUEST['email'];
						else $email = "";
						if (isset($_REQUEST['mode'])) $mode = $_REQUEST['mode'];
						else $mode = "";
						if (isset($_REQUEST['double_optin'])) $double_optin = $_REQUEST['double_optin'];
						else $double_optin = "";
						if (isset($_REQUEST['update_existing'])) $update_existing = $_REQUEST['update_existing'];
						else $update_existing = "";
						if (isset($_REQUEST['replace_interests'])) $replace_interests = $_REQUEST['replace_interests'];
						else $replace_interests = "";
						if (isset($_REQUEST['mailchimp_listid'])) $mailchimp_listid = $_REQUEST['mailchimp_listid'];
						else $mailchimp_listid = "";
						if (isset($_REQUEST['send_welcome'])) $send_welcome = $_REQUEST['send_welcome'];
						else $send_welcome = "";
						$customfields = '';
						if (isset($_REQUEST['customfieldsarray']))
						{
							if (!empty($_REQUEST['customfieldsarray']))
							{
								foreach($_REQUEST['customfieldsarray'] as $cfa)
								{
									$mv[$cfa] = $_REQUEST[$cfa];
						$customfields .='
						
'.$cfa.': '.$_REQUEST[$cfa]; 
								}
							}
						}
						else $mv = '';
						$customfields .='
						
IP Address: ' . $_SERVER[ 'REMOTE_ADDR' ] . '
						
Date: ' . date( "d-m-Y H:i" ); 
						if (!empty($signup_form_id)&&($signup_form_id>0))
						{
						$form_check = $wpdb->get_var($wpdb->prepare("SELECT options FROM ".$wpdb->base_prefix."simple_subscription_popup WHERE `id` = %d",$signup_form_id));
						if (!empty($form_check)) $form_options = json_decode(stripslashes($form_check));
						}
						if (empty($form_check)&&!empty($signup_form_id)) $form_options[35] = sanitize_email($signup_form_id);
						//if (!isset($form_options[35])&&($mode=="mail"||$mode=="mixed")) die('Error: Missing Recipient Email');
						if (!filter_var($email, FILTER_VALIDATE_EMAIL)) die('Error: Invalid Email Address');
						else {
						if ( $mode == 'mailchimp' || $mode == 'mixed' ) {
							require_once( sprintf( "%s/php/mailchimp/module_mailchimp.php", dirname( __FILE__ ) ) );
						}
						if ( $mode == 'mail' || $mode == 'mixed' ) {
							if (!empty($form_options[35])) {
							$body = "

You've got a new signup on the http://".$_SERVER['HTTP_HOST'].str_replace('/wp-admin/admin-ajax.php','',$_SERVER['REQUEST_URI'])." website with the following mail address: ".$email.$customfields."
							
							";
								$from_a = 'noreply@'.str_replace("www.","",$_SERVER['HTTP_HOST']);
								$from_name = 'MailChimper Form';
								$header = 'MIME-Version: 1.0' . '\r\n';
								$header .= 'From: "'.$from_name.'" <'.$from_a.'>\r\n';
								$header .= 'Content-type: text/plain; charset=UTF-8' . '\r\n';
								if ( mail( $form_options[ 35 ], 'Subscription Signup', $body, $header, "-f" . $from_a ) ) {
									$result = true;
								}
								elseif ( mail( $form_options[ 35 ], 'Subscription Signup', $body, $header ) ) {
									$result = true;
								}
								else {
									$result = false;
								}
							}
							else {
								$result = true;
							}
						}
						if ( $form_options[ 53 ] == '1' ) {
							require_once(sprintf("%s/php/activecampaign/module_activecampaign.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 57 ] == '1' ) {
							require_once( sprintf( "%s/php/aweber/module_aweber.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 64 ] == '1' ) {
							require_once( sprintf( "%s/php/benchmark/module_benchmark.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 68 ] == '1' ) {
							require_once( sprintf( "%s/php/campaignmonitor/module_campaignmonitor.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 72 ] == '1' ) {
							require_once( sprintf( "%s/php/campayn/module_campayn.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 75 ] == '1' ) {
							require_once( sprintf( "%s/php/constantcontact/module_constantcontact.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 79 ] == '1' ) {
							require_once( sprintf( "%s/php/freshmail/module_freshmail.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 83 ] == '1' ) {
							require_once( sprintf( "%s/php/getresponse/module_getresponse.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 86 ] == '1' ) {
							require_once( sprintf( "%s/php/icontact/module_icontact.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 91 ] == '1' ) {
							require_once( sprintf( "%s/php/infusionsoft/module_infusionsoft.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 95 ] == '1' ) {
							require_once( sprintf( "%s/php/interspire/module_interspire.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 99 ] == '1' ) {
							require_once( sprintf( "%s/php/madmimi/module_madmimi.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 103 ] == '1' ) {
							require_once( sprintf( "%s/php/mailerlite/module_mailerlite.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 106 ] == '1' ) {
							require_once( sprintf( "%s/php/mailigen/module_mailigen.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 110 ] == '1' ) {
							require_once( sprintf( "%s/php/mailjet/module_mailjet.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 114 ] == '1' ) {
							require_once( sprintf( "%s/php/emma/module_emma.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 118 ] == '1' ) {
							require_once( sprintf( "%s/php/mymail/module_mymail.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 120 ] == '1' ) {
							require_once( sprintf( "%s/php/ontraport/module_ontraport.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 125 ] == '1' ) {
							require_once( sprintf( "%s/php/pinpointe/module_pinpointe.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 129 ] == '1' ) {
							require_once( sprintf( "%s/php/sendinblue/module_sendinblue.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 132 ] == '1' ) {
							require_once( sprintf( "%s/php/sendreach/module_sendreach.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 137 ] == '1' ) {
							require_once( sprintf( "%s/php/sendy/module_sendy.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 141 ] == '1' ) {
							require_once( sprintf( "%s/php/simplycast/module_simplycast.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 145 ] == '1' ) {
							require_once( sprintf( "%s/php/ymlp/module_ymlp.php", dirname( __FILE__ ) ) );
						}
						if ( $form_options[ 160 ] == '1' ) {
							require_once( sprintf( "%s/php/mailpoet/module_mailpoet.php", dirname( __FILE__ ) ) );
						}
						if ( $result == true ) {
							if ( get_option( 'ssfpro_setting_stats' ) == 'on' ) {
								$form_check = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM " . $wpdb->base_prefix . "simple_subscription_popup_stats WHERE `formid` = %d AND `email` = %s", $signup_form_id, $email ) );
								if ( ! empty( $form_check ) ) {
									$wpdb->update( $wpdb->base_prefix . "simple_subscription_popup_stats", array( "sdate" => date( "Y-m-d H:i:s" ) ),array('formid' => $signup_form_id, 'email' => $email ) );
								}
								else {
									$wpdb->insert( $wpdb->base_prefix . "simple_subscription_popup_stats", array( 
										'formid' => $signup_form_id, 
										'email' => $email,
										'link' => $_SERVER[ "HTTP_REFERER" ],
										'params' => serialize( $mv ),
										'sdate'=> date( "Y-m-d H:i:s" )
										) );
								}
							}
							die( "success" );
						}
						else {
								if ( $error_msg != "" ) {
									die("Error: ".$error_msg);
								}
								else {
									die("Error: Mail Sending Failure");
								}
							}
						}
					}
				}
				else die();
			}
		}
	}
}
?>