<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<form method="post" class="login wc-global-login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

	<p class="form-row form-row-first">
		<input type="text" class="input-text" name="username" id="username" placeholder="<?php esc_attr_e( 'Username or email', 'woocommerce' ); ?>" size="30">
	</p>
	<p class="form-row form-row-last">
		<input type="password" class="input-text" name="password" id="password" placeholder="<?php esc_attr_e( 'Password', 'woocommerce' ); ?>" size="30">
	</p>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<p class="form-row">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		<input type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>">
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>">
		&nbsp;&nbsp;
		<label for="rememberme" class="inline text-nowrap">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever"> <?php esc_html_e( 'Remember me', 'woocommerce' ); ?>
		</label>
	</p>

	<p class="lost_password">
		<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
	</p>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
