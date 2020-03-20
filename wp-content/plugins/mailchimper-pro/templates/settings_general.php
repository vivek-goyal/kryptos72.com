	<div id="screen_preloader" style="position: absolute;width: 100%;height: 1000px;z-index: 9999;text-align: center;background: #fff;padding-top: 200px;"><h3>MailChimper PRO</h3><img src="<?php print(plugins_url( '/assets/img/screen_preloader.gif' , __FILE__ ));?>"><h5><?php _e( 'LOADING', SSPRO_TEXT_DOMAIN );?><br><br><?php _e( 'Please wait...', SSPRO_TEXT_DOMAIN );?></h5></div>
<div class="wrap" style="visibility:hidden">
	<br />
	<h3>MailChimper PRO - <?php _e( 'General Settings', SSPRO_TEXT_DOMAIN );?></h3>
	<div class="help_link"><a target="_blank" href="http://simplesignupform.pantherius.com/documentation"><?php _e( 'Documentation', SSPRO_TEXT_DOMAIN );?></a></div>
	<hr /><br>
	<?php
	if (isset($_REQUEST['settings-updated'])) {?>
	<div id="message" class="updated below-h2"><p>Settings saved.</p></div>
	<?php }?>
				<form method="post" action="options.php"> 
					<?php @settings_fields('ssf_form-group'); ?>
					<?php @do_settings_fields('ssf_form-group'); ?>
					<?php do_settings_sections('ssf_form'); ?>
					<?php @submit_button(); ?>
				</form>
</div>