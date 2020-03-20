<?php 

if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) exit();

// delete plugin options
delete_option('elfsight_google_maps_other_products_hidden');
delete_option('elfsight_google_maps_latest_version');
delete_option('elfsight_google_maps_last_check_datetime');

?>