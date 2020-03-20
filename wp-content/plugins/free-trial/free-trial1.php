<?php
/**
 * Plugin Name: Free Trial
 * Plugin URI: http://kryptos72.com
 * Description: Free Trial Form
 * Version: 1.0.0
 * Author: YTS
 * Author URI: http://kryptos72.com
 * License: GPL2
 */
 require ('WP_Mail.php');
 function free_trial() {
 	?>
 	<style>
 	.loader{
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url('/wp-content/plugins/free-trial/image/free-trial-loader.gif') 50% 50% no-repeat rgb(0,0,0, 0.7);
		opacity: .8;
	}
	.customloader .loader::before{
		font-size: 1em !important;
	}
 	</style>
 	
 	<script>
 	jQuery(function($) {
 		$('#free_trila_btn').on('click', function()  {
 			var email = $('#email').val();
 			var phone = $('#phone').val();
			var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
			var data = {
				'action': 'submit_ajax_form',
				'email': email,
				'phone': phone
			
			};
			if(email == '' || phone == ''){
				$("#error_msg").hide();
				$("#required_fields").hide();
				$("#success_msg").hide();
				$("#exists_msg").hide();
				$( "#free-trial.uvc-main-heading.ult-responsive" ).prepend( '<h4 id="required_fields" style="font-weight:bold;margin-bottom:30px;color: red;">Wypełnij wszystkie pola.</h4>' );
				return false;
			}
			$(".customloader").show();
		    $(".customloader").html("<div class='loader'></div>");
			$.post(ajaxurl, data, function(response, status) {
				if(response == 1){
					$("#error_msg").hide();
					$("#exists_msg").hide();
					$("#required_fields").hide();
					$(".customloader").hide();
					$("#free_trial_form")[0].reset();
					
					$( "#free-trial.uvc-main-heading.ult-responsive" ).prepend( '<h4 id="success_msg" style="font-size:20px;font-weight:bold;margin-bottom:30px;color: green;">Sprawdź swój adres e-mail, aby aktywować darmowy okres</h4>' );
				}else if(response == 2){
					$("#error_msg").hide();
					$("#success_msg").hide();
					$("#required_fields").hide();
					$(".customloader").hide();
					$("#free_trial_form")[0].reset();
					
					$( "#free-trial.uvc-main-heading.ult-responsive" ).prepend( '<h4 id="exists_msg" style="font-weight:bold;margin-bottom:30px;color: red;">'+email+' jest już zarejestrowany w naszej bazie. Skontaktuj się z działem sprzedaży.</h4>' );
				}else{
					$("#success_msg").hide();
					$("#exists_msg").hide();
					$("#required_fields").hide();
					$(".customloader").hide();
					$("#free_trial_form")[0].reset();
					
					$( "#free-trial.uvc-main-heading.ult-responsive" ).prepend( '<h4 id="error_msg" style="font-weight:bold;margin-bottom:30px;color: red;">Wystąpił błąd ! Skontaktuj sę z nami!</h4>' );
				}
			});
		});
 	});
 	</script>
 	<?php
 	$html = '<div class="customloader" style="display: none;"><div class="loader"></div></div>';
 	$html .= '<div class="uvc-heading ult-adjust-bottom-margin ultimate-heading-18135c2f6ad37c2a3 uvc-3058 ">';
 	$html .= '<div id="free-trial" class="uvc-main-heading ult-responsive">';
 	$html .= '<h3 style="font-weight:bold;">Bezpłatny TRIAL</h3>';
 	$html .= '<span>Udostępniamy <a href="http://www.kryptos72.com/rodo">informacje o przetwarzaniu danych</a> oraz <a href="http://www.kryptos72.com/regulamin-Kryptos72">regulamin.</a> </span>';
 	$html .= '<form action="" method="post" id="free_trial_form">';
 	$html .= '<div><label style="font-size: 17px;">Email: </label><input type="text" name="email" id="email" required="" style="margin-left: 19px;"></div>';
 	$html .= '<div><label style="font-size: 17px;">Nr telefonu:</label><input type="text" name="phone" id="phone" required="" style="margin-left: 19px;"></div>';
 	$html .= '<div style="margin-bottom: 11px;"><button type="button" name="Submit" style="margin-top: 10px;" id="free_trila_btn">Załóż konto</button></div>';
 	$html .= '</form>';
 	$html .= '</div></div>';
 	
 	
	return $html;
}
add_shortcode( 'free_trial_form', 'free_trial' );

add_action('wp_ajax_submit_ajax_form', 'submit_ajax_form_callback');
add_action('wp_ajax_nopriv_submit_ajax_form', 'submit_ajax_form_callback');
function submit_ajax_form_callback() {
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$salt = 'op2mooM5Rui9vioH';
	$sign = hash('sha256',  $_POST['email'].$_POST['phone'].$salt);
	
	if(!empty($email) && !empty($phone)){
		$postData = array(
			'email' => $email,
			'phone' => $phone,
			'sign' => $sign
		);

		$ch = curl_init();
		curl_setopt_array($ch, array(
		CURLOPT_URL => 'https://trial-manager.kryptos72.com/api/free-trial',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $postData,
		CURLOPT_FOLLOWLOCATION => true
		));

		$output = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		
		$outputArr = json_decode($output);
		$status = $outputArr->status;
		
		if($status == 0){
			echo 2;
			wp_die();
		}
		if($status == 1){
			$to = $email;
			$subject = "Kryptos72: Potwierdzenie Rejestracji / Confirm Your Registration";
			$Url="https://trial-manager.kryptos72.com/registers?phone=".$phone."&email=".$email;
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        // More headers
			$headers .= 'From: <kryptos72@kryptos72.com>' . "\r\n";
			
			try{
			$email = WP_Mail::init()
			->to($to)
			->subject($subject)
			->template(get_template_directory().'/email/email.php', ['url' => $Url])
			->send();
			}catch(Exception $e){
				print_r($e);
				die;
			}
			// wp_mail($to,$subject,$message,$headers);
			echo "1"; wp_die();
		}	
        }

}   