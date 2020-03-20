	<div id="screen_preloader" style="position: absolute;width: 100%;height: 1000px;z-index: 9999;text-align: center;background: #fff;padding-top: 200px;"><h3>MailChimper PRO</h3><img src="<?php print(plugins_url( '/assets/img/screen_preloader.gif' , __FILE__ ));?>"><h5><?php _e( 'LOADING', SSPRO_TEXT_DOMAIN );?><br><br><?php _e( 'Please wait...', SSPRO_TEXT_DOMAIN );?></h5></div>
<div class="wrap" style="visibility:hidden">
	<br />
	<h3>MailChimper PRO - <?php _e( 'Subscribers', SSPRO_TEXT_DOMAIN );?></h3>
	<div class="help_link"><a target="_blank" href="http://simplesignupform.pantherius.com/documentation"><?php _e( 'Documentation', SSPRO_TEXT_DOMAIN );?></a></div>
	<hr /><br>
	<div id="simple_subscription_popup_stats">
	<?php
if ( isset( $_REQUEST[ 'delete_subscribers' ] ) ) {
	$dp = json_decode( stripslashes( $_REQUEST[ 'delete_subscribers' ] ) );
	foreach( $dp as $users ) {
		$result = $this->wpdb->query( $this->wpdb->prepare( "DELETE FROM " . $this->wpdb->base_prefix . "simple_subscription_popup_stats WHERE `autoid` = %s", $users ) );
	}
	if ( $result ) {
		echo '<div class="updated"><p>'.__( 'Selected Rows Successfully Deleted!', SSPRO_TEXT_DOMAIN ).'</p></div>';
	}
	else {
		echo '<div class="error"><p>'.__( 'Error Occurred During the Deletion!', SSPRO_TEXT_DOMAIN ).'</p></div>';
	}
}
	if (get_option('ssfpro_setting_stats')!='on') print('<p>The tracking Stats function is <strong>disabled</strong> in the <a href="'.admin_url('admin.php?page=mailchimper_pro_generalsettings').'">General Settings</a>.</p>');
	else
	{
		global $wpdb;
		if (isset($_REQUEST['reset_ssfp_stats']))
		{
			$wpdb->query("TRUNCATE ".$wpdb->base_prefix .'simple_subscription_popup_stats');
		}
		if (isset($_REQUEST['reset_old_ssfp_stats']))
		{
			$wpdb->query("DELETE FROM ".$wpdb->base_prefix .'simple_subscription_popup_stats WHERE DATEDIFF(NOW(),`sdate`)>30');
		}
		$rsql = "SELECT ssps.*, ssp.options as formopts, ssp.name, COUNT(ssps.autoid) as subscribers, DATE_FORMAT(ssps.sdate,'%Y-%m-%d %H:%i') as sortdate, DATE_FORMAT(ssps.sdate,'%d-%m-%Y %H:%i') as sdate FROM ".$wpdb->base_prefix ."simple_subscription_popup_stats ssps 
		LEFT JOIN ".$wpdb->base_prefix ."simple_subscription_popup ssp on ssps.formid = ssp.id GROUP BY ssps.email ORDER BY ssps.link ASC";
		$ssp_rsql = $wpdb->get_results($rsql);
		if (!empty($ssp_rsql))
		{
		print('<table class="ssfp-table ssfp-table-subscribers ssfp-subscriber-table display">
				<thead>
					<tr>
						<th class="zero"><input type="checkbox" name="subscribers_all" id="subscribers-select-all" value="0"></th>
						<th class="first">User ID</th>
						<th class="second">Form Name</th>
						<th class="third">Email</th>
						<th class="third">Custom Fields</th>
						<th class="fourth">Date</th>
					</tr>
				</thead>
				<tbody>');
			foreach($ssp_rsql as $ikey => $ivalue)
			{	
				$ivalue->params = json_encode(unserialize($ivalue->params));
				$ivalue->formopts = json_encode(json_decode(stripslashes($ivalue->formopts)));
				if ( ! empty( $ivalue->name ) ) {
					$maillink = '<a href="#" data-id="'.$ivalue->autoid.'">'.$ivalue->email.'</a>';
				}
				else {
					$maillink = $ivalue->email;
				}
				$formcfields = json_decode( stripslashes( $ivalue->formopts ) );
				$custom_fields = ( array ) json_decode( $ivalue->params );
				$cfields = "";
				if ( ! empty( $custom_fields ) ) {
					$c = 0;
					foreach( $custom_fields as $key=>$cf ) {
						if ( ! empty ( $cf ) ) {
							$cfields .= $cf . ", ";
						}
						$c++;
					}
				}
				else {
					$cfields = "";
				}
				print('<tr><td><input type="checkbox" name="subscribers[ ' . $ivalue->autoid . ' ]" class="subscribers-select" id="subscribers-' . $ivalue->autoid . '" value="0"></td><td>'.$ivalue->autoid.'</td><td>'.$ivalue->name.'</td><td>'.$maillink.'</td><td>' . rtrim( trim( $cfields ), ',' ) . '</td><td>'.$ivalue->sdate.'</td></tr>');
			}
		print('</tbody></table>');
		foreach($ssp_rsql as $ikey => $ivalue)
			{	
				$user_infs = '<div class="user-infs user-inf-id'.$ivalue->autoid.'">'.json_encode($ivalue).'</div>';
				print($user_infs);
			}
		print('<form method="post" id="reset_stat_form" action="'.admin_url('admin.php?page=mailchimper_pro_subscribers').'"><input type="hidden" value="1" name="reset_ssfp_stats"></form><form method="post" id="reset_old_stat_form" action="'.admin_url('admin.php?page=mailchimper_pro_subscribers').'"><input type="hidden" value="1" name="reset_old_ssfp_stats"></form><input type="button" id="delete_alls" class="button button-secondary button-small simple_subscription_popup_tooltip" value="' . __( 'DELETE SELECTED', SSPRO_TEXT_DOMAIN ) . '" title="Delete selected entries from the list"><a class="button button-secondary button-small reset_ssfp_stats simple_subscription_popup_tooltip" name="reset_stats" title="Delete all entries from the list" data-formid="reset_stat_form">DELETE ALL SUBSCRIBERS</a><a class="button button-secondary button-small reset_ssfp_stats simple_subscription_popup_tooltip" title="Delete Subscribers from the list, that older than 30 days" data-formid="reset_old_stat_form" name="reset_stats">DELETE SUBSCRIBERS</a>');
		}
		else print('<p>Subscribers list is currently empty.</p>');
	}
	?>
	</div>
	<div id="dialog-confirm2" title="Reset Stats?">
	  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>All stats will be permanently deleted and cannot be recovered. Are you sure?</p>
	</div>
	<div id="dialog-confirm3" title="<?php _e( 'Delete Subscribers?', SSPRO_TEXT_DOMAIN ); ?>">
	  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php _e( 'The selected subscribers will be permanently deleted! Are you sure?', SSPRO_TEXT_DOMAIN );?></p>
	</div>
	<div class="pop-up-screen"><div class="pop-up-content">
		<div class="half acenter">
			<div><img src="<?php print(plugins_url( '/assets/img/user-icon.png' , __FILE__ ));?>"></div>
			<div><strong>Email: </strong> <span class="email-info"></span></div>
		</div>
		<div class="half">
			<div><p><strong>Subscription Date: </strong> <span class="date-info"></span></p></div>
			<div><p><strong>Subscribed on: </strong> <span class="link-info"></span></p></div>
			<div><p><strong>Subscribed with: </strong> <span class="form-info"></span></p></div>
			<div class="params"></div>
		</div>
		<a class="close button button-default" href="#">Close</a>
	</div></div><div class="overlay"></div>
</div>