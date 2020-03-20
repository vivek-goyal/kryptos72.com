<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices(); ?>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="wc-account-reset-password">

			<h1 class="wc-account-reset-password_h"><?php esc_html_e( 'Reset Password', 'woocommerce' ); ?></h1>

			<form method="post" class="wc-account-reset-password_form">

				<p class="wc-lead"><?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'woocommerce') ); ?></p>

				<p class="form-row form-row-first">
					<label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" />
				</p>
				<p class="form-row form-row-last">
					<label for="password_2"><?php _e( 'Re-enter new password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_2" id="password_2" />
				</p>

				<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
				<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />
				<?php do_action( 'woocommerce_resetpassword_form' ); ?>

				<p class="form-row">
					<input type="hidden" name="wc_reset_password" value="true" />
					<input type="submit" class="wc-account-reset-password_btn" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>" />
				</p>

				<?php wp_nonce_field( 'reset_password' ); ?>

			</form>

		</div>
	</div>
</div>
