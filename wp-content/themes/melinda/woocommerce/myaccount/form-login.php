<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="row" id="customer_login">
	<div class="col-md-6 col-md-offset-3">
		<div id="wc-account-login-tabs">

			<div id="wc-account-login" class="wc-account-login">

				<h1 class="wc-account-login_h"><?php esc_html_e( 'Login', 'woocommerce' ); ?></h1>

				<form method="post" class="wc-account-login_form">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<p class="form-row form-row-wide">
						<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="text" class="input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</p>
					<p class="form-row form-row-wide">
						<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input class="input-text" type="password" name="password" id="password" />
					</p>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<p class="form-row">
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
						<input type="submit" class="wc-account-login_btn" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="lost_password"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
						<label for="rememberme" class="inline rememberme">
							<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'woocommerce' ); ?>
						</label>
					</p>

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>

			</div>

			<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) { ?>

				<div id="wc-account-register" class="wc-account-register">

					<h1 class="wc-account-register_h"><?php esc_html_e( 'Register', 'woocommerce' ); ?></h1>

					<form method="post" class="wc-account-register_form">

						<?php do_action( 'woocommerce_register_form_start' ); ?>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

							<p class="form-row form-row-wide">
								<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
								<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
							</p>

						<?php endif; ?>

						<p class="form-row form-row-wide">
							<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
							<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
						</p>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

							<p class="form-row form-row-wide">
								<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
								<input type="password" class="input-text" name="password" id="reg_password" />
							</p>

						<?php endif; ?>

						<!-- Spam Trap -->
						<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

						<?php do_action( 'woocommerce_register_form' ); ?>
						<?php do_action( 'register_form' ); ?>

						<p class="form-row">
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<input type="submit" class="wc-account-register_btn" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
						</p>

						<?php do_action( 'woocommerce_register_form_end' ); ?>

					</form>

				</div>

				<div class="wc-account-login_separator"><span><?php esc_html_e('Or', 'melinda'); ?></span></div>

				<ul class="wc-account-login-tabs">
					<li><a href="#wc-account-login" class="wc-account-login-tabs_lk"><?php esc_html_e( 'Login', 'woocommerce' ); ?></a></li>
					<li><a href="#wc-account-register" class="wc-account-login-tabs_lk"><?php esc_html_e( 'Register', 'woocommerce' ); ?></a></li>
				</ul>

			<?php } ?>

		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
