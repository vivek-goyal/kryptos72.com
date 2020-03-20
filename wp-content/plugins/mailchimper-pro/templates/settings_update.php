	<div id="screen_preloader" style="position: absolute;width: 100%;height: 1000px;z-index: 9999;text-align: center;background: #fff;padding-top: 200px;"><h3>MailChimper PRO</h3><img src="<?php print(plugins_url( '/assets/img/screen_preloader.gif' , __FILE__ ));?>"><h5><?php _e( 'LOADING', SSPRO_TEXT_DOMAIN );?><br><br><?php _e( 'Please wait...', SSPRO_TEXT_DOMAIN );?></h5></div>
<div class="wrap" id="simple-signup-pro-help" style="visibility:hidden">
	<br />
	<h3>MailChimper PRO - <?php _e( 'Update', SSPRO_TEXT_DOMAIN );?></h3>
	<div class="help_link"><a target="_blank" href="http://simplesignupform.pantherius.com/documentation"><?php _e( 'Documentation', SSPRO_TEXT_DOMAIN );?></a></div>
	<hr /><br>
	<?php 
		require_once(str_replace('templates','',sprintf("%s/modules/manual.update.php", dirname(__FILE__))));
		manual_plugin_updater::getInstance(
		'mailchimper_pro/mailchimper_pro.php',
		'mailchimper_pro/mailchimper_pro.php',
		array(),
		'mailchimper_pro'
		);
	?>
</div>