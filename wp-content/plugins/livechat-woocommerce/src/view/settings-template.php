<?php
/**
 * Settings template. Allows admin to manage LiveChat window settings.
 *
 * @category Admin pages
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div id="woocommerce-livechat-container">
    <div class="woocommerce-livechat-column-left">
        <div class="login-box-header">
            <img src="<?php echo plugins_url('livechat-woocommerce').'/src/media/livechat-woocommerce@2x.png'; ?>" alt="LiveChat + WooCommerce" class="logo">
        </div>
        <div class="account">
	        <?php _e('Currently you are using your', 'livechat-woocommerce'); ?><br>
            <strong><?php echo $license_email ?></strong><br>
	        <?php _e('LiveChat account.', 'livechat-woocommerce'); ?>
        </div>
        <p class="webapp">
            <a href="https://my.livechatinc.com/?utm_source=woocommerce.com&utm_medium=integration&utm_campaign=woocommerce_plugin" target="_blank">
	            <?php _e('Open web application', 'livechat-woocommerce'); ?>
            </a>
        </p>
        <p class="disconenct">
	        <?php _e('Something went wrong?', 'livechat-woocommerce'); ?> <a id="resetAccount" href="?page=wc-livechat&reset=1" style="display: inline-block">
		        <?php _e('Disconect your account.', 'livechat-woocommerce'); ?>
            </a>
        </p>
    </div>
    <div class="woocommerce-livechat-column-right">
        <h2><?php _e('Chat window settings', 'livechat-woocommerce'); ?></h2>
        <div class="settings">
            <div>
                <div class="title">
                    <span><?php _e('Hide chat on mobile', 'livechat-woocommerce'); ?></span>
                </div>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $settings_disable_mobile_key ?>" <?php echo (isset($settings[$settings_disable_mobile_key]) && $settings[$settings_disable_mobile_key]) ? 'checked': '' ?>>
                    <label class="onoffswitch-label" for="<?php echo $settings_disable_mobile_key ?>">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div>
                <div class="title">
                    <span><?php _e('Hide chat for Guest visitors', 'livechat-woocommerce'); ?></span>
                </div>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $settings_disable_guests_key ?>" <?php echo (isset($settings[$settings_disable_guests_key]) && $settings[$settings_disable_guests_key]) ? 'checked': '' ?>>
                    <label class="onoffswitch-label" for="<?php echo $settings_disable_guests_key ?>">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <h2><?php _e('Tracking settings', 'livechat-woocommerce'); ?></h2>
        <div class="settings">
            <p class="login-with-livechat"><br>
                <iframe id="login-with-livechat" src="https://addons.livechatinc.com/sign-in-with-livechat" > </iframe>
            </p>
            <div>
                <div class="title">
                    <span><?php _e('Products details', 'livechat-woocommerce'); ?></span>
                </div>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $settings_products_key ?>" <?php echo (isset($settings[$settings_products_key]) && $settings[$settings_products_key]) ? 'checked': '' ?>>
                    <label class="onoffswitch-label" for="<?php echo $settings_products_key ?>">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div>
                <div class="title">
                    <span><?php _e('Products count', 'livechat-woocommerce'); ?></span>
                </div>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $settings_products_count_key ?>" <?php echo (isset($settings[$settings_products_count_key]) && $settings[$settings_products_count_key]) ? 'checked': '' ?>>
                    <label class="onoffswitch-label" for="<?php echo $settings_products_count_key ?>">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div>
                <div class="title">
                    <span><?php _e('Total value', 'livechat-woocommerce'); ?></span>
                </div>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $settings_total_value_key ?>" <?php echo (isset($settings[$settings_total_value_key]) && $settings[$settings_total_value_key]) ? 'checked': '' ?>>
                    <label class="onoffswitch-label" for="<?php echo $settings_total_value_key ?>">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div>
                <div class="title">
                    <span><?php _e('Shipping address', 'livechat-woocommerce'); ?></span>
                </div>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $settings_shipping_address_key ?>" <?php echo (isset($settings[$settings_shipping_address_key]) && $settings[$settings_shipping_address_key]) ? 'checked': '' ?>>
                    <label class="onoffswitch-label" for="<?php echo $settings_shipping_address_key ?>">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            <div>
                <div class="title">
                    <span><?php _e('Last order details', 'livechat-woocommerce'); ?></span>
                </div>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $settings_last_order_key ?>" <?php echo (isset($settings[$settings_last_order_key]) && $settings[$settings_last_order_key]) ? 'checked': '' ?>>
                    <label class="onoffswitch-label" for="<?php echo $settings_last_order_key ?>">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <script>
        var lcDetails = {
            email: '<?php echo $license_email ?>',
            license: <?php echo $license_id ?>
        }
    </script>
</div>
