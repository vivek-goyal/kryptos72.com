<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="product_price price"><?php echo wp_kses($product->get_price_html(), 'post'); ?></p>

	<meta itemprop="price" content="<?php echo esc_attr( $product->get_display_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php
		if ($product->is_in_stock()) { echo 'InStock'; } else { echo 'OutOfStock'; }
	?>" />

</div>
