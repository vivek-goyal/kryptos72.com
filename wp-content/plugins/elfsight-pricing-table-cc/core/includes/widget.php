<?php

if (!defined('ABSPATH')) exit;


if (!class_exists('ElfsightPricingTableWidget')) {
	class ElfsightPricingTableWidget extends WP_Widget {
        private $configSlug;
        private $configPluginName;
        private $configDescription;
        private $configTextDomain;

        private $widgetsApi;

		public function __construct($config, $widgetsApi) {
            $this->configSlug = $config['slug'];
            $this->configPluginName = $config['plugin_name'];
            $this->configDescription = $config['description'];
            $this->configTextDomain = $config['text_domain'];

            $this->widgetsApi = $widgetsApi;

            parent::__construct(
                $this->configSlug,
                __($this->configPluginName, $this->configTextDomain),
                array('description' => __($this->configDescription, $this->configTextDomain))
            );
		}

		public function widget($args, $instance) {
			extract($instance, EXTR_SKIP);

			if (!empty($instance['id'])) {
				echo do_shortcode('[' . str_replace('-', '_', $this->configSlug) . ' id="' . $instance['id'] . '"]');
			}
		}

		public function form($instance) {
			$widgets = array();
    		$widgetsList = array();

    		$this->widgetsApi->getList($widgets);

			if (!empty($widgets['data'])) {?>
				<p>
					<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Select a widget:', $this->configTextDomain); ?></label>
					<select class='widefat' id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>">
						<option value="0">— Select —</option>
						<?php foreach ($widgets['data'] as $widget) { ?>
							<option value="<?php echo $widget['id'] ?>"<?php echo (!empty($instance['id']) && $instance['id'] == $widget['id']) ? ' selected' : ''; ?>><?php echo $widget['name']; ?></option>
						<?php } ?>
					</select>
				</p>
			<?php } else { ?>
				<p>
					<?php _e('No widgets yet.', $this->configTextDomain); ?>
                	<a href="<?php echo esc_url(admin_url('admin.php?page=' . $this->configSlug)); ?>#/add-widget/"><?php _e('Create the first one.', $this->configTextDomain); ?></a>
				</p>
			<?php }
		}

		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
		    $instance['id'] = !empty($new_instance['id']) ? $new_instance['id'] : '';

		    return $instance;
		}
	}
}

?>