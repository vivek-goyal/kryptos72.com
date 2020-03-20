<?php
/*
Plugin Name: Elfsight Google Maps CC
Description: Start creating Google Maps on your website with the incredible Elfsight map builder.
Plugin URI: https://elfsight.com/google-maps-widget/wordpress/?utm_source=markets&utm_medium=codecanyon&utm_campaign=google-maps&utm_content=plugin-site
Version: 1.6.1
Author: Elfsight
Author URI: https://elfsight.com/?utm_source=markets&utm_medium=codecanyon&utm_campaign=google-maps&utm_content=plugins-list
*/

if (!defined('ABSPATH')) exit;


require_once('core/elfsight-plugin.php');

$elfsight_google_maps_config_path = plugin_dir_path(__FILE__) . 'config.json';
$elfsight_google_maps_config = json_decode(file_get_contents($elfsight_google_maps_config_path), true);

require_once('includes/api-key.php');
require_once('includes/geocoder.php');

register_activation_hook(__FILE__, 'elfsight_google_maps_activation_geocode');

new ElfsightGoogleMapsPlugin(array(
        'name' => 'Google Maps',
        'description' => 'Start creating Google Maps on your website with the incredible Elfsight map builder.',
        'slug' => 'elfsight-google-maps',
        'version' => '1.6.1',
        'text_domain' => 'elfsight-google-maps',
        'editor_settings' => $elfsight_google_maps_config['settings'],
        'editor_preferences' => $elfsight_google_maps_config['preferences'],
        'script_url' => plugins_url('assets/elfsight-google-maps.js', __FILE__),

        'plugin_name' => 'Elfsight Google Maps',
        'plugin_file' => __FILE__,
        'plugin_slug' => plugin_basename(__FILE__),

        'vc_icon' => plugins_url('assets/img/vc-icon.png', __FILE__),

        'menu_icon' => plugins_url('assets/img/menu-icon.png', __FILE__),
        'update_url' => 'https://a.elfsight.com/updates/v1/',

        'preview_url' => plugins_url('preview/index.html', __FILE__),
        'observer_url' => plugins_url('preview/google-maps-observer.js', __FILE__),

        'product_url' => 'https://codecanyon.net/item/elfsight-google-maps-wordpress-plugin/20574814?ref=Elfsight',
        'support_url' => 'https://elfsight.ticksy.com/submit/#100010647',

        'admin_custom_script_url' => plugins_url('assets/elfsight-admin-custom.js', __FILE__),
        'admin_custom_style_url' => plugins_url('assets/elfsight-admin-custom.css', __FILE__),
        'admin_custom_pages' => array(
            array(
                'id' => 'api-key',
                'menu_index' => 1,
                'menu_title' => 'Google API Key',
                'template' => plugin_dir_path(__FILE__) . 'includes/templates/admin-api-key.php',
                'notification' => 'Google API Key is required'
            )
        )
    )
);

?>