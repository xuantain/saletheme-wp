<?php global $product; ?>
<li class="row">
	<div class="col-xs-4 widget-image img-responsive">
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo $product->get_image(); ?>
		</a>
	</div>
	<div class="col-xs-8 widget-text">
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>">
			<span><?php echo $product->get_title(); ?></span>
		</a>
		<?php if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>
		<?php echo $product->get_price_html(); ?>
	</div>
</li>
