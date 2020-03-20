	<div id="screen_preloader" style="position: absolute;width: 100%;height: 1000px;z-index: 9999;text-align: center;background: #fff;padding-top: 200px;"><h3>MailChimper PRO</h3><img src="<?php print(plugins_url( '/assets/img/screen_preloader.gif' , __FILE__ ));?>"><h5><?php _e( 'LOADING', SSPRO_TEXT_DOMAIN );?><br><br><?php _e( 'Please wait...', SSPRO_TEXT_DOMAIN );?></h5></div>
<div class="wrap" style="visibility:hidden">
	<br />
	<h3>MailChimper PRO - <?php _e( 'Saved Forms', SSPRO_TEXT_DOMAIN );?></h3>
	<div class="help_link"><a target="_blank" href="http://simplesignupform.pantherius.com/documentation"><?php _e( 'Documentation', SSPRO_TEXT_DOMAIN );?></a></div>
	<hr /><br>
<?php
	if ( isset ( $_REQUEST[ 'result' ] ) ) {
		$result = $_REQUEST[ 'result' ];
		$reason = "";
		if ( isset ( $_REQUEST[ 'reason' ] ) ) {
			if ( $_REQUEST[ 'reason' ] == "exists" ) {
				$reason = __( 'Form name already exists', SSPRO_TEXT_DOMAIN );
			}
		}
		if ( $result == "deleted" ) echo '<div class="updated"><p>'.__( 'Form successfully deleted!', SSPRO_TEXT_DOMAIN ).'</p></div>'; 
		if ( $result == "duplicated" ) echo '<div class="updated"><p>'.__( 'Form successfully duplicated!', SSPRO_TEXT_DOMAIN ).'</p></div>';  
		if ( $result == "fail" ) echo '<div class="updated"><p>'.__( 'Action failed due to error! '.$reason, SSPRO_TEXT_DOMAIN ).'</p></div>'; 
	}
if ( isset( $_REQUEST[ 'ssfpro_id' ] ) ) {
	$ssfpro_id = $_REQUEST[ 'ssfpro_id' ];
}
else {
	$ssfpro_id = "";
}
if ( ! empty( $ssfpro_id ) ) {
	?>
	<div id="simple_subscription_popup_settings">
			<p>    
			<div id="simple_subscription_popup_accordion">
				<?php
					$sf = $this->wpdb->get_row( $this->wpdb->prepare( "SELECT ssp.options, ssp.id, ssp.name, ssp.global as glb FROM " . $this->wpdb->base_prefix . "simple_subscription_popup ssp WHERE id = %s", $ssfpro_id ) );
					$options = json_decode(stripslashes($sf->options));
					if (!isset($options[38])) $options[38] = '0';
					if (!isset($options[39])) $options[39] = '0';
					if (!isset($options[167])) $options[167] = '1';
					if (!isset($options[169])) $options[169] = '';
					if ( ! isset( $options[162] ) ) {
						$options[162] = '0';
					}
					for ($i = 1; $i <= 300; $i++) {
						if (!isset($options[$i])) $options[$i]='';
					}
						if ($sf->glb==1) {$global_opt = "checked";$global_opt_value='1';}
						else {$global_opt = "";$global_opt_value='0';}
						if ($options[1]=='true') {$autoopen = "checked";$autoopen_value='1';}
						else {$autoopen = "";$autoopen_value='0';}
						if ($options[23]=='true') {$atbottom = "checked";$atbottom_value='1';}
						else {$atbottom = "";$atbottom_value='0';}
						if ($options[13]=='bold') {$boldcontent = "checked";$boldcontent_value='1';}
						else {$boldcontent = "";$boldcontent_value='0';}
						if ($options[26]=='true') {$doubleoptin = "checked";$doubleoptin_value='1';}
						else {$doubleoptin = "";$doubleoptin_value='0';}
						if ($options[27]=='true') {$updateexisting = "checked";$updateexisting_value='1';}
						else {$updateexisting = "";$updateexisting_value='0';}
						if ($options[28]=='true') {$replaceinterests = "checked";$replaceinterests_value='1';}
						else {$replaceinterests = "";$replaceinterests_value='0';}
						if ($options[25]=='bold') {$boldtitle = "checked";$boldtitle_value='1';}
						else {$boldtitle = "";$boldtitle_value='0';}
						if ($options[29]=='true') {$sendwelcome = "checked";$sendwelcome_value='1';}
						else {$sendwelcome = "";$sendwelcome_value='0';}
						if ($options[31]=='true') {$onceperuser = "checked";$onceperuser_value='1';}
						else {$onceperuser = "";$onceperuser_value='0';}
						if ($options[38]=='true') {$lock = "checked";$lock_value='1';}
						else {$lock = "";$lock_value='0';}
						if ($options[39]=='true') {$hidebutton = "checked";$hidebutton_value='1';}
						else {$hidebutton = "";$hidebutton_value='0';}
						if ($options[47]=='true') {$openwithlink = "checked";$openwithlink_value='1';}
						else {$openwithlink = "";$openwithlink_value='0';}
						if ($options[48]=='true') {$once_per_fout = "checked";$once_per_fout_value='1';}
						else {$once_per_fout = "";$once_per_fout_value='0';}
						if ($options[49]=='true') {$closewithlayer = "checked";$closewithlayer_value='1';}
						else {$closewithlayer = "";$closewithlayer_value='0';}
						if ($options[158]=='true') {$trackforms = "checked";$trackforms_value='1';}
						else {$trackforms = "";$trackforms_value='0';}
						if ($options[170]=='true') {$disablemobile = "checked";$disablemobile_value='1';}
						else {$disablemobile = "";$disablemobile_value='0';}
						if ($options[171]=='true') {$disablemembers = "checked";$disablemembers_value='1';}
						else {$disablemembers = "";$disablemembers_value='0';}
						if ($options[53]=='1') {$activecampaign = "checked";$activecampaign_value='1';}
						else {$activecampaign = "";$activecampaign_value='0';}
						if ($options[57]=='1') {$aweber = "checked";$aweber_value='1';}
						else {$aweber = "";$aweber_value='0';}
						if ($options[64]=='1') {$benchmark = "checked";$benchmark_value='1';}
						else {$benchmark = "";$benchmark_value='0';}
						if ($options[67]=='1') {$benchmark_doubleoptin = "checked";$benchmark_doubleoptin_value='1';}
						else {$benchmark_doubleoptin = "";$benchmark_doubleoptin_value='0';}
						if ($options[68]=='1') {$campaignmonitor = "checked";$campaignmonitor_value='1';}
						else {$campaignmonitor = "";$campaignmonitor_value='0';}
						if ($options[72]=='1') {$campayn = "checked";$campayn_value='1';}
						else {$campayn = "";$campayn_value='0';}
						if ($options[75]=='1') {$constantcontact = "checked";$constantcontact_value='1';}
						else {$constantcontact = "";$constantcontact_value='0';}
						if ($options[79]=='1') {$freshmail = "checked";$freshmail_value='1';}
						else {$freshmail = "";$freshmail_value='0';}
						if ($options[83]=='1') {$getresponse = "checked";$getresponse_value='1';}
						else {$getresponse = "";$getresponse_value='0';}
						if ($options[86]=='1') {$icontact = "checked";$icontact_value='1';}
						else {$icontact = "";$icontact_value='0';}
						if ($options[91]=='1') {$infusionsoft = "checked";$infusionsoft_value='1';}
						else {$infusionsoft = "";$infusionsoft_value='0';}
						if ($options[95]=='1') {$interspire = "checked";$interspire_value='1';}
						else {$interspire = "";$interspire_value='0';}
						if ($options[99]=='1') {$madmimi = "checked";$madmimi_value='1';}
						else {$madmimi = "";$madmimi_value='0';}
						if ($options[103]=='1') {$mailerlite = "checked";$mailerlite_value='1';}
						else {$mailerlite = "";$mailerlite_value='0';}
						if ($options[106]=='1') {$mailigen = "checked";$mailigen_value='1';}
						else {$mailigen = "";$mailigen_value='0';}
						if ($options[109]=='1') {$mailigen_doubleoptin = "checked";$mailigen_doubleoptin_value='1';}
						else {$mailigen_doubleoptin = "";$mailigen_doubleoptin_value='0';}
						if ($options[110]=='1') {$mailjet = "checked";$mailjet_value='1';}
						else {$mailjet = "";$mailjet_value='0';}
						if ($options[114]=='1') {$emma = "checked";$emma_value='1';}
						else {$emma = "";$emma_value='0';}
						if ($options[118]=='1') {$mymail = "checked";$mymail_value='1';}
						else {$mymail = "";$mymail_value='0';}
						if ($options[120]=='1') {$ontraport = "checked";$ontraport_value='1';}
						else {$ontraport = "";$ontraport_value='0';}
						if ($options[125]=='1') {$pinpointe = "checked";$pinpointe_value='1';}
						else {$pinpointe = "";$pinpointe_value='0';}
						if ($options[129]=='1') {$sendinblue = "checked";$sendinblue_value='1';}
						else {$sendinblue = "";$sendinblue_value='0';}
						if ($options[132]=='1') {$sendreach = "checked";$sendreach_value='1';}
						else {$sendreach = "";$sendreach_value='0';}
						if ($options[137]=='1') {$sendy = "checked";$sendy_value='1';}
						else {$sendy = "";$sendy_value='0';}
						if ($options[141]=='1') {$simplycast = "checked";$simplycast_value='1';}
						else {$simplycast = "";$simplycast_value='0';}
						if ($options[145]=='1') {$ymlp = "checked";$ymlp_value='1';}
						else {$ymlp = "";$ymlp_value='0';}
						if ($options[160]=='1') {$mailpoet = "checked";$mailpoet_value='1';}
						else {$mailpoet = "";$mailpoet_value='0';}
						if ($options[149]=='1') {$youtube = "checked";$youtube_value='1';}
						else {$youtube = "";$youtube_value='0';}
						$youtube_position1 = "";$youtube_position2 = "";$youtube_position3 = "";$youtube_position4 = "";
						if ($options[151]=='1') {$youtube_position1 = "checked";}
						if ($options[151]=='2') {$youtube_position2 = "checked";}
						if ($options[151]=='3') {$youtube_position3 = "checked";}
						if ($options[151]=='4') {$youtube_position4 = "checked";}
						if ($options[152]=='1') {$youtube_autoplay = "checked";$youtube_autoplay_value='1';}
						else {$youtube_autoplay = "";$youtube_autoplay_value='0';}
						if ($options[153]=='1') {$youtube_showinfo = "checked";$youtube_showinfo_value='1';}
						else {$youtube_showinfo = "";$youtube_showinfo_value='0';}
						if ($options[154]=='1') {$youtube_loop = "checked";$youtube_loop_value='1';}
						else {$youtube_loop = "";$youtube_loop_value='0';}
						if ($options[155]=='1') {$youtube_controls = "checked";$youtube_controls_value='1';}
						else {$youtube_controls = "";$youtube_controls_value='0';}
						if ($options[162]=='1') {$image_integration = "checked";$image_integration_value='1';}
						else {$image_integration = "";$image_integration_value='0';}
						$image_position1 = "";$image_position2 = "";$image_position3 = "";$image_position4 = "";$image_position5 = "";$image_position6 = "";$image_position7 = "";
						if ($options[164]=='1') {$image_position1 = "checked";}
						if ($options[164]=='2') {$image_position2 = "checked";}
						if ($options[164]=='3') {$image_position3 = "checked";}
						if ($options[164]=='4') {$image_position4 = "checked";}
						if ($options[164]=='5') {$image_position5 = "checked";}
						if ($options[168]=='1') {$image_repeat = "checked";$image_repeat_value='1';}
						else {$image_repeat = "";$image_repeat_value='0';}
					$custom_fields = "";
					foreach($options[50] as $cf)
					{
					if ($cf->required=='true') {$req = '1';$req_value = 'checked';}
					else {$req = '0';$req_value = '';}
					if ( ! isset( $cf->type ) ) $cf->type = "text";
					$onkeyup = 'onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9]/g,\'\');"';
						if ( $cf->type == "text" ) {
							$custom_fields .= "<div class='one-custom-field'><input ".$onkeyup." type='text' data-type='text' class='cfid simple_subscription_popup_tooltip' title='ID of input field, eg.: FNAME' value='".$cf->id."' placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip' value='".$cf->name."' title='Name of custom field, eg.: First Name' placeholder='Name'><input type='text' class='cfwarning simple_subscription_popup_tooltip' title='Warning text for the field if it is required, eg.: Firstname field is mandatory' value='".$cf->warning."' placeholder='Warning'><input type='text' class='cfminlength simple_subscription_popup_tooltip' title='Minimum character length for required field' value='".$cf->minlength."' placeholder='0'><input type='checkbox' class='cfrequired simple_subscription_popup_tooltip' ".$req_value." title='Check this if the field is mandatory' value='".$req."'><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Text Field' src='".plugins_url( '/assets/img/delete.png' , __FILE__ )."'></div>";
						}
						if ( $cf->type == "textarea" ) {
							$custom_fields .= "<div class='one-custom-field'><input ".$onkeyup." type='text' data-type='textarea' class='cfid simple_subscription_popup_tooltip' title='ID of textarea field, eg.: Description' value='".$cf->id."' placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip' value='".$cf->name."' title='Placeholder for custom field, eg.: Description' placeholder='Description'><input type='text' class='cfwarning simple_subscription_popup_tooltip' title='Warning text for the field if it is required, eg.: Description field is mandatory' value='".$cf->warning."' placeholder='Warning'><input type='text' class='cfminlength simple_subscription_popup_tooltip' title='Minimum character length for required field' value='".$cf->minlength."' placeholder='0'><input type='checkbox' class='cfrequired simple_subscription_popup_tooltip' ".$req_value." title='Check this if the field is mandatory' value='".$req."'><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Textarea Field' src='".plugins_url( '/assets/img/delete.png' , __FILE__ )."'></div>";
						}
						if ( $cf->type == "radio" ) {
							$custom_fields .= "<div class='one-custom-field'><input ".$onkeyup." type='text' data-type='radio' class='cfid simple_subscription_popup_tooltip' title='ID of radio field, eg.: GENDER' value='".$cf->id."' placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip longinput' value='".$cf->name."' title='Name and value pair for custom field, eg.: Female:female,Male:male' placeholder='Female:female,Male:male'><input type='checkbox' class='cfrequired simple_subscription_popup_tooltip' ".$req_value." title='Check this if the field is mandatory' value='".$req."'><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Radio Field' src='".plugins_url( '/assets/img/delete.png' , __FILE__ )."'></div>";
						}
						if ( $cf->type == "checkbox" ) {
							$custom_fields .= "<div class='one-custom-field'><input ".$onkeyup." type='text' data-type='checkbox' class='cfid simple_subscription_popup_tooltip' title='ID of checkbox field, eg.: I agreee with Terms and Conditions' value='".$cf->id."' placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip longinput' value='".$cf->name."' title='Value of custom field, eg.: Yes' placeholder='Yes'><input type='checkbox' class='cfrequired simple_subscription_popup_tooltip' ".$req_value." title='Check this if the field is mandatory' value='".$req."'><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Checkbox Field' src='".plugins_url( '/assets/img/delete.png' , __FILE__ )."'></div>";
						}
						if ( $cf->type == "select" ) {
							$custom_fields .= "<div class='one-custom-field'><input ".$onkeyup." type='text' data-type='select' class='cfid simple_subscription_popup_tooltip' title='ID of select field, eg.: FRUITS' value='".$cf->id."' placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip longinput' value='".$cf->name."' title='Name and value pair for custom field, eg.: Select from the list,Apple:apple,Orange:orange,Lemon:lemon' placeholder='Select from the list,Apple:applevalue,Orange:orangevalue,Lemon:lemonvalue'><input type='checkbox' class='cfrequired simple_subscription_popup_tooltip' ".$req_value." title='Check this if the field is mandatory' value='".$req."'><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Select Field' src='".plugins_url( '/assets/img/delete.png' , __FILE__ )."'></div>";
						}
						if ( $cf->type == "hidden" ) {
							$custom_fields .= "<div class='one-custom-field'><input ".$onkeyup." type='text' data-type='hidden' class='cfid simple_subscription_popup_tooltip' title='ID of hidden field, eg.: SIGNUP' value='".$cf->id."' placeholder='ID'><input type='text' class='cfname simple_subscription_popup_tooltip longinput' value='".$cf->name."' title='Value of the field, eg.: blog name'><div class='emptycheckbox'></div><img class='remove_cfield simple_subscription_popup_tooltip' title='Remove Custom Hidden Field' src='".plugins_url( '/assets/img/delete.png' , __FILE__ )."'></div>";
						}
					}
				print('<h3 class="header_'.$sf->id.'">'.$sf->name.'</h3>
	  <div id="'.$sf->id.'" class="main_form_container"><div class="scode_tag">Shortcode: [ssp id='.$sf->id.']</div>
			<div class="text simple_subscription_popup_tooltip" title="Predefined style of the form"><p>Presets</p>
			<select name="preset" class="preset">
				<option '.selected( $options[52], "default", false ).' value="default">Default</option>
				<option '.selected( $options[52], "business", false ).' value="business">Business</option>
				<option '.selected( $options[52], "baby", false ).' value="baby">Baby</option>
				<option '.selected( $options[52], "dating", false ).' value="dating">Dating</option>
				<option '.selected( $options[52], "technology", false ).' value="technology">Technology</option>
				<option '.selected( $options[52], "finance", false ).' value="finance">Finance</option>
				<option '.selected( $options[52], "custom", false ).' value="custom">Custom</option>
			</select>
			</div>
			<div class="text simple_subscription_popup_tooltip" title="Specify the position of the incoming form"><p>Position</p>
			<select name="display_style" class="display_style">
				<option '.selected( $options[19], "lefttop", false ).' value="lefttop">Left-Top</option>
				<option '.selected( $options[19], "leftcenter", false ).' value="leftcenter">Left-Center</option>
				<option '.selected( $options[19], "leftbottom", false ).' value="leftbottom">Left-Bottom</option>
				<option '.selected( $options[19], "centertop", false ).' value="centertop">Center-Top</option>
				<option '.selected( $options[19], "centercenter", false ).' value="centercenter">Center-Center</option>
				<option '.selected( $options[19], "centerbottom", false ).' value="centerbottom">Center-Bottom</option>
				<option '.selected( $options[19], "righttop", false ).' value="righttop">Right-Top</option>
				<option '.selected( $options[19], "rightcenter", false ).' value="rightcenter">Right-Center</option>
				<option '.selected( $options[19], "rightbottom", false ).' value="rightbottom">Right-Bottom</option>
			</select>
			</div> 
			<div class="text simple_subscription_popup_tooltip" title="Select animation type"><p>Animation</p>
			<select name="animation" class="animation">
				<option '.selected( $options[40], "perspectivein", false ).' value="perspectivein">Perspective</option>
				<option '.selected( $options[40], "scalein", false ).' value="scalein">Scale</option>
				<option '.selected( $options[40], "slide", false ).' value="slide">Slide</option>
				<option '.selected( $options[40], "rotatein", false ).' value="rotatein">Rotate</option>
			</select>
			</div> 
			<div class="text simple_subscription_popup_tooltip" title="Select item effect"><p>Item Effect</p>
			<select name="elementanimation" class="elementanimation">
				<option '.selected( $options[159], "", false ).' value="">Disabled</option>
				<option '.selected( $options[159], "elemmove", false ).' value="elemmove">Move</option>
				<option '.selected( $options[159], "elemmove-random", false ).' value="elemmove-random">Move - Random</option>
				<option '.selected( $options[159], "elemfade", false ).' value="elemfade">Fade</option>
				<option '.selected( $options[159], "elemfade-random", false ).' value="elemfade-random">Fade - Random</option>
				<option '.selected( $options[159], "elemscale", false ).' value="elemscale">Scale</option>
				<option '.selected( $options[159], "elemscale-random", false ).' value="elemscale-random">Scale - Random</option>
			</select>
			</div> 
			<div class="text simple_subscription_popup_tooltip" title="Select Mail Notification Mode, Connect to MailChimp or use both (Mixed Mode)"><p>Mode</p>
			<select name="mode" class="mode">
				<option '.selected( $options[2], 'mail', false ).' value="mail">Mail</option>
				<option '.selected( $options[2], 'mailchimp', false ).' value="mailchimp">MailChimp</option>
				<option '.selected( $options[2], 'mixed', false ).' value="mixed">Mixed</option>
				<option '.selected( $options[2], 'advancedapi', false ).' value="advancedapi">Additional API</option>
			</select>
			</div>
			<div class="text simple_subscription_popup_tooltip" title="Font Family of the Title of Signup Form"><p>Font Family</p> <select name="font_family" class="font_family">
							<option '.selected( $options[10], '', false ).' value="">Default</option>
							<option '.selected( $options[10], 'ABeeZee', false ).' value="ABeeZee">ABeeZee</option>
							<option '.selected( $options[10], 'Abel', false ).' value="Abel">Abel</option>
							<option '.selected( $options[10], 'Abril Fatface', false ).' value="Abril Fatface">Abril Fatface</option>
							<option '.selected( $options[10], 'Aclonica', false ).' value="Aclonica">Aclonica</option>
							<option '.selected( $options[10], 'Acme', false ).' value="Acme">Acme</option>
							<option '.selected( $options[10], 'Actor', false ).' value="Actor">Actor</option>
							<option '.selected( $options[10], 'Adamina', false ).' value="Adamina">Adamina</option>
							<option '.selected( $options[10], 'Advent Pro', false ).' value="Advent Pro">Advent Pro</option>
							<option '.selected( $options[10], 'Aguafina Script', false ).' value="Aguafina Script">Aguafina Script</option>
							<option '.selected( $options[10], 'Akronim', false ).' value="Akronim">Akronim</option>
							<option '.selected( $options[10], 'Aladin', false ).' value="Aladin">Aladin</option>
							<option '.selected( $options[10], 'Aldrich', false ).' value="Aldrich">Aldrich</option>
							<option '.selected( $options[10], 'Alef', false ).' value="Alef">Alef</option>
							<option '.selected( $options[10], 'Alegreya', false ).' value="Alegreya">Alegreya</option>
							<option '.selected( $options[10], 'Alegreya SC', false ).' value="Alegreya SC">Alegreya SC</option>
							<option '.selected( $options[10], 'Alex Brush', false ).' value="Alex Brush">Alex Brush</option>
							<option '.selected( $options[10], 'Alfa Slab One', false ).' value="Alfa Slab One">Alfa Slab One</option>
							<option '.selected( $options[10], 'Alice', false ).' value="Alice">Alice</option>
							<option '.selected( $options[10], 'Alike', false ).' value="Alike">Alike</option>
							<option '.selected( $options[10], 'Alike Angular', false ).' value="Alike Angular">Alike Angular</option>
							<option '.selected( $options[10], 'Allan', false ).' value="Allan">Allan</option>
							<option '.selected( $options[10], 'Allerta', false ).' value="Allerta">Allerta</option>
							<option '.selected( $options[10], 'Allerta Stencil', false ).' value="Allerta Stencil">Allerta Stencil</option>
							<option '.selected( $options[10], 'Allura', false ).' value="Allura">Allura</option>
							<option '.selected( $options[10], 'Almendra', false ).' value="Almendra">Almendra</option>
							<option '.selected( $options[10], 'Almendra Display', false ).' value="Almendra Display">Almendra Display</option>
							<option '.selected( $options[10], 'Almendra SC', false ).' value="Almendra SC">Almendra SC</option>
							<option '.selected( $options[10], 'Amarante', false ).' value="Amarante">Amarante</option>
							<option '.selected( $options[10], 'Amaranth', false ).' value="Amaranth">Amaranth</option>
							<option '.selected( $options[10], 'Amatic SC', false ).' value="Amatic SC">Amatic SC</option>
							<option '.selected( $options[10], 'Amethysta', false ).' value="Amethysta">Amethysta</option>
							<option '.selected( $options[10], 'Anaheim', false ).' value="Anaheim">Anaheim</option>
							<option '.selected( $options[10], 'Andada', false ).' value="Andada">Andada</option>
							<option '.selected( $options[10], 'Andika', false ).' value="Andika">Andika</option>
							<option '.selected( $options[10], 'Angkor', false ).' value="Angkor">Angkor</option>
							<option '.selected( $options[10], 'Annie Use Your Telescope', false ).' value="Annie Use Your Telescope">Annie Use Your Telescope</option>
							<option '.selected( $options[10], 'Anonymous Pro', false ).' value="Anonymous Pro">Anonymous Pro</option>
							<option '.selected( $options[10], 'Antic', false ).' value="Antic">Antic</option>
							<option '.selected( $options[10], 'Antic Didone', false ).' value="Antic Didone">Antic Didone</option>
							<option '.selected( $options[10], 'Antic Slab', false ).' value="Antic Slab">Antic Slab</option>
							<option '.selected( $options[10], 'Anton', false ).' value="Anton">Anton</option>
							<option '.selected( $options[10], 'Arapey', false ).' value="Arapey">Arapey</option>
							<option '.selected( $options[10], 'Arbutus', false ).' value="Arbutus">Arbutus</option>
							<option '.selected( $options[10], 'Arbutus Slab', false ).' value="Arbutus Slab">Arbutus Slab</option>
							<option '.selected( $options[10], 'Architects Daughter', false ).' value="Architects Daughter">Architects Daughter</option>
							<option '.selected( $options[10], 'Archivo Black', false ).' value="Archivo Black">Archivo Black</option>
							<option '.selected( $options[10], 'Archivo Narrow', false ).' value="Archivo Narrow">Archivo Narrow</option>
							<option '.selected( $options[10], 'Arimo', false ).' value="Arimo">Arimo</option>
							<option '.selected( $options[10], 'Arizonia', false ).' value="Arizonia">Arizonia</option>
							<option '.selected( $options[10], 'Armata', false ).' value="Armata">Armata</option>
							<option '.selected( $options[10], 'Artifika', false ).' value="Artifika">Artifika</option>
							<option '.selected( $options[10], 'Arvo', false ).' value="Arvo">Arvo</option>
							<option '.selected( $options[10], 'Asap', false ).' value="Asap">Asap</option>
							<option '.selected( $options[10], 'Asset', false ).' value="Asset">Asset</option>
							<option '.selected( $options[10], 'Astloch', false ).' value="Astloch">Astloch</option>
							<option '.selected( $options[10], 'Asul', false ).' value="Asul">Asul</option>
							<option '.selected( $options[10], 'Atomic Age', false ).' value="Atomic Age">Atomic Age</option>
							<option '.selected( $options[10], 'Aubrey', false ).' value="Aubrey">Aubrey</option>
							<option '.selected( $options[10], 'Audiowide', false ).' value="Audiowide">Audiowide</option>
							<option '.selected( $options[10], 'Autour One', false ).' value="Autour One">Autour One</option>
							<option '.selected( $options[10], 'Average', false ).' value="Average">Average</option>
							<option '.selected( $options[10], 'Average Sans', false ).' value="Average Sans">Average Sans</option>
							<option '.selected( $options[10], 'Averia Gruesa Libre', false ).' value="Averia Gruesa Libre">Averia Gruesa Libre</option>
							<option '.selected( $options[10], 'Averia Libre', false ).' value="Averia Libre">Averia Libre</option>
							<option '.selected( $options[10], 'Averia Sans Libre', false ).' value="Averia Sans Libre">Averia Sans Libre</option>
							<option '.selected( $options[10], 'Averia Serif Libre', false ).' value="Averia Serif Libre">Averia Serif Libre</option>
							<option '.selected( $options[10], 'Bad Script', false ).' value="Bad Script">Bad Script</option>
							<option '.selected( $options[10], 'Balthazar', false ).' value="Balthazar">Balthazar</option>
							<option '.selected( $options[10], 'Bangers', false ).' value="Bangers">Bangers</option>
							<option '.selected( $options[10], 'Basic', false ).' value="Basic">Basic</option>
							<option '.selected( $options[10], 'Battambang', false ).' value="Battambang">Battambang</option>
							<option '.selected( $options[10], 'Baumans', false ).' value="Baumans">Baumans</option>
							<option '.selected( $options[10], 'Bayon', false ).' value="Bayon">Bayon</option>
							<option '.selected( $options[10], 'Belgrano', false ).' value="Belgrano">Belgrano</option>
							<option '.selected( $options[10], 'Belleza', false ).' value="Belleza">Belleza</option>
							<option '.selected( $options[10], 'BenchNine', false ).' value="BenchNine">BenchNine</option>
							<option '.selected( $options[10], 'Bentham', false ).' value="Bentham">Bentham</option>
							<option '.selected( $options[10], 'Berkshire Swash', false ).' value="Berkshire Swash">Berkshire Swash</option>
							<option '.selected( $options[10], 'Bevan', false ).' value="Bevan">Bevan</option>
							<option '.selected( $options[10], 'Bigelow Rules', false ).' value="Bigelow Rules">Bigelow Rules</option>
							<option '.selected( $options[10], 'Bigshot One', false ).' value="Bigshot One">Bigshot One</option>
							<option '.selected( $options[10], 'Bilbo', false ).' value="Bilbo">Bilbo</option>
							<option '.selected( $options[10], 'Bilbo Swash Caps', false ).' value="Bilbo Swash Caps">Bilbo Swash Caps</option>
							<option '.selected( $options[10], 'Bitter', false ).' value="Bitter">Bitter</option>
							<option '.selected( $options[10], 'Black Ops One', false ).' value="Black Ops One">Black Ops One</option>
							<option '.selected( $options[10], 'Bokor', false ).' value="Bokor">Bokor</option>
							<option '.selected( $options[10], 'Bonbon', false ).' value="Bonbon">Bonbon</option>
							<option '.selected( $options[10], 'Boogaloo', false ).' value="Boogaloo">Boogaloo</option>
							<option '.selected( $options[10], 'Bowlby One', false ).' value="Bowlby One">Bowlby One</option>
							<option '.selected( $options[10], 'Bowlby One SC', false ).' value="Bowlby One SC">Bowlby One SC</option>
							<option '.selected( $options[10], 'Brawler', false ).' value="Brawler">Brawler</option>
							<option '.selected( $options[10], 'Bree Serif', false ).' value="Bree Serif">Bree Serif</option>
							<option '.selected( $options[10], 'Bubblegum Sans', false ).' value="Bubblegum Sans">Bubblegum Sans</option>
							<option '.selected( $options[10], 'Bubbler One', false ).' value="Bubbler One">Bubbler One</option>
							<option '.selected( $options[10], 'Buenard', false ).' value="Buenard">Buenard</option>
							<option '.selected( $options[10], 'Butcherman', false ).' value="Butcherman">Butcherman</option>
							<option '.selected( $options[10], 'Butterfly Kids', false ).' value="Butterfly Kids">Butterfly Kids</option>
							<option '.selected( $options[10], 'Cabin', false ).' value="Cabin">Cabin</option>
							<option '.selected( $options[10], 'Cabin Condensed', false ).' value="Cabin Condensed">Cabin Condensed</option>
							<option '.selected( $options[10], 'Cabin Sketch', false ).' value="Cabin Sketch">Cabin Sketch</option>
							<option '.selected( $options[10], 'Caesar Dressing', false ).' value="Caesar Dressing">Caesar Dressing</option>
							<option '.selected( $options[10], 'Cagliostro', false ).' value="Cagliostro">Cagliostro</option>
							<option '.selected( $options[10], 'Calligraffitti', false ).' value="Calligraffitti">Calligraffitti</option>
							<option '.selected( $options[10], 'ABeeCamboZee', false ).' value="Cambo">Cambo</option>
							<option '.selected( $options[10], 'Candal', false ).' value="Candal">Candal</option>
							<option '.selected( $options[10], 'Cantarell', false ).' value="Cantarell">Cantarell</option>
							<option '.selected( $options[10], 'Cantata One', false ).' value="Cantata One">Cantata One</option>
							<option '.selected( $options[10], 'Cantora One', false ).' value="Cantora One">Cantora One</option>
							<option '.selected( $options[10], 'Capriola', false ).' value="Capriola">Capriola</option>
							<option '.selected( $options[10], 'Cardo', false ).' value="Cardo">Cardo</option>
							<option '.selected( $options[10], 'Carme', false ).' value="Carme">Carme</option>
							<option '.selected( $options[10], 'Carrois Gothic', false ).' value="Carrois Gothic">Carrois Gothic</option>
							<option '.selected( $options[10], 'Carrois Gothic SC', false ).' value="Carrois Gothic SC">Carrois Gothic SC</option>
							<option '.selected( $options[10], 'Carter One', false ).' value="Carter One">Carter One</option>
							<option '.selected( $options[10], 'Caudex', false ).' value="Caudex">Caudex</option>
							<option '.selected( $options[10], 'Cedarville Cursive', false ).' value="Cedarville Cursive">Cedarville Cursive</option>
							<option '.selected( $options[10], 'Ceviche One', false ).' value="Ceviche One">Ceviche One</option>
							<option '.selected( $options[10], 'Changa One', false ).' value="Changa One">Changa One</option>
							<option '.selected( $options[10], 'Chango', false ).' value="Chango">Chango</option>
							<option '.selected( $options[10], 'Chau Philomene One', false ).' value="Chau Philomene One">Chau Philomene One</option>
							<option '.selected( $options[10], 'Chela One', false ).' value="Chela One">Chela One</option>
							<option '.selected( $options[10], 'Chelsea Market', false ).' value="Chelsea Market">Chelsea Market</option>
							<option '.selected( $options[10], 'Chenla', false ).' value="Chenla">Chenla</option>
							<option '.selected( $options[10], 'Cherry Cream Soda', false ).' value="Cherry Cream Soda">Cherry Cream Soda</option>
							<option '.selected( $options[10], 'Cherry Swash', false ).' value="Cherry Swash">Cherry Swash</option>
							<option '.selected( $options[10], 'Chewy', false ).' value="Chewy">Chewy</option>
							<option '.selected( $options[10], 'Chicle', false ).' value="Chicle">Chicle</option>
							<option '.selected( $options[10], 'Chivo', false ).' value="Chivo">Chivo</option>
							<option '.selected( $options[10], 'Cinzel', false ).' value="Cinzel">Cinzel</option>
							<option '.selected( $options[10], 'Cinzel Decorative', false ).' value="Cinzel Decorative">Cinzel Decorative</option>
							<option '.selected( $options[10], 'Clicker Script', false ).' value="Clicker Script">Clicker Script</option>
							<option '.selected( $options[10], 'Coda', false ).' value="Coda">Coda</option>
							<option '.selected( $options[10], 'Coda Caption:800', false ).' value="Coda Caption:800">Coda Caption</option>
							<option '.selected( $options[10], 'Codystar', false ).' value="Codystar">Codystar</option>
							<option '.selected( $options[10], 'Combo', false ).' value="Combo">Combo</option>
							<option '.selected( $options[10], 'Comfortaa', false ).' value="Comfortaa">Comfortaa</option>
							<option '.selected( $options[10], 'Coming Soon', false ).' value="Coming Soon">Coming Soon</option>
							<option '.selected( $options[10], 'Concert One', false ).' value="Concert One">Concert One</option>
							<option '.selected( $options[10], 'Condiment', false ).' value="Condiment">Condiment</option>
							<option '.selected( $options[10], 'Content', false ).' value="Content">Content</option>
							<option '.selected( $options[10], 'Contrail One', false ).' value="Contrail One">Contrail One</option>
							<option '.selected( $options[10], 'Convergence', false ).' value="Convergence">Convergence</option>
							<option '.selected( $options[10], 'Cookie', false ).' value="Cookie">Cookie</option>
							<option '.selected( $options[10], 'Copse', false ).' value="Copse">Copse</option>
							<option '.selected( $options[10], 'Corben', false ).' value="Corben">Corben</option>
							<option '.selected( $options[10], 'Courgette', false ).' value="Courgette">Courgette</option>
							<option '.selected( $options[10], 'Cousine', false ).' value="Cousine">Cousine</option>
							<option '.selected( $options[10], 'Coustard', false ).' value="Coustard">Coustard</option>
							<option '.selected( $options[10], 'Covered By Your Grace', false ).' value="Covered By Your Grace">Covered By Your Grace</option>
							<option '.selected( $options[10], 'Crafty Girls', false ).' value="Crafty Girls">Crafty Girls</option>
							<option '.selected( $options[10], 'Creepster', false ).' value="Creepster">Creepster</option>
							<option '.selected( $options[10], 'Crete Round', false ).' value="Crete Round">Crete Round</option>
							<option '.selected( $options[10], 'Crimson Text', false ).' value="Crimson Text">Crimson Text</option>
							<option '.selected( $options[10], 'Croissant One', false ).' value="Croissant One">Croissant One</option>
							<option '.selected( $options[10], 'Crushed', false ).' value="Crushed">Crushed</option>
							<option '.selected( $options[10], 'Cuprum', false ).' value="Cuprum">Cuprum</option>
							<option '.selected( $options[10], 'Cutive', false ).' value="Cutive">Cutive</option>
							<option '.selected( $options[10], 'Cutive Mono', false ).' value="Cutive Mono">Cutive Mono</option>
							<option '.selected( $options[10], 'Damion', false ).' value="Damion">Damion</option>
							<option '.selected( $options[10], 'Dancing Script', false ).' value="Dancing Script">Dancing Script</option>
							<option '.selected( $options[10], 'Dangrek', false ).' value="Dangrek">Dangrek</option>
							<option '.selected( $options[10], 'Dawning of a New Day', false ).' value="Dawning of a New Day">Dawning of a New Day</option>
							<option '.selected( $options[10], 'Days One', false ).' value="Days One">Days One</option>
							<option '.selected( $options[10], 'Delius', false ).' value="Delius">Delius</option>
							<option '.selected( $options[10], 'Delius Swash Caps', false ).' value="Delius Swash Caps">Delius Swash Caps</option>
							<option '.selected( $options[10], 'Delius Unicase', false ).' value="Delius Unicase">Delius Unicase</option>
							<option '.selected( $options[10], 'Della Respira', false ).' value="Della Respira">Della Respira</option>
							<option '.selected( $options[10], 'Denk One', false ).' value="Denk One">Denk One</option>
							<option '.selected( $options[10], 'Devonshire', false ).' value="Devonshire">Devonshire</option>
							<option '.selected( $options[10], 'Didact Gothic', false ).' value="Didact Gothic">Didact Gothic</option>
							<option '.selected( $options[10], 'Diplomata', false ).' value="Diplomata">Diplomata</option>
							<option '.selected( $options[10], 'Diplomata SC', false ).' value="Diplomata SC">Diplomata SC</option>
							<option '.selected( $options[10], 'Domine', false ).' value="Domine">Domine</option>
							<option '.selected( $options[10], 'Donegal One', false ).' value="Donegal One">Donegal One</option>
							<option '.selected( $options[10], 'Doppio One', false ).' value="Doppio One">Doppio One</option>
							<option '.selected( $options[10], 'Dorsa', false ).' value="Dorsa">Dorsa</option>
							<option '.selected( $options[10], 'Dosis', false ).' value="Dosis">Dosis</option>
							<option '.selected( $options[10], 'Dr Sugiyama', false ).' value="Dr Sugiyama">Dr Sugiyama</option>
							<option '.selected( $options[10], 'Droid Sans', false ).' value="Droid Sans">Droid Sans</option>
							<option '.selected( $options[10], 'Droid Sans Mono', false ).' value="Droid Sans Mono">Droid Sans Mono</option>
							<option '.selected( $options[10], 'Droid Serif', false ).' value="Droid Serif">Droid Serif</option>
							<option '.selected( $options[10], 'Duru Sans', false ).' value="Duru Sans">Duru Sans</option>
							<option '.selected( $options[10], 'Dynalight', false ).' value="Dynalight">Dynalight</option>
							<option '.selected( $options[10], 'Eagle Lake', false ).' value="Eagle Lake">Eagle Lake</option>
							<option '.selected( $options[10], 'Eater', false ).' value="Eater">Eater</option>
							<option '.selected( $options[10], 'EB Garamond', false ).' value="EB Garamond">EB Garamond</option>
							<option '.selected( $options[10], 'Economica', false ).' value="Economica">Economica</option>
							<option '.selected( $options[10], 'Electrolize', false ).' value="Electrolize">Electrolize</option>
							<option '.selected( $options[10], 'Elsie', false ).' value="Elsie">Elsie</option>
							<option '.selected( $options[10], 'Elsie Swash Caps', false ).' value="Elsie Swash Caps">Elsie Swash Caps</option>
							<option '.selected( $options[10], 'Emblema One', false ).' value="Emblema One">Emblema One</option>
							<option '.selected( $options[10], 'Emilys Candy', false ).' value="Emilys Candy">Emilys Candy</option>
							<option '.selected( $options[10], 'Engagement', false ).' value="Engagement">Engagement</option>
							<option '.selected( $options[10], 'Englebert', false ).' value="Englebert">Englebert</option>
							<option '.selected( $options[10], 'Enriqueta', false ).' value="Enriqueta">Enriqueta</option>
							<option '.selected( $options[10], 'Erica One', false ).' value="Erica One">Erica One</option>
							<option '.selected( $options[10], 'Esteban', false ).' value="Esteban">Esteban</option>
							<option '.selected( $options[10], 'Euphoria Script', false ).' value="Euphoria Script">Euphoria Script</option>
							<option '.selected( $options[10], 'Ewert', false ).' value="Ewert">Ewert</option>
							<option '.selected( $options[10], 'Exo', false ).' value="Exo">Exo</option>
							<option '.selected( $options[10], 'Expletus Sans', false ).' value="Expletus Sans">Expletus Sans</option>
							<option '.selected( $options[10], 'Fanwood Text', false ).' value="Fanwood Text">Fanwood Text</option>
							<option '.selected( $options[10], 'Fascinate', false ).' value="Fascinate">Fascinate</option>
							<option '.selected( $options[10], 'Fascinate Inline', false ).' value="Fascinate Inline">Fascinate Inline</option>
							<option '.selected( $options[10], 'Faster One', false ).' value="Faster One">Faster One</option>
							<option '.selected( $options[10], 'Fasthand', false ).' value="Fasthand">Fasthand</option>
							<option '.selected( $options[10], 'Fauna One', false ).' value="Fauna One">Fauna One</option>
							<option '.selected( $options[10], 'Federant', false ).' value="Federant">Federant</option>
							<option '.selected( $options[10], 'Federo', false ).' value="Federo">Federo</option>
							<option '.selected( $options[10], 'Felipa', false ).' value="Felipa">Felipa</option>
							<option '.selected( $options[10], 'Fenix', false ).' value="Fenix">Fenix</option>
							<option '.selected( $options[10], 'Finger Paint', false ).' value="Finger Paint">Finger Paint</option>
							<option '.selected( $options[10], 'Fjalla One', false ).' value="Fjalla One">Fjalla One</option>
							<option '.selected( $options[10], 'Fjord One', false ).' value="Fjord One">Fjord One</option>
							<option '.selected( $options[10], 'Flamenco', false ).' value="Flamenco">Flamenco</option>
							<option '.selected( $options[10], 'Flavors', false ).' value="Flavors">Flavors</option>
							<option '.selected( $options[10], 'Fondamento', false ).' value="Fondamento">Fondamento</option>
							<option '.selected( $options[10], 'Fontdiner Swanky', false ).' value="Fontdiner Swanky">Fontdiner Swanky</option>
							<option '.selected( $options[10], 'Forum', false ).' value="Forum">Forum</option>
							<option '.selected( $options[10], 'Francois One', false ).' value="Francois One">Francois One</option>
							<option '.selected( $options[10], 'Freckle Face', false ).' value="Freckle Face">Freckle Face</option>
							<option '.selected( $options[10], 'Fredericka the Great', false ).' value="Fredericka the Great">Fredericka the Great</option>
							<option '.selected( $options[10], 'Fredoka One', false ).' value="Fredoka One">Fredoka One</option>
							<option '.selected( $options[10], 'Freehand', false ).' value="Freehand">Freehand</option>
							<option '.selected( $options[10], 'Fresca', false ).' value="Fresca">Fresca</option>
							<option '.selected( $options[10], 'Frijole', false ).' value="Frijole">Frijole</option>
							<option '.selected( $options[10], 'Fruktur', false ).' value="Fruktur">Fruktur</option>
							<option '.selected( $options[10], 'Fugaz One', false ).' value="Fugaz One">Fugaz One</option>
							<option '.selected( $options[10], 'Gabriela', false ).' value="Gabriela">Gabriela</option>
							<option '.selected( $options[10], 'Gafata', false ).' value="Gafata">Gafata</option>
							<option '.selected( $options[10], 'Galdeano', false ).' value="Galdeano">Galdeano</option>
							<option '.selected( $options[10], 'Galindo', false ).' value="Galindo">Galindo</option>
							<option '.selected( $options[10], 'Gentium Basic', false ).' value="Gentium Basic">Gentium Basic</option>
							<option '.selected( $options[10], 'Gentium Book Basic', false ).' value="Gentium Book Basic">Gentium Book Basic</option>
							<option '.selected( $options[10], 'Geo', false ).' value="Geo">Geo</option>
							<option '.selected( $options[10], 'Geostar', false ).' value="Geostar">Geostar</option>
							<option '.selected( $options[10], 'Geostar Fill', false ).' value="Geostar Fill">Geostar Fill</option>
							<option '.selected( $options[10], 'Germania One', false ).' value="Germania One">Germania One</option>
							<option '.selected( $options[10], 'GFS Didot', false ).' value="GFS Didot">GFS Didot</option>
							<option '.selected( $options[10], 'GFS Neohellenic', false ).' value="GFS Neohellenic">GFS Neohellenic</option>
							<option '.selected( $options[10], 'GFS Neohellenic', false ).' value="c">Gilda Display</option>
							<option '.selected( $options[10], 'Give You Glory', false ).' value="Give You Glory">Give You Glory</option>
							<option '.selected( $options[10], 'Glass Antiqua', false ).' value="Glass Antiqua">Glass Antiqua</option>
							<option '.selected( $options[10], 'Glegoo', false ).' value="Glegoo">Glegoo</option>
							<option '.selected( $options[10], 'Gloria Hallelujah', false ).' value="Gloria Hallelujah">Gloria Hallelujah</option>
							<option '.selected( $options[10], 'Goblin One', false ).' value="Goblin One">Goblin One</option>
							<option '.selected( $options[10], 'Gochi Hand', false ).' value="Gochi Hand">Gochi Hand</option>
							<option '.selected( $options[10], 'Gorditas', false ).' value="Gorditas">Gorditas</option>
							<option '.selected( $options[10], 'Goudy Bookletter 1911', false ).' value="Goudy Bookletter 1911">Goudy Bookletter 1911</option>
							<option '.selected( $options[10], 'Graduate', false ).' value="Graduate">Graduate</option>
							<option '.selected( $options[10], 'Grand Hotel', false ).' value="Grand Hotel">Grand Hotel</option>
							<option '.selected( $options[10], 'Gravitas One', false ).' value="Gravitas One">Gravitas One</option>
							<option '.selected( $options[10], 'Great Vibes', false ).' value="Great Vibes">Great Vibes</option>
							<option '.selected( $options[10], 'Griffy', false ).' value="Griffy">Griffy</option>
							<option '.selected( $options[10], 'Gruppo', false ).' value="Gruppo">Gruppo</option>
							<option '.selected( $options[10], 'Gudea', false ).' value="Gudea">Gudea</option>
							<option '.selected( $options[10], 'Habibi', false ).' value="Habibi">Habibi</option>
							<option '.selected( $options[10], 'Hammersmith One', false ).' value="Hammersmith One">Hammersmith One</option>
							<option '.selected( $options[10], 'Hanalei', false ).' value="Hanalei">Hanalei</option>
							<option '.selected( $options[10], 'Hanalei Fill', false ).' value="Hanalei Fill">Hanalei Fill</option>
							<option '.selected( $options[10], 'Handlee', false ).' value="Handlee">Handlee</option>
							<option '.selected( $options[10], 'Hanuman', false ).' value="Hanuman">Hanuman</option>
							<option '.selected( $options[10], 'Happy Monkey', false ).' value="Happy Monkey">Happy Monkey</option>
							<option '.selected( $options[10], 'Headland One', false ).' value="Headland One">Headland One</option>
							<option '.selected( $options[10], 'Henny Penny', false ).' value="Henny Penny">Henny Penny</option>
							<option '.selected( $options[10], 'Herr Von Muellerhoff', false ).' value="Herr Von Muellerhoff">Herr Von Muellerhoff</option>
							<option '.selected( $options[10], 'Holtwood One SC', false ).' value="Holtwood One SC">Holtwood One SC</option>
							<option '.selected( $options[10], 'Homemade Apple', false ).' value="Homemade Apple">Homemade Apple</option>
							<option '.selected( $options[10], 'Homenaje', false ).' value="Homenaje">Homenaje</option>
							<option '.selected( $options[10], 'Iceberg', false ).' value="Iceberg">Iceberg</option>
							<option '.selected( $options[10], 'Iceland', false ).' value="Iceland">Iceland</option>
							<option '.selected( $options[10], 'IM Fell Double Pica', false ).' value="IM Fell Double Pica">IM Fell Double Pica</option>
							<option '.selected( $options[10], 'IM Fell Double Pica SC', false ).' value="IM Fell Double Pica SC">IM Fell Double Pica SC</option>
							<option '.selected( $options[10], 'IM Fell DW Pica', false ).' value="IM Fell DW Pica">IM Fell DW Pica</option>
							<option '.selected( $options[10], 'IM Fell DW Pica SC', false ).' value="IM Fell DW Pica SC">IM Fell DW Pica SC</option>
							<option '.selected( $options[10], 'IM Fell English', false ).' value="IM Fell English">IM Fell English</option>
							<option '.selected( $options[10], 'IM Fell English SC', false ).' value="IM Fell English SC">IM Fell English SC</option>
							<option '.selected( $options[10], 'IM Fell French Canon', false ).' value="IM Fell French Canon">IM Fell French Canon</option>
							<option '.selected( $options[10], 'IM Fell French Canon SC', false ).' value="IM Fell French Canon SC">IM Fell French Canon SC</option>
							<option '.selected( $options[10], 'IM Fell Great Primer', false ).' value="IM Fell Great Primer">IM Fell Great Primer</option>
							<option '.selected( $options[10], 'IM Fell Great Primer SC', false ).' value="IM Fell Great Primer SC">IM Fell Great Primer SC</option>
							<option '.selected( $options[10], 'Imprima', false ).' value="Imprima">Imprima</option>
							<option '.selected( $options[10], 'Inconsolata', false ).' value="Inconsolata">Inconsolata</option>
							<option '.selected( $options[10], 'Inder', false ).' value="Inder">Inder</option>
							<option '.selected( $options[10], 'Indie Flower', false ).' value="Indie Flower">Indie Flower</option>
							<option '.selected( $options[10], 'Inika', false ).' value="Inika">Inika</option>
							<option '.selected( $options[10], 'Irish Grover', false ).' value="Irish Grover">Irish Grover</option>
							<option '.selected( $options[10], 'Istok Web', false ).' value="Istok Web">Istok Web</option>
							<option '.selected( $options[10], 'Italiana', false ).' value="Italiana">Italiana</option>
							<option '.selected( $options[10], 'Italianno', false ).' value="Italianno">Italianno</option>
							<option '.selected( $options[10], 'Jacques Francois', false ).' value="Jacques Francois">Jacques Francois</option>
							<option '.selected( $options[10], 'Jacques Francois Shadow', false ).' value="Jacques Francois Shadow">Jacques Francois Shadow</option>
							<option '.selected( $options[10], 'Jim Nightshade', false ).' value="Jim Nightshade">Jim Nightshade</option>
							<option '.selected( $options[10], 'Jockey One', false ).' value="Jockey One">Jockey One</option>
							<option '.selected( $options[10], 'Jolly Lodger', false ).' value="Jolly Lodger">Jolly Lodger</option>
							<option '.selected( $options[10], 'Josefin Sans', false ).' value="Josefin Sans">Josefin Sans</option>
							<option '.selected( $options[10], 'Josefin Slab', false ).' value="Josefin Slab">Josefin Slab</option>
							<option '.selected( $options[10], 'Joti One', false ).' value="Joti One">Joti One</option>
							<option '.selected( $options[10], 'Judson', false ).' value="Judson">Judson</option>
							<option '.selected( $options[10], 'Julee', false ).' value="Julee">Julee</option>
							<option '.selected( $options[10], 'Julius Sans One', false ).' value="Julius Sans One">Julius Sans One</option>
							<option '.selected( $options[10], 'Junge', false ).' value="Junge">Junge</option>
							<option '.selected( $options[10], 'Jura', false ).' value="Jura">Jura</option>
							<option '.selected( $options[10], 'Just Another Hand', false ).' value="Just Another Hand">Just Another Hand</option>
							<option '.selected( $options[10], 'Just Me Again Down Here', false ).' value="Just Me Again Down Here">Just Me Again Down Here</option>
							<option '.selected( $options[10], 'Kameron', false ).' value="Kameron">Kameron</option>
							<option '.selected( $options[10], 'Karla', false ).' value="Karla">Karla</option>
							<option '.selected( $options[10], 'Kaushan Script', false ).' value="Kaushan Script">Kaushan Script</option>
							<option '.selected( $options[10], 'Kavoon', false ).' value="Kavoon">Kavoon</option>
							<option '.selected( $options[10], 'Keania One', false ).' value="Keania One">Keania One</option>
							<option '.selected( $options[10], 'Kelly Slab', false ).' value="Kelly Slab">Kelly Slab</option>
							<option '.selected( $options[10], 'Kenia', false ).' value="Kenia">Kenia</option>
							<option '.selected( $options[10], 'Khmer', false ).' value="Khmer">Khmer</option>
							<option '.selected( $options[10], 'Khmer', false ).' value="c">Kite One</option>
							<option '.selected( $options[10], 'Knewave', false ).' value="Knewave">Knewave</option>
							<option '.selected( $options[10], 'Kotta One', false ).' value="Kotta One">Kotta One</option>
							<option '.selected( $options[10], 'Koulen', false ).' value="Koulen">Koulen</option>
							<option '.selected( $options[10], 'Kranky', false ).' value="Kranky">Kranky</option>
							<option '.selected( $options[10], 'Kreon', false ).' value="Kreon">Kreon</option>
							<option '.selected( $options[10], 'Kristi', false ).' value="Kristi">Kristi</option>
							<option '.selected( $options[10], 'Krona One', false ).' value="Krona One">Krona One</option>
							<option '.selected( $options[10], 'La Belle Aurore', false ).' value="La Belle Aurore">La Belle Aurore</option>
							<option '.selected( $options[10], 'Lancelot', false ).' value="Lancelot">Lancelot</option>
							<option '.selected( $options[10], 'Lato', false ).' value="Lato">Lato</option>
							<option '.selected( $options[10], 'League Script', false ).' value="League Script">League Script</option>
							<option '.selected( $options[10], 'Leckerli One', false ).' value="Leckerli One">Leckerli One</option>
							<option '.selected( $options[10], 'Ledger', false ).' value="Ledger">Ledger</option>
							<option '.selected( $options[10], 'Lekton', false ).' value="Lekton">Lekton</option>
							<option '.selected( $options[10], 'Lemon', false ).' value="Lemon">Lemon</option>
							<option '.selected( $options[10], 'Libre Baskerville', false ).' value="Libre Baskerville">Libre Baskerville</option>
							<option '.selected( $options[10], 'Life Savers', false ).' value="Life Savers">Life Savers</option>
							<option '.selected( $options[10], 'Lilita One', false ).' value="Lilita One">Lilita One</option>
							<option '.selected( $options[10], 'Lily Script One', false ).' value="Lily Script One">Lily Script One</option>
							<option '.selected( $options[10], 'Limelight', false ).' value="Limelight">Limelight</option>
							<option '.selected( $options[10], 'Linden Hill', false ).' value="Linden Hill">Linden Hill</option>
							<option '.selected( $options[10], 'Lobster', false ).' value="Lobster">Lobster</option>
							<option '.selected( $options[10], 'Lobster Two', false ).' value="Lobster Two">Lobster Two</option>
							<option '.selected( $options[10], 'Londrina Outline', false ).' value="Londrina Outline">Londrina Outline</option>
							<option '.selected( $options[10], 'Londrina Shadow', false ).' value="Londrina Shadow">Londrina Shadow</option>
							<option '.selected( $options[10], 'Londrina Sketch', false ).' value="Londrina Sketch">Londrina Sketch</option>
							<option '.selected( $options[10], 'Londrina Solid', false ).' value="Londrina Solid">Londrina Solid</option>
							<option '.selected( $options[10], 'Lora', false ).' value="Lora">Lora</option>
							<option '.selected( $options[10], 'Love Ya Like A Sister', false ).' value="Love Ya Like A Sister">Love Ya Like A Sister</option>
							<option '.selected( $options[10], 'Loved by the King', false ).' value="Loved by the King">Loved by the King</option>
							<option '.selected( $options[10], 'Lovers Quarrel', false ).' value="Lovers Quarrel">Lovers Quarrel</option>
							<option '.selected( $options[10], 'Luckiest Guy', false ).' value="Luckiest Guy">Luckiest Guy</option>
							<option '.selected( $options[10], 'Lusitana', false ).' value="Lusitana">Lusitana</option>
							<option '.selected( $options[10], 'Lustria', false ).' value="Lustria">Lustria</option>
							<option '.selected( $options[10], 'Macondo', false ).' value="Macondo">Macondo</option>
							<option '.selected( $options[10], 'Macondo Swash Caps', false ).' value="Macondo Swash Caps">Macondo Swash Caps</option>
							<option '.selected( $options[10], 'ABeeMagraZee', false ).' value="Magra">Magra</option>
							<option '.selected( $options[10], 'Maiden Orange', false ).' value="Maiden Orange">Maiden Orange</option>
							<option '.selected( $options[10], 'Mako', false ).' value="Mako">Mako</option>
							<option '.selected( $options[10], 'Marcellus', false ).' value="Marcellus">Marcellus</option>
							<option '.selected( $options[10], 'Marcellus SC', false ).' value="Marcellus SC">Marcellus SC</option>
							<option '.selected( $options[10], 'Marck Script', false ).' value="Marck Script">Marck Script</option>
							<option '.selected( $options[10], 'Margarine', false ).' value="Margarine">Margarine</option>
							<option '.selected( $options[10], 'Marko One', false ).' value="Marko One">Marko One</option>
							<option '.selected( $options[10], 'Marmelad', false ).' value="Marmelad">Marmelad</option>
							<option '.selected( $options[10], 'Marvel', false ).' value="Marvel">Marvel</option>
							<option '.selected( $options[10], 'Mate', false ).' value="Mate">Mate</option>
							<option '.selected( $options[10], 'Mate SC', false ).' value="Mate SC">Mate SC</option>
							<option '.selected( $options[10], 'Maven Pro', false ).' value="Maven Pro">Maven Pro</option>
							<option '.selected( $options[10], 'McLaren', false ).' value="McLaren">McLaren</option>
							<option '.selected( $options[10], 'Meddon', false ).' value="Meddon">Meddon</option>
							<option '.selected( $options[10], 'MedievalSharp', false ).' value="MedievalSharp">MedievalSharp</option>
							<option '.selected( $options[10], 'Medula One', false ).' value="Medula One">Medula One</option>
							<option '.selected( $options[10], 'Megrim', false ).' value="Megrim">Megrim</option>
							<option '.selected( $options[10], 'Meie Script', false ).' value="Meie Script">Meie Script</option>
							<option '.selected( $options[10], 'Merienda', false ).' value="Merienda">Merienda</option>
							<option '.selected( $options[10], 'Merienda One', false ).' value="Merienda One">Merienda One</option>
							<option '.selected( $options[10], 'Merriweather', false ).' value="Merriweather">Merriweather</option>
							<option '.selected( $options[10], 'Merriweather Sans', false ).' value="Merriweather Sans">Merriweather Sans</option>
							<option '.selected( $options[10], 'Metal', false ).' value="Metal">Metal</option>
							<option '.selected( $options[10], 'Metal Mania', false ).' value="Metal Mania">Metal Mania</option>
							<option '.selected( $options[10], 'Metamorphous', false ).' value="Metamorphous">Metamorphous</option>
							<option '.selected( $options[10], 'Metrophobic', false ).' value="Metrophobic">Metrophobic</option>
							<option '.selected( $options[10], 'Michroma', false ).' value="Michroma">Michroma</option>
							<option '.selected( $options[10], 'Milonga', false ).' value="Milonga">Milonga</option>
							<option '.selected( $options[10], 'Miltonian', false ).' value="Miltonian">Miltonian</option>
							<option '.selected( $options[10], 'Miltonian Tattoo', false ).' value="Miltonian Tattoo">Miltonian Tattoo</option>
							<option '.selected( $options[10], 'Miniver', false ).' value="Miniver">Miniver</option>
							<option '.selected( $options[10], 'Miss Fajardose', false ).' value="Miss Fajardose">Miss Fajardose</option>
							<option '.selected( $options[10], 'Modern Antiqua', false ).' value="Modern Antiqua">Modern Antiqua</option>
							<option '.selected( $options[10], 'Molengo', false ).' value="Molengo">Molengo</option>
							<option '.selected( $options[10], 'Molle:400italic', false ).' value="Molle:400italic">Molle</option>
							<option '.selected( $options[10], 'Monda', false ).' value="Monda">Monda</option>
							<option '.selected( $options[10], 'Monofett', false ).' value="Monofett">Monofett</option>
							<option '.selected( $options[10], 'Monoton', false ).' value="Monoton">Monoton</option>
							<option '.selected( $options[10], 'Monsieur La Doulaise', false ).' value="Monsieur La Doulaise">Monsieur La Doulaise</option>
							<option '.selected( $options[10], 'Montaga', false ).' value="Montaga">Montaga</option>
							<option '.selected( $options[10], 'Montez', false ).' value="Montez">Montez</option>
							<option '.selected( $options[10], 'Montserrat', false ).' value="Montserrat">Montserrat</option>
							<option '.selected( $options[10], 'Montserrat Alternates', false ).' value="Montserrat Alternates">Montserrat Alternates</option>
							<option '.selected( $options[10], 'Montserrat Subrayada', false ).' value="Montserrat Subrayada">Montserrat Subrayada</option>
							<option '.selected( $options[10], 'Moul', false ).' value="Moul">Moul</option>
							<option '.selected( $options[10], 'Moulpali', false ).' value="Moulpali">Moulpali</option>
							<option '.selected( $options[10], 'Mountains of Christmas', false ).' value="Mountains of Christmas">Mountains of Christmas</option>
							<option '.selected( $options[10], 'Mouse Memoirs', false ).' value="Mouse Memoirs">Mouse Memoirs</option>
							<option '.selected( $options[10], 'Mr Bedfort', false ).' value="Mr Bedfort">Mr Bedfort</option>
							<option '.selected( $options[10], 'Mr Dafoe', false ).' value="Mr Dafoe">Mr Dafoe</option>
							<option '.selected( $options[10], 'Mr De Haviland', false ).' value="Mr De Haviland">Mr De Haviland</option>
							<option '.selected( $options[10], 'Mrs Saint Delafield', false ).' value="Mrs Saint Delafield">Mrs Saint Delafield</option>
							<option '.selected( $options[10], 'Mrs Sheppards', false ).' value="Mrs Sheppards">Mrs Sheppards</option>
							<option '.selected( $options[10], 'Muli', false ).' value="Muli">Muli</option>
							<option '.selected( $options[10], 'Mystery Quest', false ).' value="Mystery Quest">Mystery Quest</option>
							<option '.selected( $options[10], 'Neucha', false ).' value="Neucha">Neucha</option>
							<option '.selected( $options[10], 'Neuton', false ).' value="Neuton">Neuton</option>
							<option '.selected( $options[10], 'New Rocker', false ).' value="New Rocker">New Rocker</option>
							<option '.selected( $options[10], 'News Cycle', false ).' value="News Cycle">News Cycle</option>
							<option '.selected( $options[10], 'Niconne', false ).' value="Niconne">Niconne</option>
							<option '.selected( $options[10], 'Nixie One', false ).' value="Nixie One">Nixie One</option>
							<option '.selected( $options[10], 'Nobile', false ).' value="Nobile">Nobile</option>
							<option '.selected( $options[10], 'Nokora', false ).' value="Nokora">Nokora</option>
							<option '.selected( $options[10], 'Norican', false ).' value="Norican">Norican</option>
							<option '.selected( $options[10], 'Nosifer', false ).' value="Nosifer">Nosifer</option>
							<option '.selected( $options[10], 'Nothing You Could Do', false ).' value="Nothing You Could Do">Nothing You Could Do</option>
							<option '.selected( $options[10], 'Noticia Text', false ).' value="Noticia Text">Noticia Text</option>
							<option '.selected( $options[10], 'Noto Sans', false ).' value="Noto Sans">Noto Sans</option>
							<option '.selected( $options[10], 'Noto Serif', false ).' value="Noto Serif">Noto Serif</option>
							<option '.selected( $options[10], 'Nova Cut', false ).' value="Nova Cut">Nova Cut</option>
							<option '.selected( $options[10], 'Nova Flat', false ).' value="Nova Flat">Nova Flat</option>
							<option '.selected( $options[10], 'Nova Mono', false ).' value="Nova Mono">Nova Mono</option>
							<option '.selected( $options[10], 'Nova Oval', false ).' value="Nova Oval">Nova Oval</option>
							<option '.selected( $options[10], 'Nova Round', false ).' value="Nova Round">Nova Round</option>
							<option '.selected( $options[10], 'Nova Script', false ).' value="Nova Script">Nova Script</option>
							<option '.selected( $options[10], 'Nova Slim', false ).' value="Nova Slim">Nova Slim</option>
							<option '.selected( $options[10], 'Nova Square', false ).' value="Nova Square">Nova Square</option>
							<option '.selected( $options[10], 'Numans', false ).' value="Numans">Numans</option>
							<option '.selected( $options[10], 'Nunito', false ).' value="Nunito">Nunito</option>
							<option '.selected( $options[10], 'Odor Mean Chey', false ).' value="Odor Mean Chey">Odor Mean Chey</option>
							<option '.selected( $options[10], 'Offside', false ).' value="Offside">Offside</option>
							<option '.selected( $options[10], 'Old Standard TT', false ).' value="Old Standard TT">Old Standard TT</option>
							<option '.selected( $options[10], 'Oldenburg', false ).' value="Oldenburg">Oldenburg</option>
							<option '.selected( $options[10], 'Oleo Script', false ).' value="Oleo Script">Oleo Script</option>
							<option '.selected( $options[10], 'Oleo Script Swash Caps', false ).' value="Oleo Script Swash Caps">Oleo Script Swash Caps</option>
							<option '.selected( $options[10], 'Open Sans', false ).' value="Open Sans">Open Sans</option>
							<option '.selected( $options[10], 'Open Sans Condensed:300', false ).' value="Open Sans Condensed:300">Open Sans Condensed</option>
							<option '.selected( $options[10], 'Oranienbaum', false ).' value="Oranienbaum">Oranienbaum</option>
							<option '.selected( $options[10], 'Orbitron', false ).' value="Orbitron">Orbitron</option>
							<option '.selected( $options[10], 'Oregano', false ).' value="Oregano">Oregano</option>
							<option '.selected( $options[10], 'Orienta', false ).' value="Orienta">Orienta</option>
							<option '.selected( $options[10], 'Original Surfer', false ).' value="Original Surfer">Original Surfer</option>
							<option '.selected( $options[10], 'Oswald', false ).' value="Oswald">Oswald</option>
							<option '.selected( $options[10], 'Over the Rainbow', false ).' value="Over the Rainbow">Over the Rainbow</option>
							<option '.selected( $options[10], 'Overlock', false ).' value="Overlock">Overlock</option>
							<option '.selected( $options[10], 'Overlock SC', false ).' value="Overlock SC">Overlock SC</option>
							<option '.selected( $options[10], 'Ovo', false ).' value="Ovo">Ovo</option>
							<option '.selected( $options[10], 'Oxygen', false ).' value="Oxygen">Oxygen</option>
							<option '.selected( $options[10], 'Oxygen Mono', false ).' value="Oxygen Mono">Oxygen Mono</option>
							<option '.selected( $options[10], 'Pacifico', false ).' value="Pacifico">Pacifico</option>
							<option '.selected( $options[10], 'Paprika', false ).' value="Paprika">Paprika</option>
							<option '.selected( $options[10], 'Parisienne', false ).' value="Parisienne">Parisienne</option>
							<option '.selected( $options[10], 'Passero One', false ).' value="Passero One">Passero One</option>
							<option '.selected( $options[10], 'Passion One', false ).' value="Passion One">Passion One</option>
							<option '.selected( $options[10], 'Pathway Gothic One', false ).' value="Pathway Gothic One">Pathway Gothic One</option>
							<option '.selected( $options[10], 'Patrick Hand', false ).' value="Patrick Hand">Patrick Hand</option>
							<option '.selected( $options[10], 'Patrick Hand SC', false ).' value="Patrick Hand SC">Patrick Hand SC</option>
							<option '.selected( $options[10], 'Patua One', false ).' value="Patua One">Patua One</option>
							<option '.selected( $options[10], 'Paytone One', false ).' value="Paytone One">Paytone One</option>
							<option '.selected( $options[10], 'Peralta', false ).' value="Peralta">Peralta</option>
							<option '.selected( $options[10], 'Permanent Marker', false ).' value="Permanent Marker">Permanent Marker</option>
							<option '.selected( $options[10], 'Petit Formal Script', false ).' value="Petit Formal Script">Petit Formal Script</option>
							<option '.selected( $options[10], 'Petrona', false ).' value="Petrona">Petrona</option>
							<option '.selected( $options[10], 'Philosopher', false ).' value="Philosopher">Philosopher</option>
							<option '.selected( $options[10], 'Piedra', false ).' value="Piedra">Piedra</option>
							<option '.selected( $options[10], 'Pinyon Script', false ).' value="Pinyon Script">Pinyon Script</option>
							<option '.selected( $options[10], 'Pirata One', false ).' value="Pirata One">Pirata One</option>
							<option '.selected( $options[10], 'Plaster', false ).' value="Plaster">Plaster</option>
							<option '.selected( $options[10], 'Play', false ).' value="Play">Play</option>
							<option '.selected( $options[10], 'Playball', false ).' value="Playball">Playball</option>
							<option '.selected( $options[10], 'Playfair Display', false ).' value="Playfair Display">Playfair Display</option>
							<option '.selected( $options[10], 'Playfair Display SC', false ).' value="Playfair Display SC">Playfair Display SC</option>
							<option '.selected( $options[10], 'Podkova', false ).' value="Podkova">Podkova</option>
							<option '.selected( $options[10], 'Poiret One', false ).' value="Poiret One">Poiret One</option>
							<option '.selected( $options[10], 'Poller One', false ).' value="Poller One">Poller One</option>
							<option '.selected( $options[10], 'Poly', false ).' value="Poly">Poly</option>
							<option '.selected( $options[10], 'Pompiere', false ).' value="Pompiere">Pompiere</option>
							<option '.selected( $options[10], 'Pontano Sans', false ).' value="Pontano Sans">Pontano Sans</option>
							<option '.selected( $options[10], 'Port Lligat Sans', false ).' value="Port Lligat Sans">Port Lligat Sans</option>
							<option '.selected( $options[10], 'Port Lligat Slab', false ).' value="Port Lligat Slab">Port Lligat Slab</option>
							<option '.selected( $options[10], 'Prata', false ).' value="Prata">Prata</option>
							<option '.selected( $options[10], 'Preahvihear', false ).' value="Preahvihear">Preahvihear</option>
							<option '.selected( $options[10], 'Press Start 2P', false ).' value="Press Start 2P">Press Start 2P</option>
							<option '.selected( $options[10], 'Princess Sofia', false ).' value="Princess Sofia">Princess Sofia</option>
							<option '.selected( $options[10], 'Prociono', false ).' value="Prociono">Prociono</option>
							<option '.selected( $options[10], 'Prosto One', false ).' value="Prosto One">Prosto One</option>
							<option '.selected( $options[10], 'PT Mono', false ).' value="PT Mono">PT Mono</option>
							<option '.selected( $options[10], 'PT Sans', false ).' value="PT Sans">PT Sans</option>
							<option '.selected( $options[10], 'PT Sans Caption', false ).' value="PT Sans Caption">PT Sans Caption</option>
							<option '.selected( $options[10], 'PT Sans Narrow', false ).' value="PT Sans Narrow">PT Sans Narrow</option>
							<option '.selected( $options[10], 'PT Serif', false ).' value="PT Serif">PT Serif</option>
							<option '.selected( $options[10], 'PT Serif Caption', false ).' value="PT Serif Caption">PT Serif Caption</option>
							<option '.selected( $options[10], 'Puritan', false ).' value="Puritan">Puritan</option>
							<option '.selected( $options[10], 'Purple Purse', false ).' value="Purple Purse">Purple Purse</option>
							<option '.selected( $options[10], 'Quando', false ).' value="Quando">Quando</option>
							<option '.selected( $options[10], 'Quantico', false ).' value="Quantico">Quantico</option>
							<option '.selected( $options[10], 'Quattrocento', false ).' value="Quattrocento">Quattrocento</option>
							<option '.selected( $options[10], 'Quattrocento Sans', false ).' value="Quattrocento Sans">Quattrocento Sans</option>
							<option '.selected( $options[10], 'Questrial', false ).' value="Questrial">Questrial</option>
							<option '.selected( $options[10], 'Quicksand', false ).' value="Quicksand">Quicksand</option>
							<option '.selected( $options[10], 'Quintessential', false ).' value="Quintessential">Quintessential</option>
							<option '.selected( $options[10], 'Qwigley', false ).' value="Qwigley">Qwigley</option>
							<option '.selected( $options[10], 'Racing Sans One', false ).' value="Racing Sans One">Racing Sans One</option>
							<option '.selected( $options[10], 'Radley', false ).' value="Radley">Radley</option>
							<option '.selected( $options[10], 'Raleway', false ).' value="Raleway">Raleway</option>
							<option '.selected( $options[10], 'Raleway Dots', false ).' value="Raleway Dots">Raleway Dots</option>
							<option '.selected( $options[10], 'Rambla', false ).' value="Rambla">Rambla</option>
							<option '.selected( $options[10], 'Rammetto One', false ).' value="Rammetto One">Rammetto One</option>
							<option '.selected( $options[10], 'Ranchers', false ).' value="Ranchers">Ranchers</option>
							<option '.selected( $options[10], 'Rancho', false ).' value="Rancho">Rancho</option>
							<option '.selected( $options[10], 'Rationale', false ).' value="Rationale">Rationale</option>
							<option '.selected( $options[10], 'Redressed', false ).' value="Redressed">Redressed</option>
							<option '.selected( $options[10], 'Reenie Beanie', false ).' value="Reenie Beanie">Reenie Beanie</option>
							<option '.selected( $options[10], 'Revalia', false ).' value="Revalia">Revalia</option>
							<option '.selected( $options[10], 'Ribeye', false ).' value="Ribeye">Ribeye</option>
							<option '.selected( $options[10], 'Ribeye Marrow', false ).' value="Ribeye Marrow">Ribeye Marrow</option>
							<option '.selected( $options[10], 'Righteous', false ).' value="Righteous">Righteous</option>
							<option '.selected( $options[10], 'Risque', false ).' value="Risque">Risque</option>
							<option '.selected( $options[10], 'Roboto', false ).' value="Roboto">Roboto</option>
							<option '.selected( $options[10], 'Roboto Condensed', false ).' value="Roboto Condensed">Roboto Condensed</option>
							<option '.selected( $options[10], 'Roboto Slab', false ).' value="Roboto Slab">Roboto Slab</option>
							<option '.selected( $options[10], 'Rochester', false ).' value="Rochester">Rochester</option>
							<option '.selected( $options[10], 'Rock Salt', false ).' value="Rock Salt">Rock Salt</option>
							<option '.selected( $options[10], 'Rokkitt', false ).' value="Rokkitt">Rokkitt</option>
							<option '.selected( $options[10], 'Romanesco', false ).' value="Romanesco">Romanesco</option>
							<option '.selected( $options[10], 'Ropa Sans', false ).' value="Ropa Sans">Ropa Sans</option>
							<option '.selected( $options[10], 'Rosario', false ).' value="Rosario">Rosario</option>
							<option '.selected( $options[10], 'Rosarivo', false ).' value="Rosarivo">Rosarivo</option>
							<option '.selected( $options[10], 'Rouge Script', false ).' value="Rouge Script">Rouge Script</option>
							<option '.selected( $options[10], 'Ruda', false ).' value="Ruda">Ruda</option>
							<option '.selected( $options[10], 'Rufina', false ).' value="Rufina">Rufina</option>
							<option '.selected( $options[10], 'Ruge Boogie', false ).' value="Ruge Boogie">Ruge Boogie</option>
							<option '.selected( $options[10], 'Ruluko', false ).' value="Ruluko">Ruluko</option>
							<option '.selected( $options[10], 'Rum Raisin', false ).' value="Rum Raisin">Rum Raisin</option>
							<option '.selected( $options[10], 'Ruslan Display', false ).' value="Ruslan Display">Ruslan Display</option>
							<option '.selected( $options[10], 'Russo One', false ).' value="Russo One">Russo One</option>
							<option '.selected( $options[10], 'Ruthie', false ).' value="Ruthie">Ruthie</option>
							<option '.selected( $options[10], 'Rye', false ).' value="Rye">Rye</option>
							<option '.selected( $options[10], 'Sacramento', false ).' value="Sacramento">Sacramento</option>
							<option '.selected( $options[10], 'Sail', false ).' value="Sail">Sail</option>
							<option '.selected( $options[10], 'Salsa', false ).' value="Salsa">Salsa</option>
							<option '.selected( $options[10], 'Sanchez', false ).' value="Sanchez">Sanchez</option>
							<option '.selected( $options[10], 'Sancreek', false ).' value="Sancreek">Sancreek</option>
							<option '.selected( $options[10], 'Sansita One', false ).' value="Sansita One">Sansita One</option>
							<option '.selected( $options[10], 'Sarina', false ).' value="Sarina">Sarina</option>
							<option '.selected( $options[10], 'Satisfy', false ).' value="Satisfy">Satisfy</option>
							<option '.selected( $options[10], 'Scada', false ).' value="Scada">Scada</option>
							<option '.selected( $options[10], 'Schoolbell', false ).' value="Schoolbell">Schoolbell</option>
							<option '.selected( $options[10], 'Seaweed Script', false ).' value="Seaweed Script">Seaweed Script</option>
							<option '.selected( $options[10], 'Sevillana', false ).' value="Sevillana">Sevillana</option>
							<option '.selected( $options[10], 'Seymour One', false ).' value="Seymour One">Seymour One</option>
							<option '.selected( $options[10], 'Shadows Into Light', false ).' value="Shadows Into Light">Shadows Into Light</option>
							<option '.selected( $options[10], 'Shadows Into Light Two', false ).' value="Shadows Into Light Two">Shadows Into Light Two</option>
							<option '.selected( $options[10], 'Shanti', false ).' value="Shanti">Shanti</option>
							<option '.selected( $options[10], 'Share', false ).' value="Share">Share</option>
							<option '.selected( $options[10], 'Share Tech', false ).' value="Share Tech">Share Tech</option>
							<option '.selected( $options[10], 'Share Tech Mono', false ).' value="Share Tech Mono">Share Tech Mono</option>
							<option '.selected( $options[10], 'Shojumaru', false ).' value="Shojumaru">Shojumaru</option>
							<option '.selected( $options[10], 'Short Stack', false ).' value="Short Stack">Short Stack</option>
							<option '.selected( $options[10], 'Siemreap', false ).' value="Siemreap">Siemreap</option>
							<option '.selected( $options[10], 'Sigmar One', false ).' value="Sigmar One">Sigmar One</option>
							<option '.selected( $options[10], 'Signika', false ).' value="Signika">Signika</option>
							<option '.selected( $options[10], 'Signika Negative', false ).' value="Signika Negative">Signika Negative</option>
							<option '.selected( $options[10], 'Simonetta', false ).' value="Simonetta">Simonetta</option>
							<option '.selected( $options[10], 'Sintony', false ).' value="Sintony">Sintony</option>
							<option '.selected( $options[10], 'Sirin Stencil', false ).' value="Sirin Stencil">Sirin Stencil</option>
							<option '.selected( $options[10], 'Six Caps', false ).' value="Six Caps">Six Caps</option>
							<option '.selected( $options[10], 'Skranji', false ).' value="Skranji">Skranji</option>
							<option '.selected( $options[10], 'Slackey', false ).' value="Slackey">Slackey</option>
							<option '.selected( $options[10], 'Smokum', false ).' value="Smokum">Smokum</option>
							<option '.selected( $options[10], 'Smythe', false ).' value="Smythe">Smythe</option>
							<option '.selected( $options[10], 'Sniglet:800', false ).' value="Sniglet:800">Sniglet</option>
							<option '.selected( $options[10], 'Snippet', false ).' value="Snippet">Snippet</option>
							<option '.selected( $options[10], 'Snowburst One', false ).' value="Snowburst One">Snowburst One</option>
							<option '.selected( $options[10], 'Sofadi One', false ).' value="Sofadi One">Sofadi One</option>
							<option '.selected( $options[10], 'Sofia', false ).' value="Sofia">Sofia</option>
							<option '.selected( $options[10], 'Sonsie One', false ).' value="Sonsie One">Sonsie One</option>
							<option '.selected( $options[10], 'Sorts Mill Goudy', false ).' value="Sorts Mill Goudy">Sorts Mill Goudy</option>
							<option '.selected( $options[10], 'Source Code Pro', false ).' value="Source Code Pro">Source Code Pro</option>
							<option '.selected( $options[10], 'Source Sans Pro', false ).' value="Source Sans Pro">Source Sans Pro</option>
							<option '.selected( $options[10], 'Special Elite', false ).' value="Special Elite">Special Elite</option>
							<option '.selected( $options[10], 'Spicy Rice', false ).' value="Spicy Rice">Spicy Rice</option>
							<option '.selected( $options[10], 'Spinnaker', false ).' value="Spinnaker">Spinnaker</option>
							<option '.selected( $options[10], 'Spirax', false ).' value="Spirax">Spirax</option>
							<option '.selected( $options[10], 'Squada One', false ).' value="Squada One">Squada One</option>
							<option '.selected( $options[10], 'Stalemate', false ).' value="Stalemate">Stalemate</option>
							<option '.selected( $options[10], 'Stalinist One', false ).' value="Stalinist One">Stalinist One</option>
							<option '.selected( $options[10], 'Stardos Stencil', false ).' value="Stardos Stencil">Stardos Stencil</option>
							<option '.selected( $options[10], 'Stint Ultra Condensed', false ).' value="Stint Ultra Condensed">Stint Ultra Condensed</option>
							<option '.selected( $options[10], 'Stint Ultra Expanded', false ).' value="Stint Ultra Expanded">Stint Ultra Expanded</option>
							<option '.selected( $options[10], 'Stoke', false ).' value="Stoke">Stoke</option>
							<option '.selected( $options[10], 'Strait', false ).' value="Strait">Strait</option>
							<option '.selected( $options[10], 'Sue Ellen Francisco', false ).' value="Sue Ellen Francisco">Sue Ellen Francisco</option>
							<option '.selected( $options[10], 'Sunshiney', false ).' value="Sunshiney">Sunshiney</option>
							<option '.selected( $options[10], 'Supermercado One', false ).' value="Supermercado One">Supermercado One</option>
							<option '.selected( $options[10], 'Suwannaphum', false ).' value="Suwannaphum">Suwannaphum</option>
							<option '.selected( $options[10], 'Swanky and Moo Moo', false ).' value="Swanky and Moo Moo">Swanky and Moo Moo</option>
							<option '.selected( $options[10], 'Syncopate', false ).' value="Syncopate">Syncopate</option>
							<option '.selected( $options[10], 'Tangerine', false ).' value="Tangerine">Tangerine</option>
							<option '.selected( $options[10], 'Taprom', false ).' value="Taprom">Taprom</option>
							<option '.selected( $options[10], 'Tauri', false ).' value="Tauri">Tauri</option>
							<option '.selected( $options[10], 'Telex', false ).' value="Telex">Telex</option>
							<option '.selected( $options[10], 'Tenor Sans', false ).' value="Tenor Sans">Tenor Sans</option>
							<option '.selected( $options[10], 'Text Me One', false ).' value="Text Me One">Text Me One</option>
							<option '.selected( $options[10], 'The Girl Next Door', false ).' value="The Girl Next Door">The Girl Next Door</option>
							<option '.selected( $options[10], 'Tienne', false ).' value="Tienne">Tienne</option>
							<option '.selected( $options[10], 'Tinos', false ).' value="Tinos">Tinos</option>
							<option '.selected( $options[10], 'Titan One', false ).' value="Titan One">Titan One</option>
							<option '.selected( $options[10], 'Titillium Web', false ).' value="Titillium Web">Titillium Web</option>
							<option '.selected( $options[10], 'Trade Winds', false ).' value="Trade Winds">Trade Winds</option>
							<option '.selected( $options[10], 'Trocchi', false ).' value="Trocchi">Trocchi</option>
							<option '.selected( $options[10], 'Trochut', false ).' value="Trochut">Trochut</option>
							<option '.selected( $options[10], 'Trykker', false ).' value="Trykker">Trykker</option>
							<option '.selected( $options[10], 'Tulpen One', false ).' value="Tulpen One">Tulpen One</option>
							<option '.selected( $options[10], 'Ubuntu', false ).' value="Ubuntu">Ubuntu</option>
							<option '.selected( $options[10], 'Ubuntu Condensed', false ).' value="Ubuntu Condensed">Ubuntu Condensed</option>
							<option '.selected( $options[10], 'Ubuntu Mono', false ).' value="Ubuntu Mono">Ubuntu Mono</option>
							<option '.selected( $options[10], 'Ultra', false ).' value="Ultra">Ultra</option>
							<option '.selected( $options[10], 'Uncial Antiqua', false ).' value="Uncial Antiqua">Uncial Antiqua</option>
							<option '.selected( $options[10], 'Underdog', false ).' value="Underdog">Underdog</option>
							<option '.selected( $options[10], 'Unica One', false ).' value="Unica One">Unica One</option>
							<option '.selected( $options[10], 'UnifrakturCook:700', false ).' value="UnifrakturCook:700">UnifrakturCook</option>
							<option '.selected( $options[10], 'UnifrakturMaguntia', false ).' value="UnifrakturMaguntia">UnifrakturMaguntia</option>
							<option '.selected( $options[10], 'Unkempt', false ).' value="Unkempt">Unkempt</option>
							<option '.selected( $options[10], 'Unlock', false ).' value="Unlock">Unlock</option>
							<option '.selected( $options[10], 'Unna', false ).' value="Unna">Unna</option>
							<option '.selected( $options[10], 'Vampiro One', false ).' value="Vampiro One">Vampiro One</option>
							<option '.selected( $options[10], 'Varela', false ).' value="Varela">Varela</option>
							<option '.selected( $options[10], 'Varela Round', false ).' value="Varela Round">Varela Round</option>
							<option '.selected( $options[10], 'Vast Shadow', false ).' value="Vast Shadow">Vast Shadow</option>
							<option '.selected( $options[10], 'Vibur', false ).' value="Vibur">Vibur</option>
							<option '.selected( $options[10], 'Vidaloka', false ).' value="Vidaloka">Vidaloka</option>
							<option '.selected( $options[10], 'Viga', false ).' value="Viga">Viga</option>
							<option '.selected( $options[10], 'Voces', false ).' value="Voces">Voces</option>
							<option '.selected( $options[10], 'Volkhov', false ).' value="Volkhov">Volkhov</option>
							<option '.selected( $options[10], 'Vollkorn', false ).' value="Vollkorn">Vollkorn</option>
							<option '.selected( $options[10], 'Voltaire', false ).' value="Voltaire">Voltaire</option>
							<option '.selected( $options[10], 'VT323', false ).' value="VT323">VT323</option>
							<option '.selected( $options[10], 'Waiting for the Sunrise', false ).' value="Waiting for the Sunrise">Waiting for the Sunrise</option>
							<option '.selected( $options[10], 'Wallpoet', false ).' value="Wallpoet">Wallpoet</option>
							<option '.selected( $options[10], 'Walter Turncoat', false ).' value="Walter Turncoat">Walter Turncoat</option>
							<option '.selected( $options[10], 'Warnes', false ).' value="Warnes">Warnes</option>
							<option '.selected( $options[10], 'Wellfleet', false ).' value="Wellfleet">Wellfleet</option>
							<option '.selected( $options[10], 'Wendy One', false ).' value="Wendy One">Wendy One</option>
							<option '.selected( $options[10], 'Wire One', false ).' value="Wire One">Wire One</option>
							<option '.selected( $options[10], 'Yanone Kaffeesatz', false ).' value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
							<option '.selected( $options[10], 'Yellowtail', false ).' value="Yellowtail">Yellowtail</option>
							<option '.selected( $options[10], 'Yeseva One', false ).' value="Yeseva One">Yeseva One</option>
							<option '.selected( $options[10], 'Yesteryear', false ).' value="Yesteryear">Yesteryear</option>
							<option '.selected( $options[10], 'Zeyada', false ).' value="Zeyada">Zeyada</option>
						</select>
			</div>
			<div class="text simple_subscription_popup_tooltip" title="Font Family of the content of Signup Form"><p>Content Font Family</p> <select name="content_font_family" class="content_font_family">
							<option '.selected( $options[11], '', false ).' value="">Default</option>
							<option '.selected( $options[11], 'ABeeZee', false ).' value="ABeeZee">ABeeZee</option>
							<option '.selected( $options[11], 'Abel', false ).' value="Abel">Abel</option>
							<option '.selected( $options[11], 'Abril Fatface', false ).' value="Abril Fatface">Abril Fatface</option>
							<option '.selected( $options[11], 'Aclonica', false ).' value="Aclonica">Aclonica</option>
							<option '.selected( $options[11], 'Acme', false ).' value="Acme">Acme</option>
							<option '.selected( $options[11], 'Actor', false ).' value="Actor">Actor</option>
							<option '.selected( $options[11], 'Adamina', false ).' value="Adamina">Adamina</option>
							<option '.selected( $options[11], 'Advent Pro', false ).' value="Advent Pro">Advent Pro</option>
							<option '.selected( $options[11], 'Aguafina Script', false ).' value="Aguafina Script">Aguafina Script</option>
							<option '.selected( $options[11], 'Akronim', false ).' value="Akronim">Akronim</option>
							<option '.selected( $options[11], 'Aladin', false ).' value="Aladin">Aladin</option>
							<option '.selected( $options[11], 'Aldrich', false ).' value="Aldrich">Aldrich</option>
							<option '.selected( $options[11], 'Alef', false ).' value="Alef">Alef</option>
							<option '.selected( $options[11], 'Alegreya', false ).' value="Alegreya">Alegreya</option>
							<option '.selected( $options[11], 'Alegreya SC', false ).' value="Alegreya SC">Alegreya SC</option>
							<option '.selected( $options[11], 'Alex Brush', false ).' value="Alex Brush">Alex Brush</option>
							<option '.selected( $options[11], 'Alfa Slab One', false ).' value="Alfa Slab One">Alfa Slab One</option>
							<option '.selected( $options[11], 'Alice', false ).' value="Alice">Alice</option>
							<option '.selected( $options[11], 'Alike', false ).' value="Alike">Alike</option>
							<option '.selected( $options[11], 'Alike Angular', false ).' value="Alike Angular">Alike Angular</option>
							<option '.selected( $options[11], 'Allan', false ).' value="Allan">Allan</option>
							<option '.selected( $options[11], 'Allerta', false ).' value="Allerta">Allerta</option>
							<option '.selected( $options[11], 'Allerta Stencil', false ).' value="Allerta Stencil">Allerta Stencil</option>
							<option '.selected( $options[11], 'Allura', false ).' value="Allura">Allura</option>
							<option '.selected( $options[11], 'Almendra', false ).' value="Almendra">Almendra</option>
							<option '.selected( $options[11], 'Almendra Display', false ).' value="Almendra Display">Almendra Display</option>
							<option '.selected( $options[11], 'Almendra SC', false ).' value="Almendra SC">Almendra SC</option>
							<option '.selected( $options[11], 'Amarante', false ).' value="Amarante">Amarante</option>
							<option '.selected( $options[11], 'Amaranth', false ).' value="Amaranth">Amaranth</option>
							<option '.selected( $options[11], 'Amatic SC', false ).' value="Amatic SC">Amatic SC</option>
							<option '.selected( $options[11], 'Amethysta', false ).' value="Amethysta">Amethysta</option>
							<option '.selected( $options[11], 'Anaheim', false ).' value="Anaheim">Anaheim</option>
							<option '.selected( $options[11], 'Andada', false ).' value="Andada">Andada</option>
							<option '.selected( $options[11], 'Andika', false ).' value="Andika">Andika</option>
							<option '.selected( $options[11], 'Angkor', false ).' value="Angkor">Angkor</option>
							<option '.selected( $options[11], 'Annie Use Your Telescope', false ).' value="Annie Use Your Telescope">Annie Use Your Telescope</option>
							<option '.selected( $options[11], 'Anonymous Pro', false ).' value="Anonymous Pro">Anonymous Pro</option>
							<option '.selected( $options[11], 'Antic', false ).' value="Antic">Antic</option>
							<option '.selected( $options[11], 'Antic Didone', false ).' value="Antic Didone">Antic Didone</option>
							<option '.selected( $options[11], 'Antic Slab', false ).' value="Antic Slab">Antic Slab</option>
							<option '.selected( $options[11], 'Anton', false ).' value="Anton">Anton</option>
							<option '.selected( $options[11], 'Arapey', false ).' value="Arapey">Arapey</option>
							<option '.selected( $options[11], 'Arbutus', false ).' value="Arbutus">Arbutus</option>
							<option '.selected( $options[11], 'Arbutus Slab', false ).' value="Arbutus Slab">Arbutus Slab</option>
							<option '.selected( $options[11], 'Architects Daughter', false ).' value="Architects Daughter">Architects Daughter</option>
							<option '.selected( $options[11], 'Archivo Black', false ).' value="Archivo Black">Archivo Black</option>
							<option '.selected( $options[11], 'Archivo Narrow', false ).' value="Archivo Narrow">Archivo Narrow</option>
							<option '.selected( $options[11], 'Arimo', false ).' value="Arimo">Arimo</option>
							<option '.selected( $options[11], 'Arizonia', false ).' value="Arizonia">Arizonia</option>
							<option '.selected( $options[11], 'Armata', false ).' value="Armata">Armata</option>
							<option '.selected( $options[11], 'Artifika', false ).' value="Artifika">Artifika</option>
							<option '.selected( $options[11], 'Arvo', false ).' value="Arvo">Arvo</option>
							<option '.selected( $options[11], 'Asap', false ).' value="Asap">Asap</option>
							<option '.selected( $options[11], 'Asset', false ).' value="Asset">Asset</option>
							<option '.selected( $options[11], 'Astloch', false ).' value="Astloch">Astloch</option>
							<option '.selected( $options[11], 'Asul', false ).' value="Asul">Asul</option>
							<option '.selected( $options[11], 'Atomic Age', false ).' value="Atomic Age">Atomic Age</option>
							<option '.selected( $options[11], 'Aubrey', false ).' value="Aubrey">Aubrey</option>
							<option '.selected( $options[11], 'Audiowide', false ).' value="Audiowide">Audiowide</option>
							<option '.selected( $options[11], 'Autour One', false ).' value="Autour One">Autour One</option>
							<option '.selected( $options[11], 'Average', false ).' value="Average">Average</option>
							<option '.selected( $options[11], 'Average Sans', false ).' value="Average Sans">Average Sans</option>
							<option '.selected( $options[11], 'Averia Gruesa Libre', false ).' value="Averia Gruesa Libre">Averia Gruesa Libre</option>
							<option '.selected( $options[11], 'Averia Libre', false ).' value="Averia Libre">Averia Libre</option>
							<option '.selected( $options[11], 'Averia Sans Libre', false ).' value="Averia Sans Libre">Averia Sans Libre</option>
							<option '.selected( $options[11], 'Averia Serif Libre', false ).' value="Averia Serif Libre">Averia Serif Libre</option>
							<option '.selected( $options[11], 'Bad Script', false ).' value="Bad Script">Bad Script</option>
							<option '.selected( $options[11], 'Balthazar', false ).' value="Balthazar">Balthazar</option>
							<option '.selected( $options[11], 'Bangers', false ).' value="Bangers">Bangers</option>
							<option '.selected( $options[11], 'Basic', false ).' value="Basic">Basic</option>
							<option '.selected( $options[11], 'Battambang', false ).' value="Battambang">Battambang</option>
							<option '.selected( $options[11], 'Baumans', false ).' value="Baumans">Baumans</option>
							<option '.selected( $options[11], 'Bayon', false ).' value="Bayon">Bayon</option>
							<option '.selected( $options[11], 'Belgrano', false ).' value="Belgrano">Belgrano</option>
							<option '.selected( $options[11], 'Belleza', false ).' value="Belleza">Belleza</option>
							<option '.selected( $options[11], 'BenchNine', false ).' value="BenchNine">BenchNine</option>
							<option '.selected( $options[11], 'Bentham', false ).' value="Bentham">Bentham</option>
							<option '.selected( $options[11], 'Berkshire Swash', false ).' value="Berkshire Swash">Berkshire Swash</option>
							<option '.selected( $options[11], 'Bevan', false ).' value="Bevan">Bevan</option>
							<option '.selected( $options[11], 'Bigelow Rules', false ).' value="Bigelow Rules">Bigelow Rules</option>
							<option '.selected( $options[11], 'Bigshot One', false ).' value="Bigshot One">Bigshot One</option>
							<option '.selected( $options[11], 'Bilbo', false ).' value="Bilbo">Bilbo</option>
							<option '.selected( $options[11], 'Bilbo Swash Caps', false ).' value="Bilbo Swash Caps">Bilbo Swash Caps</option>
							<option '.selected( $options[11], 'Bitter', false ).' value="Bitter">Bitter</option>
							<option '.selected( $options[11], 'Black Ops One', false ).' value="Black Ops One">Black Ops One</option>
							<option '.selected( $options[11], 'Bokor', false ).' value="Bokor">Bokor</option>
							<option '.selected( $options[11], 'Bonbon', false ).' value="Bonbon">Bonbon</option>
							<option '.selected( $options[11], 'Boogaloo', false ).' value="Boogaloo">Boogaloo</option>
							<option '.selected( $options[11], 'Bowlby One', false ).' value="Bowlby One">Bowlby One</option>
							<option '.selected( $options[11], 'Bowlby One SC', false ).' value="Bowlby One SC">Bowlby One SC</option>
							<option '.selected( $options[11], 'Brawler', false ).' value="Brawler">Brawler</option>
							<option '.selected( $options[11], 'Bree Serif', false ).' value="Bree Serif">Bree Serif</option>
							<option '.selected( $options[11], 'Bubblegum Sans', false ).' value="Bubblegum Sans">Bubblegum Sans</option>
							<option '.selected( $options[11], 'Bubbler One', false ).' value="Bubbler One">Bubbler One</option>
							<option '.selected( $options[11], 'Buenard', false ).' value="Buenard">Buenard</option>
							<option '.selected( $options[11], 'Butcherman', false ).' value="Butcherman">Butcherman</option>
							<option '.selected( $options[11], 'Butterfly Kids', false ).' value="Butterfly Kids">Butterfly Kids</option>
							<option '.selected( $options[11], 'Cabin', false ).' value="Cabin">Cabin</option>
							<option '.selected( $options[11], 'Cabin Condensed', false ).' value="Cabin Condensed">Cabin Condensed</option>
							<option '.selected( $options[11], 'Cabin Sketch', false ).' value="Cabin Sketch">Cabin Sketch</option>
							<option '.selected( $options[11], 'Caesar Dressing', false ).' value="Caesar Dressing">Caesar Dressing</option>
							<option '.selected( $options[11], 'Cagliostro', false ).' value="Cagliostro">Cagliostro</option>
							<option '.selected( $options[11], 'Calligraffitti', false ).' value="Calligraffitti">Calligraffitti</option>
							<option '.selected( $options[11], 'ABeeCamboZee', false ).' value="Cambo">Cambo</option>
							<option '.selected( $options[11], 'Candal', false ).' value="Candal">Candal</option>
							<option '.selected( $options[11], 'Cantarell', false ).' value="Cantarell">Cantarell</option>
							<option '.selected( $options[11], 'Cantata One', false ).' value="Cantata One">Cantata One</option>
							<option '.selected( $options[11], 'Cantora One', false ).' value="Cantora One">Cantora One</option>
							<option '.selected( $options[11], 'Capriola', false ).' value="Capriola">Capriola</option>
							<option '.selected( $options[11], 'Cardo', false ).' value="Cardo">Cardo</option>
							<option '.selected( $options[11], 'Carme', false ).' value="Carme">Carme</option>
							<option '.selected( $options[11], 'Carrois Gothic', false ).' value="Carrois Gothic">Carrois Gothic</option>
							<option '.selected( $options[11], 'Carrois Gothic SC', false ).' value="Carrois Gothic SC">Carrois Gothic SC</option>
							<option '.selected( $options[11], 'Carter One', false ).' value="Carter One">Carter One</option>
							<option '.selected( $options[11], 'Caudex', false ).' value="Caudex">Caudex</option>
							<option '.selected( $options[11], 'Cedarville Cursive', false ).' value="Cedarville Cursive">Cedarville Cursive</option>
							<option '.selected( $options[11], 'Ceviche One', false ).' value="Ceviche One">Ceviche One</option>
							<option '.selected( $options[11], 'Changa One', false ).' value="Changa One">Changa One</option>
							<option '.selected( $options[11], 'Chango', false ).' value="Chango">Chango</option>
							<option '.selected( $options[11], 'Chau Philomene One', false ).' value="Chau Philomene One">Chau Philomene One</option>
							<option '.selected( $options[11], 'Chela One', false ).' value="Chela One">Chela One</option>
							<option '.selected( $options[11], 'Chelsea Market', false ).' value="Chelsea Market">Chelsea Market</option>
							<option '.selected( $options[11], 'Chenla', false ).' value="Chenla">Chenla</option>
							<option '.selected( $options[11], 'Cherry Cream Soda', false ).' value="Cherry Cream Soda">Cherry Cream Soda</option>
							<option '.selected( $options[11], 'Cherry Swash', false ).' value="Cherry Swash">Cherry Swash</option>
							<option '.selected( $options[11], 'Chewy', false ).' value="Chewy">Chewy</option>
							<option '.selected( $options[11], 'Chicle', false ).' value="Chicle">Chicle</option>
							<option '.selected( $options[11], 'Chivo', false ).' value="Chivo">Chivo</option>
							<option '.selected( $options[11], 'Cinzel', false ).' value="Cinzel">Cinzel</option>
							<option '.selected( $options[11], 'Cinzel Decorative', false ).' value="Cinzel Decorative">Cinzel Decorative</option>
							<option '.selected( $options[11], 'Clicker Script', false ).' value="Clicker Script">Clicker Script</option>
							<option '.selected( $options[11], 'Coda', false ).' value="Coda">Coda</option>
							<option '.selected( $options[11], 'Coda Caption:800', false ).' value="Coda Caption:800">Coda Caption</option>
							<option '.selected( $options[11], 'Codystar', false ).' value="Codystar">Codystar</option>
							<option '.selected( $options[11], 'Combo', false ).' value="Combo">Combo</option>
							<option '.selected( $options[11], 'Comfortaa', false ).' value="Comfortaa">Comfortaa</option>
							<option '.selected( $options[11], 'Coming Soon', false ).' value="Coming Soon">Coming Soon</option>
							<option '.selected( $options[11], 'Concert One', false ).' value="Concert One">Concert One</option>
							<option '.selected( $options[11], 'Condiment', false ).' value="Condiment">Condiment</option>
							<option '.selected( $options[11], 'Content', false ).' value="Content">Content</option>
							<option '.selected( $options[11], 'Contrail One', false ).' value="Contrail One">Contrail One</option>
							<option '.selected( $options[11], 'Convergence', false ).' value="Convergence">Convergence</option>
							<option '.selected( $options[11], 'Cookie', false ).' value="Cookie">Cookie</option>
							<option '.selected( $options[11], 'Copse', false ).' value="Copse">Copse</option>
							<option '.selected( $options[11], 'Corben', false ).' value="Corben">Corben</option>
							<option '.selected( $options[11], 'Courgette', false ).' value="Courgette">Courgette</option>
							<option '.selected( $options[11], 'Cousine', false ).' value="Cousine">Cousine</option>
							<option '.selected( $options[11], 'Coustard', false ).' value="Coustard">Coustard</option>
							<option '.selected( $options[11], 'Covered By Your Grace', false ).' value="Covered By Your Grace">Covered By Your Grace</option>
							<option '.selected( $options[11], 'Crafty Girls', false ).' value="Crafty Girls">Crafty Girls</option>
							<option '.selected( $options[11], 'Creepster', false ).' value="Creepster">Creepster</option>
							<option '.selected( $options[11], 'Crete Round', false ).' value="Crete Round">Crete Round</option>
							<option '.selected( $options[11], 'Crimson Text', false ).' value="Crimson Text">Crimson Text</option>
							<option '.selected( $options[11], 'Croissant One', false ).' value="Croissant One">Croissant One</option>
							<option '.selected( $options[11], 'Crushed', false ).' value="Crushed">Crushed</option>
							<option '.selected( $options[11], 'Cuprum', false ).' value="Cuprum">Cuprum</option>
							<option '.selected( $options[11], 'Cutive', false ).' value="Cutive">Cutive</option>
							<option '.selected( $options[11], 'Cutive Mono', false ).' value="Cutive Mono">Cutive Mono</option>
							<option '.selected( $options[11], 'Damion', false ).' value="Damion">Damion</option>
							<option '.selected( $options[11], 'Dancing Script', false ).' value="Dancing Script">Dancing Script</option>
							<option '.selected( $options[11], 'Dangrek', false ).' value="Dangrek">Dangrek</option>
							<option '.selected( $options[11], 'Dawning of a New Day', false ).' value="Dawning of a New Day">Dawning of a New Day</option>
							<option '.selected( $options[11], 'Days One', false ).' value="Days One">Days One</option>
							<option '.selected( $options[11], 'Delius', false ).' value="Delius">Delius</option>
							<option '.selected( $options[11], 'Delius Swash Caps', false ).' value="Delius Swash Caps">Delius Swash Caps</option>
							<option '.selected( $options[11], 'Delius Unicase', false ).' value="Delius Unicase">Delius Unicase</option>
							<option '.selected( $options[11], 'Della Respira', false ).' value="Della Respira">Della Respira</option>
							<option '.selected( $options[11], 'Denk One', false ).' value="Denk One">Denk One</option>
							<option '.selected( $options[11], 'Devonshire', false ).' value="Devonshire">Devonshire</option>
							<option '.selected( $options[11], 'Didact Gothic', false ).' value="Didact Gothic">Didact Gothic</option>
							<option '.selected( $options[11], 'Diplomata', false ).' value="Diplomata">Diplomata</option>
							<option '.selected( $options[11], 'Diplomata SC', false ).' value="Diplomata SC">Diplomata SC</option>
							<option '.selected( $options[11], 'Domine', false ).' value="Domine">Domine</option>
							<option '.selected( $options[11], 'Donegal One', false ).' value="Donegal One">Donegal One</option>
							<option '.selected( $options[11], 'Doppio One', false ).' value="Doppio One">Doppio One</option>
							<option '.selected( $options[11], 'Dorsa', false ).' value="Dorsa">Dorsa</option>
							<option '.selected( $options[11], 'Dosis', false ).' value="Dosis">Dosis</option>
							<option '.selected( $options[11], 'Dr Sugiyama', false ).' value="Dr Sugiyama">Dr Sugiyama</option>
							<option '.selected( $options[11], 'Droid Sans', false ).' value="Droid Sans">Droid Sans</option>
							<option '.selected( $options[11], 'Droid Sans Mono', false ).' value="Droid Sans Mono">Droid Sans Mono</option>
							<option '.selected( $options[11], 'Droid Serif', false ).' value="Droid Serif">Droid Serif</option>
							<option '.selected( $options[11], 'Duru Sans', false ).' value="Duru Sans">Duru Sans</option>
							<option '.selected( $options[11], 'Dynalight', false ).' value="Dynalight">Dynalight</option>
							<option '.selected( $options[11], 'Eagle Lake', false ).' value="Eagle Lake">Eagle Lake</option>
							<option '.selected( $options[11], 'Eater', false ).' value="Eater">Eater</option>
							<option '.selected( $options[11], 'EB Garamond', false ).' value="EB Garamond">EB Garamond</option>
							<option '.selected( $options[11], 'Economica', false ).' value="Economica">Economica</option>
							<option '.selected( $options[11], 'Electrolize', false ).' value="Electrolize">Electrolize</option>
							<option '.selected( $options[11], 'Elsie', false ).' value="Elsie">Elsie</option>
							<option '.selected( $options[11], 'Elsie Swash Caps', false ).' value="Elsie Swash Caps">Elsie Swash Caps</option>
							<option '.selected( $options[11], 'Emblema One', false ).' value="Emblema One">Emblema One</option>
							<option '.selected( $options[11], 'Emilys Candy', false ).' value="Emilys Candy">Emilys Candy</option>
							<option '.selected( $options[11], 'Engagement', false ).' value="Engagement">Engagement</option>
							<option '.selected( $options[11], 'Englebert', false ).' value="Englebert">Englebert</option>
							<option '.selected( $options[11], 'Enriqueta', false ).' value="Enriqueta">Enriqueta</option>
							<option '.selected( $options[11], 'Erica One', false ).' value="Erica One">Erica One</option>
							<option '.selected( $options[11], 'Esteban', false ).' value="Esteban">Esteban</option>
							<option '.selected( $options[11], 'Euphoria Script', false ).' value="Euphoria Script">Euphoria Script</option>
							<option '.selected( $options[11], 'Ewert', false ).' value="Ewert">Ewert</option>
							<option '.selected( $options[11], 'Exo', false ).' value="Exo">Exo</option>
							<option '.selected( $options[11], 'Expletus Sans', false ).' value="Expletus Sans">Expletus Sans</option>
							<option '.selected( $options[11], 'Fanwood Text', false ).' value="Fanwood Text">Fanwood Text</option>
							<option '.selected( $options[11], 'Fascinate', false ).' value="Fascinate">Fascinate</option>
							<option '.selected( $options[11], 'Fascinate Inline', false ).' value="Fascinate Inline">Fascinate Inline</option>
							<option '.selected( $options[11], 'Faster One', false ).' value="Faster One">Faster One</option>
							<option '.selected( $options[11], 'Fasthand', false ).' value="Fasthand">Fasthand</option>
							<option '.selected( $options[11], 'Fauna One', false ).' value="Fauna One">Fauna One</option>
							<option '.selected( $options[11], 'Federant', false ).' value="Federant">Federant</option>
							<option '.selected( $options[11], 'Federo', false ).' value="Federo">Federo</option>
							<option '.selected( $options[11], 'Felipa', false ).' value="Felipa">Felipa</option>
							<option '.selected( $options[11], 'Fenix', false ).' value="Fenix">Fenix</option>
							<option '.selected( $options[11], 'Finger Paint', false ).' value="Finger Paint">Finger Paint</option>
							<option '.selected( $options[11], 'Fjalla One', false ).' value="Fjalla One">Fjalla One</option>
							<option '.selected( $options[11], 'Fjord One', false ).' value="Fjord One">Fjord One</option>
							<option '.selected( $options[11], 'Flamenco', false ).' value="Flamenco">Flamenco</option>
							<option '.selected( $options[11], 'Flavors', false ).' value="Flavors">Flavors</option>
							<option '.selected( $options[11], 'Fondamento', false ).' value="Fondamento">Fondamento</option>
							<option '.selected( $options[11], 'Fontdiner Swanky', false ).' value="Fontdiner Swanky">Fontdiner Swanky</option>
							<option '.selected( $options[11], 'Forum', false ).' value="Forum">Forum</option>
							<option '.selected( $options[11], 'Francois One', false ).' value="Francois One">Francois One</option>
							<option '.selected( $options[11], 'Freckle Face', false ).' value="Freckle Face">Freckle Face</option>
							<option '.selected( $options[11], 'Fredericka the Great', false ).' value="Fredericka the Great">Fredericka the Great</option>
							<option '.selected( $options[11], 'Fredoka One', false ).' value="Fredoka One">Fredoka One</option>
							<option '.selected( $options[11], 'Freehand', false ).' value="Freehand">Freehand</option>
							<option '.selected( $options[11], 'Fresca', false ).' value="Fresca">Fresca</option>
							<option '.selected( $options[11], 'Frijole', false ).' value="Frijole">Frijole</option>
							<option '.selected( $options[11], 'Fruktur', false ).' value="Fruktur">Fruktur</option>
							<option '.selected( $options[11], 'Fugaz One', false ).' value="Fugaz One">Fugaz One</option>
							<option '.selected( $options[11], 'Gabriela', false ).' value="Gabriela">Gabriela</option>
							<option '.selected( $options[11], 'Gafata', false ).' value="Gafata">Gafata</option>
							<option '.selected( $options[11], 'Galdeano', false ).' value="Galdeano">Galdeano</option>
							<option '.selected( $options[11], 'Galindo', false ).' value="Galindo">Galindo</option>
							<option '.selected( $options[11], 'Gentium Basic', false ).' value="Gentium Basic">Gentium Basic</option>
							<option '.selected( $options[11], 'Gentium Book Basic', false ).' value="Gentium Book Basic">Gentium Book Basic</option>
							<option '.selected( $options[11], 'Geo', false ).' value="Geo">Geo</option>
							<option '.selected( $options[11], 'Geostar', false ).' value="Geostar">Geostar</option>
							<option '.selected( $options[11], 'Geostar Fill', false ).' value="Geostar Fill">Geostar Fill</option>
							<option '.selected( $options[11], 'Germania One', false ).' value="Germania One">Germania One</option>
							<option '.selected( $options[11], 'GFS Didot', false ).' value="GFS Didot">GFS Didot</option>
							<option '.selected( $options[11], 'GFS Neohellenic', false ).' value="GFS Neohellenic">GFS Neohellenic</option>
							<option '.selected( $options[11], 'GFS Neohellenic', false ).' value="c">Gilda Display</option>
							<option '.selected( $options[11], 'Give You Glory', false ).' value="Give You Glory">Give You Glory</option>
							<option '.selected( $options[11], 'Glass Antiqua', false ).' value="Glass Antiqua">Glass Antiqua</option>
							<option '.selected( $options[11], 'Glegoo', false ).' value="Glegoo">Glegoo</option>
							<option '.selected( $options[11], 'Gloria Hallelujah', false ).' value="Gloria Hallelujah">Gloria Hallelujah</option>
							<option '.selected( $options[11], 'Goblin One', false ).' value="Goblin One">Goblin One</option>
							<option '.selected( $options[11], 'Gochi Hand', false ).' value="Gochi Hand">Gochi Hand</option>
							<option '.selected( $options[11], 'Gorditas', false ).' value="Gorditas">Gorditas</option>
							<option '.selected( $options[11], 'Goudy Bookletter 1911', false ).' value="Goudy Bookletter 1911">Goudy Bookletter 1911</option>
							<option '.selected( $options[11], 'Graduate', false ).' value="Graduate">Graduate</option>
							<option '.selected( $options[11], 'Grand Hotel', false ).' value="Grand Hotel">Grand Hotel</option>
							<option '.selected( $options[11], 'Gravitas One', false ).' value="Gravitas One">Gravitas One</option>
							<option '.selected( $options[11], 'Great Vibes', false ).' value="Great Vibes">Great Vibes</option>
							<option '.selected( $options[11], 'Griffy', false ).' value="Griffy">Griffy</option>
							<option '.selected( $options[11], 'Gruppo', false ).' value="Gruppo">Gruppo</option>
							<option '.selected( $options[11], 'Gudea', false ).' value="Gudea">Gudea</option>
							<option '.selected( $options[11], 'Habibi', false ).' value="Habibi">Habibi</option>
							<option '.selected( $options[11], 'Hammersmith One', false ).' value="Hammersmith One">Hammersmith One</option>
							<option '.selected( $options[11], 'Hanalei', false ).' value="Hanalei">Hanalei</option>
							<option '.selected( $options[11], 'Hanalei Fill', false ).' value="Hanalei Fill">Hanalei Fill</option>
							<option '.selected( $options[11], 'Handlee', false ).' value="Handlee">Handlee</option>
							<option '.selected( $options[11], 'Hanuman', false ).' value="Hanuman">Hanuman</option>
							<option '.selected( $options[11], 'Happy Monkey', false ).' value="Happy Monkey">Happy Monkey</option>
							<option '.selected( $options[11], 'Headland One', false ).' value="Headland One">Headland One</option>
							<option '.selected( $options[11], 'Henny Penny', false ).' value="Henny Penny">Henny Penny</option>
							<option '.selected( $options[11], 'Herr Von Muellerhoff', false ).' value="Herr Von Muellerhoff">Herr Von Muellerhoff</option>
							<option '.selected( $options[11], 'Holtwood One SC', false ).' value="Holtwood One SC">Holtwood One SC</option>
							<option '.selected( $options[11], 'Homemade Apple', false ).' value="Homemade Apple">Homemade Apple</option>
							<option '.selected( $options[11], 'Homenaje', false ).' value="Homenaje">Homenaje</option>
							<option '.selected( $options[11], 'Iceberg', false ).' value="Iceberg">Iceberg</option>
							<option '.selected( $options[11], 'Iceland', false ).' value="Iceland">Iceland</option>
							<option '.selected( $options[11], 'IM Fell Double Pica', false ).' value="IM Fell Double Pica">IM Fell Double Pica</option>
							<option '.selected( $options[11], 'IM Fell Double Pica SC', false ).' value="IM Fell Double Pica SC">IM Fell Double Pica SC</option>
							<option '.selected( $options[11], 'IM Fell DW Pica', false ).' value="IM Fell DW Pica">IM Fell DW Pica</option>
							<option '.selected( $options[11], 'IM Fell DW Pica SC', false ).' value="IM Fell DW Pica SC">IM Fell DW Pica SC</option>
							<option '.selected( $options[11], 'IM Fell English', false ).' value="IM Fell English">IM Fell English</option>
							<option '.selected( $options[11], 'IM Fell English SC', false ).' value="IM Fell English SC">IM Fell English SC</option>
							<option '.selected( $options[11], 'IM Fell French Canon', false ).' value="IM Fell French Canon">IM Fell French Canon</option>
							<option '.selected( $options[11], 'IM Fell French Canon SC', false ).' value="IM Fell French Canon SC">IM Fell French Canon SC</option>
							<option '.selected( $options[11], 'IM Fell Great Primer', false ).' value="IM Fell Great Primer">IM Fell Great Primer</option>
							<option '.selected( $options[11], 'IM Fell Great Primer SC', false ).' value="IM Fell Great Primer SC">IM Fell Great Primer SC</option>
							<option '.selected( $options[11], 'Imprima', false ).' value="Imprima">Imprima</option>
							<option '.selected( $options[11], 'Inconsolata', false ).' value="Inconsolata">Inconsolata</option>
							<option '.selected( $options[11], 'Inder', false ).' value="Inder">Inder</option>
							<option '.selected( $options[11], 'Indie Flower', false ).' value="Indie Flower">Indie Flower</option>
							<option '.selected( $options[11], 'Inika', false ).' value="Inika">Inika</option>
							<option '.selected( $options[11], 'Irish Grover', false ).' value="Irish Grover">Irish Grover</option>
							<option '.selected( $options[11], 'Istok Web', false ).' value="Istok Web">Istok Web</option>
							<option '.selected( $options[11], 'Italiana', false ).' value="Italiana">Italiana</option>
							<option '.selected( $options[11], 'Italianno', false ).' value="Italianno">Italianno</option>
							<option '.selected( $options[11], 'Jacques Francois', false ).' value="Jacques Francois">Jacques Francois</option>
							<option '.selected( $options[11], 'Jacques Francois Shadow', false ).' value="Jacques Francois Shadow">Jacques Francois Shadow</option>
							<option '.selected( $options[11], 'Jim Nightshade', false ).' value="Jim Nightshade">Jim Nightshade</option>
							<option '.selected( $options[11], 'Jockey One', false ).' value="Jockey One">Jockey One</option>
							<option '.selected( $options[11], 'Jolly Lodger', false ).' value="Jolly Lodger">Jolly Lodger</option>
							<option '.selected( $options[11], 'Josefin Sans', false ).' value="Josefin Sans">Josefin Sans</option>
							<option '.selected( $options[11], 'Josefin Slab', false ).' value="Josefin Slab">Josefin Slab</option>
							<option '.selected( $options[11], 'Joti One', false ).' value="Joti One">Joti One</option>
							<option '.selected( $options[11], 'Judson', false ).' value="Judson">Judson</option>
							<option '.selected( $options[11], 'Julee', false ).' value="Julee">Julee</option>
							<option '.selected( $options[11], 'Julius Sans One', false ).' value="Julius Sans One">Julius Sans One</option>
							<option '.selected( $options[11], 'Junge', false ).' value="Junge">Junge</option>
							<option '.selected( $options[11], 'Jura', false ).' value="Jura">Jura</option>
							<option '.selected( $options[11], 'Just Another Hand', false ).' value="Just Another Hand">Just Another Hand</option>
							<option '.selected( $options[11], 'Just Me Again Down Here', false ).' value="Just Me Again Down Here">Just Me Again Down Here</option>
							<option '.selected( $options[11], 'Kameron', false ).' value="Kameron">Kameron</option>
							<option '.selected( $options[11], 'Karla', false ).' value="Karla">Karla</option>
							<option '.selected( $options[11], 'Kaushan Script', false ).' value="Kaushan Script">Kaushan Script</option>
							<option '.selected( $options[11], 'Kavoon', false ).' value="Kavoon">Kavoon</option>
							<option '.selected( $options[11], 'Keania One', false ).' value="Keania One">Keania One</option>
							<option '.selected( $options[11], 'Kelly Slab', false ).' value="Kelly Slab">Kelly Slab</option>
							<option '.selected( $options[11], 'Kenia', false ).' value="Kenia">Kenia</option>
							<option '.selected( $options[11], 'Khmer', false ).' value="Khmer">Khmer</option>
							<option '.selected( $options[11], 'Khmer', false ).' value="c">Kite One</option>
							<option '.selected( $options[11], 'Knewave', false ).' value="Knewave">Knewave</option>
							<option '.selected( $options[11], 'Kotta One', false ).' value="Kotta One">Kotta One</option>
							<option '.selected( $options[11], 'Koulen', false ).' value="Koulen">Koulen</option>
							<option '.selected( $options[11], 'Kranky', false ).' value="Kranky">Kranky</option>
							<option '.selected( $options[11], 'Kreon', false ).' value="Kreon">Kreon</option>
							<option '.selected( $options[11], 'Kristi', false ).' value="Kristi">Kristi</option>
							<option '.selected( $options[11], 'Krona One', false ).' value="Krona One">Krona One</option>
							<option '.selected( $options[11], 'La Belle Aurore', false ).' value="La Belle Aurore">La Belle Aurore</option>
							<option '.selected( $options[11], 'Lancelot', false ).' value="Lancelot">Lancelot</option>
							<option '.selected( $options[11], 'Lato', false ).' value="Lato">Lato</option>
							<option '.selected( $options[11], 'League Script', false ).' value="League Script">League Script</option>
							<option '.selected( $options[11], 'Leckerli One', false ).' value="Leckerli One">Leckerli One</option>
							<option '.selected( $options[11], 'Ledger', false ).' value="Ledger">Ledger</option>
							<option '.selected( $options[11], 'Lekton', false ).' value="Lekton">Lekton</option>
							<option '.selected( $options[11], 'Lemon', false ).' value="Lemon">Lemon</option>
							<option '.selected( $options[11], 'Libre Baskerville', false ).' value="Libre Baskerville">Libre Baskerville</option>
							<option '.selected( $options[11], 'Life Savers', false ).' value="Life Savers">Life Savers</option>
							<option '.selected( $options[11], 'Lilita One', false ).' value="Lilita One">Lilita One</option>
							<option '.selected( $options[11], 'Lily Script One', false ).' value="Lily Script One">Lily Script One</option>
							<option '.selected( $options[11], 'Limelight', false ).' value="Limelight">Limelight</option>
							<option '.selected( $options[11], 'Linden Hill', false ).' value="Linden Hill">Linden Hill</option>
							<option '.selected( $options[11], 'Lobster', false ).' value="Lobster">Lobster</option>
							<option '.selected( $options[11], 'Lobster Two', false ).' value="Lobster Two">Lobster Two</option>
							<option '.selected( $options[11], 'Londrina Outline', false ).' value="Londrina Outline">Londrina Outline</option>
							<option '.selected( $options[11], 'Londrina Shadow', false ).' value="Londrina Shadow">Londrina Shadow</option>
							<option '.selected( $options[11], 'Londrina Sketch', false ).' value="Londrina Sketch">Londrina Sketch</option>
							<option '.selected( $options[11], 'Londrina Solid', false ).' value="Londrina Solid">Londrina Solid</option>
							<option '.selected( $options[11], 'Lora', false ).' value="Lora">Lora</option>
							<option '.selected( $options[11], 'Love Ya Like A Sister', false ).' value="Love Ya Like A Sister">Love Ya Like A Sister</option>
							<option '.selected( $options[11], 'Loved by the King', false ).' value="Loved by the King">Loved by the King</option>
							<option '.selected( $options[11], 'Lovers Quarrel', false ).' value="Lovers Quarrel">Lovers Quarrel</option>
							<option '.selected( $options[11], 'Luckiest Guy', false ).' value="Luckiest Guy">Luckiest Guy</option>
							<option '.selected( $options[11], 'Lusitana', false ).' value="Lusitana">Lusitana</option>
							<option '.selected( $options[11], 'Lustria', false ).' value="Lustria">Lustria</option>
							<option '.selected( $options[11], 'Macondo', false ).' value="Macondo">Macondo</option>
							<option '.selected( $options[11], 'Macondo Swash Caps', false ).' value="Macondo Swash Caps">Macondo Swash Caps</option>
							<option '.selected( $options[11], 'ABeeMagraZee', false ).' value="Magra">Magra</option>
							<option '.selected( $options[11], 'Maiden Orange', false ).' value="Maiden Orange">Maiden Orange</option>
							<option '.selected( $options[11], 'Mako', false ).' value="Mako">Mako</option>
							<option '.selected( $options[11], 'Marcellus', false ).' value="Marcellus">Marcellus</option>
							<option '.selected( $options[11], 'Marcellus SC', false ).' value="Marcellus SC">Marcellus SC</option>
							<option '.selected( $options[11], 'Marck Script', false ).' value="Marck Script">Marck Script</option>
							<option '.selected( $options[11], 'Margarine', false ).' value="Margarine">Margarine</option>
							<option '.selected( $options[11], 'Marko One', false ).' value="Marko One">Marko One</option>
							<option '.selected( $options[11], 'Marmelad', false ).' value="Marmelad">Marmelad</option>
							<option '.selected( $options[11], 'Marvel', false ).' value="Marvel">Marvel</option>
							<option '.selected( $options[11], 'Mate', false ).' value="Mate">Mate</option>
							<option '.selected( $options[11], 'Mate SC', false ).' value="Mate SC">Mate SC</option>
							<option '.selected( $options[11], 'Maven Pro', false ).' value="Maven Pro">Maven Pro</option>
							<option '.selected( $options[11], 'McLaren', false ).' value="McLaren">McLaren</option>
							<option '.selected( $options[11], 'Meddon', false ).' value="Meddon">Meddon</option>
							<option '.selected( $options[11], 'MedievalSharp', false ).' value="MedievalSharp">MedievalSharp</option>
							<option '.selected( $options[11], 'Medula One', false ).' value="Medula One">Medula One</option>
							<option '.selected( $options[11], 'Megrim', false ).' value="Megrim">Megrim</option>
							<option '.selected( $options[11], 'Meie Script', false ).' value="Meie Script">Meie Script</option>
							<option '.selected( $options[11], 'Merienda', false ).' value="Merienda">Merienda</option>
							<option '.selected( $options[11], 'Merienda One', false ).' value="Merienda One">Merienda One</option>
							<option '.selected( $options[11], 'Merriweather', false ).' value="Merriweather">Merriweather</option>
							<option '.selected( $options[11], 'Merriweather Sans', false ).' value="Merriweather Sans">Merriweather Sans</option>
							<option '.selected( $options[11], 'Metal', false ).' value="Metal">Metal</option>
							<option '.selected( $options[11], 'Metal Mania', false ).' value="Metal Mania">Metal Mania</option>
							<option '.selected( $options[11], 'Metamorphous', false ).' value="Metamorphous">Metamorphous</option>
							<option '.selected( $options[11], 'Metrophobic', false ).' value="Metrophobic">Metrophobic</option>
							<option '.selected( $options[11], 'Michroma', false ).' value="Michroma">Michroma</option>
							<option '.selected( $options[11], 'Milonga', false ).' value="Milonga">Milonga</option>
							<option '.selected( $options[11], 'Miltonian', false ).' value="Miltonian">Miltonian</option>
							<option '.selected( $options[11], 'Miltonian Tattoo', false ).' value="Miltonian Tattoo">Miltonian Tattoo</option>
							<option '.selected( $options[11], 'Miniver', false ).' value="Miniver">Miniver</option>
							<option '.selected( $options[11], 'Miss Fajardose', false ).' value="Miss Fajardose">Miss Fajardose</option>
							<option '.selected( $options[11], 'Modern Antiqua', false ).' value="Modern Antiqua">Modern Antiqua</option>
							<option '.selected( $options[11], 'Molengo', false ).' value="Molengo">Molengo</option>
							<option '.selected( $options[11], 'Molle:400italic', false ).' value="Molle:400italic">Molle</option>
							<option '.selected( $options[11], 'Monda', false ).' value="Monda">Monda</option>
							<option '.selected( $options[11], 'Monofett', false ).' value="Monofett">Monofett</option>
							<option '.selected( $options[11], 'Monoton', false ).' value="Monoton">Monoton</option>
							<option '.selected( $options[11], 'Monsieur La Doulaise', false ).' value="Monsieur La Doulaise">Monsieur La Doulaise</option>
							<option '.selected( $options[11], 'Montaga', false ).' value="Montaga">Montaga</option>
							<option '.selected( $options[11], 'Montez', false ).' value="Montez">Montez</option>
							<option '.selected( $options[11], 'Montserrat', false ).' value="Montserrat">Montserrat</option>
							<option '.selected( $options[11], 'Montserrat Alternates', false ).' value="Montserrat Alternates">Montserrat Alternates</option>
							<option '.selected( $options[11], 'Montserrat Subrayada', false ).' value="Montserrat Subrayada">Montserrat Subrayada</option>
							<option '.selected( $options[11], 'Moul', false ).' value="Moul">Moul</option>
							<option '.selected( $options[11], 'Moulpali', false ).' value="Moulpali">Moulpali</option>
							<option '.selected( $options[11], 'Mountains of Christmas', false ).' value="Mountains of Christmas">Mountains of Christmas</option>
							<option '.selected( $options[11], 'Mouse Memoirs', false ).' value="Mouse Memoirs">Mouse Memoirs</option>
							<option '.selected( $options[11], 'Mr Bedfort', false ).' value="Mr Bedfort">Mr Bedfort</option>
							<option '.selected( $options[11], 'Mr Dafoe', false ).' value="Mr Dafoe">Mr Dafoe</option>
							<option '.selected( $options[11], 'Mr De Haviland', false ).' value="Mr De Haviland">Mr De Haviland</option>
							<option '.selected( $options[11], 'Mrs Saint Delafield', false ).' value="Mrs Saint Delafield">Mrs Saint Delafield</option>
							<option '.selected( $options[11], 'Mrs Sheppards', false ).' value="Mrs Sheppards">Mrs Sheppards</option>
							<option '.selected( $options[11], 'Muli', false ).' value="Muli">Muli</option>
							<option '.selected( $options[11], 'Mystery Quest', false ).' value="Mystery Quest">Mystery Quest</option>
							<option '.selected( $options[11], 'Neucha', false ).' value="Neucha">Neucha</option>
							<option '.selected( $options[11], 'Neuton', false ).' value="Neuton">Neuton</option>
							<option '.selected( $options[11], 'New Rocker', false ).' value="New Rocker">New Rocker</option>
							<option '.selected( $options[11], 'News Cycle', false ).' value="News Cycle">News Cycle</option>
							<option '.selected( $options[11], 'Niconne', false ).' value="Niconne">Niconne</option>
							<option '.selected( $options[11], 'Nixie One', false ).' value="Nixie One">Nixie One</option>
							<option '.selected( $options[11], 'Nobile', false ).' value="Nobile">Nobile</option>
							<option '.selected( $options[11], 'Nokora', false ).' value="Nokora">Nokora</option>
							<option '.selected( $options[11], 'Norican', false ).' value="Norican">Norican</option>
							<option '.selected( $options[11], 'Nosifer', false ).' value="Nosifer">Nosifer</option>
							<option '.selected( $options[11], 'Nothing You Could Do', false ).' value="Nothing You Could Do">Nothing You Could Do</option>
							<option '.selected( $options[11], 'Noticia Text', false ).' value="Noticia Text">Noticia Text</option>
							<option '.selected( $options[11], 'Noto Sans', false ).' value="Noto Sans">Noto Sans</option>
							<option '.selected( $options[11], 'Noto Serif', false ).' value="Noto Serif">Noto Serif</option>
							<option '.selected( $options[11], 'Nova Cut', false ).' value="Nova Cut">Nova Cut</option>
							<option '.selected( $options[11], 'Nova Flat', false ).' value="Nova Flat">Nova Flat</option>
							<option '.selected( $options[11], 'Nova Mono', false ).' value="Nova Mono">Nova Mono</option>
							<option '.selected( $options[11], 'Nova Oval', false ).' value="Nova Oval">Nova Oval</option>
							<option '.selected( $options[11], 'Nova Round', false ).' value="Nova Round">Nova Round</option>
							<option '.selected( $options[11], 'Nova Script', false ).' value="Nova Script">Nova Script</option>
							<option '.selected( $options[11], 'Nova Slim', false ).' value="Nova Slim">Nova Slim</option>
							<option '.selected( $options[11], 'Nova Square', false ).' value="Nova Square">Nova Square</option>
							<option '.selected( $options[11], 'Numans', false ).' value="Numans">Numans</option>
							<option '.selected( $options[11], 'Nunito', false ).' value="Nunito">Nunito</option>
							<option '.selected( $options[11], 'Odor Mean Chey', false ).' value="Odor Mean Chey">Odor Mean Chey</option>
							<option '.selected( $options[11], 'Offside', false ).' value="Offside">Offside</option>
							<option '.selected( $options[11], 'Old Standard TT', false ).' value="Old Standard TT">Old Standard TT</option>
							<option '.selected( $options[11], 'Oldenburg', false ).' value="Oldenburg">Oldenburg</option>
							<option '.selected( $options[11], 'Oleo Script', false ).' value="Oleo Script">Oleo Script</option>
							<option '.selected( $options[11], 'Oleo Script Swash Caps', false ).' value="Oleo Script Swash Caps">Oleo Script Swash Caps</option>
							<option '.selected( $options[11], 'Open Sans', false ).' value="Open Sans">Open Sans</option>
							<option '.selected( $options[11], 'Open Sans Condensed:300', false ).' value="Open Sans Condensed:300">Open Sans Condensed</option>
							<option '.selected( $options[11], 'Oranienbaum', false ).' value="Oranienbaum">Oranienbaum</option>
							<option '.selected( $options[11], 'Orbitron', false ).' value="Orbitron">Orbitron</option>
							<option '.selected( $options[11], 'Oregano', false ).' value="Oregano">Oregano</option>
							<option '.selected( $options[11], 'Orienta', false ).' value="Orienta">Orienta</option>
							<option '.selected( $options[11], 'Original Surfer', false ).' value="Original Surfer">Original Surfer</option>
							<option '.selected( $options[11], 'Oswald', false ).' value="Oswald">Oswald</option>
							<option '.selected( $options[11], 'Over the Rainbow', false ).' value="Over the Rainbow">Over the Rainbow</option>
							<option '.selected( $options[11], 'Overlock', false ).' value="Overlock">Overlock</option>
							<option '.selected( $options[11], 'Overlock SC', false ).' value="Overlock SC">Overlock SC</option>
							<option '.selected( $options[11], 'Ovo', false ).' value="Ovo">Ovo</option>
							<option '.selected( $options[11], 'Oxygen', false ).' value="Oxygen">Oxygen</option>
							<option '.selected( $options[11], 'Oxygen Mono', false ).' value="Oxygen Mono">Oxygen Mono</option>
							<option '.selected( $options[11], 'Pacifico', false ).' value="Pacifico">Pacifico</option>
							<option '.selected( $options[11], 'Paprika', false ).' value="Paprika">Paprika</option>
							<option '.selected( $options[11], 'Parisienne', false ).' value="Parisienne">Parisienne</option>
							<option '.selected( $options[11], 'Passero One', false ).' value="Passero One">Passero One</option>
							<option '.selected( $options[11], 'Passion One', false ).' value="Passion One">Passion One</option>
							<option '.selected( $options[11], 'Pathway Gothic One', false ).' value="Pathway Gothic One">Pathway Gothic One</option>
							<option '.selected( $options[11], 'Patrick Hand', false ).' value="Patrick Hand">Patrick Hand</option>
							<option '.selected( $options[11], 'Patrick Hand SC', false ).' value="Patrick Hand SC">Patrick Hand SC</option>
							<option '.selected( $options[11], 'Patua One', false ).' value="Patua One">Patua One</option>
							<option '.selected( $options[11], 'Paytone One', false ).' value="Paytone One">Paytone One</option>
							<option '.selected( $options[11], 'Peralta', false ).' value="Peralta">Peralta</option>
							<option '.selected( $options[11], 'Permanent Marker', false ).' value="Permanent Marker">Permanent Marker</option>
							<option '.selected( $options[11], 'Petit Formal Script', false ).' value="Petit Formal Script">Petit Formal Script</option>
							<option '.selected( $options[11], 'Petrona', false ).' value="Petrona">Petrona</option>
							<option '.selected( $options[11], 'Philosopher', false ).' value="Philosopher">Philosopher</option>
							<option '.selected( $options[11], 'Piedra', false ).' value="Piedra">Piedra</option>
							<option '.selected( $options[11], 'Pinyon Script', false ).' value="Pinyon Script">Pinyon Script</option>
							<option '.selected( $options[11], 'Pirata One', false ).' value="Pirata One">Pirata One</option>
							<option '.selected( $options[11], 'Plaster', false ).' value="Plaster">Plaster</option>
							<option '.selected( $options[11], 'Play', false ).' value="Play">Play</option>
							<option '.selected( $options[11], 'Playball', false ).' value="Playball">Playball</option>
							<option '.selected( $options[11], 'Playfair Display', false ).' value="Playfair Display">Playfair Display</option>
							<option '.selected( $options[11], 'Playfair Display SC', false ).' value="Playfair Display SC">Playfair Display SC</option>
							<option '.selected( $options[11], 'Podkova', false ).' value="Podkova">Podkova</option>
							<option '.selected( $options[11], 'Poiret One', false ).' value="Poiret One">Poiret One</option>
							<option '.selected( $options[11], 'Poller One', false ).' value="Poller One">Poller One</option>
							<option '.selected( $options[11], 'Poly', false ).' value="Poly">Poly</option>
							<option '.selected( $options[11], 'Pompiere', false ).' value="Pompiere">Pompiere</option>
							<option '.selected( $options[11], 'Pontano Sans', false ).' value="Pontano Sans">Pontano Sans</option>
							<option '.selected( $options[11], 'Port Lligat Sans', false ).' value="Port Lligat Sans">Port Lligat Sans</option>
							<option '.selected( $options[11], 'Port Lligat Slab', false ).' value="Port Lligat Slab">Port Lligat Slab</option>
							<option '.selected( $options[11], 'Prata', false ).' value="Prata">Prata</option>
							<option '.selected( $options[11], 'Preahvihear', false ).' value="Preahvihear">Preahvihear</option>
							<option '.selected( $options[11], 'Press Start 2P', false ).' value="Press Start 2P">Press Start 2P</option>
							<option '.selected( $options[11], 'Princess Sofia', false ).' value="Princess Sofia">Princess Sofia</option>
							<option '.selected( $options[11], 'Prociono', false ).' value="Prociono">Prociono</option>
							<option '.selected( $options[11], 'Prosto One', false ).' value="Prosto One">Prosto One</option>
							<option '.selected( $options[11], 'PT Mono', false ).' value="PT Mono">PT Mono</option>
							<option '.selected( $options[11], 'PT Sans', false ).' value="PT Sans">PT Sans</option>
							<option '.selected( $options[11], 'PT Sans Caption', false ).' value="PT Sans Caption">PT Sans Caption</option>
							<option '.selected( $options[11], 'PT Sans Narrow', false ).' value="PT Sans Narrow">PT Sans Narrow</option>
							<option '.selected( $options[11], 'PT Serif', false ).' value="PT Serif">PT Serif</option>
							<option '.selected( $options[11], 'PT Serif Caption', false ).' value="PT Serif Caption">PT Serif Caption</option>
							<option '.selected( $options[11], 'Puritan', false ).' value="Puritan">Puritan</option>
							<option '.selected( $options[11], 'Purple Purse', false ).' value="Purple Purse">Purple Purse</option>
							<option '.selected( $options[11], 'Quando', false ).' value="Quando">Quando</option>
							<option '.selected( $options[11], 'Quantico', false ).' value="Quantico">Quantico</option>
							<option '.selected( $options[11], 'Quattrocento', false ).' value="Quattrocento">Quattrocento</option>
							<option '.selected( $options[11], 'Quattrocento Sans', false ).' value="Quattrocento Sans">Quattrocento Sans</option>
							<option '.selected( $options[11], 'Questrial', false ).' value="Questrial">Questrial</option>
							<option '.selected( $options[11], 'Quicksand', false ).' value="Quicksand">Quicksand</option>
							<option '.selected( $options[11], 'Quintessential', false ).' value="Quintessential">Quintessential</option>
							<option '.selected( $options[11], 'Qwigley', false ).' value="Qwigley">Qwigley</option>
							<option '.selected( $options[11], 'Racing Sans One', false ).' value="Racing Sans One">Racing Sans One</option>
							<option '.selected( $options[11], 'Radley', false ).' value="Radley">Radley</option>
							<option '.selected( $options[11], 'Raleway', false ).' value="Raleway">Raleway</option>
							<option '.selected( $options[11], 'Raleway Dots', false ).' value="Raleway Dots">Raleway Dots</option>
							<option '.selected( $options[11], 'Rambla', false ).' value="Rambla">Rambla</option>
							<option '.selected( $options[11], 'Rammetto One', false ).' value="Rammetto One">Rammetto One</option>
							<option '.selected( $options[11], 'Ranchers', false ).' value="Ranchers">Ranchers</option>
							<option '.selected( $options[11], 'Rancho', false ).' value="Rancho">Rancho</option>
							<option '.selected( $options[11], 'Rationale', false ).' value="Rationale">Rationale</option>
							<option '.selected( $options[11], 'Redressed', false ).' value="Redressed">Redressed</option>
							<option '.selected( $options[11], 'Reenie Beanie', false ).' value="Reenie Beanie">Reenie Beanie</option>
							<option '.selected( $options[11], 'Revalia', false ).' value="Revalia">Revalia</option>
							<option '.selected( $options[11], 'Ribeye', false ).' value="Ribeye">Ribeye</option>
							<option '.selected( $options[11], 'Ribeye Marrow', false ).' value="Ribeye Marrow">Ribeye Marrow</option>
							<option '.selected( $options[11], 'Righteous', false ).' value="Righteous">Righteous</option>
							<option '.selected( $options[11], 'Risque', false ).' value="Risque">Risque</option>
							<option '.selected( $options[11], 'Roboto', false ).' value="Roboto">Roboto</option>
							<option '.selected( $options[11], 'Roboto Condensed', false ).' value="Roboto Condensed">Roboto Condensed</option>
							<option '.selected( $options[11], 'Roboto Slab', false ).' value="Roboto Slab">Roboto Slab</option>
							<option '.selected( $options[11], 'Rochester', false ).' value="Rochester">Rochester</option>
							<option '.selected( $options[11], 'Rock Salt', false ).' value="Rock Salt">Rock Salt</option>
							<option '.selected( $options[11], 'Rokkitt', false ).' value="Rokkitt">Rokkitt</option>
							<option '.selected( $options[11], 'Romanesco', false ).' value="Romanesco">Romanesco</option>
							<option '.selected( $options[11], 'Ropa Sans', false ).' value="Ropa Sans">Ropa Sans</option>
							<option '.selected( $options[11], 'Rosario', false ).' value="Rosario">Rosario</option>
							<option '.selected( $options[11], 'Rosarivo', false ).' value="Rosarivo">Rosarivo</option>
							<option '.selected( $options[11], 'Rouge Script', false ).' value="Rouge Script">Rouge Script</option>
							<option '.selected( $options[11], 'Ruda', false ).' value="Ruda">Ruda</option>
							<option '.selected( $options[11], 'Rufina', false ).' value="Rufina">Rufina</option>
							<option '.selected( $options[11], 'Ruge Boogie', false ).' value="Ruge Boogie">Ruge Boogie</option>
							<option '.selected( $options[11], 'Ruluko', false ).' value="Ruluko">Ruluko</option>
							<option '.selected( $options[11], 'Rum Raisin', false ).' value="Rum Raisin">Rum Raisin</option>
							<option '.selected( $options[11], 'Ruslan Display', false ).' value="Ruslan Display">Ruslan Display</option>
							<option '.selected( $options[11], 'Russo One', false ).' value="Russo One">Russo One</option>
							<option '.selected( $options[11], 'Ruthie', false ).' value="Ruthie">Ruthie</option>
							<option '.selected( $options[11], 'Rye', false ).' value="Rye">Rye</option>
							<option '.selected( $options[11], 'Sacramento', false ).' value="Sacramento">Sacramento</option>
							<option '.selected( $options[11], 'Sail', false ).' value="Sail">Sail</option>
							<option '.selected( $options[11], 'Salsa', false ).' value="Salsa">Salsa</option>
							<option '.selected( $options[11], 'Sanchez', false ).' value="Sanchez">Sanchez</option>
							<option '.selected( $options[11], 'Sancreek', false ).' value="Sancreek">Sancreek</option>
							<option '.selected( $options[11], 'Sansita One', false ).' value="Sansita One">Sansita One</option>
							<option '.selected( $options[11], 'Sarina', false ).' value="Sarina">Sarina</option>
							<option '.selected( $options[11], 'Satisfy', false ).' value="Satisfy">Satisfy</option>
							<option '.selected( $options[11], 'Scada', false ).' value="Scada">Scada</option>
							<option '.selected( $options[11], 'Schoolbell', false ).' value="Schoolbell">Schoolbell</option>
							<option '.selected( $options[11], 'Seaweed Script', false ).' value="Seaweed Script">Seaweed Script</option>
							<option '.selected( $options[11], 'Sevillana', false ).' value="Sevillana">Sevillana</option>
							<option '.selected( $options[11], 'Seymour One', false ).' value="Seymour One">Seymour One</option>
							<option '.selected( $options[11], 'Shadows Into Light', false ).' value="Shadows Into Light">Shadows Into Light</option>
							<option '.selected( $options[11], 'Shadows Into Light Two', false ).' value="Shadows Into Light Two">Shadows Into Light Two</option>
							<option '.selected( $options[11], 'Shanti', false ).' value="Shanti">Shanti</option>
							<option '.selected( $options[11], 'Share', false ).' value="Share">Share</option>
							<option '.selected( $options[11], 'Share Tech', false ).' value="Share Tech">Share Tech</option>
							<option '.selected( $options[11], 'Share Tech Mono', false ).' value="Share Tech Mono">Share Tech Mono</option>
							<option '.selected( $options[11], 'Shojumaru', false ).' value="Shojumaru">Shojumaru</option>
							<option '.selected( $options[11], 'Short Stack', false ).' value="Short Stack">Short Stack</option>
							<option '.selected( $options[11], 'Siemreap', false ).' value="Siemreap">Siemreap</option>
							<option '.selected( $options[11], 'Sigmar One', false ).' value="Sigmar One">Sigmar One</option>
							<option '.selected( $options[11], 'Signika', false ).' value="Signika">Signika</option>
							<option '.selected( $options[11], 'Signika Negative', false ).' value="Signika Negative">Signika Negative</option>
							<option '.selected( $options[11], 'Simonetta', false ).' value="Simonetta">Simonetta</option>
							<option '.selected( $options[11], 'Sintony', false ).' value="Sintony">Sintony</option>
							<option '.selected( $options[11], 'Sirin Stencil', false ).' value="Sirin Stencil">Sirin Stencil</option>
							<option '.selected( $options[11], 'Six Caps', false ).' value="Six Caps">Six Caps</option>
							<option '.selected( $options[11], 'Skranji', false ).' value="Skranji">Skranji</option>
							<option '.selected( $options[11], 'Slackey', false ).' value="Slackey">Slackey</option>
							<option '.selected( $options[11], 'Smokum', false ).' value="Smokum">Smokum</option>
							<option '.selected( $options[11], 'Smythe', false ).' value="Smythe">Smythe</option>
							<option '.selected( $options[11], 'Sniglet:800', false ).' value="Sniglet:800">Sniglet</option>
							<option '.selected( $options[11], 'Snippet', false ).' value="Snippet">Snippet</option>
							<option '.selected( $options[11], 'Snowburst One', false ).' value="Snowburst One">Snowburst One</option>
							<option '.selected( $options[11], 'Sofadi One', false ).' value="Sofadi One">Sofadi One</option>
							<option '.selected( $options[11], 'Sofia', false ).' value="Sofia">Sofia</option>
							<option '.selected( $options[11], 'Sonsie One', false ).' value="Sonsie One">Sonsie One</option>
							<option '.selected( $options[11], 'Sorts Mill Goudy', false ).' value="Sorts Mill Goudy">Sorts Mill Goudy</option>
							<option '.selected( $options[11], 'Source Code Pro', false ).' value="Source Code Pro">Source Code Pro</option>
							<option '.selected( $options[11], 'Source Sans Pro', false ).' value="Source Sans Pro">Source Sans Pro</option>
							<option '.selected( $options[11], 'Special Elite', false ).' value="Special Elite">Special Elite</option>
							<option '.selected( $options[11], 'Spicy Rice', false ).' value="Spicy Rice">Spicy Rice</option>
							<option '.selected( $options[11], 'Spinnaker', false ).' value="Spinnaker">Spinnaker</option>
							<option '.selected( $options[11], 'Spirax', false ).' value="Spirax">Spirax</option>
							<option '.selected( $options[11], 'Squada One', false ).' value="Squada One">Squada One</option>
							<option '.selected( $options[11], 'Stalemate', false ).' value="Stalemate">Stalemate</option>
							<option '.selected( $options[11], 'Stalinist One', false ).' value="Stalinist One">Stalinist One</option>
							<option '.selected( $options[11], 'Stardos Stencil', false ).' value="Stardos Stencil">Stardos Stencil</option>
							<option '.selected( $options[11], 'Stint Ultra Condensed', false ).' value="Stint Ultra Condensed">Stint Ultra Condensed</option>
							<option '.selected( $options[11], 'Stint Ultra Expanded', false ).' value="Stint Ultra Expanded">Stint Ultra Expanded</option>
							<option '.selected( $options[11], 'Stoke', false ).' value="Stoke">Stoke</option>
							<option '.selected( $options[11], 'Strait', false ).' value="Strait">Strait</option>
							<option '.selected( $options[11], 'Sue Ellen Francisco', false ).' value="Sue Ellen Francisco">Sue Ellen Francisco</option>
							<option '.selected( $options[11], 'Sunshiney', false ).' value="Sunshiney">Sunshiney</option>
							<option '.selected( $options[11], 'Supermercado One', false ).' value="Supermercado One">Supermercado One</option>
							<option '.selected( $options[11], 'Suwannaphum', false ).' value="Suwannaphum">Suwannaphum</option>
							<option '.selected( $options[11], 'Swanky and Moo Moo', false ).' value="Swanky and Moo Moo">Swanky and Moo Moo</option>
							<option '.selected( $options[11], 'Syncopate', false ).' value="Syncopate">Syncopate</option>
							<option '.selected( $options[11], 'Tangerine', false ).' value="Tangerine">Tangerine</option>
							<option '.selected( $options[11], 'Taprom', false ).' value="Taprom">Taprom</option>
							<option '.selected( $options[11], 'Tauri', false ).' value="Tauri">Tauri</option>
							<option '.selected( $options[11], 'Telex', false ).' value="Telex">Telex</option>
							<option '.selected( $options[11], 'Tenor Sans', false ).' value="Tenor Sans">Tenor Sans</option>
							<option '.selected( $options[11], 'Text Me One', false ).' value="Text Me One">Text Me One</option>
							<option '.selected( $options[11], 'The Girl Next Door', false ).' value="The Girl Next Door">The Girl Next Door</option>
							<option '.selected( $options[11], 'Tienne', false ).' value="Tienne">Tienne</option>
							<option '.selected( $options[11], 'Tinos', false ).' value="Tinos">Tinos</option>
							<option '.selected( $options[11], 'Titan One', false ).' value="Titan One">Titan One</option>
							<option '.selected( $options[11], 'Titillium Web', false ).' value="Titillium Web">Titillium Web</option>
							<option '.selected( $options[11], 'Trade Winds', false ).' value="Trade Winds">Trade Winds</option>
							<option '.selected( $options[11], 'Trocchi', false ).' value="Trocchi">Trocchi</option>
							<option '.selected( $options[11], 'Trochut', false ).' value="Trochut">Trochut</option>
							<option '.selected( $options[11], 'Trykker', false ).' value="Trykker">Trykker</option>
							<option '.selected( $options[11], 'Tulpen One', false ).' value="Tulpen One">Tulpen One</option>
							<option '.selected( $options[11], 'Ubuntu', false ).' value="Ubuntu">Ubuntu</option>
							<option '.selected( $options[11], 'Ubuntu Condensed', false ).' value="Ubuntu Condensed">Ubuntu Condensed</option>
							<option '.selected( $options[11], 'Ubuntu Mono', false ).' value="Ubuntu Mono">Ubuntu Mono</option>
							<option '.selected( $options[11], 'Ultra', false ).' value="Ultra">Ultra</option>
							<option '.selected( $options[11], 'Uncial Antiqua', false ).' value="Uncial Antiqua">Uncial Antiqua</option>
							<option '.selected( $options[11], 'Underdog', false ).' value="Underdog">Underdog</option>
							<option '.selected( $options[11], 'Unica One', false ).' value="Unica One">Unica One</option>
							<option '.selected( $options[11], 'UnifrakturCook:700', false ).' value="UnifrakturCook:700">UnifrakturCook</option>
							<option '.selected( $options[11], 'UnifrakturMaguntia', false ).' value="UnifrakturMaguntia">UnifrakturMaguntia</option>
							<option '.selected( $options[11], 'Unkempt', false ).' value="Unkempt">Unkempt</option>
							<option '.selected( $options[11], 'Unlock', false ).' value="Unlock">Unlock</option>
							<option '.selected( $options[11], 'Unna', false ).' value="Unna">Unna</option>
							<option '.selected( $options[11], 'Vampiro One', false ).' value="Vampiro One">Vampiro One</option>
							<option '.selected( $options[11], 'Varela', false ).' value="Varela">Varela</option>
							<option '.selected( $options[11], 'Varela Round', false ).' value="Varela Round">Varela Round</option>
							<option '.selected( $options[11], 'Vast Shadow', false ).' value="Vast Shadow">Vast Shadow</option>
							<option '.selected( $options[11], 'Vibur', false ).' value="Vibur">Vibur</option>
							<option '.selected( $options[11], 'Vidaloka', false ).' value="Vidaloka">Vidaloka</option>
							<option '.selected( $options[11], 'Viga', false ).' value="Viga">Viga</option>
							<option '.selected( $options[11], 'Voces', false ).' value="Voces">Voces</option>
							<option '.selected( $options[11], 'Volkhov', false ).' value="Volkhov">Volkhov</option>
							<option '.selected( $options[11], 'Vollkorn', false ).' value="Vollkorn">Vollkorn</option>
							<option '.selected( $options[11], 'Voltaire', false ).' value="Voltaire">Voltaire</option>
							<option '.selected( $options[11], 'VT323', false ).' value="VT323">VT323</option>
							<option '.selected( $options[11], 'Waiting for the Sunrise', false ).' value="Waiting for the Sunrise">Waiting for the Sunrise</option>
							<option '.selected( $options[11], 'Wallpoet', false ).' value="Wallpoet">Wallpoet</option>
							<option '.selected( $options[11], 'Walter Turncoat', false ).' value="Walter Turncoat">Walter Turncoat</option>
							<option '.selected( $options[11], 'Warnes', false ).' value="Warnes">Warnes</option>
							<option '.selected( $options[11], 'Wellfleet', false ).' value="Wellfleet">Wellfleet</option>
							<option '.selected( $options[11], 'Wendy One', false ).' value="Wendy One">Wendy One</option>
							<option '.selected( $options[11], 'Wire One', false ).' value="Wire One">Wire One</option>
							<option '.selected( $options[11], 'Yanone Kaffeesatz', false ).' value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
							<option '.selected( $options[11], 'Yellowtail', false ).' value="Yellowtail">Yellowtail</option>
							<option '.selected( $options[11], 'Yeseva One', false ).' value="Yeseva One">Yeseva One</option>
							<option '.selected( $options[11], 'Yesteryear', false ).' value="Yesteryear">Yesteryear</option>
							<option '.selected( $options[11], 'Zeyada', false ).' value="Zeyada">Zeyada</option>
						</select>
			</div>
			<div class="colors"><div title="Background Color" style="background-color:'.$options[3].'" class="simple_subscription_popup_preview1001 simple_subscription_popup_preview simple_subscription_popup_tooltip"></div>
			<div title="Locked Background Color" style="background-color:'.$options[51].'" class="simple_subscription_popup_preview1007 simple_subscription_popup_preview simple_subscription_popup_tooltip"></div>
			<div title="Title Font Color" style="background-color:'.$options[8].'" class="simple_subscription_popup_preview1002 simple_subscription_popup_preview simple_subscription_popup_tooltip"></div>
			<div title="Content Font Color" style="background-color:'.$options[9].'" class="simple_subscription_popup_preview1003 simple_subscription_popup_preview simple_subscription_popup_tooltip"></div>
			<div title="Subscribe Button Background" style="background-color:'.$options[4].'" class="simple_subscription_popup_preview1004 simple_subscription_popup_preview simple_subscription_popup_tooltip"></div>
			<div title="Subscribe Button Font Color" style="background-color:'.$options[5].'" class="simple_subscription_popup_preview1005 simple_subscription_popup_preview simple_subscription_popup_tooltip"></div>
			<div title="Close Button Color" style="background-color:'.$options[6].'" class="simple_subscription_popup_preview1006 simple_subscription_popup_preview simple_subscription_popup_tooltip"></div>
			<div class="play_button"><img class="simple_subscription_popup_tooltip" title="Play Form" src="'.plugins_url( '/assets/img/play.png' , __FILE__ ).'"></div>
			</div>
			<div style="clear:both;"></div><br><hr><br>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Animation speed of the incoming Signup Form"><input value="Animation Speed: '.$options[0].'sec" type="text" style="width:150px;" class="simple_subscription_popup_animation_speed_value" /><div class="simple_subscription_popup_animation_speed"></div></div>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Font size of the title of Signup Form"><input value="Font Size: '.$options[24].'" type="text" class="simple_subscription_popup_font_size_value" /><div class="simple_subscription_popup_font_size"></div></div>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Font size of the content of Signup Form"><input value="Content Font Size: '.$options[12].'" type="text" class="simple_subscription_popup_content_font_size_value" /><div class="simple_subscription_popup_content_font_size"></div></div>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Set the border radius for the entire subscription popup"><input value="Border Radius: '.$options[22].'" type="text" class="simple_subscription_popup_border_radius_value" /><div class="simple_subscription_popup_border_radius"></div></div>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Define the font size of the Close Button"><input value="Close Button Size: '.$options[7].'" type="text" class="simple_subscription_popup_close_button_size_value" /><div class="simple_subscription_popup_close_button_size"></div></div>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Expiry time for each user who already filled out the form- requires Once per Filled set to ON"><input value="Filled Cookie Days: '.trim($options[41]).'" type="text" class="simple_subscription_popup_fcookie_days_value" /><div class="simple_subscription_popup_fcookie_days"></div></div>
			<div style="clear:both;"></div>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Vertical distance relative to the top or bottom (depends on the position)"><input value="Vertical Space: '.$options[16].'" type="text" class="simple_subscription_popup_vertical_space_value" /><div class="simple_subscription_popup_vertical_space"></div></div>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Horizontal distance relative to the left or right side of the screen (depends on the position)"><input value="Horizontal Space: '.$options[17].'" type="text" class="simple_subscription_popup_horizontal_space_value" /><div class="simple_subscription_popup_horizontal_space"></div></div>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Border Radius for Input Fields"><input value="Input Border Radius: '.$options[42].'" type="text" class="simple_subscription_popup_iborderradius_value" /><div class="simple_subscription_popup_iborderradius"></div></div>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Margin for Custom Fields"><input value="Fields Margin: '.$options[33].'" type="text" class="simple_subscription_popup_cmargin_value" /><div class="simple_subscription_popup_cmargin"></div></div>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Delay time before the popup animation start"><input value="Display Timer: '.$options[18].'sec" type="text" class="simple_subscription_popup_display_timer_value" /><div class="simple_subscription_popup_display_timer"></div></div>
			<div class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Expiry time for each user - requires Once per User set to ON"><input value="Cookie Days: '.$options[32].'" type="text" class="simple_subscription_popup_cookie_days_value" /><div class="simple_subscription_popup_cookie_days"></div></div>
			<div style="clear: both;"></div><br><hr><br>
			<div class="text thankyou simple_subscription_popup_tooltip" title="Required with mode MailChimp or Mixed (eg.: ba7a2f8f9dc267557de6a3fb241471c9-us3)">MailChimp API Key: <input type="text" name="thankyou" class="inputtext thankyou mailchimpapikey" value="'.str_replace('"','\'',$options[34]).'" /></div>
			<div class="text thankyou simple_subscription_popup_tooltip" title="Required with mode MailChimp or Mixed (eg.: b9c0fde42d)">MailChimp Listid: <input type="text" name="thankyou" class="inputtext thankyou listid" value="'.str_replace('"','\'',$options[30]).'" /></div>
			<div class="text thankyou simple_subscription_popup_tooltip" title="Required with mode Mail or Mixed (eg.: youremail@address.com)">Email Address for optional signup notifications: <input type="text" name="thankyou" class="inputtext thankyou notemail" value="'.str_replace('"','\'',$options[35]).'" /></div>
			<div style="clear: both;"></div>
			<div class="text thankyou simple_subscription_popup_tooltip" title="Error message for invalid email address">Invalid Address: <input type="text" name="thankyou" class="inputtext thankyou invalidemail" value="'.str_replace('"','\'',$options[20]).'" /></div>
			<div class="text thankyou simple_subscription_popup_tooltip" title="Thank you message for successful signup">Signup Success: <input type="text" name="thankyou" class="inputtext thankyou successsignup" value="'.str_replace('"','\'',$options[21]).'" /></div>
			<div class="text thankyou simple_subscription_popup_tooltip" title="Specify the Subscribe Button Text">Subscribe Button Text: <input type="text" name="thankyou" class="inputtext thankyou subscribe_text" value="'.str_replace('"','\'',$options[36]).'" /></div>
			<div style="clear: both;"></div>
			<div class="text thankyou simple_subscription_popup_tooltip" title="Facebook App ID">Facebook App ID: <input type="text" name="thankyou" class="inputtext thankyou facebookappid" value="'.str_replace('"','\'',$options[43]).'" /></div>
			<div class="text thankyou simple_subscription_popup_tooltip" title="Google Plus Client ID">Google Plus Client ID: <input type="text" name="thankyou" class="inputtext thankyou gplusclientid" value="'.str_replace('"','\'',$options[44]).'" /></div>
			<div class="text thankyou simple_subscription_popup_tooltip" title="Google Plus API Key">Google Plus API Key: <input type="text" name="thankyou" class="inputtext thankyou gplusapikey" value="'.str_replace('"','\'',$options[45]).'" /></div>
			<div style="clear: both;"></div>
			<div class="text titletext simple_subscription_popup_tooltip" title="Specify the placeholder text on the input field">Placeholder Text: <input type="text" name="thankyou" class="inputtext titletext placeholder_text" value="'.str_replace('"','\'',$options[37]).'" /></div>
			<div style="clear: both;"></div>
			<div class="text titletext simple_subscription_popup_tooltip" title="The main title of the Signup Form">Title: <input type="text" name="titletext" class="inputtext titletext formtitle" value="'.str_replace('"','\'',$options[14]).'" /></div>
			<div class="text titletext simple_subscription_popup_tooltip" title="The bottom line text in form">Bottom Text: <input type="text" name="titletext" class="inputtext titletext bottomline" value="'.str_replace('"','\'',$options[46]).'" /></div>
			<div class="text titletext simple_subscription_popup_tooltip" title="Enter the URL where would like to redirect the user after a successful signup">Redirect URL after signup: <input type="text" name="titletext" class="inputtext titletext redirecturl" value="'.str_replace('"','\'',$options[169]).'" placeholder="http://www.redirectionurl.com/page" /></div>
			<div style="clear: both;"></div><br><hr><br>
			<div class="custom_field_section">
				<div class="acfield add_custom_fields button button-secondary button-large">Add Text Field</div><div class="acfield add_custom_fields_textarea button button-secondary button-large">Add Textarea</div><div class="acfield add_custom_fields_radio button button-secondary button-large">Add Radio Buttons</div><div class="acfield add_custom_fields_checkbox button button-secondary button-large">Add Checkbox</div><div class="acfield add_custom_fields_select button button-secondary button-large">Add Select Box</div><div class="acfield add_custom_fields_hidden button button-secondary button-large">Add Hidden Field</div>'.$custom_fields.'
			</div>
			<div style="clear: both;"></div><br><hr><br>
			<div class="text thankyou simple_subscription_popup_tooltip contenttextarea" title="Content text of the Signup Form">Content: <textarea name="thankyou" class="inputtext thankyou formtext" rows="10" />'.str_replace('"','\'',$options[15]).'</textarea></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" style="width: 200px;" title="Enable if you want to display the signup form on the entire website"><input type="checkbox" name="global_signup" class="inputtext global_signup" '.$global_opt.' value="'.$global_opt_value.'" /> Global Signup Form</label></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Automatically displays the signup form without any user interaction" style="width: 200px;"><input type="checkbox" name="autoopen" class="inputtext autoopen" '.$autoopen.' value="'.$autoopen_value.'" /> Auto Open</label></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="The signup form will appears when the user scrolled down at the bottom of the page" style="width: 200px;"><input type="checkbox" name="atbottom" class="inputtext atbottom" '.$atbottom.' value="'.$atbottom_value.'" /> Display at bottom</label></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Make the form content bold" style="width: 200px;"><input type="checkbox" name="boldcontent" class="inputtext boldcontent" '.$boldcontent.' value="'.$boldcontent_value.'" /> Bold Content</label></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="The potential subscriber will get an email with a link to confirm their subscription. If they don\'t click this link, they won\'t be added to your list. To disable this confirmation, set false to this attribute. (MailChimp Option)" style="width: 200px;"><input type="checkbox" name="doubleoptin" class="inputtext doubleoptin" '.$doubleoptin.' value="'.$doubleoptin_value.'" /> Double Optin</label></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Existing subscribers will be updated with true value. (MailChimp Option)" style="width: 200px;"><input type="checkbox" name="updateexisting" class="inputtext updateexisting" '.$updateexisting.' value="'.$updateexisting_value.'" /> Update Existing</label></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Flag to determine whether MailChimp replace the interest groups with the groups provided or MailChimp add the provided groups to the member\'s interest groups. (MailChimp Option)" style="width: 200px;"><input type="checkbox" name="replaceinterests" class="inputtext replaceinterests" '.$replaceinterests.' value="'.$replaceinterests_value.'" /> Replace Interests</label></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Make the title of the Signup Form bold" style="width: 200px;"><input type="checkbox" name="boldtitle" class="inputtext boldtitle" '.$boldtitle.' value="'.$boldtitle_value.'" /> Bold Title</label></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="If your double_optin is false and this is true, MailChimp will send your lists Welcome Email if this subscribe succeeds - this will *not* fire if we end up updating an existing subscriber. If double_optin is true, this has no effect. (MailChimp Option)" style="width: 200px;"><input type="checkbox" name="sendwelcome" class="inputtext sendwelcome" '.$sendwelcome.' value="'.$sendwelcome_value.'" /> Send Welcome</label></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Track users with cookies and prevents reopen the Signup Form" style="width: 200px;"><input type="checkbox" name="onceperuser" class="inputtext onceperuser" '.$onceperuser.' value="'.$onceperuser_value.'" /> Once per User</label></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Lock the screen with a transparent background" style="width: 200px;"><input type="checkbox" name="lock" class="inputtext lock" '.$lock.' value="'.$lock_value.'" /> Lock the screen</label></div>
			<div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Hide the close button of the popup" style="width: 200px;"><input type="checkbox" name="hidebutton" class="inputtext hidebutton" '.$hidebutton.' value="'.$hidebutton_value.'" /> Hide Close Button</label></div><div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Enable the triggering event on links" style="width: 200px;"><input type="checkbox" name="openwithlink" class="inputtext openwithlink" '.$openwithlink.' value="'.$openwithlink_value.'" /> Enable Open with Link</label></div><div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Do not display the Form for the user who is already filled out" style="width: 200px;"><input type="checkbox" name="once_per_filled" class="inputtext once_per_filled" '.$once_per_fout.' value="'.$once_per_fout_value.'" /> Once per Filled Out</label></div><div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Ability to close the form with clicking on the layer (enabled lock the screen)" style="width: 200px;"><input type="checkbox" name="closewithlayer" class="inputtext closewithlayer" '.$closewithlayer.' value="'.$closewithlayer_value.'" /> Close with Layer</label></div><div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Track Forms with Google Analytics Events" style="width: 200px;"><input type="checkbox" name="trackforms" class="inputtext trackforms" '.$trackforms.' value="'.$trackforms_value.'" /> Track Forms</label></div><div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Disable on Mobile" style="width: 200px;"><input type="checkbox" name="disablemobile" class="inputtext disablemobile" '.$disablemobile.' value="'.$disablemobile_value.'" /> Disable on Mobile</label></div><div class="simple_subscription_popup_checkbox"><label class="text simple_subscription_popup_tooltip" title="Disable for Members" style="width: 200px;"><input type="checkbox" name="disablemembers" class="inputtext disablemembers" '.$disablemembers.' value="'.$disablemembers_value.'" /> Disable for Members</label></div>');
		print('<div style="clear:both;"></div>
		<div class="ssp_accordion_more_api">
			<h4>Image Integration</h4>
				<div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Image Integration" style="width: 200px;"><input type="checkbox" name="addmoreapi_image" class="inputtext addmoreapi_image admincheckbox" ' . $image_integration . ' value="' . $image_integration_value . '" /> Enable Image</label>
					</div>
					<div class="aright">');
			if ( $options[ 163 ] =="" ) {
				print( '<div class="imageelement"><div class="uploaded-image"><input class="image-upload button add-button" type="button" value="Add Image" /></div></div>' );
			}
			else {
				print( '<div class="imageelement"><div class="uploaded-image"><div class="image_container"><div class="img-cont-outer"><div class="img-cont"><img style="opacity:' . $options[167] . '" src="' . $options[ 163 ] . '"></div></div><input type="hidden" class="upl_image upl-photo" name="image[]" value="' . $options[ 163 ] . '"><div><input class="remove_customimage_button button remove-button" type="button" value="REMOVE IMAGE"></div></div></div></div>' );				
			}		
						print('<div class="right-options-section">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Eg.: 100% or 390px">Image Width: <input type="text" name="shortfield" class="inputtext shortfield imagewidth" placeholder="100%" value="'.str_replace('"','\'',$options[165]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Eg.: 195px">Image Height: <input type="text" name="shortfield" class="inputtext shortfield imageheight" placeholder="195px" value="'.str_replace('"','\'',$options[166]).'" /></div>
						<div style="margin-right:20px;" class="simple_subscription_popup_sliders simple_subscription_popup_tooltip" title="Image Opacity"><input value="Image Opacity: '.$options[167].'" type="text" class="simple_subscription_popup_image_opacity_value" /><div class="simple_subscription_popup_image_opacity"></div></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="It will be displayed at the top of the popup" style="width: 200px;vertical-align:baseline;"><input type="radio" checked name="image_position['.$sf->id.']" class="inputtext image_position" '.$image_position1.' value="1" /> Above the Content</label></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="It will be displayed right above the form and below the content" style="width: 200px;vertical-align:baseline;"><input type="radio" name="image_position['.$sf->id.']" class="inputtext image_position" '.$image_position2.' value="2" /> Below the Content</label></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="Display it below the title" style="width: 200px;vertical-align:baseline;"><input type="radio" name="image_position['.$sf->id.']" class="inputtext image_position" '.$image_position3.' value="3" /> Below the Title</label></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="Include the image as background" style="width: 200px;vertical-align:baseline;"><input type="radio" name="image_position['.$sf->id.']" class="inputtext image_position" '.$image_position4.' value="4" /> Background ( Cover )</label></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="Include the image as background" style="width: 200px;vertical-align:baseline;"><input type="radio" name="image_position['.$sf->id.']" class="inputtext image_position" '.$image_position5.' value="5" /> Background ( Contain )</label></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="Background Repeat" style="width: 150px;vertical-align:baseline;"><input type="checkbox" name="image_repeat" class="inputtext image_repeat admincheckbox" '.$image_repeat.' value="'.$image_repeat_value.'" /> Repeat</label></div>
						</div>
					</div>
				</div>
				</div>
		</div>
		<div class="ssp_accordion_more_api">
			<h4>YouTube Integration</h4>
				<div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable YouTube Video in the content" style="width: 200px;"><input type="checkbox" name="activecampaign_status" class="inputtext addmoreapi_youtube admincheckbox" '.$youtube.' value="'.$youtube_value.'" /> Enable YouTube</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Grab from the URL, eg:gRgZnZz_Tj4 from https://www.youtube.com/watch?v=gRgZnZz_Tj4">YouTube Video ID: <input type="text" name="shortfield" class="inputtext shortfield youtube_videoid" placeholder="gRgZnZz_Tj4" value="'.str_replace('"','\'',$options[150]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Eg.: 100% or 390px">YouTube Video Width: <input type="text" name="shortfield" class="inputtext shortfield youtube_videowidth" placeholder="100%" value="'.str_replace('"','\'',$options[156]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Eg.: 195px">YouTube Video Height: <input type="text" name="shortfield" class="inputtext shortfield youtube_videoheight" placeholder="195px" value="'.str_replace('"','\'',$options[157]).'" /></div>
						<div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="It will be displayed at the top of the popup" style="width: 200px;vertical-align:baseline;"><input type="radio" name="youtube_position['.$sf->id.']" class="inputtext youtube_position" '.$youtube_position1.' value="1" /> Above the Content</label></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="It will be displayed right above the form and below the content" style="width: 200px;vertical-align:baseline;"><input type="radio" name="youtube_position['.$sf->id.']" class="inputtext youtube_position" '.$youtube_position2.' value="2" /> Below the Content</label></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="Display it below the title" style="width: 200px;vertical-align:baseline;"><input type="radio" name="youtube_position['.$sf->id.']" class="inputtext youtube_position" '.$youtube_position3.' value="3" /> Below the Title</label></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="Include the video as a whole form background" style="width: 200px;vertical-align:baseline;"><input type="radio" name="youtube_position['.$sf->id.']" class="inputtext youtube_position" '.$youtube_position4.' value="4" /> Use it as Background</label></div>
						</div>
						<div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="Enable Auto Play" style="width: 150px;vertical-align:baseline;"><input type="checkbox" name="youtube_autoplay" class="inputtext youtube_autoplay admincheckbox" '.$youtube_autoplay.' value="'.$youtube_autoplay_value.'" /> Auto Play</label></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="Enable Video Informations on the top" style="width: 150px;vertical-align:baseline;"><input type="checkbox" name="youtube_showinfo" class="inputtext youtube_showinfo admincheckbox" '.$youtube_showinfo.' value="'.$youtube_showinfo_value.'" /> Show Info</label></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="Enable Loop" style="width: 150px;vertical-align:baseline;"><input type="checkbox" name="youtube_loop" class="inputtext youtube_loop admincheckbox" '.$youtube_loop.' value="'.$youtube_loop_value.'" /> Loop</label></div>
							<div class="text tinyfield"><label class="text simple_subscription_popup_tooltip" title="Hide YouTube Player Controls" style="width: 150px;vertical-align:baseline;"><input type="checkbox" name="youtube_controls" class="inputtext youtube_controls admincheckbox" '.$youtube_controls.' value="'.$youtube_controls_value.'" /> Hide Controls</label></div>
						</div>
					</div>
				</div>
				</div>
		</div>
		<div class="ssp_accordion_more_api">
			<h4>Additional Newsletter Integrations</h4>
			<div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Active Campaign" style="width: 200px;"><input type="checkbox" name="activecampaign_status" class="inputtext addmoreapi_activecampaign admincheckbox" '.$activecampaign.' value="'.$activecampaign_value.'" /> Enable Active Campaign</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Find your Active Campaign API URL in your Active Campaign Account->My Settings->API menu after you logged in">Active Campaign API URL: <input type="text" name="shortfield" class="inputtext shortfield activecampaign_url" placeholder="API URL" value="'.str_replace('"','\'',$options[54]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Find your Active Campaign API Key in your Active Campaign Account->My Settings->API menu after you logged in">Active Campaign API Key: <input type="text" name="shortfield" class="inputtext shortfield activecampaign_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[55]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Select your list in your Active Campaign account, then see the List ID in the URL. Eg.: List ID=1 from username.activehosted.com/contact/?listid=1&status=1 ">Active Campaign List ID: <input type="text" name="shortfield" class="inputtext shortfield activecampaign_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[56]).'" /></div>
					</div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable AWeber" style="width: 200px;"><input type="checkbox" name="aweber_status" class="inputtext addmoreapi_aweber admincheckbox" '.$aweber.' value="'.$aweber_value.'" /> Enable AWeber</label>
					</div>
					<div class="aright">
						<div class="text fwidth simple_subscription_popup_tooltip" title="Enter your AWeber Authorization Code">Authorization Code: <textarea name="shortfield" class="inputtext aweber_authorizationcode" placeholder="AWeber Authorization Code">'.str_replace('"','\'',$options[58]).'</textarea></div>
						<div class="textgetapi"><a href="https://auth.aweber.com/1.0/oauth/authorize_app/2a94dad4" class="button button-secondary button-small" target="_blank">Get Authorization Code</a></div>
						<div class="textgetapi simple_subscription_popup_tooltip" title="Authorization Code is required for connection."><a href="#" class="getapiinfo button button-secondary button-small" id="awebercredentials" target="_blank">Get Credentials</a></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Get your AWeber Consumer Key with Click on the Get Credentials button">Consumer Key: <input type="text" name="shortfield" class="inputtext shortfield aweber_consumerkey" placeholder="AWeber Consumer Key" value="'.str_replace('"','\'',$options[62]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Get your AWeber Consumer Secret with Click on the Get Credentials button">Consumer Secret: <input type="text" name="shortfield" class="inputtext shortfield aweber_consumersecret" placeholder="AWeber Consumer Secret" value="'.str_replace('"','\'',$options[59]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Get your AWeber Access Key with Click on the Get Credentials button">Access Key: <input type="text" name="shortfield" class="inputtext shortfield aweber_accesskey" placeholder="AWeber Access Key" value="'.str_replace('"','\'',$options[60]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Get your AWeber Access Secret with Click on the Get Credentials button">Access Secret: <input type="text" name="shortfield" class="inputtext shortfield aweber_accesssecret" placeholder="AWeber Access Secret" value="'.str_replace('"','\'',$options[61]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your AWeber List ID">List ID: <input type="text" name="shortfield" class="inputtext shortfield aweber_listid" placeholder="AWeber List ID" value="'.str_replace('"','\'',$options[63]).'" /></div>
					</div>
				</div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Benchmark" style="width: 200px;"><input type="checkbox" name="benchmark_status" class="inputtext addmoreapi_benchmark admincheckbox" '.$benchmark.' value="'.$benchmark_value.'" /> Enable Benchmark</label>
					</div>
					<div class="aright">
						<div class="text shortfield"><a target="_blank" class="simple_subscription_popup_tooltip" title="Click here to get your API Key<br>Registration required" href="https://ui.benchmarkemail.com/EditSetting#apikey">Benchmark API Key</a>: <input type="text" name="shortfield" class="simple_subscription_popup_tooltip inputtext shortfield benchmark_apikey" placeholder="API Key" title="Enter your Benchmark API Key" value="'.str_replace('"','\'',$options[65]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Benchmark List ID"><a href="#" class="getapiinfo" data-apiid="benchmarklists" title="Click here to get your Benchmark Lists.<br>Valid API Key is required for getting the lists.">Benchmark List ID</a>: <input type="text" name="shortfield" class="inputtext shortfield benchmark_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[66]).'" /></div>
						<div class="text shortfield"><label class="text simple_subscription_popup_tooltip" title="Enable Double-Optin" style="width: 200px;vertical-align:baseline;"><input type="checkbox" name="benchmark_doubleoptin" class="inputtext benchmark_doubleoptin admincheckbox" '.$benchmark_doubleoptin.' value="'.$benchmark_doubleoptin_value.'" /> Enable Double Optin</label></div>
						<div class="benchmarklists_container autocont"></div>
					</div>
				</div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Campaign Monitor" style="width: 200px;"><input type="checkbox" name="campaignmonitor_status" class="inputtext addmoreapi_campaignmonitor admincheckbox" '.$campaignmonitor.' value="'.$campaignmonitor_value.'" /> Enable Campaign Monitor</label>
					</div>
					<div class="aright">
						<div class="text shortfield">Campaign Monitor API Key: <input type="text" name="shortfield" class="simple_subscription_popup_tooltip inputtext shortfield campaignmonitor_apikey" title="Log in to your Campaign Monitor account and find the API Key in <i>Account Settings</i>" placeholder="API Key" value="'.str_replace('"','\'',$options[69]).'" /></div>
						<div class="text shortfield">Campaign Monitor List ID: <input type="text" name="shortfield" class="inputtext shortfield campaignmonitor_listid simple_subscription_popup_tooltip" title="Find your Campaign Monitor List ID in the bottom of the Edit screen of your chosen List" placeholder="List ID" value="'.str_replace('"','\'',$options[71]).'" /></div>
					</div>
				</div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Campayn" style="width: 200px;"><input type="checkbox" name="campayn_status" class="inputtext addmoreapi_campayn admincheckbox" '.$campayn.' value="'.$campayn_value.'" /> Enable Campayn</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="You can see in the URL after you logged in to Campayn">Campayn Domain: <input type="text" name="shortfield" class="inputtext shortfield campayn_domain" placeholder="Domain" value="'.str_replace('"','\'',$options[73]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Find it here: http://xxx.campayn.com/users/api<br>replace xxx to your Campayn Domain">Campayn API Key: <input type="text" name="shortfield" class="inputtext shortfield campayn_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[74]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Campayn List ID"><a href="#" class="getapiinfo" data-apiid="campaynlists" title="Click here to get your Campayn Lists.<br>Valid API Key and Domain are required for getting the lists.">Campayn List ID</a>: <input type="text" name="shortfield" class="inputtext shortfield campayn_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[70]).'" /></div>
						<div class="campaynlists_container autocont"></div>
					</div>
				</div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Constant Contact" style="width: 200px;"><input type="checkbox" name="constantcontact_status" class="inputtext addmoreapi_constantcontact admincheckbox" '.$constantcontact.' value="'.$constantcontact_value.'" /> Enable Constant Contact</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Constant Contact API Key">Constant Contact API Key: <input type="text" name="shortfield" class="inputtext shortfield constantcontact_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[76]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Constant Contact Access Token">Constant Contact Access Token: <input type="text" name="shortfield" class="inputtext shortfield constantcontact_accesstoken" placeholder="Access Token" value="'.str_replace('"','\'',$options[77]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Constant Contact List ID"><a href="#" class="getapiinfo" data-apiid="constantcontactlists" title="Click here to get your Constant Contact Lists.<br>Valid API Key and Access Token are required for getting the lists.">Constant Contact List ID</a>: <input type="text" name="shortfield" class="inputtext shortfield constantcontact_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[78]).'" /></div>
						<div class="constantcontactlists_container autocont"></div>
					</div>
					<p class="tinynote">To get API Key, <a target="_blank" href="https://constantcontact.mashery.com/member/register">register here</a> and <a  target="_blank" href="https://constantcontact.mashery.com/apps/register">create you APP here </a>. <a  target="_blank" href="https://constantcontact.mashery.com/io-docs">Select your app and get the Access Token here.</a></p>
				</div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Freshmail" style="width: 200px;"><input type="checkbox" name="freshmail_status" class="inputtext addmoreapi_freshmail admincheckbox" '.$freshmail.' value="'.$freshmail_value.'" /> Enable Freshmail</label>
					</div>
					<div class="aright">
						<div class="text shortfield"><a target="_blank" class="simple_subscription_popup_tooltip" title="Click here to get your Freshmail API Key" href="https://app.freshmail.com/en/settings/integration/">Freshmail API Key</a>: <input type="text" name="shortfield" class="inputtext shortfield freshmail_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[80]).'" /></div>
						<div class="text shortfield"><a target="_blank" class="simple_subscription_popup_tooltip" title="Click here to get your Freshmail API Secret" href="https://app.freshmail.com/en/settings/integration/">Freshmail API Secret</a>: <input type="text" name="shortfield" class="inputtext shortfield freshmail_apisecret" placeholder="API Secret" value="'.str_replace('"','\'',$options[81]).'" /></div>
						<div class="text shortfield><a target="_blank" class="simple_subscription_popup_tooltip" title="Click here to get your Lists, then select one and see the Freshmail List Hash in the URL. Eg.: List Hash = nynedux96k from https://app.freshmail.com/en/subscribers/index/?id_hash=nynedux96k" href="https://app.freshmail.com/en/lists/index/">Freshmail List Hash</a>: <input type="text" name="shortfield" class="inputtext shortfield freshmail_listhash" placeholder="List Hash" value="'.str_replace('"','\'',$options[82]).'" /></div>
					</div>
				</div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable GetResponse" style="width: 200px;"><input type="checkbox" name="getresponse_status" class="inputtext addmoreapi_getresponse admincheckbox" '.$getresponse.' value="'.$getresponse_value.'" /> Enable GetResponse</label>
					</div>
					<div class="aright">
						<div class="text shortfield"><a target="_blank" class="simple_subscription_popup_tooltip" title="Click here to get your GetResponse API Key" href="https://app.getresponse.com/account.html#api">GetResponse API Key</a>: <input type="text" name="shortfield" class="inputtext shortfield getresponse_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[84]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your GetResponse Campaign ID"><a href="#" class="getapiinfo" data-apiid="getresponselists" title="Click here to get your GetResponse Campaigns.<br>Valid API Key is required for getting the lists.">GetResponse Campaign ID</a>: <input type="text" name="shortfield" class="inputtext shortfield getresponse_campaignid" placeholder="Campaign ID" value="'.str_replace('"','\'',$options[85]).'" /></div>
						<div class="getresponselists_container autocont"></div>
					</div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable iContact" style="width: 200px;"><input type="checkbox" name="icontact_status" class="inputtext addmoreapi_icontact admincheckbox" '.$icontact.' value="'.$icontact_value.'" /> Enable iContact</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your iContact appId">iContact appId: <input type="text" name="shortfield" class="inputtext shortfield icontact_appid" placeholder="appId" value="'.str_replace('"','\'',$options[87]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your iContact API Username">iContact API Username: <input type="text" name="shortfield" class="inputtext shortfield icontact_apiusername" placeholder="API Username" value="'.str_replace('"','\'',$options[88]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your iContact API Password">iContact API Password: <input type="text" name="shortfield" class="inputtext shortfield icontact_apipassword" placeholder="API Password" value="'.str_replace('"','\'',$options[89]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your iContact List ID">iContact List ID: <input type="text" name="shortfield" class="inputtext shortfield icontact_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[90]).'" /></div>
					</div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Infusionsoft" style="width: 200px;"><input type="checkbox" name="infusionsoft_status" class="inputtext addmoreapi_infusionsoft admincheckbox" '.$infusionsoft.' value="'.$infusionsoft_value.'" /> Enable Infusionsoft</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Infusionsoft API Key">Infusionsoft API Key: <input type="text" name="shortfield" class="inputtext shortfield infusionsoft_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[92]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Infusionsoft Campaign ID">Infusionsoft Campaign ID: <input type="text" name="shortfield" class="inputtext shortfield infusionsoft_campaignid" placeholder="Campaign ID" value="'.str_replace('"','\'',$options[93]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Infusionsoft Group ID (optional)">Infusionsoft Group ID: <input type="text" name="shortfield" class="inputtext shortfield infusionsoft_groupid" placeholder="Group ID" value="'.str_replace('"','\'',$options[94]).'" /></div>
					</div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Interspire" style="width: 200px;"><input type="checkbox" name="interspire_status" class="inputtext addmoreapi_interspire admincheckbox" '.$interspire.' value="'.$interspire_value.'" /> Enable Interspire</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Interspire Username">Interspire Username: <input type="text" name="shortfield" class="inputtext shortfield interspire_username" placeholder="Username" value="'.str_replace('"','\'',$options[96]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Interspire User Token">Interspire User Token: <input type="text" name="shortfield" class="inputtext shortfield interspire_usertoken" placeholder="User Token" value="'.str_replace('"','\'',$options[97]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Interspire List ID">Interspire List ID: <input type="text" name="shortfield" class="inputtext shortfield interspire_listid" placeholder=" List ID" value="'.str_replace('"','\'',$options[98]).'" /></div>
					</div>
				</div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Mad Mimi" style="width: 200px;"><input type="checkbox" name="madmimi_status" class="inputtext addmoreapi_madmimi admincheckbox" '.$madmimi.' value="'.$madmimi_value.'" /> Enable Mad Mimi</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Mad Mimi Username">Mad Mimi Username(or email): <input type="text" name="shortfield" class="inputtext shortfield madmimi_username" placeholder="Username" value="'.str_replace('"','\'',$options[100]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Mad Mimi API Key"><a target="_blank" href="https://madmimi.com/user/edit?account_info_tabs=account_info_personal">Mad Mimi API Key</a>: <input type="text" name="shortfield" class="inputtext shortfield madmimi_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[101]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Mad Mimi List Name"><a href="https://madmimi.com/audience_members" target="_blank">Mad Mimi List Name</a>: <input type="text" name="shortfield" class="inputtext shortfield madmimi_listname" placeholder="List Name" value="'.str_replace('"','\'',$options[102]).'" /></div>
					</div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable MailerLite" style="width: 200px;"><input type="checkbox" name="mailerlite_status" class="inputtext addmoreapi_mailerlite admincheckbox" '.$mailerlite.' value="'.$mailerlite_value.'" /> Enable MailerLite</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your MailerLite API Key">MailerLite API Key: <input type="text" name="shortfield" class="inputtext shortfield mailerlite_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[104]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your MailerLite List ID">MailerLite List ID: <input type="text" name="shortfield" class="inputtext shortfield mailerlite_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[105]).'" /></div>
					</div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Mailigen" style="width: 200px;"><input type="checkbox" name="mailigen_status" class="inputtext addmoreapi_mailigen admincheckbox" '.$mailigen.' value="'.$mailigen_value.'" /> Enable Mailigen</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Mailigen API Key">Mailigen API Key: <input type="text" name="shortfield" class="inputtext shortfield mailigen_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[107]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Mailigen List ID">Mailigen List ID: <input type="text" name="shortfield" class="inputtext shortfield mailigen_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[108]).'" /></div>
						<div class="text shortfield"><label class="text simple_subscription_popup_tooltip" title="Enable Double-Optin" style="width: 200px;vertical-align:baseline;"><input type="checkbox" name="mailigen_doubleoptin" class="inputtext mailigen_doubleoptin admincheckbox" '.$mailigen_doubleoptin.' value="'.$mailigen_doubleoptin_value.'" /> Enable Double Optin</label></div>
					</div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Mailjet" style="width: 200px;"><input type="checkbox" name="mailjet_status" class="inputtext addmoreapi_mailjet admincheckbox" '.$mailjet.' value="'.$mailjet_value.'" /> Enable Mailjet</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Mailjet API Key">Mailjet API Key: <input type="text" name="shortfield" class="inputtext shortfield mailjet_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[111]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Mailjet Secret Key">Mailjet Secret Key: <input type="text" name="shortfield" class="inputtext shortfield mailjet_secretkey" placeholder="Secret Key" value="'.str_replace('"','\'',$options[112]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Mailjet List ID">Mailjet List ID: <input type="text" name="shortfield" class="inputtext shortfield mailjet_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[113]).'" /></div>
					</div>
				</div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable MailPoet" style="width: 200px;"><input type="checkbox" name="mailpoet_status" class="inputtext addmoreapi_mailpoet admincheckbox" '.$mailpoet.' value="'.$mailpoet_value.'" /> Enable MailPoet</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your MailPoet List ID"><a href="#" class="getapiinfo" data-apiid="mailpoetlists" title="Click here to get your MailPoet Lists.">MailPoet List ID</a>: <input type="text" name="shortfield" class="inputtext shortfield mailpoet_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[161]).'" /></div>
					</div>
					<div class="mailpoetlists_container autocont"></div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Emma" style="width: 200px;"><input type="checkbox" name="emma_status" class="inputtext addmoreapi_emma admincheckbox" '.$emma.' value="'.$emma_value.'" /> Enable Emma</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Emma Account ID">Emma Account ID: <input type="text" name="shortfield" class="inputtext shortfield emma_accountid" placeholder="Account ID" value="'.str_replace('"','\'',$options[115]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Emma Public Key">Emma Public Key: <input type="text" name="shortfield" class="inputtext shortfield emma_publickey" placeholder="Public Key" value="'.str_replace('"','\'',$options[116]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Emma Private Key">Emma Private Key: <input type="text" name="shortfield" class="inputtext shortfield emma_privatekey" placeholder="Private Key" value="'.str_replace('"','\'',$options[117]).'" /></div>
					</div>
				</div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable MyMail" style="width: 200px;"><input type="checkbox" name="mymail_status" class="inputtext addmoreapi_mymail admincheckbox" '.$mymail.' value="'.$mymail_value.'" /> Enable MyMail</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your MyMail List ID"><a href="#" class="getapiinfo" data-apiid="mymaillists" title="Click here to get your MyMail Lists.">MyMail List ID</a>: <input type="text" name="shortfield" class="inputtext shortfield mymail_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[119]).'" /></div>
					</div>
					<div class="mymaillists_container autocont"></div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable ONTRAPORT" style="width: 200px;"><input type="checkbox" name="ontraport_status" class="inputtext addmoreapi_ontraport admincheckbox" '.$ontraport.' value="'.$ontraport_value.'" /> Enable ONTRAPORT</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your ONTRAPORT APP ID">ONTRAPORT APP ID: <input type="text" name="shortfield" class="inputtext shortfield ontraport_appid" placeholder="APP ID" value="'.str_replace('"','\'',$options[121]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your ONTRAPORT Key">ONTRAPORT Key: <input type="text" name="shortfield" class="inputtext shortfield ontraport_key" placeholder="Key" value="'.str_replace('"','\'',$options[122]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your ONTRAPORT Tag ID">ONTRAPORT Tag ID: <input type="text" name="shortfield" class="inputtext shortfield ontraport_tagid" placeholder="Tag ID" value="'.str_replace('"','\'',$options[123]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your ONTRAPORT Sequence ID">ONTRAPORT Sequence ID: <input type="text" name="shortfield" class="inputtext shortfield ontraport_sequenceid" placeholder="Sequence ID" value="'.str_replace('"','\'',$options[124]).'" /></div>
					</div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Pinpointe" style="width: 200px;"><input type="checkbox" name="pinpointe_status" class="inputtext addmoreapi_pinpointe admincheckbox" '.$pinpointe.' value="'.$pinpointe_value.'" /> Enable Pinpointe</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Pinpointe Username">Pinpointe Username: <input type="text" name="shortfield" class="inputtext shortfield pinpointe_username" placeholder="Username" value="'.str_replace('"','\'',$options[126]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Pinpointe User Token">Pinpointe User Token: <input type="text" name="shortfield" class="inputtext shortfield pinpointe_usertoken" placeholder="User Token" value="'.str_replace('"','\'',$options[127]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Pinpointe List ID">Pinpointe List ID: <input type="text" name="shortfield" class="inputtext shortfield pinpointe_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[128]).'" /></div>
					</div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable SendinBlue" style="width: 200px;"><input type="checkbox" name="sendinblue_status" class="inputtext addmoreapi_sendinblue admincheckbox" '.$sendinblue.' value="'.$sendinblue_value.'" /> Enable SendinBlue</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your SendinBlue Access Key">SendinBlue Access Key: <input type="text" name="shortfield" class="inputtext shortfield sendinblue_accesskey" placeholder="Access Key" value="'.str_replace('"','\'',$options[130]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your SendinBlue List ID">SendinBlue List ID: <input type="text" name="shortfield" class="inputtext shortfield sendinblue_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[131]).'" /></div>
					</div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable SendReach" style="width: 200px;"><input type="checkbox" name="sendreach_status" class="inputtext addmoreapi_sendreach admincheckbox" '.$sendreach.' value="'.$sendreach_value.'" /> Enable SendReach</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your SendReach Key">SendReach Key: <input type="text" name="shortfield" class="inputtext shortfield sendreach_key" placeholder="Key" value="'.str_replace('"','\'',$options[133]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your SendReach Secret">SendReach Secret: <input type="text" name="shortfield" class="inputtext shortfield sendreach_secret" placeholder="Secret" value="'.str_replace('"','\'',$options[134]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your SendReach User ID">SendReach User ID: <input type="text" name="shortfield" class="inputtext shortfield sendreach_userid" placeholder="User ID" value="'.str_replace('"','\'',$options[135]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your SendReach List ID">SendReach List ID: <input type="text" name="shortfield" class="inputtext shortfield sendreach_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[136]).'" /></div>
					</div>
				</div>
				<div class="dnone">
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable Sendy" style="width: 200px;"><input type="checkbox" name="sendy_status" class="inputtext addmoreapi_sendy admincheckbox" '.$sendy.' value="'.$sendy_value.'" /> Enable Sendy</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Sendy Installation URL">Sendy Installation URL: <input type="text" name="shortfield" class="inputtext shortfield sendy_installationurl" placeholder="Installation URL" value="'.str_replace('"','\'',$options[138]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Sendy API Key">Sendy API Key: <input type="text" name="shortfield" class="inputtext shortfield sendy_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[139]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your Sendy List ID">Sendy List ID: <input type="text" name="shortfield" class="inputtext shortfield sendy_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[140]).'" /></div>
					</div>
				</div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable SimplyCast" style="width: 200px;"><input type="checkbox" name="simplycast_status" class="inputtext addmoreapi_simplycast admincheckbox" '.$simplycast.' value="'.$simplycast_value.'" /> Enable SimplyCast</label>
					</div>
					<div class="aright">
						<div class="text shortfield"><a class="simple_subscription_popup_tooltip" title="Click here to get your SimplyCast Public Key" href="https://app.simplycast.com/?q=account/info/api" target="_blank">SimplyCast Public Key</a>: <input type="text" name="shortfield" class="inputtext shortfield simplycast_publickey" placeholder="Public Key" value="'.str_replace('"','\'',$options[142]).'" /></div>
						<div class="text shortfield"><a class="simple_subscription_popup_tooltip" title="Click here to get your SimplyCast Secret Key" href="https://app.simplycast.com/?q=account/info/api" target="_blank">SimplyCast Secret Key</a>: <input type="text" name="shortfield" class="inputtext shortfield simplycast_secretkey" placeholder="Secret Key" value="'.str_replace('"','\'',$options[143]).'" /></div>
						<div class="text shortfield"><a class="simple_subscription_popup_tooltip" title="Click here to get your SimplyCast List ID" href="https://app.simplycast.com/?q=crm/lists" target="_blank">SimplyCast List ID</a>: <input type="text" name="shortfield" class="inputtext shortfield simplycast_listid" placeholder="List ID" value="'.str_replace('"','\'',$options[144]).'" /></div>
					</div>
				</div>
				<div>
					<div>
						<label class="text simple_subscription_popup_tooltip" title="Enable YMLP" style="width: 200px;"><input type="checkbox" name="ymlp_status" class="inputtext addmoreapi_ymlp admincheckbox" '.$ymlp.' value="'.$ymlp_value.'" /> Enable YMLP</label>
					</div>
					<div class="aright">
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your YMLP Username">YMLP Username: <input type="text" name="shortfield" class="inputtext shortfield ymlp_username" placeholder="Username" value="'.str_replace('"','\'',$options[146]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your YMLP API Key"><a target="_blank" href="http://www.ymlp.com/app/api.php">YMLP API Key</a>: <input type="text" name="shortfield" class="inputtext shortfield ymlp_apikey" placeholder="API Key" value="'.str_replace('"','\'',$options[147]).'" /></div>
						<div class="text shortfield simple_subscription_popup_tooltip" title="Enter your YMLP Group ID"><a href="#" class="getapiinfo" data-apiid="ymlplists" title="Click here to get your YMLP Groups.">YMLP Group ID</a>: <input type="text" name="shortfield" class="inputtext shortfield ymlp_groupid" placeholder="Group ID" value="'.str_replace('"','\'',$options[148]).'" /></div>
					</div>
					<div class="ymlplists_container autocont"></div>
					</div>
			</div>
		</div>		
		<div>
			<br><span><input type="submit" name="delete_form" class="delete_form button button-secondary button-small" value="DELETE"></span><span><input type="submit" name="save_form" class="save_form button button-primary button-small" value="UPDATE"></span><span class="signup_error_span"></span>
		</div>
	</div>
	</div>
	</p>
	</div>
');
	}
	else {
		$signup_form = $this->wpdb->get_results( "SELECT ssp.options, ssp.id, ssp.name, ssp.global as glb, COUNT( ssps.autoid ) as subscribers FROM " . $this->wpdb->base_prefix . "simple_subscription_popup ssp LEFT JOIN " . $this->wpdb->base_prefix . "simple_subscription_popup_stats ssps on ssp.id = ssps.formid GROUP BY ssp.id ORDER BY ssp.autoid DESC");
		if ( empty( $signup_form ) ) {
			print( '<p>There are no saved forms, <a href="' . admin_url('admin.php?page=mailchimper_pro') . '">Click here to create a new one</a>.</p>' );
		}
		else {
				print('<table class="simple-signup-list-table simple-signup-list-table-saved-forms">
					<thead>
						<tr>
							<th>' . __( 'ID', SSPRO_TEXT_DOMAIN ) . '</th>
							<th>' . __( 'Name', SSPRO_TEXT_DOMAIN ) . '</th>
							<th>' . __( 'Subscribers', SSPRO_TEXT_DOMAIN ) . '</th>
							<th>' . __( 'Auto Open', SSPRO_TEXT_DOMAIN ) . '</th>
							<th>' . __( 'Custom Fields', SSPRO_TEXT_DOMAIN ) . '</th>
							<th>' . __( 'Mode', SSPRO_TEXT_DOMAIN ) . '</th>
							<th>' . __( 'Global', SSPRO_TEXT_DOMAIN ) . '</th>
							<th>' . __( 'Tracking', SSPRO_TEXT_DOMAIN ) . '</th>
							<th>' . __( 'Actions', SSPRO_TEXT_DOMAIN ) . '</th>
						</tr>
					</thead><tbody>');
				foreach( $signup_form as $sf ) {
					$sfoptions = (array) json_decode( stripslashes( $sf->options ) );
					switch ( $sfoptions[ 2 ] ) {
						case 'mixed':
							$mode = 'Mixed';
							break;
						case 'mailchimp':
							$mode = 'MailChimp';
							break;
						case 'mail':
							$mode = 'Mail';
							break;
						case 'advancedapi':
							$mode = 'API';
							break;
					}
					print('<tr id="'.$sf->id.'">
					<td><a href="' . admin_url('admin.php?page=mailchimper_pro_savedforms&ssfpro_id=' . $sf->id . '') . '">'.$sf->id.'</a></td>
					<td><a href="' . admin_url('admin.php?page=mailchimper_pro_savedforms&ssfpro_id=' . $sf->id . '') . '">'.$sf->name.'</a></td>
					<td>' . $sf->subscribers . '</td>
					<td>' . ( $sfoptions[ 1 ] == 'true' ? "Yes" : "No" ) . '</td>
					<td>' . ( ! empty( $sfoptions[ 50 ] ) ? "Yes" : "No" ) . '</td>
					<td>' . $mode . '</td>
					<td>' . ( $sf->glb == 1 ? "Yes" : "No" ) . '</td>
					<td>' . ( $sfoptions[ 158 ] == 'true' ? "Yes" : "No" ) . '</td>
					<td>
						<a href="' . admin_url('admin.php?page=mailchimper_pro_savedforms&ssfpro_id=' . $sf->id . '') . '" class="simple_subscription_popup_tooltip" title="' . __( 'Edit', SSPRO_TEXT_DOMAIN ) . '"><img src="'.plugins_url( '/assets/img/list-edit.png' , __FILE__ ).'"></a>
						<a href="Javascript: void(0);" class="simple_subscription_popup_tooltip duplicate_form" title="' . __( 'Duplicate', SSPRO_TEXT_DOMAIN ) . '" data-formid="'.$sf->id.'" data-formname="'.$sf->name.'"><img src="'.plugins_url( '/assets/img/list-duplicate.png' , __FILE__ ).'"></a>
						<a href="Javascript: void(0);" class="simple_subscription_popup_tooltip delete_form" data-formid="'.$sf->id.'" title="' . __( 'Delete', SSPRO_TEXT_DOMAIN ) . '"><img src="'.plugins_url( '/assets/img/list-remove.png' , __FILE__ ).'"></a></td></tr>');
				}
				print('</tbody></table>');			
		}
	}
				?>
	<div id="dialog-confirm" title="Delete Signup Form?">
	  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
	</div>
	<div id="dialog-confirm4" title="<?php _e( 'Duplicate Form', SSPRO_TEXT_DOMAIN );?>">
	  <p class="validateTips"><?php _e( 'Enter the name of the new form.', SSPRO_TEXT_DOMAIN );?></p>
	  <form>
		<fieldset>
		  <input type="text" name="dform_name" id="dform_name" value="" class="text ui-widget-content ui-corner-all">
		  <!-- Allow form submission with keyboard without duplicating the dialog button -->
		  <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
		</fieldset>
	  </form>
	  <span class="duplicate-notice"> <?php _e( 'This form name is already exist!', SSPRO_TEXT_DOMAIN );?></span>
	</div>
	<div id="simplesignuppro-admin" class="simplesignuppro"></div>
</div>