<?php

if (!defined('ABSPATH')) exit;


require_once(plugin_dir_path(__FILE__) . '/includes/update.php');
require_once(plugin_dir_path(__FILE__) . '/includes/widgets-api.php');
require_once(plugin_dir_path(__FILE__) . '/includes/admin.php');
require_once(plugin_dir_path(__FILE__) . '/includes/widget.php');
require_once(plugin_dir_path(__FILE__) . '/includes/vc-element.php');

if (!class_exists('ElfsightGoogleMapsPlugin')) {
    class ElfsightGoogleMapsPlugin {
        private $name;
        private $slug;
        private $version;
        private $textDomain;
        private $editorSettings;
        private $scriptUrl;

        private $pluginFile;
        private $pluginSlug;

        private $updateUrl;

        private $purchaseCode;

        private $update;
        private $widgetsApi;
        private $admin;
        private $widget;
        private $vcElement;

        private $isShortcodePresent;

        public function __construct($config) {
            $this->name = $config['name'];
            $this->slug = $config['slug'];
            $this->version = $config['version'];
            $this->textDomain = $config['text_domain'];
            $this->editorSettings = $config['editor_settings'];
            $this->scriptUrl = $config['script_url'];

            $this->pluginFile = $config['plugin_file'];
            $this->pluginSlug = $config['plugin_slug'];

            $this->updateUrl = $config['update_url'];

            $this->purchaseCode = get_option($this->getOptionName('purchase_code'), '');

            $this->update = new ElfsightGoogleMapsPluginUpdate($this->updateUrl, $this->version, $this->pluginSlug, $this->purchaseCode);
            $this->widgetsApi = new ElfsightGoogleMapsWidgetsApi($this->slug, $this->pluginFile, $this->textDomain);
            $this->admin = new ElfsightGoogleMapsPluginAdmin($config, $this->widgetsApi);
            $this->widget = new ElfsightGoogleMapsWidget($config, $this->widgetsApi);
            $this->vcElement = new ElfsightGoogleMapsVCElement($config, $this->widgetsApi);

            add_action('wp_footer', array($this, 'printAssets'));
            add_shortcode(str_replace('-', '_', $this->slug), array($this, 'addShortcode'));
            add_action('plugin_action_links_' . $this->pluginSlug, array($this, 'addPluginActionLinks'));
            add_action('widgets_init', array($this, 'registerWidget'));

            add_action('init', array($this, 'initBlock'));
            add_action('admin_init', array($this, 'enqueueBlockAssets'));
        }

        public function initBlock() {
            if (function_exists('register_block_type')) {
                register_block_type($this->slug.'/block', array(
                    'attributes' => array(
                        'id' => array(
                            'type' => 'number',
                        )
                    ),
                    'render_callback' => array($this, 'addShortcode')
                ));
            }
        }

        public function enqueueBlockAssets() {
            if (function_exists('register_block_type')) {
                wp_enqueue_script($this->slug . '-block-editor-js', plugins_url('assets/elfsight-block.js', $this->pluginFile), array('wp-blocks', 'wp-i18n', 'wp-element'), $this->version, true);
                wp_enqueue_style($this->slug . '-block-editor-css', plugins_url('assets/elfsight-block.css', $this->pluginFile), array('wp-edit-blocks'), $this->version);

                wp_enqueue_script($this->slug, $this->scriptUrl, array($this->slug . '-block-editor-js'), $this->version, true);
            }
        }

        public function printAssets() {
            $force_script_add = get_option($this->getOptionName('force_script_add'));

            $uploads_dir_params = wp_upload_dir();
            $uploads_dir = $uploads_dir_params['basedir'] . '/' . $this->slug;
            $uploads_url = $uploads_dir_params['baseurl'] . '/' . $this->slug;

            wp_register_script($this->slug, $this->scriptUrl, array(), $this->version);
            wp_register_script($this->slug . '-custom', $uploads_url . '/' . $this->slug . '-custom.js', array(), $this->version);

            wp_register_style($this->slug . '-custom', $uploads_url . '/' . $this->slug . '-custom.css', array(), $this->version);

            if ($this->isShortcodePresent || $force_script_add === 'on') {
                $custom_css_path = $uploads_dir . '/' . $this->slug . '-custom.css';
                $custom_js_path = $uploads_dir . '/' . $this->slug . '-custom.js';

                wp_print_scripts($this->slug);

                if (is_readable($custom_js_path) && filesize($custom_js_path) > 0) {
                    wp_print_scripts($this->slug . '-custom');
                }

                if (is_readable($custom_css_path) && filesize($custom_css_path) > 0) {
                    wp_print_styles($this->slug . '-custom');
                }
            }
        }

        public function recursiveDefaults($properties, $defaults){
            foreach($properties as $property) {
                if ($property['type'] == 'subgroup') {
                    $defaults = $this->recursiveDefaults($property['subgroup']['properties'], $defaults);
                } else {
	                if (!empty($property['id'])) {
		                $defaults[$property['id']] = !empty($property['defaultValue']) ? $property['defaultValue'] : null;
	                }
                }
            }

            return $defaults;
        }

        public function addShortcode($atts) {
            $this->isShortcodePresent = true;

            $atts = $atts ? $this->formatAtts($atts) : $atts;
            $widget_id = !empty($atts['id']) ? $atts['id'] : null;

            $defaults = array();
            $defaults = $this->recursiveDefaults($this->editorSettings['properties'], $defaults);

            if (!empty($widget_id)) {
                $widget_options = $this->getWidgetOptions($widget_id);

                if (!$widget_options) {
                    return '';
                }

                $atts = array_combine(
                    array_merge(array_keys($widget_options), array_keys($atts)),
                    array_merge(array_values($widget_options), array_values($atts))
                );

                unset($atts['id']);
            }

            $options = shortcode_atts($defaults, $atts, str_replace('-', '_', $this->slug));
            $options = apply_filters($this->getOptionName('shortcode_options'), $options, $widget_id);

            $options_string = rawurlencode(json_encode($options));

            $result = '<div class="elfsight-widget-' . str_replace('elfsight-', '', $this->slug) . ' elfsight-widget" data-' . $this->slug . '-options="' . $options_string . '"></div>';

            return $result;
        }

        public function formatAtts($atts){
            if (!function_exists('dashesToCamelCase')) {
                function dashesToCamelCase($string, $capitalizeFirstCharacter = false) {
                    $string = preg_replace_callback('/_[a-zA-Z]/', 'capitalize', $string);
                    $string = preg_replace_callback('/-[a-zA-Z]/', 'capitalize', $string);

                    return $string;
                }
            }

            if (!function_exists('capitalize')) {
                function capitalize($matches) {
                    return strtoupper($matches[0][1]);
                }
            }

            foreach ($atts as $key => $value) {
                $atts[dashesToCamelCase($key)] = $value;
            }

            return $atts;
        }

        function registerWidget() {
            if (!empty($this->widget)) {
                if (!get_option($this->getOptionName('widget_hash'))) {
                    register_widget($this->widget);

                    add_option($this->getOptionName('widget_hash'), spl_object_hash($this->widget));
                } else {
                    global $wp_widget_factory;

                    $wp_widget_factory->widgets[get_option($this->getOptionName('widget_hash'))] = $this->widget;
                }
            }
        }

        public function addPluginActionLinks($links) {
            $links[] = '<a href="' . esc_url(admin_url('admin.php?page=' . $this->slug)) . '">Settings</a>';
            $links[] = '<a href="http://codecanyon.net/user/elfsight/portfolio?ref=Elfsight" target="_blank">More plugins by Elfsight</a>';

            return $links;
        }

        private function getWidgetOptions($id) {
            global $wpdb;

            $id = intval($id);

            $widgets_table_name = $this->widgetsApi->getTableName();
            $select_sql = '
                SELECT options FROM `' . esc_sql($widgets_table_name) . '`
                WHERE `id` = "' . esc_sql($id) . '" and `active` = "1"
            ';

            $item = $wpdb->get_row($select_sql, ARRAY_A);

            if (!empty($item) && !empty($item['options'])) {
                $options = json_decode($item['options'], true);
            }
            else {
                $options = null;
            }

            return $options;
        }

        private function getOptionName($name) {
            return str_replace('-', '_', $this->slug) . '_' . $name;
        }
    }
}

?>