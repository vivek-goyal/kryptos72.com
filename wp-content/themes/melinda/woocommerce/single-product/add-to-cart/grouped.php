<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see         http://docs.woothemes.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.0.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $post;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="product_add-to-cart-w" method="post" enctype='multipart/form-data'>
	<table cellspacing="0" class="product-group">
		<?php
			$quantites_required = false;
			$previous_post      = $post;

			foreach ( $grouped_products as $grouped_product ) {
				$post_object        = get_post( $grouped_product->get_id() );
				$quantites_required = $quantites_required || ( $grouped_product->is_purchasable() && ! $grouped_product->has_options() );

				setup_postdata( $post =& $post_object );
				?>
				<tr>
					<td>
						<?php if ( ! $grouped_product->is_purchasable() || $grouped_product->has_options() ) : ?>
							<?php woocommerce_template_loop_add_to_cart(); ?>
						<?php elseif ( $grouped_product->is_sold_individually() ) : ?>
							<input type="checkbox" name="<?php echo esc_attr( 'quantity[' . $grouped_product->get_id() . ']' ); ?>" value="1" class="wc-grouped-product-add-to-cart-checkbox" />
						<?php else : ?>
							<?php
								do_action( 'woocommerce_before_add_to_cart_quantity' );

								woocommerce_quantity_input( array(
									'class' => '__bold_round',
									'input_name'  => 'quantity[' . $grouped_product->get_id() . ']',
									'input_value' => isset( $_POST['quantity'][ $grouped_product->get_id() ] ) ? wc_stock_amount( $_POST['quantity'][ $grouped_product->get_id() ] ) : 0,
									'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product ),
									'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product->get_max_purchase_quantity(), $grouped_product ),
								) );

								do_action( 'woocommerce_after_add_to_cart_quantity' );
							?>
						<?php endif; ?>
					</td>

					<td class="label">
						<label for="product-<?php echo $grouped_product->get_id(); ?>">
							<?php
							if ($product->is_visible()) {
								echo '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink(), $grouped_product->get_id() ) ) . '">' . $grouped_product->get_name()  . '</a>';
							} else {
								$grouped_product->get_name();
							}
							?>
						</label>
					</td>

					<?php do_action ( 'woocommerce_grouped_product_list_before_price', $product ); ?>

					<td class="price">
						<?php
							echo $grouped_product->get_price_html();
							echo wc_get_stock_html( $grouped_product );
						?>
					</td>
				</tr>
				<?php
			}

			setup_postdata( $post =& $previous_post );
		?>
	</table>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>">

	<?php if ( $quantites_required ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<button type="submit" class="single_add_to_cart_button button alt"><span class="icon-bag"></span> <span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
