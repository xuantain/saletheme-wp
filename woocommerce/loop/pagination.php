<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version		 2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

if ( $wp_query->max_num_pages <= 1 )
	return;
?>
<div class="grid_pagination">
	<?php
		// echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
		// 	'base'				 => esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
		// 	'format' 		=> '',
		// 	'current' 		=> max( 1, get_query_var('paged') ),
		// 	'total' 		=> $wp_query->max_num_pages,
		// 	'prev_text' 	=> '',
		// 	'next_text' 	=> '',
		// 	'type'			=> 'list',
		// 	'end_size'		=> 1,
		// 	'mid_size'		=> 2
		// ) ) );
		$big = 999999999; // need an unlikely integer
		$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'prev_next' => false,
			'type'	=> 'array',
			'prev_next'	 => TRUE,
			'prev_text'		=> __('«'),
			'next_text'		=> __('»'),
		) );
		if( is_array( $pages ) ) {
				$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
				echo '<ul class="pagination">';
				foreach ( $pages as $page ) {
					echo "<li class='page-item'>$page</li>";
				}
				echo '</ul>';
		 }
	?>
</div>
