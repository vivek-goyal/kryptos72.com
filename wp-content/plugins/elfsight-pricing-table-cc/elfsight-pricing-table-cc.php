<?php
/*
Plugin Name: Elfsight Pricing Table CC
Description: 
Plugin URI:
Version: 2.3.0
Author: Elfsight
Author URI: https://elfsight.com/?utm_source=markets&utm_medium=codecanyon&utm_campaign=pricing-table&utm_content=plugins-list
*/

if (!defined('ABSPATH')) exit;


require_once('core/elfsight-plugin.php');

$elfsight_pricing_table_config_path = plugin_dir_path(__FILE__) . 'config.json';
$elfsight_pricing_table_config = json_decode(file_get_contents($elfsight_pricing_table_config_path), true);

register_activation_hook(__FILE__, 'elfsight_pricing_table_activation_geocode');

new ElfsightPricingTablePlugin(array(
        'name' => 'Pricing Table',
        'description' => '',
        'slug' => 'elfsight-pricing-table',
        'version' => '2.3.0',
        'text_domain' => 'elfsight-pricing-table',
        'editor_settings' => $elfsight_pricing_table_config['settings'],
        'editor_preferences' => $elfsight_pricing_table_config['preferences'],
        'script_url' => plugins_url('assets/elfsight-pricing-table.js', __FILE__),

        'plugin_name' => 'Elfsight Pricing Table',
        'plugin_file' => __FILE__,
        'plugin_slug' => plugin_basename(__FILE__),

        'vc_icon' => plugins_url('assets/img/vc-icon.png', __FILE__),

        'menu_icon' => plugins_url('assets/img/menu-icon.png', __FILE__),
        'update_url' => 'https://a.elfsight.com/updates/v1/',

        'preview_url' => plugins_url('preview/index.html', __FILE__),
        'observer_url' => plugins_url('preview/pricing-table-observer.js', __FILE__),

        'product_url' => 'https://codecanyon.net/item/elfsight-pricing-table-wordpress-plugin/20574814?ref=Elfsight',
        'support_url' => 'https://elfsight.ticksy.com/submit/#100010647',
    )
);

?>