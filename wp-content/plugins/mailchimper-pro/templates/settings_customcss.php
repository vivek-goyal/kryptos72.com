<div id="screen_preloader" style="position: absolute;width: 100%;height: 1000px;z-index: 9999;text-align: center;background: #fff;padding-top: 200px;"><h3>MailChimper PRO</h3><img src="<?php print(plugins_url( '/assets/img/screen_preloader.gif' , __FILE__ ));?>"><h5><?php _e( 'LOADING', SSPRO_TEXT_DOMAIN );?><br><br><?php _e( 'Please wait...', SSPRO_TEXT_DOMAIN );?></h5></div>
<div class="wrap" id="simple-signup-pro-customcss" style="visibility:hidden">
	<br />
	<h3>MailChimper PRO - <?php _e( 'Custom CSS', SSPRO_TEXT_DOMAIN );?></h3>
	<div class="help_link"><a target="_blank" href="http://simplesignupform.pantherius.com/documentation"><?php _e( 'Documentation', SSPRO_TEXT_DOMAIN );?></a></div>
	<hr /><br>
	<form method="post" action="options.php"> 
		<?php settings_fields('ssf_form_customcss-group'); ?>
		<?php do_settings_fields('ssf_form_customcss-group','ssf_form_customcss-section'); ?>
		<?php do_settings_sections('ssf_form_customcss'); ?>
		<?php submit_button(); ?>
	</form>
</div>