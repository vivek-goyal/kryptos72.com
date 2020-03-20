<?php
/**
 * Wishlist page template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.12
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly
?>

<?php do_action( 'yith_wcwl_before_wishlist_form', $wishlist_meta ); ?>

<form
	id="yith-wcwl-form"
	class="wishlist"
	action="<?php echo $form_action ?>"
	method="post"
>

	<!-- TITLE -->
	<?php
	do_action( 'yith_wcwl_before_wishlist_title' );

	if( ! empty( $page_title ) ) :
	?>
		<div class="wishlist-title <?php echo ( $is_custom_list ) ? 'wishlist-title-with-form' : ''; ?>">
			<?php if( $is_custom_list ): ?>
				<a class="btn button show-title-form">
					<?php echo apply_filters( 'yith_wcwl_edit_title_icon', '<i class="fa fa-pencil"></i>' )?>
					<?php esc_html_e( 'Edit title', 'yith-woocommerce-wishlist' ) ?>
				</a>
			<?php endif; ?>
		</div>
		<?php if( $is_custom_list ): ?>
			<div class="hidden-title-form">
				<input type="text" value="<?php echo esc_attr($page_title); ?>" name="wishlist_name">
				<button>
					<?php echo apply_filters( 'yith_wcwl_save_wishlist_title_icon', '<i class="fa fa-check"></i>' )?>
					<?php esc_html_e( 'Save', 'yith-woocommerce-wishlist' )?>
				</button>
				<a class="hide-title-form btn button">
					<?php echo apply_filters( 'yith_wcwl_cancel_wishlist_title_icon', '<i class="fa fa-remove"></i>' )?>
					<?php esc_html_e( 'Cancel', 'yith-woocommerce-wishlist' )?>
				</a>
			</div>
		<?php endif; ?>
	<?php
	endif;

	do_action( 'yith_wcwl_before_wishlist' ); ?>

	<!-- WISHLIST TABLE -->
	<div class="cart-lst-w __full-width">
	<table
		class="shop_table cart wishlist_table cart-lst text-left"
		cellspacing="0"
		data-pagination="<?php echo esc_attr( $pagination )?>"
		data-per-page="<?php echo esc_attr( $per_page )?>"
		data-page="<?php echo esc_attr( $current_page )?>"
		data-id="<?php echo $wishlist_id ?>"
		data-token="<?php echo $wishlist_token ?>"
	>

		<?php $column_count = 2; ?>

		<thead>
		<tr>
			<?php if( $show_cb ) : ?>

				<th class="product-checkbox cart-lst-el_h">
					<input type="checkbox" value="" name="" id="bulk_add_to_cart"/>
				</th>

			<?php
				$column_count ++;
			endif;
			?>

			<?php if( $is_user_owner ): ?>
				<th class="product-remove cart-lst-el_h"></th>
			<?php
				$column_count ++;
			endif;
			?>

			<th class="product-thumbnail cart-lst-el_h"></th>

			<th class="product-name cart-lst-el_h text-left">
				<span class="nobr"><?php echo apply_filters( 'yith_wcwl_wishlist_view_name_heading', esc_html__( 'Product Name', 'yith-woocommerce-wishlist' ) ) ?></span>
			</th>

			<?php if( $show_price ) : ?>

				<th class="product-price cart-lst-el_h">
					<span class="nobr">
						<?php echo apply_filters( 'yith_wcwl_wishlist_view_price_heading', esc_html__( 'Price', 'yith-woocommerce-wishlist' ) ) ?>
					</span>
				</th>

			<?php
				$column_count ++;
			endif;
			?>

			<?php if( $show_stock_status ) : ?>

				<th class="product-stock-stauts cart-lst-el_h">
					<span class="nobr">
						<?php echo apply_filters( 'yith_wcwl_wishlist_view_stock_heading', esc_html__( 'Stock Status', 'yith-woocommerce-wishlist' ) ) ?>
					</span>
				</th>

			<?php
				$column_count ++;
			endif;
			?>

			<?php if( $show_last_column ) : ?>

				<?php if( $show_dateadded ): ?>
					<th class="product-date-added cart-lst-el_h"></th>
				<?php endif; ?>

				<th class="product-add-to-cart cart-lst-el_h"></th>

				<?php if( $is_user_owner && $repeat_remove_button ): ?>
					<th class="product-remove cart-lst-el_h"></th>
				<?php endif; ?>

			<?php
				$column_count ++;
			endif;
			?>
		</tr>
		</thead>

		<tbody>
		<?php
		if( count( $wishlist_items ) > 0 ) :
			$added_items = array();
			foreach( $wishlist_items as $item ) :
				global $product;

				$item['prod_id'] = yit_wpml_object_id ( $item['prod_id'], 'product', true );
				
				if( in_array( $item['prod_id'], $added_items ) ){
					continue;
				}

				$added_items[] = $item['prod_id'];
	            $product = wc_get_product( $item['prod_id'] );
	            $availability = $product->get_availability();
	            $stock_status = $availability['class'];				

				if( $product && $product->exists() ) :
					?>
					<tr id="yith-wcwl-row-<?php echo esc_attr($item['prod_id']); ?>" data-row-id="<?php echo esc_attr($item['prod_id']); ?>">
						<?php if( $show_cb ) : ?>
							<td class="product-checkbox cart-lst-el_cnt">
								<input type="checkbox" value="<?php echo esc_attr( $item['prod_id'] ) ?>" name="add_to_cart[]" <?php echo ( ! $product->is_type( 'simple' ) ) ? 'disabled="disabled"' : '' ?>>
							</td>
						<?php endif ?>

						<?php if( $is_user_owner ): ?>
						<td class="product-remove cart-lst-el_cnt text-left __remove">
							<div>
								<a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id'] ) ) ?>" class="remove remove_from_wishlist cart-lst-el_remove" title="<?php esc_html_e( 'Remove this product', 'yith-woocommerce-wishlist' ) ?>"><i class="fa fa-times"></i></a>
							</div>
						</td>
						<?php endif; ?>

						<td class="product-thumbnail cart-lst-el_cnt __thumbnail-s">
							<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>">
								<?php echo wp_kses($product->get_image(), 'post'); ?>
							</a>
						</td>

						<td class="product-name cart-lst-el_cnt __product">
							<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>"><?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ?></a>
						</td>

						<?php if( $show_price ) : ?>
							<td class="product-price cart-lst-el_cnt __price">
								<?php echo $product->get_price() ? $product->get_price_html() : apply_filters( 'yith_free_text', __( 'Free!', 'yith-woocommerce-wishlist' ) ); ?>
							</td>
						<?php endif ?>

						<?php if( $show_stock_status ) : ?>
							<td class="product-stock-status cart-lst-el_cnt">
								<?php
								if( $stock_status == 'out-of-stock' ) {
									$stock_status = "Out";
									echo '<b class="wishlist-out-of-stock">' . esc_html__( 'Out of Stock', 'yith-woocommerce-wishlist' ) . '</b>';
								} else {
									$stock_status = "In";
									echo '<b class="wishlist-in-stock">' . esc_html__( 'In Stock', 'yith-woocommerce-wishlist' ) . '</b>';
								}
								?>
							</td>
						<?php endif ?>

						<?php if( $show_last_column ): ?>
						<?php
						if( $show_dateadded && isset( $item['dateadded'] ) ):
							echo '<td class="product-date-added cart-lst-el_cnt"><span class="dateadded">' . sprintf( esc_html__( 'Added on: %s', 'yith-woocommerce-wishlist' ), date_i18n( get_option( 'date_format' ), strtotime( $item['dateadded'] ) ) ) . '</span></td>';
						endif;
						?>

						<td class="product-add-to-cart cart-lst-el_cnt">
							<?php if ($show_add_to_cart && isset($stock_status) && $stock_status != 'Out') { ?>
								<?php woocommerce_template_loop_add_to_cart(); ?>
							<?php } ?>

							<!-- Change wishlist -->
							<?php if( $available_multi_wishlist && is_user_logged_in() && count( $users_wishlists ) > 1 && $move_to_another_wishlist && $is_user_owner ): ?>
							<select class="change-wishlist selectBox">
								<option value=""><?php esc_html_e( 'Move', 'yith-woocommerce-wishlist' ) ?></option>
								<?php
								foreach( $users_wishlists as $wl ):
									if( $wl['wishlist_token'] == $wishlist_meta['wishlist_token'] ){
										continue;
									}

								?>
									<option value="<?php echo esc_attr( $wl['wishlist_token'] ) ?>">
										<?php
										$wl_title = ! empty( $wl['wishlist_name'] ) ? esc_html( $wl['wishlist_name'] ) : esc_html( $default_wishlsit_title );
										if( $wl['wishlist_privacy'] == 1 ){
											$wl_privacy = esc_html__( 'Shared', 'yith-woocommerce-wishlist' );
										}
										elseif( $wl['wishlist_privacy'] == 2 ){
											$wl_privacy = esc_html__( 'Private', 'yith-woocommerce-wishlist' );
										}
										else{
											$wl_privacy = esc_html__( 'Public', 'yith-woocommerce-wishlist' );
										}

										echo sprintf( '%s - %s', $wl_title, $wl_privacy );
										?>
									</option>
								<?php
								endforeach;
								?>
							</select>
							<?php endif; ?>
						</td>

						<?php if( $is_user_owner && $repeat_remove_button ): ?>
						<td class="product-remove cart-lst-el_cnt">
								<a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id'] ) ) ?>" class="remove_from_wishlist button" title="<?php esc_html_e( 'Remove this product', 'yith-woocommerce-wishlist' ) ?>"><?php esc_html_e( 'Remove', 'yith-woocommerce-wishlist' ) ?></a>
						</td>
						<?php endif; ?>
					<?php endif; ?>
					</tr>
				<?php
				endif;
			endforeach;
		else: ?>
			<tr>
				<td colspan="<?php echo esc_attr( $column_count ) ?>" class="wishlist-empty cart-lst-el_cnt"><?php esc_html_e( 'No products were added to the wishlist', 'yith-woocommerce-wishlist' ) ?></td>
			</tr>
		<?php
		endif;

		if( ! empty( $page_links ) ) : ?>
			<tr class="pagination-row">
				<td colspan="<?php echo esc_attr( $column_count ); ?>" class="cart-lst-el_cnt"><?php echo wp_kses($page_links, 'post'); ?></td>
			</tr>
		<?php endif ?>
		</tbody>

		<tfoot>
		<tr>
			<td colspan="<?php echo esc_attr( $column_count ) ?>" class="cart-lst-el_f">
				<?php if( $show_cb ) : ?>
					<span class="custom-add-to-cart-button-cotaniner">
						<a href="<?php echo esc_url( add_query_arg( array( 'wishlist_products_to_add_to_cart' => '', 'wishlist_token' => $wishlist_token ) ) ) ?>" class="button alt" id="custom_add_to_cart"><?php esc_html_e( 'Add the selected products to the cart', 'yith-woocommerce-wishlist' ) ?></a>
					</span> &nbsp;
				<?php endif; ?>

				<?php if ( $is_user_owner && $show_ask_estimate_button && $count > 0 ): ?>
					<span class="ask-an-estimate-button-container">
						<a
							href="<?php
							if ($additional_info || !is_user_logged_in()) { echo '#ask_an_estimate_popup'; } else { esc_url($ask_estimate_url); }
							?>"
							class="btn button ask-an-estimate-button"
							<?php if ($additional_info) { echo 'data-rel="prettyPhoto[ask_an_estimate]"'; } ?>
						>
						<?php echo apply_filters( 'yith_wcwl_ask_an_estimate_icon', '<i class="fa fa-shopping-cart"></i>' )?>
						<span><?php esc_html_e( 'Ask for an estimate', 'yith-woocommerce-wishlist' ) ?></span>
						</a>
					</span> &nbsp;
				<?php endif; ?>

				<?php
				do_action( 'yith_wcwl_before_wishlist_share' );

				if ( is_user_logged_in() && $is_user_owner && ! $is_private && $share_enabled ){
					yith_wcwl_get_template( 'share.php', $share_atts );
				}

				do_action( 'yith_wcwl_after_wishlist_share' );
				?>
			</td>
		</tr>
		</tfoot>

	</table>
	</div>

	<?php wp_nonce_field( 'yith_wcwl_edit_wishlist_action', 'yith_wcwl_edit_wishlist' ); ?>

	<?php if( ! $is_default ): ?>
		<input type="hidden" value="<?php echo esc_attr($wishlist_token); ?>" name="wishlist_id" id="wishlist_id">
	<?php endif; ?>

	<?php do_action( 'yith_wcwl_after_wishlist' ); ?>

</form>

<?php do_action( 'yith_wcwl_after_wishlist_form', $wishlist_meta ); ?>

<?php if( $show_ask_estimate_button && ( ! is_user_logged_in() || $additional_info ) ): ?>
	<div id="ask_an_estimate_popup">
		<form action="<?php echo esc_url($ask_estimate_url); ?>" method="post" class="wishlist-ask-an-estimate-popup">
			<?php if( ! empty( $additional_info_label ) ):?>
				<label for="additional_notes"><?php echo esc_html( $additional_info_label ) ?></label>
			<?php endif; ?>
			<textarea id="additional_notes" name="additional_notes"></textarea>

			<button class="btn button ask-an-estimate-button ask-an-estimate-button-popup" >
				<?php echo apply_filters( 'yith_wcwl_ask_an_estimate_icon', '<i class="fa fa-shopping-cart"></i>' )?>
				<?php esc_html_e( 'Ask for an estimate', 'yith-woocommerce-wishlist' ) ?>
			</button>
		</form>
	</div>
<?php endif; ?>
