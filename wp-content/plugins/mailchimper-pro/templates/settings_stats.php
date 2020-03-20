	<div id="screen_preloader" style="position: absolute;width: 100%;height: 1000px;z-index: 9999;text-align: center;background: #fff;padding-top: 200px;"><h3>MailChimper PRO</h3><img src="<?php print(plugins_url( '/assets/img/screen_preloader.gif' , __FILE__ ));?>"><h5><?php _e( 'LOADING', SSPRO_TEXT_DOMAIN );?><br><br><?php _e( 'Please wait...', SSPRO_TEXT_DOMAIN );?></h5></div>
<div class="wrap" style="visibility:hidden">
	<br />
	<?php
		if (isset($_REQUEST['stat'])) $stat = $_REQUEST['stat'];
		else $stat = "link";
	?>
	<h3>MailChimper PRO - Stats by <?php print($stat);?></h3>
	<div class="help_link"><a target="_blank" href="http://simplesignupform.pantherius.com/documentation"><?php _e( 'Documentation', SSPRO_TEXT_DOMAIN );?></a></div>
	<hr /><br>
	<div id="simple_subscription_popup_stats">
	<?php
	if (get_option('ssfpro_setting_stats')!='on') print('<p>The tracking Stats function is <strong>disabled</strong> in the <a href="'.admin_url('admin.php?page=mailchimper_pro_generalsettings').'">General Settings</a>.</p>');
	else
	{
		if (get_option('ssfpro_setting_gprofile')!='')
		{
			print('<div id="stat_with_ganalytics"><div class="inner_preloader"><img src="'.plugins_url( "/assets/img/innerpreloader.gif" , __FILE__ ).'"><p>Please wait... Connecting to Google Analytics, Gathering Datas...</p></div></div>');
		}
		else
		{
			global $wpdb;$chart_datas = array(); $charttype = '';
			if ($stat=="link") {
				$rsql = "SELECT ssps.*,ssp.name, COUNT(ssps.autoid) as subscribers FROM ".$wpdb->base_prefix ."simple_subscription_popup_stats ssps LEFT JOIN ".$wpdb->base_prefix ."simple_subscription_popup ssp on ssps.formid = ssp.id GROUP BY ssps.link ORDER BY ssps.link ASC";
			}
			elseif ($stat=="form") {
				$rsql = "SELECT ssps.*,ssp.name, COUNT(ssps.autoid) as subscribers FROM ".$wpdb->base_prefix ."simple_subscription_popup_stats ssps 
			LEFT JOIN ".$wpdb->base_prefix ."simple_subscription_popup ssp on ssps.formid = ssp.id GROUP BY ssps.formid ORDER BY ssps.formid ASC";
			}
			elseif ($stat=="date") {
				$rsql = "SELECT ssps.*, ssps.sdate,ssp.name, COUNT(ssps.autoid) as subscribers, DATE_FORMAT(ssps.sdate,'%d-%m-%Y') as fsdate, DATE_FORMAT(ssps.sdate,'%Y-%m-%d') as fcsdate FROM ".$wpdb->base_prefix ."simple_subscription_popup_stats ssps LEFT JOIN ".$wpdb->base_prefix ."simple_subscription_popup ssp on ssps.formid = ssp.id GROUP BY DATE_FORMAT(sdate,'%m-%d-%Y') ORDER BY ssps.sdate DESC";
			}
			$ssp_rsql = $wpdb->get_results($rsql);
			if (!empty($ssp_rsql))
			{
			if ($stat=="date")
			{
				print('<table class="ssfp-table ssfp-table-date display">
					<thead>
						<tr>
							<th class="first">Date</th>
							<th class="second">Subscribers</th>
						</tr>
					</thead>
					<tbody>');
				foreach($ssp_rsql as $ikey => $ivalue)
				{
					print('<tr><td>'.$ivalue->fsdate.'</td><td>'.$ivalue->subscribers.'</td></tr>');
					$chart_datas[] = array($ivalue->fsdate, $ivalue->subscribers); 
				}
				$charttype = "bar";
			}
			elseif ($stat=="form")
			{
				print('<table class="ssfp-table ssfp-table-form display">
					<thead>
						<tr>
							<th class="first">Form ID</th>
							<th class="second">Form Name</th>
							<th class="fourth">Subscribers</th>
						</tr>
					</thead>
					<tbody>');
				foreach($ssp_rsql as $ikey => $ivalue)
				{
				print('<tr><td>'.$ivalue->formid.'</td><td>'.$ivalue->name.'</td><td>'.$ivalue->subscribers.'</td></tr>');
				$chart_datas[] = array($ivalue->name, $ivalue->subscribers); 
				}		
				$charttype = "polar";
			}
			elseif ($stat=="link")
			{
				print('<table class="ssfp-table ssfp-table-link display">
					<thead>
						<tr>
							<th class="third">Link</th>
							<th class="fourth">Subscribers</th>
						</tr>
					</thead>
					<tbody>');
				foreach($ssp_rsql as $ikey => $ivalue)
				{
				print('<tr><td><a target="_blank" href="'.$ivalue->link.'">'.str_replace("http://","",$ivalue->link).'</a></td><td>'.$ivalue->subscribers.'</td></tr>');
				$chart_datas[] = array(str_replace("http://","",$ivalue->link), $ivalue->subscribers); 
				}
				$charttype = "pie";
			}
			print('</tbody></table><div class="ssfp-graph" data-chart="'.$charttype.'"><canvas style="width: 100%; height: 100%;"></canvas><div class="graph_params">'.json_encode($chart_datas).'</div></div>');
			}
			else print('<p>Stats are currently empty.</p>');
		}
	}
	?>
	</div>
</div>