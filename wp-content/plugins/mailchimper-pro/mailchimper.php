<?php
defined( 'ABSPATH' ) OR exit;
/**
 * Plugin Name: MailChimper PRO
 * Plugin URI: http://simplesignupform.pantherius.com/
 * Description: Easily add and manage signup forms
 * Author: Pantherius
 * Version: 1.8.1
 * Author URI: http://pantherius.com
 */
 
if ( ! class_exists( 'simple_signup_pro' ) ) {
	if (!defined('SSF_PRO_VERSION')) define( 'SSF_PRO_VERSION' , '1.8' );
	if (!defined('SSPRO_TEXT_DOMAIN')) define( 'SSPRO_TEXT_DOMAIN' , 'simple_signup_pro' );
	if (!defined('SSFPRO_GA_CLIENTID')) define('SSFPRO_GA_CLIENTID', '822474455430-olfcm1al55r3v340rmkl77q06hb3oc2d.apps.googleusercontent.com');
	if (!defined('SSFPRO_GA_CLIENTSECRET')) define('SSFPRO_GA_CLIENTSECRET', 'OYAxdLkH27QfScIRuAfroZM9');
	if (!defined('SSFPRO_GA_REDIRECT')) define('SSFPRO_GA_REDIRECT', 'urn:ietf:wg:oauth:2.0:oob');
	if (!defined('SSFPRO_GA_SCOPE')) define('SSFPRO_GA_SCOPE', 'https://www.googleapis.com/auth/analytics');//.readonly
	class simple_signup_pro
	{
		protected static $instance = null;
		var $scripts = array( 'ssdev' => 'plugin.js', 'ssmin' => 'plugin.min.js' );
		var $mainscript = '';
		var $plugininit_array = array();
		/**
		 * Construct the plugin object
		 */
		public function __construct() {
			global $wpdb;
			// installation and uninstallation hooks
			register_activation_hook(__FILE__, array('simple_signup_pro', 'activate'));
			register_deactivation_hook(__FILE__, array('simple_signup_pro', 'deactivate'));
			register_uninstall_hook(__FILE__, array('simple_signup_pro', 'uninstall'));
			if ( is_admin() ) {
				require_once( sprintf( "%s/settings.php", dirname( __FILE__ ) ) );
				$simple_signup_pro_settings = new simple_signup_pro_settings();
				$plugin = plugin_basename(__FILE__);
				add_filter( "plugin_action_links_$plugin", array( &$this, 'plugin_settings_link' ) );
				add_action( 'admin_notices', array( &$this, 'free_version_notice' ) );
			}
			else {
				$simple_signup_pro_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$simple_signup_pro_load = true;
				if ( ( strpos( $simple_signup_pro_url, 'wp-login' ) ) !== false ) {
					$simple_signup_pro_load = false;
				}
				if ( ( strpos( $simple_signup_pro_url, 'wp-admin' ) ) !== false ) {
					$simple_signup_pro_load = false;
				}
				if ( $simple_signup_pro_load || isset( $_REQUEST[ 'sspcmd' ] ) ) {
					//integrate the public functions
					add_action( 'init', array(&$this, 'enqueue_custom_scripts_and_styles' ) );
					add_shortcode( 'ssp', array( &$this, 'ssp_shortcodes' ) );
					add_filter( 'widget_text', 'do_shortcode' );
					if ( get_option( 'ssfpro_setting_plugininit' ) == 'getfooter' ) {
						add_action( 'get_footer' , array( &$this, 'initialize_plugin' ), 169 );
					}
					elseif ( get_option( 'ssfpro_setting_plugininit' ) == 'wpfooter' ) {
						add_action( 'wp_footer' , array( &$this, 'initialize_plugin' ), 169 );
					}
					elseif ( get_option( 'ssfpro_setting_plugininit' ) == 'aftercontent' ) {
						add_action( 'the_content' , array( &$this, 'initialize_plugin_content' ), 169 );
					}
					else {
						add_action( 'get_footer' , array( &$this, 'initialize_plugin' ), 169 );						
					}
				}
			}
			if ( get_option( 'ssfpro_setting_minify' ) == 'on' ) {
				$this->mainscript = $this->scripts[ 'ssmin' ];
			}
			else {
				$this->mainscript = $this->scripts[ 'ssdev' ];				
			}
		}
		public static function getInstance()
		{
			if (!isset($instance)) 
			{
				$instance = new simple_signup_pro;
			}
		return $instance;
		}
		/**
		* Activate the plugin
		**/
		public static function activate()
		{
			global $wpdb;
			$db_info = array();
			//define custom data tables
			$charset_collate = '';
			if ( ! empty( $wpdb->charset ) ) {
			  $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
			}

			if ( ! empty( $wpdb->collate ) ) {
			  $charset_collate .= " COLLATE {$wpdb->collate}";
			}
			//creating custom tables
			$sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->base_prefix.'simple_subscription_popup'." (
			  autoid mediumint(9) NOT NULL AUTO_INCREMENT,
			  id varchar(255) NOT NULL,
			  name varchar(255) NOT NULL,
			  options text NOT NULL,
			  global tinyint(1) NOT NULL,
			  UNIQUE KEY autoid (autoid)
			) $charset_collate";
			$wpdb->query($sql);
			$sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->base_prefix.'simple_subscription_popup_stats'." (
			  autoid mediumint(9) NOT NULL AUTO_INCREMENT,
			  formid varchar(255) NOT NULL,
			  email varchar(255) NULL,
			  link text NOT NULL,
			  params text NOT NULL,
			  sdate datetime NOT NULL,
			  UNIQUE KEY autoid (autoid)
			) $charset_collate";
			$wpdb->query($sql);
			if ( ! get_option('ssfpro_setting_keep_settings'))
			{
				add_option('ssfpro_setting_keep_settings' , 'on');
			}
			if ( ! get_option('ssfpro_setting_stats'))
			{
				add_option('ssfpro_setting_stats' , 'on');
			}
			if ( ! get_option('ssfpro_setting_plugininit'))
			{
				add_option('ssfpro_setting_plugininit' , 'aftercontent');
			}
			if ( ! get_option('ssfpro_setting_minify'))
			{
				update_option('ssfpro_setting_minify' , 'on');
			}
			if ( ! get_option('ssfpro_setting_customcss'))
			{
				add_option('ssfpro_setting_customcss' , '');
			}
		}
		/**
		* Deactivate the plugin
		**/
		public static function deactivate()
		{
			wp_unregister_sidebar_widget('simple_signup_pro');
			unregister_setting('ssf_form-group', 'ssfpro_setting_keep_settings');
			unregister_setting('ssf_form-group', 'ssfpro_setting_stats');
			unregister_setting('ssf_form-group', 'ssfpro_setting_plugininit');
			unregister_setting('ssf_form-group', 'ssfpro_setting_ganalytics');			
			unregister_setting('ssf_form-group', 'ssfpro_setting_ganalytics_auth_token');	
			unregister_setting('ssf_form-group', 'ssfpro_setting_gprofile');
			unregister_setting('ssf_form-group', 'ssfpro_setting_minify');
			unregister_setting('ssf_form_customcss-group', 'ssfpro_setting_customcss');
		}
		
		/**
		* Uninstall the plugin
		**/
		public static function uninstall()
		{
			if (get_option("ssfpro_setting_keep_settings")!="on")
			{
				global $wpdb;
				$db_info = array();
				//define custom data tables
				$wpdb->query("DROP TABLE IF EXISTS ".$wpdb->base_prefix.'simple_subscription_popup');
				delete_option('ssfpro_setting_keep_settings');
				delete_option('ssfpro_setting_stats');
				delete_option('ssfpro_setting_plugininit');
				delete_option('ssfpro_setting_ganalytics');
				delete_option('ssfpro_setting_ganalytics_auth_token');
				delete_option('ssfpro_setting_gprofile');
				delete_option('ssfpro_setting_minify');
				delete_option('ssfpro_setting_customcss');
			}
		}
			
		public function ssp_shortcodes( $atts ) {
			global $wpdb, $plugininit_array;
			$divcontainer = "";
			extract( shortcode_atts( array(
					'id' => '-1',
					'embed' => '',
					'width' => '',
					'type' => '',
					'init' => '',
					'allpage' => '',
					'visible' => ''
				), $atts, 'ssp' ) );
				if (!isset($atts['embed'])) $atts['embed'] = '';
				if (!isset($atts['type'])) $atts['type'] = '';
				if (!isset($atts['init'])) $atts['init'] = '';
				if (!isset($atts['allpage'])) $atts['allpage'] = '';
				if (!isset($atts['width'])) $atts['width'] = '';
				if (!isset($atts['visible'])) $atts['visible'] = '';
				$args = array('id' => $atts['id'], 'type' => $atts['type'], 'init' => $atts['init'], 'allpage' => $atts['allpage'], 'embed' => $atts['embed'], 'width' => $atts['width'], 'visible' => $atts['visible']);
				if (isset($atts['type'])) $type = $atts['type'];
				else $type = '';
				if (isset($atts['embed'])) $embed = $atts['embed'];
				if (isset($atts['width'])) $width = $atts['width'];
				if (isset($atts['visible'])) $visible = $atts['visible'];
				else $type = '';
				$embedclass = "";
				if ($embed != "") {
					$embedclass = " ssp_embed";
				}
				if ( ! is_single() && ! is_page() && $atts[ 'allpage' ] == "" ) {
					return('');
				}
			$unique_key = mt_rand();
			$sql = "SELECT * FROM ".$wpdb->base_prefix."simple_subscription_popup ssp WHERE ssp.id='".$args['id']."' ORDER BY ssp.id ASC";
			$ssp_sql = $wpdb->get_row($sql);
			if (!empty($ssp_sql))
			{
			$unique_key = $args['id'] . "-" . $unique_key;
			$ssp_options = ( array ) json_decode( stripslashes( $ssp_sql->options ) );
			$ssp_options[ 50 ] = json_encode( $ssp_options[ 50 ] );
			if ($ssp_options[10]) $ssp_options[18] = $ssp_options[18]*1000;
			$ssp_options[100] = admin_url( 'admin-ajax.php');
			$ssp_options[101] = $ssp_sql->id;
			if ( ! isset( $ssp_options[ 162 ] ) ) {
				$ssp_options[ 162 ] = "0";
			}
			if ( ! isset( $ssp_options[ 169 ] ) ) {
				$ssp_options[ 169 ] = "";
			}
			if ($ssp_options[149]=="1")
			{
				if ($ssp_options[150]!='')
				{
					$cont = $ssp_options[15];
					$tit = $ssp_options[14];
					$contenttext = $cont;
					$contenttitle = $tit;
					$protocol = ( ! empty( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] !== 'off' || $_SERVER[ 'SERVER_PORT' ] == 443 ) ? "https://" : "http://";
					$youtubeurl = $protocol . 'www.youtube.com/embed/' . $ssp_options[ 150 ] . '?wmode=opaque&version=3&rel=0';
					if ($ssp_options[152]=='1') $youtubeurl .= '&autoplay=1';
					else $youtubeurl .= '&autoplay=0';
					if ($ssp_options[153]=='1') $youtubeurl .= '&showinfo=1';
					else $youtubeurl .= '&showinfo=0';
					if ($ssp_options[154]=='1') $youtubeurl .= '&loop=1';
					else $youtubeurl .= '&loop=0';
					if ($ssp_options[155]=='1') $youtubeurl .= '&controls=0';
					else $youtubeurl .= '&controls=1';
					$videowidth = "100%";
					$videoheight = "195px";
					if ($ssp_options[156]!="") $videowidth = $ssp_options[156];
					if ($ssp_options[157]!="") $videoheight = $ssp_options[157];
					$youtubecontent = "<div class='ssfproacenter'><iframe width='".str_replace('px','',$ssp_options[156])."' class='customplayer' height='".str_replace('px','',$ssp_options[157])."' src='".$youtubeurl."' frameborder='0' allowfullscreen></iframe></div>";
					if ($ssp_options[151]=="1") $contenttitle = $youtubecontent.$tit;
					if ($ssp_options[151]=="2") $contenttext = $cont.$youtubecontent;
					if ($ssp_options[151]=="3"||$ssp_options[151]=="4") $contenttitle = $tit.$youtubecontent;
					$ssp_options[14] = $contenttitle;
					$ssp_options[15] = $contenttext;
				}
			}
			elseif ($ssp_options[162]=="1")
			{
				if ($ssp_options[163]!='')
				{
					$cont = $ssp_options[15];
					$tit = $ssp_options[14];
					$contenttext = $cont;
					$contenttitle = $tit;
					$imagewidth = ""; $imageheight = ""; $divwidth = ""; $divheight = ""; $divbgsize = ""; $repeat = "";
					if ( $ssp_options[165] != "" ) {
						$imagewidth = "width='" . $ssp_options[ 165 ] . "'";
						$divwidth = $ssp_options[ 165 ];
					}
					if ( $ssp_options[166] != "" ) {
						$imageheight = "height='" . $ssp_options[ 166 ] . "'";
						$divheight = $ssp_options[ 166 ];
					}
					if ( $divwidth == "" && $divheight == "" ) {
					}
					else {
						if ( $divwidth == "" ) {
							$divwidth = "auto";
						}
						if ( $divheight == "" ) {
							$divheight = "auto";
						}
						$divbgsize = "background-size: " . $divwidth . " " . $divheight . ";";
					}
					if ( $ssp_options[ 168 ] == "1" ) {
						$repeat = 'background-repeat: repeat;';
					}
					else {
						$repeat = 'background-repeat: no-repeat;';
					}
						$imagecontent = "<div class='ssfproacenter'><img style='opacity:" . $ssp_options[ 167 ] . "' src='" . $ssp_options[ 163 ] . "' " . $imagewidth . " " . $imageheight . " ></div>";						
					if ( $ssp_options[164] == "4" || $ssp_options[164] == "5" ) {
						if ( $divbgsize == "" && $ssp_options[164] == "4" ) {
							$divbgsize = "background-size: cover;";
						}
						if ( $divbgsize == "" && $ssp_options[164] == "5" ) {
							$divbgsize = "background-size: contain;";
						}
						$imagecontent = "<div class='ssfproacenter' style='background-image: url(" . $ssp_options[ 163 ] . ");" . $repeat . $divbgsize . "opacity:" . $ssp_options[ 167 ] . "'></div>";
						$ssp_options[ 151 ] = "4";
					}
					if ( $ssp_options[ 164 ] == "1" ) {
						$contenttitle = $imagecontent.$tit;
					}
					if ( $ssp_options[ 164 ] == "2" ) {
						$contenttext = $cont.$imagecontent;
					}
					if ( $ssp_options[ 164 ] == "3" || $ssp_options[ 164 ] == "4" || $ssp_options[ 164 ] == "5" ) {
						$contenttitle = $tit.$imagecontent;
					}
					$ssp_options[14] = $contenttitle;
					$ssp_options[15] = $contenttext;
				}
			}
			if (($ssp_options[31]||$ssp_options[48])&&($type=='unique'))
				{
					$ssp_form = array();
					if (isset($_COOKIE['ssp_form'])) 
					{
						$ssp_form = unserialize(stripslashes($_COOKIE['ssp_form']));
						if (!in_array($args['id'],$ssp_form)) 
						{
							$ssp_form[]=$args['id'];
							if ($ssp_options[31]) {$ssp_options[102] = serialize($ssp_form);$ssp_options[31] = false;}
							if ($ssp_options[48]) {$ssp_options[103] = serialize($ssp_form);$ssp_options[48] = false;}
							$divcontainer = '<div id="ssp-'.$unique_key.'" class="simplesignuppro' . $embedclass . '"></div>';
						}
						else {/*DO NOT DISPLAY THE FORM*/}
					}
					else
					{
						$ssp_form[]=$args['id'];
						if ($ssp_options[31]) {$ssp_options[102] = serialize($ssp_form);$ssp_options[31] = false;}
						if ($ssp_options[48]) {$ssp_options[103] = serialize($ssp_form);$ssp_options[48] = false;}
						
						$divcontainer = '<div id="ssp-'.$unique_key.'" class="simplesignuppro' . $embedclass . '"></div>';
					}
				}
				else
				{
						$divcontainer = '<div id="ssp-'.$unique_key.'" class="simplesignuppro' . $embedclass . '"></div>';
				}
				if ( isset( $plugininit_array ) ) {
					foreach( $plugininit_array as $key => $pa ) {
						$ckey = explode( "-", $key );
						if ( $ckey[ 0 ] == $args['id'] ) {
							unset( $plugininit_array[ $key ] );
						}
					}
				}
				if ( isset( $ssp_options[ 171 ] ) && $ssp_options[ 171 ] == "1" && is_user_logged_in() ) {
					return;
				}
				else {
				$plugininit_array[$unique_key] = array(
				"animtime" => $ssp_options[ 0 ],
				"autoopen" => $ssp_options[ 1 ],
				"mode" => $ssp_options[ 2 ],
				"bgcolor" => $ssp_options[ 3 ],
				"buttonbgcolor" => $ssp_options[ 4 ],
				"buttoncolor" => $ssp_options[ 5 ],
				"closecolor" => $ssp_options[ 6 ],
				"closefontsize" => $ssp_options[ 7 ],
				"color" => $ssp_options[ 8 ],
				"contentcolor" => $ssp_options[ 9 ],
				"fontfamily" => $ssp_options[ 10 ],
				"contentfontfamily" => $ssp_options[ 11 ],
				"contentfontsize" => $ssp_options[ 12 ],
				"contentweight" => $ssp_options[ 13 ],
				"title" => $ssp_options[ 14 ],
				"text" => $ssp_options[ 15 ],
				"vspace" => $ssp_options[ 16 ],
				"hspace" => $ssp_options[ 17 ],
				"timer" => $ssp_options[ 18 ],
				"position" => $ssp_options[19],
				"invalid_address" => $ssp_options[ 20 ],
				"signup_success" => $ssp_options[ 21 ],
				"borderradius" => $ssp_options[ 22 ],
				"openbottom" => $ssp_options[ 23 ],
				"fontsize" => $ssp_options[ 24 ],
				"fontweight" => $ssp_options[ 25 ],
				"double_optin" => $ssp_options[ 26 ],
				"update_existing" => $ssp_options[ 27 ],
				"replace_interests" => $ssp_options[ 28 ],
				"send_welcome" => $ssp_options[ 29 ],
				"mailchimp_listid" => $ssp_options[ 30 ],
				"once_per_user" => $ssp_options[ 31 ],
				"cookie_days" => $ssp_options[ 32 ],
				"customfieldsmargin" => $ssp_options[ 33 ],
				"subscribe_text" => $ssp_options[ 36 ],
				"placeholder_text" => $ssp_options[ 37 ],
				"lock" => $ssp_options[ 38 ],
				"hideclose" => $ssp_options[ 39 ],
				"path" => $ssp_options[ 100 ],
				"formid" => $ssp_options[ 101 ],
				"animation" => $ssp_options[ 40 ],
				"filled_cookie_days" => $ssp_options[ 41 ],
				"inputborderradius" => $ssp_options[ 42 ],
				"facebook_appid" => $ssp_options[ 43 ],
				"googleplus_clientid" => $ssp_options[ 44 ],
				"googleplus_apikey" => $ssp_options[ 45 ],
				"bottomtitle" => $ssp_options[ 46 ],
				"openwithlink" => $ssp_options[ 47 ],
				"once_per_filled" => $ssp_options[ 48 ],
				"closewithlayer" => $ssp_options[ 49 ],
				"customfields" => $ssp_options[ 50 ],
				"lockbgcolor" => $ssp_options[ 51 ],
				"preset" => $ssp_options[ 52 ],
				"trackform" => $ssp_options[ 158 ],
				"preview" => "",
				"yaplay" => $ssp_options[ 152 ],
				"ypos" => $ssp_options[ 151 ],
				"embed" => $embed,
				"elemanimation" => $ssp_options[ 159 ],
				"cdatas1" => $ssp_options[ 102 ],
				"cdatas2" => $ssp_options[ 103 ],
				"width" => $width,
				"visible" => $visible,
				"redirecturl" => $ssp_options[ 169 ],
				"disablemobile" => ( isset( $ssp_options[ 170 ] ) ? $ssp_options[ 170 ] : false )
				);
				if ( $atts[ 'init' ] == "true" ) {
					$this->initialize_plugin();
				}
				return $divcontainer;
				}
			}
		}
		
		function free_version_notice() {
			 if (file_exists(ABSPATH . 'wp-content/plugins/simple-signup-form')) 
			 {
				print('<div class="error">
					<p>Simple Signup Form Free version is installed, that can causing conflicts with the Pro version.<br><strong>Please delete, then deactivate and activate the Pro Version.</strong></p>
				</div>');
			}
		}
			
		function enqueue_custom_scripts_and_styles() {
			global $wpdb, $plugininit_array;
			wp_enqueue_style( 'mailchimper_pro_style', plugins_url( '/templates/assets/css/plugin.css', __FILE__ ) );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-visible', plugins_url( '/templates/assets/js/jquery.visible.min.js', __FILE__ ), array( 'jquery' ), SSF_PRO_VERSION );
			wp_enqueue_script('mailchimper_pro_script', plugins_url('/templates/assets/js/' . $this->mainscript, __FILE__ ), array( 'jquery', 'jquery-visible' ), SSF_PRO_VERSION );
			$sql = "SELECT * FROM ".$wpdb->base_prefix."simple_subscription_popup ssp WHERE global = 1 ORDER BY ssp.id ASC";
			$ssp_sql = $wpdb->get_results($sql);
			if (!empty($ssp_sql))
			{
				foreach( $ssp_sql as $ssp_key => $ssp_val ) {
					$unique_key = $ssp_val->id . "-" . mt_rand();
					$ssp_options = ( array ) json_decode(stripslashes($ssp_val->options));
					$ssp_options[ 50 ] = json_encode( $ssp_options[ 50 ] );
					if ($ssp_options[10]) $ssp_options[18] = $ssp_options[18]*1000;
					$ssp_options[100] = admin_url( 'admin-ajax.php');
					$ssp_options[101] = $ssp_val->id;
					if ($ssp_options[149]=="1")
					{
						if ($ssp_options[150]!='')
						{
							$cont = $ssp_options[15];
							$tit = $ssp_options[14];
							$contenttext = $cont;
							$contenttitle = $tit;
							$protocol = ( ! empty( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] !== 'off' || $_SERVER[ 'SERVER_PORT' ] == 443 ) ? "https://" : "http://";
							$youtubeurl = $protocol . 'www.youtube.com/embed/'.$ssp_options[150].'?wmode=opaque&version=3&rel=0';
							if ($ssp_options[152]=='1') $youtubeurl .= '&autoplay=0';
							else $youtubeurl .= '&autoplay=0';
							if ($ssp_options[153]=='1') $youtubeurl .= '&showinfo=1';
							else $youtubeurl .= '&showinfo=0';
							if ($ssp_options[154]=='1') $youtubeurl .= '&loop=1';
							else $youtubeurl .= '&loop=0';
							if ($ssp_options[155]) $youtubeurl .= '&controls=0';
							else $youtubeurl .= '&controls=1';
							$videowidth = "100%";
							$videoheight = "195px";
							if ($ssp_options[156]!="") $videowidth = $ssp_options[156];
							if ($ssp_options[157]!="") $videoheight = $ssp_options[157];
							$youtubecontent = "<div class='ssfproacenter'><iframe width='".str_replace('px','',$ssp_options[156])."' class='customplayer' height='".str_replace('px','',$ssp_options[157])."' src='".$youtubeurl."' frameborder='0' allowfullscreen></iframe></div>";
							if ($ssp_options[151]=="1") $contenttitle = $youtubecontent.$tit;
							if ($ssp_options[151]=="2") $contenttext = $cont.$youtubecontent;
							if ($ssp_options[151]=="3"||$ssp_options[151]=="4") $contenttitle = $tit.$youtubecontent;
							$ssp_options[14] = $contenttitle;
							$ssp_options[15] = $contenttext;
						}
					}
					elseif ($ssp_options[162]=="1")
					{
						if ($ssp_options[163]!='')
						{
							$cont = $ssp_options[15];
							$tit = $ssp_options[14];
							$contenttext = $cont;
							$contenttitle = $tit;
							$imagewidth = ""; $imageheight = ""; $divwidth = ""; $divheight = ""; $divbgsize = ""; $repeat = "";
							if ( $ssp_options[165] != "" ) {
								$imagewidth = "width='" . $ssp_options[ 165 ] . "'";
								$divwidth = $ssp_options[ 165 ];
							}
							if ( $ssp_options[166] != "" ) {
								$imageheight = "height='" . $ssp_options[ 166 ] . "'";
								$divheight = $ssp_options[ 166 ];
							}
							if ( $divwidth == "" && $divheight == "" ) {
							}
							else {
								if ( $divwidth == "" ) {
									$divwidth = "auto";
								}
								if ( $divheight == "" ) {
									$divheight = "auto";
								}
								$divbgsize = "background-size: " . $divwidth . " " . $divheight . ";";
							}
							if ( $ssp_options[ 168 ] == "1" ) {
								$repeat = 'background-repeat: repeat;';
							}
							else {
								$repeat = 'background-repeat: no-repeat;';
							}
								$imagecontent = "<div class='ssfproacenter'><img style='opacity:" . $ssp_options[ 167 ] . "' src='" . $ssp_options[ 163 ] . "' " . $imagewidth . " " . $imageheight . " ></div>";						
							if ( $ssp_options[164] == "4" || $ssp_options[164] == "5" ) {
								if ( $divbgsize == "" && $ssp_options[164] == "4" ) {
									$divbgsize = "background-size: cover;";
								}
								if ( $divbgsize == "" && $ssp_options[164] == "5" ) {
									$divbgsize = "background-size: contain;";
								}
								$imagecontent = "<div class='ssfproacenter' style='background-image: url(" . $ssp_options[ 163 ] . ");" . $repeat . $divbgsize . "opacity:" . $ssp_options[ 167 ] . "'></div>";
								$ssp_options[ 151 ] = "4";
							}
							if ( $ssp_options[ 164 ] == "1" ) {
								$contenttitle = $imagecontent.$tit;
							}
							if ( $ssp_options[ 164 ] == "2" ) {
								$contenttext = $cont.$imagecontent;
							}
							if ( $ssp_options[ 164 ] == "3" || $ssp_options[ 164 ] == "4" || $ssp_options[ 164 ] == "5" ) {
								$contenttitle = $tit.$imagecontent;
							}
							$ssp_options[14] = $contenttitle;
							$ssp_options[15] = $contenttext;
						}
					}
					$ssp_options[ 999 ] = $unique_key;
					if ( isset( $ssp_options[ 171 ] ) && $ssp_options[ 171 ] == "1" && is_user_logged_in() ) {
						return;
					}
					else {
					$plugininit_array[ $unique_key ] = array(
						"animtime" => $ssp_options[ 0 ],
						"autoopen" => $ssp_options[ 1 ],
						"mode" => $ssp_options[ 2 ],
						"bgcolor" => $ssp_options[ 3 ],
						"buttonbgcolor" => $ssp_options[ 4 ],
						"buttoncolor" => $ssp_options[ 5 ],
						"closecolor" => $ssp_options[ 6 ],
						"closefontsize" => $ssp_options[ 7 ],
						"color" => $ssp_options[ 8 ],
						"contentcolor" => $ssp_options[ 9 ],
						"fontfamily" => $ssp_options[ 10 ],
						"contentfontfamily" => $ssp_options[ 11 ],
						"contentfontsize" => $ssp_options[ 12 ],
						"contentweight" => $ssp_options[ 13 ],
						"title" => $ssp_options[ 14 ],
						"text" => $ssp_options[ 15 ],
						"vspace" => $ssp_options[ 16 ],
						"hspace" => $ssp_options[ 17 ],
						"timer" => $ssp_options[ 18 ],
						"position" => $ssp_options[19],
						"invalid_address" => $ssp_options[ 20 ],
						"signup_success" => $ssp_options[ 21 ],
						"borderradius" => $ssp_options[ 22 ],
						"openbottom" => $ssp_options[ 23 ],
						"fontsize" => $ssp_options[ 24 ],
						"fontweight" => $ssp_options[ 25 ],
						"double_optin" => $ssp_options[ 26 ],
						"update_existing" => $ssp_options[ 27 ],
						"replace_interests" => $ssp_options[ 28 ],
						"send_welcome" => $ssp_options[ 29 ],
						"mailchimp_listid" => $ssp_options[ 30 ],
						"once_per_user" => $ssp_options[ 31 ],
						"cookie_days" => $ssp_options[ 32 ],
						"customfieldsmargin" => $ssp_options[ 33 ],
						"subscribe_text" => $ssp_options[ 36 ],
						"placeholder_text" => $ssp_options[ 37 ],
						"lock" => $ssp_options[ 38 ],
						"hideclose" => $ssp_options[ 39 ],
						"path" => $ssp_options[ 100 ],
						"formid" => $ssp_options[ 101 ],
						"animation" => $ssp_options[ 40 ],
						"filled_cookie_days" => $ssp_options[ 41 ],
						"inputborderradius" => $ssp_options[ 42 ],
						"facebook_appid" => $ssp_options[ 43 ],
						"googleplus_clientid" => $ssp_options[ 44 ],
						"googleplus_apikey" => $ssp_options[ 45 ],
						"bottomtitle" => $ssp_options[ 46 ],
						"openwithlink" => $ssp_options[ 47 ],
						"once_per_filled" => $ssp_options[ 48 ],
						"closewithlayer" => $ssp_options[ 49 ],
						"customfields" => $ssp_options[ 50 ],
						"lockbgcolor" => $ssp_options[ 51 ],
						"preset" => $ssp_options[ 52 ],
						"trackform" => $ssp_options[ 158 ],
						"preview" => "",
						"yaplay" => $ssp_options[ 152 ],
						"ypos" => $ssp_options[ 151 ],
						"embed" => "",
						"elemanimation" => $ssp_options[ 159 ],
						"cdatas1" => $ssp_options[ 102 ],
						"cdatas2" => $ssp_options[ 103 ],
						"width" => "",
						"visible" => "",
						"redirecturl" => $ssp_options[ 169 ],
						"disablemobile" => ( isset( $ssp_options[ 170 ] ) ? $ssp_options[ 170 ] : false )
						);
					}
				}
			}
			$custom_css = get_option( 'ssfpro_setting_customcss' );
			if ( $custom_css != ""  ) {
				wp_enqueue_style( 'ssfpro-custom-style', plugins_url( '/templates/assets/css/custom_ssfpro.css', __FILE__ ) );
				wp_add_inline_style( 'ssfpro-custom-style', $custom_css );
			}
		}
		/**
		* Add the settings link to the plugins page
		**/
		function plugin_settings_link($links)
		{ 
			$settings_link = '<a href="/wp-admin/admin.php?page=mailchimper_pro_generalsettings">Settings</a>';
			array_unshift($links, $settings_link); 
			return $links;
		}
		
		function initialize_plugin() {
		global $plugininit_array;
			if ( ! empty( $plugininit_array ) ) {
				wp_register_script( 'mailchimper_pro_init_script', plugins_url('/templates/assets/js/plugin.init.js', __FILE__ ), array( 'jquery' ), SSF_PRO_VERSION, true );
				wp_localize_script( 'mailchimper_pro_init_script', 'ssp_init_params', $plugininit_array );
				wp_enqueue_script( 'mailchimper_pro_init_script' );
			}
		}

		function initialize_plugin_content( $content ) {
		global $plugininit_array;
			if ( ! empty( $plugininit_array ) ) {
				wp_register_script( 'mailchimper_pro_init_script', plugins_url( '/templates/assets/js/plugin.init.js', __FILE__ ), array( 'jquery' ), SSF_PRO_VERSION, true );
				wp_localize_script( 'mailchimper_pro_init_script', 'ssp_init_params', $plugininit_array );
				wp_enqueue_script( 'mailchimper_pro_init_script' );
			}
			return $content;
		}
	}
}
if(class_exists('simple_signup_pro'))
{
	// call the main class
	$simple_signup_pro = simple_signup_pro::getInstance();
}
?>